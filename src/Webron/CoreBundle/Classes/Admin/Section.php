<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 23.10.2014
 * Time: 22:00
 */

namespace Webron\CoreBundle\Classes\Admin;


class Section {

    private $classMulti;
    protected $classDate;
    protected $classArray;
    protected $classImage;
    private $title;
    protected $classInput;
    protected $classSelect;

    public function __construct(){
        $this->classInput = new SectionInput();
        $this->classSelect = new SectionSelect();
        $this->classArray = new SectionArray();
        $this->classDate = new SectionDate();
        $this->classImage = new SectionImage();
        $this->classMulti = new SectionMulti();
    }

    public function getValues($data, &$retval){
        if($data['t'] == 'i') $this->classInput->getValues($data, $retval);
        if($data['t'] == 's') $this->classSelect->getValues($data, $retval);
        if($data['t'] == 'd') $this->classDate->getValues($data, $retval);
        if($data['t'] == 'm') $this->classMulti->getValues($data, $retval);
        if($data['t'] == 'img') $this->classImage->getValues($data, $retval);
        if($data['t'] == 'a') $this->classArray->getValues($data, $retval);

        return 1;
    }


    public function addInput($label, $value){
        $this->classInput->add($label, $value);
    }

    public function addSelect($label, $chosen, $options){
        $this->classSelect->add($label, $chosen, $options);
    }

    public function addMulti($data){
        $this->classMulti->add($data);
    }

    public function addDate($label, $value){
        $this->classDate->add($label, $value);
    }

    public function addArray($label, $chosen, $options){
        $this->classArray->add($label, $chosen, $options);
    }

    public function addImage($id, $path){
        $this->classImage->add($id, $path);
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function printToArray(){
        $retval = array();
        $retval['title'] = $this->title;

        $retval['data'] = array();

        //Print inputs
        $inputs = $this->classInput->printToArray();
        if(!empty($inputs)){
            $retval['data'] = array_merge($retval['data'], $inputs);
        }

        //Print selects
        $selects = $this->classSelect->printToArray();
        if(!empty($selects)){
            $retval['data'] = array_merge($retval['data'], $selects);
        }

        //Print dates
        $dates = $this->classDate->printToArray();
        if(!empty($dates)){
            $retval['data'] = array_merge($retval['data'], $dates);
        }

        //Print images
        $images = $this->classImage->printToArray();
        if(!empty($images)){
            $retval['data'] = array_merge($retval['data'], $images);
        }

        //Print arrays
        $arrays = $this->classArray->printToArray();
        if(!empty($arrays)){
            $retval['data'] = array_merge($retval['data'], $arrays);
        }

        $multis = $this->classMulti->printToArray();
        if(!empty($multis)){
            $retval['data'][] = $multis;
        }

        return $retval;
    }

} 