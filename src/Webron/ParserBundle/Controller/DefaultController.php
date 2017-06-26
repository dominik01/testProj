<?php

namespace Webron\ParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WebronParserBundle:Default:index.html.twig', array('name' => $name));
    }
}
