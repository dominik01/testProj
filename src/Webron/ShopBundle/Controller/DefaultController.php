<?php

namespace Webron\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WebronShopBundle:Default:index.html.twig', array('name' => $name));
    }
}
