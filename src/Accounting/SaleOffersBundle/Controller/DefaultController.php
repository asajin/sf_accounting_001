<?php

namespace Accounting\SaleOffersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingSaleOffersBundle:Default:index.html.twig');
    }
}
