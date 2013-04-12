<?php

namespace Diver\PriceLisrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DiverPriceLisrBundle:Default:index.html.twig', array('name' => $name));
    }
}
