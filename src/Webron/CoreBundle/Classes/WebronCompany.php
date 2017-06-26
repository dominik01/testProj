<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4.10.2014
 * Time: 21:31
 */

namespace Webron\CoreBundle\Classes;


class WebronCompany {

    public static function inPhrase($phrase)
    {
        return preg_match('/(.*?)(s.r.o|a.s)(.*)/', $phrase);
        //print_r($match);
    }

    public static function inDictionary()
    {

    }

    public static function inWords($words)
    {
        foreach ($words as $keyWord => $word) {

            $subjectWord = self::isKeyword(strtolower($word));
            if($subjectWord) {
                return true;
            }
        }
        return false;
    }

    public static function isKeyword($word)
    {
        $keywords = array(
            's.r.o',
            's.r.o.',
            'r.o',
            'a.s.',
            'a.s'
        );
        // ak najdem v slovniku
        if(in_array($word, $keywords)) {
            return true;
        }
        return false;
    }

    public static function formatICO($ico)
    {
        return trim(str_replace(' ', '', $ico));
    }

    public function checkIco($ico){
        if(strlen($ico) != 8){
            return false;
        }
        return true;
    }

    public function cleanName($name){
        $pom = explode('<br>', $name);
        $name = $pom[0];
        $pom = explode('<br/>', $name);
        $name = $pom[0];
        $pom = explode('<br />', $name);
        $name = $pom[0];

        $name = str_replace('spol s.r.o.', '', $name);
        $name = str_replace('spol s.r.o', '', $name);
        $name = str_replace('spol s r.o.', '', $name);
        $name = str_replace('spol. s.r.o.', '', $name);
        $name = str_replace('spol. s.r.o', '', $name);
        $name = str_replace('spol. s r.o.', '', $name);
        $name = str_replace('spol. s r. o.', '', $name);
        $name = str_replace('s.r.o.', '', $name);
        $name = str_replace('s. r. o.', '', $name);
        $name = str_replace('s.r.o', '', $name);
        $name = str_replace('a.s.', '', $name);
        $name = str_replace('a.s', '', $name);
        $name = str_replace('a. s.', '', $name);
        $name = str_replace('a. s', '', $name);

        $name = str_replace('S.R.O.', '', $name);
        $name = str_replace('S.R.O', '', $name);
        $name = str_replace('A.S.', '', $name);
        $name = str_replace('A.S', '', $name);
        $name = str_replace(',', '', $name);
        $name = trim($name);
        return $name;
    }

} 