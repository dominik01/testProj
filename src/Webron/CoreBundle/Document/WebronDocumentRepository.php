<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 18.11.2014
 * Time: 16:57
 */

namespace Webron\CoreBundle\Document;


use Doctrine\ODM\MongoDB\DocumentRepository;

class WebronDocumentRepository extends DocumentRepository{

    protected $type;
    protected $id;
    protected $project=0;

    protected function prepareProfileData(){
        $retval['id'] = $this->id;
        $retval['type'] = $this->type;
        return $retval;
    }

    protected function prepareSection(){
        $section = new Section();
        return $section;
    }

    protected function getSectionObject(){
        return new Section();
    }

    protected function setProjectId($project){
        $this->project = $project;
    }

    protected function getRepo($name, $special=0){
        if(empty($special)){
            if(strpos($name, ':') === false) $name = 'DocunestCoreBundle:'.ucfirst($name);
            $repo = $this->dm->getRepository($name);
        } else {
            $repo = '';
        }
        return $repo;
    }

    public function getObjectById($id){
        $obj = $this->findOneBy(array('id'=>$id));
        return $obj;
    }

} 