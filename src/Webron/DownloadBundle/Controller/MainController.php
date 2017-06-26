<?php

namespace Webron\DownloadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WebronDownloadBundle:Default:index.html.twig', array('name' => $name));
    }
}
