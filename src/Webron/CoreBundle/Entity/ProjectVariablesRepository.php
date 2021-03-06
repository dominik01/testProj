<?php

namespace Webron\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProjectVariablesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectVariablesRepository extends EntityRepository
{

    public function incrementVersion(){
        $pvObject = $this->getObject();
        $pvObject->setVersion($pvObject->getVersion()+0.001);
        $this->_em->persist($pvObject);
        $this->_em->flush();
    }

    public function getObject(){
        $pvObject = $this->findOneBy(array('id'=>1));
        if(empty($pvObject)){
            $pvObject = new ProjectVariables();
            $pvObject->setVersion(0.1);
            $this->_em->persist($pvObject);
            $this->_em->flush();
        }
        return $pvObject;
    }

    public function getVersion(){
        $obj = $this->getObject();
        return $obj->getVersion();
    }

}
