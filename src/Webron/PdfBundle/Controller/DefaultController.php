<?php

namespace Webron\PdfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('WebronPdfBundle:Default:index.html.twig', array('name' => $name));
    }
}
