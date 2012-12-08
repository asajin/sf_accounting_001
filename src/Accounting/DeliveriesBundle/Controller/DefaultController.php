<?php

namespace Accounting\DeliveriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingDeliveriesBundle:Default:index.html.twig');
    }

    public function filterAction()
    {
        return $this->render('AccountingDeliveriesBundle:Default:filter.html.twig');
    }

    public function newAction()
    {
        return $this->render('AccountingDeliveriesBundle:Default:new.html.twig');
    }
}
