<?php
namespace Diver\PriceLisrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class RestController extends FOSRestController
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DiverPriceLisrBundle:Items')->findAll();
        $view = $this->view($entities, 200)
            ->setTemplate("DiverPriceLisrBundle:Items:index.html.twig")
            ->setTemplateVar('entities')
        ;

        return $this->handleView($view);
    }
}