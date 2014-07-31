<?php

namespace Accounting\WarehouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingWarehouseBundle:Default:index.html.twig');
    }

    public function listAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $month = '';
        $filter = $request->get('filter');
        if($filter['filters'][0]['field'] == 'price_date') {
            $month = $filter['filters'][0]['value'];
            $month = trim(str_replace(array('(GTB Standard Time)', '(GTB Daylight Time)'), '', $month));
        }

        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:MonthlyTimePrice');

        $current_month = new \DateTime($month);
        $current_month->modify("last day of this month");
        $current_month = new \DateTime($current_month->format('Y-m-t 23:59:59'));
        
        $previous_month = new \DateTime($month);
        $previous_month->modify("last day of previous month");
        $previous_month = new \DateTime($previous_month->format('Y-m-t 23:59:59'));

        $query = $repository->createQueryBuilder('mtp')
                ->select('p.id, p.code, p.name as product_name, u.name as unit')
                ->addSelect('mtp.stock as first_stock')
                ->addSelect('mtp.amount as first_amount')
                ->leftJoin('mtp.product', 'p')
                ->leftJoin('p.unit', 'u')
                ->where('mtp.amount_date = :date_end')
                    ->setParameter('date_end', $previous_month)
                ->getQuery();
        $products1 = $query->getResult(Query::HYDRATE_ARRAY);
        $result = array();
        $item = array('first_stock' => 0, 'first_amount' => 0, 
            'income_stock' => 0, 'income_amount' => 0, 
            'expense_stock' => 0, 'expense_amount' => 0,
            'last_stock' => 0, 'last_amount' => 0);
        foreach($products1 as $product) {
            $product = array_filter($product);
            $result[$product['id']] = array_merge($item, $product);
        }

        $query = $repository->createQueryBuilder('mtp')
                ->select('p.id, p.code, p.name as product_name, u.name as unit')
                ->addSelect('mtp.supply_quantity as income_stock')
                ->addSelect('mtp.supply_amount as income_amount')
                ->addSelect('mtp.sale_quantity as expense_stock')
                ->addSelect('mtp.sale_amount as expense_amount')
                ->addSelect('mtp.stock as last_stock')
                ->addSelect('mtp.amount as last_amount')
                ->leftJoin('mtp.product', 'p')
                ->leftJoin('p.unit', 'u')
                ->where('mtp.amount_date = :date_end')
                    ->setParameter('date_end', $current_month)
                ->getQuery();
        $products2 = $query->getResult(Query::HYDRATE_ARRAY);
        foreach($products2 as $product) {
            if(empty($result[$product['id']])) {
                $product = array_filter($product);
                $product = array_merge($item, $product);
                $result[$product['id']] = $product;
            } else {
                $result[$product['id']] = array_merge($result[$product['id']], $product);
            }
        }

        $result = array_values($result);
        $response = new Response(json_encode($result));

        return $response;
    }
}
