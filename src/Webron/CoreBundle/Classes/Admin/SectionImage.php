<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 23.10.2014
 * Time: 22:00
 */

namespace Webron\CoreBundle\Classes\Admin;


class SectionImage {

    private $images;

    public function add($id, $path){
        $this->images[] = array('id'=>$id, 'path'=>$path);
    }

    public function printToArray(){
        $images = array();
        if(!empty($this->images)){
            $arr = array();
            foreach($this->images as $key=>$value){
                $arr[] = array('id'=>$value['id'],'path'=>$value['path']);
            }
            $images[] = array('t'=>'img', 'l'=>'Images', 'd'=>$arr);
        }
        return $images;
    }

    public function getValues($data, &$retval){
        $pom = array();
        foreach($data['d'] as $key=>$value){
            $pom[] =array($value['id'], $value['path']);
        }
        $retval[strtolower($data['l'])] = $pom;
        return 1;
    }

} 