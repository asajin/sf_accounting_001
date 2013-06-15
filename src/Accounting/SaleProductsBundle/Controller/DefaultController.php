<?php

namespace Accounting\SaleProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingSaleProductsBundle:Default:index.html.twig');
    }
}
