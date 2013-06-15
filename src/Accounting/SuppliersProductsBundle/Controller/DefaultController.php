<?php

namespace Accounting\SuppliersProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function newAction()
    {
        return $this->render('AccountingSuppliersProductsBundle:Default:new.html.twig');
    }
}
