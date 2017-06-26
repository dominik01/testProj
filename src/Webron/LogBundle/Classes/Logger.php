<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 1.10.2014
 * Time: 9:43
 */

namespace Webron\LogBundle\Classes;

class Logger {

    protected $type;

    public function __construct($dm){
        if(get_class($dm) == 'Doctrine\ODM\MongoDB\DocumentManager'){
            $this->type = 1;
            $this->repo = 'Webron\LogBundle\Document\CommonLog';
        } else {
            $this->type = 2;
            $this->repo = 'Webron\LogBundle\Entity\CommonLog';
        }
        $this->dm = $dm;

    }

    public function setRepo($repo){
        $this->repo = $repo;
    }

    public function write($text, $action=''){
        if($this->type==1){
            $this->dm->createQueryBuilder($this->repo)
                ->insert()
                ->field('log')->set($text)
                ->field('action')->set($action)
                ->field('datetime')->set(new \DateTime())
                ->getQuery()
                ->execute();
        } else {
            $obj = new $this->repo;
            $obj->setLog($text);
            $obj->setAction($action);
            $obj->setDatetime(new \Datetime);
            $this->dm->persist($obj);
            $this->dm->flush();

        }

    }

}