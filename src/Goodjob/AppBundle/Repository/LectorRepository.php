<?php

namespace Goodjob\AppBundle\Repository;

/**
 * LectorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

use Webron\CoreBundle\Entity\WebronEntityRepository;

/**
 * Class LectorRepository
 * @package Goodjob\AppBundle\Repository
 * @author Dominik <dominik0109@gmail.com>
 */
class LectorRepository extends WebronEntityRepository
{
    public function showAll(){
        $lectors =  $this->findAll();
        $lectorsArray = [];
        if(!empty($lectors)){
            foreach($lectors as $lector){
                $pom = [];
                $pom['id'] = $lector->getId();
                $pom['name'] = $lector->getName();
                $pom['photo'] = $lector->getPhoto();
                $pom['position'] = $lector->getPosition();
                $pom['description'] = $lector->getDescription();
                $pom['shortDesc'] = $lector->getShortDesc();
                $pom['courses'] = $this->getRepo('Course')->getLectorCourses($lector->getId());
                $lectorsArray[] = $pom;
            }
        }
        return $lectorsArray;
    }

    public function getLectorById($id){
        return $this->find($id);
    }
}
