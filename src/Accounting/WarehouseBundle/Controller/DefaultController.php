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
                ->getRepository('CommonDataBundle:Product');

        $current_month = new \DateTime($month);
        $current_month->modify("last day of this month");
        $previous_month = new \DateTime($month);
        $previous_month->modify("last day of previous month");
//        echo $current_month->format("Y-m-d");
//        echo $previous_month->format("Y-m-d");

        $query = $repository->createQueryBuilder('p')
                ->select('p.id, p.code, p.name as product_name, u.name as unit')
                ->addSelect('(sum(tp.stock)-sum(stp.quantity)) as first_stock')
                ->addSelect('(sum(tp.stock*tp.local_price)-sum(stp.quantity*stp.local_price)) as first_amount')
                ->leftJoin('p.time_prices', 'tp')
                ->leftJoin('p.sale_time_prices', 'stp')
                ->leftJoin('p.unit', 'u')
                ->where('(tp.price_date <= :date_end OR stp.price_date <= :date_end)')
                ->setParameter('date_end', $previous_month)
                ->groupBy('p.id')
                ->having('first_stock <> 0')
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

        $query = $repository->createQueryBuilder('p')
                ->select('p.id, p.code, p.name as product_name, u.name as unit')
                ->addSelect('sum(tp.stock) as income_stock')
                ->addSelect('sum(tp.stock*tp.local_price) as income_amount')
                ->addSelect('sum(stp.quantity) as expense_stock')
                ->addSelect('sum(stp.quantity*stp.local_price) as expense_amount')
                ->leftJoin('p.time_prices', 'tp')
                ->leftJoin('p.sale_time_prices', 'stp')
                ->leftJoin('p.unit', 'u')
                ->where('(tp.price_date <= :date_end OR stp.price_date <= :date_end)')
                ->andWhere('(tp.price_date > :date_start OR stp.price_date > :date_end)')
                ->setParameter('date_start', $previous_month)
                ->setParameter('date_end', $current_month)
                ->groupBy('p.id')
                ->having('income_stock <> 0 OR expense_stock <> 0')
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

        $query = $repository->createQueryBuilder('p')
                ->select('p.id, p.code, p.name as product_name, u.name as unit')
                ->addSelect('(sum(tp.stock)-sum(stp.quantity)) as last_stock')
                ->addSelect('(sum(tp.stock*tp.local_price)-sum(stp.quantity*stp.local_price)) as last_amount')
                ->leftJoin('p.time_prices', 'tp')
                ->leftJoin('p.sale_time_prices', 'stp')
                ->leftJoin('p.unit', 'u')
                ->where('(tp.price_date <= :date_end OR stp.price_date <= :date_end)')
                ->andWhere('(tp.id IS NOT NULL OR stp.id IS NOT NULL)')
                ->setParameter('date_end', $current_month)
                ->groupBy('p.id')
                ->having('last_stock <> 0')
                ->getQuery();
        $products3 = $query->getResult(Query::HYDRATE_ARRAY);
        foreach($products3 as $product) {
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
