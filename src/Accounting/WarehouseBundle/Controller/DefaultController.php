<?php

namespace Accounting\WarehouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingWarehouseBundle:Default:index.html.twig');
    }
}
