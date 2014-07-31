<?php

namespace Accounting\ProfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * 
     * @Route("", name="AccountingProfitBundle_index")
     * @Method({"GET"})
     * 
     * @return type
     */
    public function indexAction()
    {
        return $this->render('AccountingProfitBundle:Default:index.html.twig');
    }
    
    /**
     * 
     * @Route(
     *  "list.{_format}", 
     *  name="AccountingProfitBundle_list", 
     *  requirements = { "_format" = "json" }, 
     *  defaults={"_format" = "json", "_locale": "en"}
     * )
     * @Method({"GET"})
     * 
     * @return type
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:SaleTimePrice');
        $query = $repository->createQueryBuilder('stp')
                ->select('SUBSTRING(stp.price_date, 1, 7) as month')
                ->addSelect('sum(stp.sale_price * stp.quantity) as products_sales')
                ->groupBy('month')
                ->getQuery();
        
        $saleTimePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $salesResult = array();
        foreach ($saleTimePrices as $value) {
            $salesResult[$value['month']] = $value;
        }
        
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:MonthlyTimePrice');
        $query = $repository->createQueryBuilder('mtp')
                ->select('SUBSTRING(mtp.amount_date, 1, 7) as month')
                ->addSelect('sum(mtp.sale_amount) as products_costs')
                ->groupBy('month')
                ->getQuery();
        
        $timePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $costsResult = array();
        foreach ($timePrices as $value) {
            $costsResult[$value['month']] = $value;
        }

        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:ChargeTimePrice');
        $query = $repository->createQueryBuilder('ctp')
                ->select('SUBSTRING(ctp.price_date, 1, 7) as month')
                ->addSelect('sum(ctp.local_price * ctp.quantity) as direct_charges')
                ->groupBy('month')
                ->getQuery();
        
        $chargeTimePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $result = array();
        $index = 0;
        
        foreach ($chargeTimePrices as $value) {
            $result[$index] = $value;
            $result[$index]['id'] = $index;
            if(empty($salesResult[$value['month']]))
                $result[$index]['products_sales'] = 0;
            else
                $result[$index]['products_sales'] = $salesResult[$value['month']]['products_sales'];
            
            if(empty($costsResult[$value['month']]))
                $result[$index]['products_costs'] = 0;
            else
                $result[$index]['products_costs'] = $costsResult[$value['month']]['products_costs'];
            
            $result[$index]['profit'] = $result[$index]['products_sales'] - $result[$index]['products_costs'] - $result[$index]['direct_charges'];
            $index++;
        }
        
        $response = new Response(json_encode($result));

        return $response;
    }

    /**
     * 
     * @Route("filter", name="AccountingProfitBundle_filter")
     * @Method({"GET"})
     * 
     * @return type
     */
    public function filterAction()
    {
        return $this->render('AccountingProfitBundle:Default:filter.html.twig');
    }
}
