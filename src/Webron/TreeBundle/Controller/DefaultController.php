<?php

namespace Webron\TreeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WebronTreeBundle:Default:index.html.twig', array('name' => $name));
    }
}
