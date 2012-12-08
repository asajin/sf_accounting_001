<?php

namespace Accounting\PriceListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingPriceListBundle:Default:index.html.twig');
    }
}
