<?php

namespace Accounting\ChargesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

use Common\DataBundle\Entity\Charge;
use Common\DataBundle\Entity\ChargeTimePrice;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingChargesBundle:Default:index.html.twig');
    }

    public function listAction(Request $request)
    {
//        $month = '2013-08-01';
        $month = '';
        $filter = $request->get('filter');
        
//        var_dump($filter);exit;
        if($filter['filters'][0]['field'] == 'price_date') {
            $month = $filter['filters'][0]['value'];
            $month = trim(str_replace(array('(GTB Standard Time)', '(GTB Daylight Time)'), '', $month));
        }

        $last_month = new \DateTime($month);
        $last_month->modify("last day of this month");
//        echo $last_month->format("Y-m-d");;
        $first_month = new \DateTime($month);
        $first_month->modify("first day of this month");
//        echo $first_month->format("Y-m-d");;

        $repository = $this->getDoctrine()
            ->getRepository('CommonDataBundle:ChargeTimePrice');
        $query = $repository->createQueryBuilder('ctp')
            ->select('ctp, c, u')
            ->leftJoin('ctp.charge', 'c')
            ->leftJoin('c.unit', 'u')
            ->where('(ctp.price_date >= :date_start AND ctp.price_date <= :date_end)')
            ->setParameter('date_start', $first_month)
            ->setParameter('date_end', $last_month)
            ->getQuery();
        $charges = $query->getResult(Query::HYDRATE_ARRAY);

        $response = new Response(json_encode($charges));

        return $response;
    }
    
    public function loadAction()
    {
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Charge');
        
        $query = $repository->createQueryBuilder('c')
                ->select('c.id, c.name')
                ->getQuery();
        
        $charges = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        array_unshift($charges, array('id' => 0, 'name' => ''));

        return new Response(json_encode(
                                array('charges' => $charges)));
    }
    
    public function createAction(Request $request)
    {
        $models = json_decode($request->get('models'));
        
        if (empty($models->id)) {
            $charge = new ChargeTimePrice();
        } else {
            $charge = $this->getDoctrine()
                ->getRepository('CommonDataBundle:ChargeTimePrice')
                ->find($models->id);
        }
        
//        var_dump($models);exit;
        $chargeType = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Charge')
                ->find($models->charge->id);
        $charge->setCharge($chargeType);
        
        $charge->setPriceDate(new \DateTime($models->price_date));
        $charge->setQuantity($models->quantity);
        $charge->setLocalPrice($models->local_price);
        $charge->setBuyAmount($models->buy_amount);
        $charge->setUpdatedAt(new \DateTime('now'));
        if (empty($models->id)) {
            $charge->setCreatedAt(new \DateTime('now'));
        }
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($charge);
        $em->flush();
        
        $models->id = $charge->getId();

        $response = new Response(json_encode($models));

        return $response;
    }

    public function createChargeAction(Request $request)
    {
        $models = json_decode($request->get('models'));
        
        if (empty($models[0]->id)) {
            $charge = new Charge();
        } else {
            $charge = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Charge')
                ->find($models[0]->id);
        }
        
        $charge->setName($models[0]->name);
        $charge->setLastBuyPrice(0);
        $charge->setLastQuantity(0);
        $charge->setLastAddDate(new \DateTime('now'));
        $charge->setDescription("");
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($charge);
        $em->flush();
        
        $models[0]->id = $charge->getId();

        $response = new Response(json_encode($models[0]));

        return $response;
    }
}
