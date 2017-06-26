<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2.10.2014
 * Time: 11:27
 */

namespace Webron\CoreBundle\Classes;


class WebronNumber {

   public function strToNum($str, $dec='.'){
       $str = trim($str);
       $str = str_replace(" ", "", $str);
       $str = str_replace(".", $dec, $str);
       $str = str_replace(",", $dec, $str);
       return $str;
   }

    public function numFromStrDb($str){
        $pom = explode(",", $str);
        $num = intval(str_replace(" ", "", $pom[0]));
        if($num==null) $num=0;
        return $num;
    }

    public function numWithSign($num){
        return sprintf("%+.2f",$num);
    }

	public function containsNum($text) {
		if (preg_match("/[0_9]+/", $text)) return true;
		
		return false;
	}

    public function numToBoolean($num){
        return ((bool)$num) ? true : false;
    }

}