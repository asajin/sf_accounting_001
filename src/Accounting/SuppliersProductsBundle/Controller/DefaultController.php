<?php

namespace Accounting\SuppliersProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Common\DataBundle\Entity\Product;
use Common\DataBundle\Entity\Supplier;
use Common\DataBundle\Entity\Unit;
use Common\DataBundle\Entity\TimePrice;
use Common\DataBundle\Entity\MonthlyTimePrice;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('AccountingSuppliersProductsBundle:Default:index.html.twig');
    }

    public function filterAction()
    {
        return $this->render('AccountingSuppliersProductsBundle:Default:filter.html.twig');
    }

    public function listFilteredAction(Request $request)
    {
        $filter = $request->get('filter');

        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:TimePrice');

        $query = $repository->createQueryBuilder('tp')
                ->select('tp.local_price as local_price')
                ->addSelect('tp.currency_price as currency_price')
                ->addSelect('tp.currency_rate as currency_rate')
                ->addSelect('tp.price_date as price_date')
                ->addSelect('u.name as unit')
                ->addSelect('tp.stock as stock')
                ->addSelect('p.name as product_name')
                ->addSelect('s.name as supplier_name')
                ->addSelect('(tp.local_price * tp.stock) as amount')
                ->leftJoin('tp.product', 'p')
                ->leftJoin('tp.supplier', 's')
                ->leftJoin('p.unit', 'u');

        if($filter) {
            foreach ($filter['filters'] as $value) {
                switch ($value['field']) {
                    case 'local_price':
                        break;
                    case 'currency_price':
                        break;
                    case 'price_date':
                        $this->filterPriceDate($query, $value);
                        break;
                    case 'unit':
                        break;
                    case 'stock':
                        break;
                    case 'product_name':
                        $query->andWhere('p.name LIKE :product_name')
                            ->setParameter('product_name', '%'.$value['value'].'%');
                        break;
                    case 'supplier_name':
                        $query->andWhere('s.name LIKE :supplier_name')
                            ->setParameter('supplier_name', '%'.$value['value'].'%');
                        break;
                    case 'amount':
                        break;
                    default:
                        break;
                }
                
                if(isset($value['filters'])) {
                    $logic = $value['logic'];
                    foreach ($value['filters'] as $filterValue) {
                        switch ($filterValue['field']) {
                            case 'price_date':
                                $this->filterPriceDate($query, $filterValue);
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }

        $timePrices = $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_SCALAR);

        $response = new Response(json_encode($timePrices));

        return $response;
    }
    
    private function filterPriceDate(&$query, $field)
    {
        $value = trim(str_replace(array('(GTB Standard Time)', '(GTB Daylight Time)'), '', $field['value']));
        
        switch ($field['operator']) {
            case 'gte':
                $query->andWhere('tp.price_date >= :time_price_gte')
                    ->setParameter('time_price_gte', new \DateTime($value));
                break;
            case 'eq':
                $query->andWhere('tp.price_date = :time_price_eq')
                    ->setParameter('time_price_eq', new \DateTime($value));
                break;
            case 'lte':
                $query->andWhere('tp.price_date <= :time_price_lte')
                    ->setParameter('time_price_lte', new \DateTime($value));
                break;
            default:
                break;
        }
    }

    public function newAction()
    {
        return $this->render('AccountingSuppliersProductsBundle:Default:new.html.twig');
    }

    public function listAction()
    {
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:TimePrice');
        $query = $repository->createQueryBuilder('tp')
                ->select('tp.local_price as local_price')
                ->addSelect('tp.currency_price as currency_price')
                ->addSelect('tp.currency_rate as currency_rate')
                ->addSelect('tp.price_date as price_date')
                ->addSelect('u.name as unit')
                ->addSelect('tp.stock as stock')
                ->addSelect('p.name as product_name')
                ->addSelect('s.name as supplier_name')
                ->addSelect('(tp.local_price * tp.stock) as amount')
                ->leftJoin('tp.product', 'p')
                ->leftJoin('tp.supplier', 's')
                ->leftJoin('p.unit', 'u')
                ->getQuery();

        $timePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_SCALAR);

        $response = new Response(json_encode($timePrices));

        return $response;
    }

    public function listFullAction()
    {
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:TimePrice');

        $query = $repository->createQueryBuilder('tp')
                ->select('tp, p, s, u')
                ->leftJoin('tp.product', 'p')
                ->leftJoin('tp.supplier', 's')
                ->leftJoin('p.unit', 'u')
                ->orderBy('tp.price_date', 'DESC')
                ->getQuery();

        $timePrices = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $response = new Response(json_encode($timePrices));

        return $response;
    }

    public function createAction(Request $request)
    {
        $models = json_decode($request->get('models'));

        if (empty($models[0]->id)) {
            $sp = new TimePrice();
        } else {
            $sp = $this->getDoctrine()
                ->getRepository('CommonDataBundle:TimePrice')
                ->find($models[0]->id);
        }

        $product = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Product')
                ->find($models[0]->product->id);
        if(empty($models[0]->id)) {
            $product->setLastSalePrice($models[0]->sale_price);
            $product->setLastLocalPrice($models[0]->local_price);
            $product->setLastStock($models[0]->stock);
            $product->setLastAddDate(new \DateTime('now'));
        }
        $sp->setProduct($product);

        $supplier = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Supplier')
                ->find($models[0]->supplier->id);
        $sp->setSupplier($supplier);

        $sp->setCurrencyPrice($models[0]->currency_price);
        $sp->setLocalPrice($models[0]->local_price);
        $sp->setSalePrice($models[0]->sale_price);
        $sp->setCurrencyRate($models[0]->currency_rate);
        $priceDate = new \DateTime($models[0]->price_date);
        $sp->setPriceDate($priceDate);
        $sp->setStock($models[0]->stock);
        $sp->setUpdatedAt(new \DateTime('now'));
        if (empty($models[0]->id)) {
            $sp->setCreatedAt(new \DateTime('now'));
        }
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $this->updateMonthlyPrice($em, $sp, $priceDate);

        $em->persist($sp);
        $em->flush();

        $models[0]->id = $sp->getId();

        $response = new Response(json_encode($models[0]));

        return $response;
    }
    
    private function updateMonthlyPrice(&$em, TimePrice $sp, \DateTime $priceDate)
    {
        $monthDate = $priceDate;
        
        $repository = $this->getDoctrine()
                ->getRepository('CommonDataBundle:MonthlyTimePrice');
        $query = $repository->createQueryBuilder('mtp')
                ->where('mtp.amount_date >= :time_price_date ')
                    ->setParameter('time_price_date', $priceDate)
                ->getQuery();
        
        $timePrices = $query->getResult();

        if ($timePrices) {
            foreach ($timePrices as $time) {
                $supplyQuantity = $time->getSupplyQuantity() + $sp->getStock();
                $supplyAmount = $time->getSupplyAmount() + ($sp->getStock() * $sp->getLocalPrice());
                
                
                $saleAmount = 0;
                $repository = $this->getDoctrine()
                        ->getRepository('CommonDataBundle:MonthlyTimePrice');
                $query = $repository->createQueryBuilder('mtp')
                        ->where('mtp.amount_date < :time_price_date ')
                            ->setParameter('time_price_date', $time->getAmountDate())
                        ->setMaxResults(1)
                        ->getQuery();
                $timePricePrev = $query->getResult();
                $saleAmount = ( ($timePricePrev->getAmount() + $supplyAmount)/($timePricePrev->getStock() + $supplyQuantity) ) * $time->getSaleQuantity();
                
                $stock = $time->getStock() + $sp->getStock();
                $amount = $time->getAmount() + ($sp->getStock() * $sp->getLocalPrice());
                
                $time->setSupplyQuantity($supplyQuantity);
                $time->setSupplyAmount($supplyAmount);
                $mp->setSaleAmount($saleAmount);
                $time->setStock($stock);
                $time->setAmount($amount);
                $time->setAmountDate($monthDate);

                $em->persist($mp);
            }
        } else {
            $monthDate->modify('last day');
            
            $repository = $this->getDoctrine()
                    ->getRepository('CommonDataBundle:MonthlyTimePrice');
            $query = $repository->createQueryBuilder('mtp')
                    ->where('mtp.amount_date < :time_price_date ')
                        ->setParameter('time_price_date', $monthDate)
                    ->setMaxResults(1)
                    ->getQuery();

            $timePricePrev = $query->getResult();
            
            if($timePricePrev) {
                $supplyQuantity = $sp->getStock();
                $supplyAmount = $sp->getStock() * $sp->getLocalPrice();
                $saleQuantity = 0;
                $saleAmount = 0;
                $stock = $supplyQuantity + $timePricePrev->getStock();
                $amount = $supplyAmount + $timePricePrev->getAmount();
            } else {
                $supplyQuantity = $sp->getStock();
                $supplyAmount = $sp->getStock() * $sp->getLocalPrice();
                $saleQuantity = 0;
                $saleAmount = 0;
                $stock = $supplyQuantity;
                $amount = $supplyAmount;
            }
            
            $mp = new MonthlyTimePrice();
            $mp->setSupplyQuantity($supplyQuantity);
            $mp->setSupplyAmount($supplyAmount);
            $mp->setSaleQuantity($saleQuantity);
            $mp->setSaleAmount($saleAmount);
            $mp->setStock($stock);
            $mp->setAmount($amount);
            $mp->setAmountDate($monthDate);
            
            $em->persist($mp);
        }
    }

    public function deleteAction(Request $request)
    {
        $models = json_decode($request->get('models'));

        $sp = $this->getDoctrine()
                ->getRepository('CommonDataBundle:TimePrice')
                ->find($models[0]->id);

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($sp);
        $em->flush();

        $response = new Response(json_encode($models[0]));

        return $response;
    }

    public function createProductAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $models = json_decode($request->get('models'));

        $product = new Product();
        $product->setCode($models[0]->code);
        $product->setName($models[0]->name);
        $unit = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Unit')
                ->findOneById($models[0]->unit);
        if(empty($unit)) {
            $unit = new Unit();
            $unit->setName($models[0]->unit);
            $em->persist($unit);
        }
        $product->setUnit($unit);
        $product->setLastPrice(0);
        $product->setLastStock(0);
        $product->setLastAddDate(new \DateTime('now'));
        $product->setDescription($models[0]->description);

        $em->persist($product);
        $em->flush();

        $models[0]->id = $product->getId();

        $response = new Response(json_encode($models[0]));

        return $response;
    }

    public function createSupplierAction(Request $request)
    {
        $models = json_decode($request->get('models'));

        $supplier = new Supplier();
        $supplier->setName($models[0]->name);
        $supplier->setAddress($models[0]->address);
        $supplier->setDescription($models[0]->description);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($supplier);
        $em->flush();

        $models[0]->id = $supplier->getId();

        $response = new Response(json_encode($models[0]));

        return $response;
    }

    public function createUnitAction(Request $request)
    {
        $models = json_decode($request->get('models'));

        $unit = new Unit();
        $unit->setName($models[0]->name);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($unit);
        $em->flush();

        $response = new Response(json_encode($models[0]));

        return $response;
    }

    public function dropdownsAction()
    {
        $repositoryProducts = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Product');
        $queryProducts = $repositoryProducts->createQueryBuilder('p')
                ->select('p, u')
                ->leftJoin('p.unit', 'u')
                ->getQuery();
        $products = $queryProducts->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        array_unshift($products, array('id' => 0, 'name' => ''));

        $repositorySuppliers = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Supplier');
        $querySuppliers = $repositorySuppliers->createQueryBuilder('s')
                ->select('s.id, s.name')
                ->getQuery();
        $suppliers = $querySuppliers->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        array_unshift($suppliers, array('id' => 0, 'name' => ''));

        $repositoryUnits = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Unit');
        $queryUnits = $repositoryUnits->createQueryBuilder('u')
                ->select('u.id, u.name')
                ->getQuery();
        $units = $queryUnits->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        array_unshift($units, array('id' => 0, 'name' => ''));
        
        $repositoryCustomers = $this->getDoctrine()
                ->getRepository('CommonDataBundle:Customer');
        $queryCustomers = $repositoryCustomers->createQueryBuilder('c')
                ->select('c.id, c.name')
                ->getQuery();
        $customers = $queryCustomers->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        array_unshift($customers, array('id' => 0, 'name' => ''));

        $response = new Response(json_encode(
                                array('products' => $products,
                                    'suppliers' => $suppliers,
                                    'units' => $units,
                                    'customers' => $customers)));

        return $response;
    }

}
