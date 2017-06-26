<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 30.9.2014
 * Time: 16:22
 */

namespace Webron\ParserBundle\Classes;
use Webron\CoreBundle\Classes\WebronDate;
use Webron\CoreBundle\Classes\WebronString;


class Parser {

    public function __construct(){

    }

    protected function parseHref($str){

        $link = explode('href="', $str);
        $link = explode('">', $link[1]);

        $title[0] = '';
       if(!empty($link[1])){
            $title = explode('</a>', $link[1]);
        }

        $link = explode(';', $link[0]);
		
        $ret['url'] = $link[0];
        $ret['title'] = $title[0];
        return $ret;
    }

    protected function removeDiacritics($string){
        $classString = new WebronString();
        $string = $classString->url_slug($string);
        return $string;
    }

    protected function clearString($string){
        $classString = new WebronString();
        $string = $classString->clearString($string);
        return $string;
    }

    protected function getValueBetweenTags($str){
        $pom = explode(">", $str);
        $pom = explode("<",$pom[1]);
        return $pom[0];
    }

    protected function removeSpace($str) {
        return str_replace(' ', '', $str);
    }

    protected function createFromDotFormat($string) {

        $class = new WebronDate();
        return $class->createFromDotFormat($string);

    }

    protected function createFromDatetime($string) {

        $class = new WebronDate();
        return $class->createFromDatetime($string);

    }

    public function getStringBetween($text, $startText, $endText, $offset=0) {
        $starTextLength = strlen($startText);
        $startTextPos = strpos($text, $startText, $offset);
        if ($startTextPos === false) return false;
        $endTextPos = strpos($text, $endText, $startTextPos+1);
        if ($endTextPos === false) return false;
        $start = $startTextPos + $starTextLength;
        $length = $endTextPos - $start;
        $retVal = substr($text, $start, $length);
        $retVal = trim($retVal);
        return $retVal;
    }
} 
