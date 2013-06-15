<?php

namespace Accounting\ChargesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingChargesBundle:Default:index.html.twig');
    }

    public function filterAction()
    {
        return $this->render('AccountingChargesBundle:Default:filter.html.twig');
    }
}
