<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4.10.2014
 * Time: 21:31
 */

namespace Webron\CoreBundle\Classes;


class WebronPerson {

    public function extractFromLine($line){
        $line = str_replace(".", ". ", $line);
        $pom = explode(",", $line);
        $line = $pom[0];

        $classString = new WebronString();
        $words = $classString->toWords($line);

        $types = array(
            'title' => array(),
            'first' => array(),
            'other' => array(),
        );


        if(!empty($words)) {
            foreach ($words as $keyWord => $word) {
                // najdem krstne meno?
                $word = trim($word);
                $word = str_replace(',', '', $word);
                $word = str_replace(';', '', $word);
                $types[$this->wordType($word)][] = $word;
            }
        }
        //print_r($types);
        $types['other'] = $this->processSurname($types['other']);

        $person              = array();
        if(isset($types['title'])) {
            $person['title']     = implode(' ', $types['title']);
        } else {
            $person['title']     = '';
        }



        // moze sa stat ze priezvisko je identifikovane ako krstne
        // ak nemam nic v other a firstName ma min 2, presuniem...
        if(count($types['first']) > 1 && count($types['other']) == 0) {
            $types['other'][] = end($types['first']);
            unset($types['first'][count($types['first'])-1]);

        }


        $person['firstName'] = implode(' ', $types['first']);
        $person['lastName']  = implode(' ', $types['other']);
        //print_r($person);
        //exit();
        return $person;
    }

    private function processSurname($surname){
        if(count($surname) > 1){
            if(trim($surname[1]) == '-'){
                if(!$this->startsWithUpper(trim($surname[2]))){
                    unset($surname[1]);
                    unset($surname[2]);
                }
            }
        }
        return $surname;
    }

    private function startsWithUpper($str) {
        $chr = mb_substr ($str, 0, 1, "UTF-8");
        return mb_strtolower($chr, "UTF-8") != $chr;
    }

    public static function wordType($word, $ucsensitive=0)
    {
        // last char,
        $lastChar = substr($word, -1);
        //
        if($lastChar == '.') {
            return 'title';
        }

        $classString = new WebronString();
        //
        $clearWord = $classString->url_slug($word);
        // ak najdem v slovniku
        if($ucsensitive){
            $modified = $clearWord;
        } else {
            $modified = ucfirst($clearWord);
        }
        if(isset($GLOBALS['lib']['firstNames'][$modified]) && strlen($clearWord) >2) {
            return 'first';
        }
        return 'other';

    }

    public static function clear($string)
    {
        $string = str_replace(',', '', $string);
        $string = str_replace('.', '', $string);

        return $string;
    }

    public static function findAllInText($line, $ucsensitive=0)
    {

        // vzor Ing. Jan Maly
        $classString = new WebronString();
        $words = $classString->toWords($line);

        $types = array(
            'title' => array(),
            'first' => array(),
            'other' => array(),
        );
        if(!empty($words)) {
            foreach ($words as $keyWord => $word) {
                // najdem krstne meno?
                $word = trim($word);
                $word = str_replace(',', '', $word);
                $word = str_replace(';', '', $word);
                $words[$keyWord] = $word;
                $types[self::wordType($word, $ucsensitive)][] = $keyWord;
            }
        }
        $persons = array();

        if(!empty($types['first'])) {
            foreach ($types['first'] as $key => $keyFirst) {

                $person = array();
                $person['meno']       = self::clear($words[$keyFirst]);
                $person['priezvisko'] = self::clear($words[$keyFirst+1]);

                if(isset($words[$keyFirst-1])) {
                    $title = $words[$keyFirst-1];
                    if(self::wordType($title) == 'title') {
                        $person['titul'] = $title;
                    }
                }

                $persons[] = $person;
            }
        }
        return $persons;
    }

} 