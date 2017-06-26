<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 23.10.2014
 * Time: 22:00
 */

namespace Webron\CoreBundle\Classes\Admin;


use Webron\CoreBundle\Classes\WebronDate;

class SectionDate {

    private $dates;


    public function add($label, $value){
        $this->dates[] = array($label=>$value);
    }

    public function printToArray(){
        $dates = array();
        if(!empty($this->dates)){
            foreach($this->dates as $key=>$value){
                $input = array();
                foreach($value as $label=>$str) {
                    $input = array('l' => $label, 'v' => $str->format('d.m.Y'), 't' => 'd');
                }
                if(!empty($input)) $dates[] = $input;
            }
        }
        return $dates;
    }

    public function getValues($data, &$retval){
        $class = new WebronDate();
        $date = $class->createFromDotFormat($data['v']);
        $retval[strtolower($data['l'])] = $date;
        return 1;
    }

} 