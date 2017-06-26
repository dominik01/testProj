<?php
/**
 * User: Michal Chylik <michal.chylik@gmail.com>
 * Date: 20.2.2015
 * Time: 13:01
 */

namespace Webron\GeographicBundle\Classes;


class WebronNuts {

    public function codeToName($code){
        $name = '';
        $codes = $this->getCodeArray();
        $names = $this->getNameArray();
        $searchKey = -1;
        if(!empty($codes)){
            foreach($codes as $key=>$value){
                if($value==$code){
                    $searchKey = $key;
                    break;
                }
            }
        }
        if(!empty($names[$searchKey])) $name = $names[$searchKey];
        return $name;
    }

    public function nameToCode($name){
        $code = '';
        $codes = $this->getCodeArray();
        $names = $this->getNameArray();
        $searchKey = -1;
        if(!empty($names)){
            foreach($names as $key=>$value){
                if($value==$name){
                    $searchKey = $key;
                    break;
                }
            }
        }
        if(!empty($codes[$searchKey])) $code = $codes[$searchKey];
        return $code;
    }

    public function getCodeArray(){
        $arr = array('SK0', 'SK01', 'SK02', 'SK03', 'SK04', 'SK010', 'SK021', 'SK022', 'SK023', 'SK031', 'SK032', 'SK041', 'SK042');
        return $arr;
    }

    public function getNameArray(){
        $arr = array('Slovensko', 'Bratislavský región', 'Západoslovenský región', 'Stredoslovenský región', 'Východoslovenský región', 'Bratislavský kraj', 'Trnavský kraj', 'Trenčiansky kraj', 'Nitriansky kraj', 'Žilinský kraj', 'Banskobystrický kraj', 'Prešovský kraj', 'Košický kraj');
        return $arr;
    }

    /**
     * Metoda vracia pole, ktorym sa naplna vyberovnik nuts oblasti
     * @author Michal Chylik <michal.chylik@gmail.com>
     * @version 1.0
     * @param $numKey - nepovinny parameter, ktory ak je nastaveny na 1 tak pouzivame ako IDcka cisla
     * @param $all - nepovinny parameter, ktory urcuje ci sa do selectu prida prvok Vsetky
     * @param $type - nepovinny parameter urcuje ake typy oblasti davame do selectu, 1-vsetky, 2-krajina, 3-region, 4-kraj, 5-krajina a region, 6-region a kraj
     * @return array - vracia pole, ktorym sa naplna vyberovnik nuts oblasti
     */
    public function getSelectName($numKey=0, $all=0, $type=1){
        $limit = $this->getNameArray();
        $retval = array();
        if(!empty($all)) $retval[] = array('id'=>0, 'label'=>'Všetky');
        if(!empty($limit)){
            foreach($limit as $key=>$value){
                if(strlen($this->NameToCode($value)) == 3 && in_array($type, array(3,4,6))) continue;
                if(strlen($this->NameToCode($value)) == 4 && in_array($type, array(2,4))) continue;
                if(strlen($this->NameToCode($value)) == 5 && in_array($type, array(2,3,5))) continue;
                $id = $value;
                if(!empty($numKey)) $id = $key+1;
                $retval[] = array('id'=>$id, 'label'=>$value);
            }
        }
        return $retval;
    }

}