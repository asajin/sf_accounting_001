<?php

namespace Accounting\OffersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingOffersBundle:Default:index.html.twig');
    }
}
