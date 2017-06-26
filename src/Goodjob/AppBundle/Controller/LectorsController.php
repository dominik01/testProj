<?php

namespace Goodjob\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Webron\CoreBundle\Controller\WebronCoreController;

class LectorsController extends WebronCoreController
{
    protected $className = 'Lector';

    public function lectorsAction(Request $request){
        $this->prepareParameters($request);
        //$lectors = $this->class->showAll();
        $lectors = $this->getRepo('Lector')->showAll();
        return $this->render('GoodjobAppBundle:About:lectors.html.twig', array('lectors'=>$lectors));
    }
}
