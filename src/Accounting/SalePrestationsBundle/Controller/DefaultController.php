<?php

namespace Accounting\SalePrestationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingSalePrestationsBundle:Default:index.html.twig');
    }
}
