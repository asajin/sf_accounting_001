<?php

namespace Accounting\WarehouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AccountingWarehouseBundle:Default:index.html.twig', array('name' => $name));
    }
}
