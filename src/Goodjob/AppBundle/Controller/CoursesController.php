<?php

namespace Goodjob\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Webron\CoreBundle\Controller\WebronCoreController;

class CoursesController extends WebronCoreController
{
    protected $className = 'Course';

    /** CATEGORIES
     * 1 - CAD
     * 2 - AUTOCAD
     * 3 - CODE
     * 4 - BACKEND
     * 5 - DATABASE
     * 6 - FRONTEND
     * 7 - MOBILE
     * 8 - WEB
     * 9 - DESIGN
     * 10 - PHOTOSHOP
     * 11 - ILLUSTRATOR
     */
    
    public function courseAction($id)
    {
        $all_courses = $this->getRepo('Course')->showAll();
        $course = $this->getRepo('Course')->getCourseByCodeName($id);
        if(empty($course)) return $this->render('GoodjobAppBundle:Course:error.html.twig',array('courses' => $all_courses));
        return $this->render('GoodjobAppBundle:Course:course.html.twig', array('data' => $course['course'],'courseLector' => $course['lector'], 'courseCategory' => $course['courseCategory'], 'courses' => $all_courses));
    }

    public function applyAction($id){
        $courses = $this->getRepo('Course')->getCourseByCodeName($id);
        return $this->render('GoodjobAppBundle:Course:application.html.twig', array('data'=>$courses['course']));
    }

}
