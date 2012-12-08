<?php

namespace Accounting\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccountingMainBundle:Page:index.html.twig', array('name' => '$name'));
    }

    public function aboutAction()
    {
        return $this->render('AccountingMainBundle:Page:about.html.twig');
    }

    public function contactAction()
    {
        return $this->render('AccountingMainBundle:Page:contact.html.twig');
    }
}
