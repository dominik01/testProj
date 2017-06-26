<?php
/**
 * User: Michal Chylik <michal.chylik@gmail.com>
 * Date: 7.8.2015
 * Time: 12:40
 */

namespace Webron\CoreBundle\Classes;


class WebronSort extends WebronCoreClass {

    public function reverseArray($array)
    {    $index = 0;
        foreach ($array as $subarray) {
            if (is_array($subarray)) {
                $subarray = array_reverse($subarray);
                $arr = $this->reverseArray($subarray);
                $array[$index] = $arr;
            } else {
                $array[$index] = $subarray;
            }
            $index++;
        }
        return $array;
    }

}