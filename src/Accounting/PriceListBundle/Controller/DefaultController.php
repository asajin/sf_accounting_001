<?php

namespace Accounting\PriceListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingPriceListBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('CommonDataBundle:Product');
        $query = $repository->createQueryBuilder('p')
            ->select('p, u')
            ->leftJoin('p.unit', 'u')
            ->where('p.last_sale_price > 0')
            ->getQuery();
        $products = $query->getResult(Query::HYDRATE_ARRAY);

        $response = new Response(json_encode($products));

        return $response;
    }
}
