<?php

namespace Accounting\ProfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingProfitBundle:Default:index.html.twig');
    }

    public function filterAction()
    {
        return $this->render('AccountingProfitBundle:Default:filter.html.twig');
    }
}
