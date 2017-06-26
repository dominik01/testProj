<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 23.10.2014
 * Time: 22:00
 */

namespace Webron\CoreBundle\Classes\Admin;


class SectionInput {

    private $inputs;

    public function add($label, $value){
        $this->inputs[] = array($label=>$value);
    }

    public function printToArray(){
        $inputs = array();
        if(!empty($this->inputs)){
            foreach($this->inputs as $key=>$value){
                $input = array();
                foreach($value as $label=>$str) {
                    $input = array('l' => $label, 'v' => $str, 't' => 'i');
                }
                if(!empty($input)) $inputs[] = $input;
            }
        }
        return $inputs;
    }

    public function getValues($data, &$retval){
        $retval[strtolower($data['l'])] = $data['v'];
        return 1;
    }

}