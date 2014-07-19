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
     * @Route("list", name="AccountingProfitBundle_list")
     * @Method({"GET"})
     * 
     * @return type
     */
    public function listAction()
    {
//                month: {type: "date"},
//                products_sales: {type: "number"},
//                products_costs: {type: "number"},
//                direct_charges: {type: "number"},
//                indirect_charges: {type: "number"},
//                profit: {type: "number"}
        

        
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:SaleTimePrice');
        $query = $repository->createQueryBuilder('stp')
                ->select('SUBSTRING(stp.price_date, 1, 7) as price_date_month')
                ->addSelect('sum(stp.quantity) as sum_quantity')
                ->addSelect('sum(stp.sale_price * stp.quantity) as sale_amount')
                ->groupBy('price_date_month')
                ->getQuery();
        
        $saleTimePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:TimePrice');
        $query = $repository->createQueryBuilder('tp')
                ->select('SUBSTRING(tp.price_date, 1, 7) as price_date_month')
                ->addSelect('sum(tp.stock) as sum_stock')
                ->addSelect('sum(tp.local_price * tp.stock) as buy_amount')
                ->groupBy('price_date_month')
                ->getQuery();
        
        $timePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        $result = array();
        $index = 0;
        foreach ($saleTimePrices as $key => $sale) {
            foreach ($timePrices as $buy) {
                if($sale['price_date_month'] == $buy['price_date_month']) {
                    $result[$index] = $sale;
                    $result[$index]['sum_stock'] = $buy['sum_stock'];
                    $result[$index++]['buy_amount'] = $buy['buy_amount'];
                    break;
                }
            }
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
