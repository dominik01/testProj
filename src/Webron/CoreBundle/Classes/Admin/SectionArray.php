<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 23.10.2014
 * Time: 22:00
 */

namespace Webron\CoreBundle\Classes\Admin;


class SectionArray {

    private $arrays;

    public function add($label, $chosen, $options){
        $this->arrays[] = array('label'=>$label, 'chosen'=>$chosen, 'options'=>$options);
    }

    public function printToArray(){
        $arrays = array();
        if(!empty($this->arrays)){
            foreach($this->arrays as $key=>$value){
                $array = array();
                $array['l'] = $value['label'];
                $array['t'] = 'a';
                foreach($value['chosen'] as $key2=>$value2){
                    $array['d'][] = array('id'=>$value2['id'], 'l'=>$value2['label']);
                }
                foreach($value['options'] as $key2=>$value2){
                    $array['a'][] = array('id'=>$value2['id'], 'l'=>$value2['label']);
                }

                if(!empty($array)) $arrays[] = $array;
            }
        }
        return $arrays;
    }

    public function getValues($data, &$retval){
        $pom = array();
        foreach($data['d'] as $key=>$value){
            $pom[] =$value['id'];
        }
        $retval[strtolower($data['l'])] = $pom;
        return 1;
    }
} 