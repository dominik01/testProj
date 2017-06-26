<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2.10.2014
 * Time: 11:27
 */

namespace Webron\CoreBundle\Classes;


class WebronHelper {

    public function parseLink($link){
        $pom = explode("|", $link);
        $retval['catalogue'] = $pom[0];

        $features = array();
        $featuresNormalized = array();
        $featuresFull = array();

        if(!empty($pom[1])) {
            $pom[1] = substr($pom[1],1);
            $pom2 = explode("-", $pom[1]);
            $i=0;
            $j=0;
            foreach ($pom2 as $key => $value) {
                if($j%2 == 0){
                    $features[$i]['name'] = $value;
                    $featuresFull[$i]['name']['real'] = $value;
                } else {
                    $myValue = $this->getFeatureValue($value);
                    if($myValue['type'] == 'simple'){
                        $features[$i]['value'] = $myValue['value'];
                        $featuresFull[$i]['value']['real'] = $myValue['value'];
                        $i++;
                    } else {
                        unset($features[$i]);
                        unset($featuresFull[$i]);
                        $features = array_merge($features,$myValue['value']);
                        $featuresFull = array_merge($featuresFull,$myValue['valueFull']);
                        $i = count($featuresFull);
                    }
                }
                $j++;
            }
            foreach ($features as $key => $value) {
                $featuresNormalized[] = $value['name'] . '-' . $value['value'];
            }

        }
        $retval['featuresNormalized'] = $featuresNormalized;
        $retval['features'] = $features;
        $retval['featuresFull'] = $featuresFull;
        return $retval;
    }

    private function getFeatureValue($str){
        $starting = substr($str, 0, 1);
        if($starting=='['){
            $str = substr($str,2);
            $last = substr($str,-1);
            if($last == ']') $str = substr($str,0,-1);
            $pom = explode(':', $str);
            $features = array();
            $featuresFull = array();
            if(!empty($pom)){
                $i=0;
                $j=0;
                foreach($pom as $key=>$value){
                    if($j%2 == 0){
                        $features[$i]['name'] = $value;
                        $featuresFull[$i]['name']['real'] = $value;
                    } else {
                        $features[$i]['value'] = $value;
                        $featuresFull[$i]['value']['real'] = $value;
                        $i++;
                    }
                    $j++;
                }
            }
            return array('type'=>'multiple', 'value'=>$features, 'valueFull'=>$featuresFull);
        } else {
            return array('type'=>'simple', 'value'=>$str);
        }
    }

    public function getHashedName($name){
        $pom = hash('md5',$name);
        $pom = base_convert($pom, 16, 10);
        $folder = $pom%1000;
        return $folder;
    }

    public function numToBoolean($num){
        return ((bool)$num) ? 'true' : 'false';
    }

    public function jsonToArray($jsonData){
        $retval = array();
        $data = (array) json_decode($jsonData);
        if(!empty($data)){
            foreach($data as $key=>$value){
                $retval[$key] = (array) $data[$key];
            }
        }
        return $retval;
    }

    public function objectToArray($obj){
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = $this->objectToArray($val);
            }
        }
        else $new = $obj;
        return $new;
    }

} 