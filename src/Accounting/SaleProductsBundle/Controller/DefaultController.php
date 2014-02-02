<?php

namespace Accounting\SaleProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Common\DataBundle\Entity\SaleTimePrice;
use Common\DataBundle\Entity\Customer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingSaleProductsBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:SaleTimePrice');

        $query = $repository->createQueryBuilder('stp')
                ->select('stp, u, p, c')
//                ->addSelect('NEW SaleTimePriceDTO((stp.sale_price * stp.quantity) as amount)')
                ->leftJoin('stp.product', 'p')
                ->leftJoin('p.unit', 'u')
                ->leftJoin('stp.customer', 'c')
                ->orderBy('stp.id', 'desc')
                ->getQuery();
        $timePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        
//        $em = $this->getDoctrine()->getManager();
//        $query = $em->createQuery(
//            'SELECT stp, u, p, c FROM Common\DataBundle\Entity\SaleTimePrice stp JOIN stp.product p JOIN p.unit u JOIN stp.customer c'
//        );
//        $timePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        $response = new Response(json_encode($timePrices));

        return $response;
    }

    public function createAction(Request $request)
    {
        $models = json_decode($request->get('models'));

        if (empty($models[0]->id)) {
            $sp = new SaleTimePrice();
        } else {
            $sp = $this->getDoctrine()
                ->getRepository('CommonDataBundle:SaleTimePrice')
                ->find($models[0]->id);
        }

        $product = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Product')
                ->find($models[0]->product->id);
        $sp->setProduct($product);
        $customer = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Customer')
                ->find($models[0]->customer->id);
        $sp->setCustomer($customer);

        $sp->setCurrencyPrice(0);
        $sp->setLocalPrice($models[0]->local_price);
        $sp->setSalePrice($models[0]->sale_price);
        $sp->setCurrencyRate(0);
        $sp->setPriceDate(new \DateTime($models[0]->price_date));
        $sp->setQuantity($models[0]->quantity);
        $sp->setUpdatedAt(new \DateTime('now'));
        if (empty($models[0]->id)) {
            $sp->setCreatedAt(new \DateTime('now'));
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($sp);
        $em->flush();

        $models[0]->id = $sp->getId();

        $response = new Response(json_encode($models[0]));

        return $response;
    }
    
    public function createCustomerAction(Request $request)
    {
        $models = json_decode($request->get('models'));

        if (empty($models[0]->id)) {
            $customer = new Customer();
        } else {
            $customer = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Customer')
                ->find($models[0]->id);
        }

        $customer->setName($models[0]->name);
        $customer->setAddress($models[0]->address);
        $customer->setEmail("");
        $customer->setTelephone($models[0]->telephone);
        $customer->setDescription($models[0]->description);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($customer);
        $em->flush();

        $models[0]->id = $customer->getId();

        $response = new Response(json_encode($models[0]));

        return $response;
    }

    public function deleteAction()
    {
        return $this->render('AccountingSaleProductsBundle:Default:index.html.twig');
    }
}
