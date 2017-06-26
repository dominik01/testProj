<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 23.10.2014
 * Time: 22:00
 */

namespace Webron\CoreBundle\Classes\Admin;


class SectionSelect {

    private $selects;

    public function add($label, $chosen, $options){
        $this->selects[] = array('label'=>$label, 'chosen'=>$chosen, 'options'=>$options);
    }

    public function printToArray(){

        $selects = array();
        if(!empty($this->selects)){
            foreach($this->selects as $key=>$value){
                $select = array();
                $select['l'] = $value['label'];
                $select['t'] = 's';
                $select['s'] = array('v'=>$value['chosen'][0], 'o'=>$value['chosen'][1]);
                foreach($value['options'] as $key2=>$value2){
                    $select['o'][] = array('v'=>$value2[0], 'o'=>$value2[1]);
                }

                if(!empty($select)) $selects[] = $select;
            }
        }
        return $selects;
    }

    public function getValues($data, &$retval){
        $retval[strtolower($data['l'])] =$data['s']['v'];
        return 1;
    }
} 