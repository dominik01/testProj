<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2.10.2014
 * Time: 11:27
 */

namespace Webron\CoreBundle\Classes;


class WebronCsv {

    public function __construct(){

    }

    public function get($file, $delimiter=';'){
        $retval = array();
        $file = fopen($file, 'r');
        $i=0;
        while(!feof($file)) {
            $line =  fgets($file);
            $arr = explode($delimiter, $line);
            $retval[] = $arr;
            $i++;
        }
        return $retval;
    }

    public function create($data, $file, $delimiter=';'){
        return 1;
    }

} 