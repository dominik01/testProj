<?php

namespace Goodjob\AppBundle\Repository;
use Webron\CoreBundle\Entity\WebronEntityRepository;

/**
 * CourseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

/**
 * Class CourseRepository
 * @package Goodjob\AppBundle\Repository
 * @author Dominik <dominik0109@gmail.com>
 */
class CourseRepository extends WebronEntityRepository
{
    public function showAll(){
        return $this->findAll();
    }

    public function getCourseByCodeName($name)
    {
        $retval = [];
        $course =  $this->findOneBy(array('codeName'=>$name));
        if(!empty($course)){
            $retval['course'] = $course;
            $retval['courseCategory'] = $this->getCategoryName($course->getCategory());
                if (!empty($course->getLectorId())) {
                $lector = $this->getRepo('Lector')->getLectorById($course->getLectorId());
                $retval["lector"] = $lector;
            }
        }
        return $retval;
    }

    public function getLectorCourses($lectorId){
        $courses = $this->findBy(array('lectorId'=>$lectorId));
        if(!empty($courses)) return $courses;
        return 0;
    }

    public function getCourseIdByCodeName($name){
        $course = $this->findOneBy(array('codeName' => $name));
        if(!empty($course)){
            return $course->getId();
        }
        return 0;
    }

    private function getCategoryName($courseId){
        if ($courseId == 1) return 'CAD';
        if ($courseId == 2) return 'AUTOCAD';
        if ($courseId == 3) return 'CODE';
        if ($courseId == 4) return 'BACKEND';
        if ($courseId == 5) return 'DATABASE';
        if ($courseId == 6) return 'FRONTEND';
        if ($courseId == 7) return 'MOBILE';
        if ($courseId == 8) return 'WEB';
        if ($courseId == 9) return 'DESIGN';
        if ($courseId == 10) return 'PHOTOSHOP';
        if ($courseId == 11) return 'ILLUSTRATOR';
    }
}
