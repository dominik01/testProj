<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 23.10.2014
 * Time: 22:00
 */

namespace Webron\CoreBundle\Classes\Admin;


class SectionMulti extends Section {

    private $label;

    public function __construct(){
        $this->classInput = new SectionInput();
        $this->classSelect = new SectionSelect();
        $this->classArray = new SectionArray();
        $this->classDate = new SectionDate();
        $this->classImage = new SectionImage();
    }

    public function add($data){
        //print_r($data);
        $this->label = $data['label'];
        foreach($data['data'] as $key=>$value){

            if($value['type']=='input'){
                $this->addInput($value['label'], $value['value']);
            }
            if($value['type']=='select'){
                $this->addSelect($value['label'], $value['chosen'], $value['options']);
            }
        }
    }

    public function getValues($input, &$retval){

        foreach($input['d'] as $key=>$data){
            if($data['t'] == 'i') $this->classInput->getValues($data, $retval);
            if($data['t'] == 's') $this->classSelect->getValues($data, $retval);
            if($data['t'] == 'd') $this->classDate->getValues($data, $retval);
            if($data['t'] == 'img') $this->classImage->getValues($data, $retval);
            if($data['t'] == 'a') $this->classArray->getValues($data, $retval);
        }

        return 1;
    }

    public function printToArray(){
        $retval = array();
        $retval['d'] = array();

        $retval['l'] = $this->label;
        $retval['t'] = 'm';

        //Print inputs
        $inputs = $this->classInput->printToArray();
        if(!empty($inputs)){
            $retval['d'] = array_merge($retval['d'], $inputs);
        }

        //Print selects
        $selects = $this->classSelect->printToArray();
        if(!empty($selects)){
            $retval['d'] = array_merge($retval['d'], $selects);
        }

        //Print dates
        $dates = $this->classDate->printToArray();
        if(!empty($dates)){
            $retval['d'] = array_merge($retval['d'], $dates);
        }

        //Print images
        $images = $this->classImage->printToArray();
        if(!empty($images)){
            $retval['d'] = array_merge($retval['d'], $images);
        }

        //Print arrays
        $arrays = $this->classArray->printToArray();
        if(!empty($arrays)){
            $retval['d'] = array_merge($retval['d'], $arrays);
        }

        return $retval;
    }
} 