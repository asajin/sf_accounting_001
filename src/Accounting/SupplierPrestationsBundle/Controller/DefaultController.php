<?php

namespace Accounting\SupplierPrestationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingSupplierPrestationsBundle:Default:index.html.twig');
    }

    public function filterAction()
    {
        return $this->render('AccountingSupplierPrestationsBundle:Default:filter.html.twig');
    }

    public function newAction()
    {
        return $this->render('AccountingSupplierPrestationsBundle:Default:new.html.twig');
    }
}
