<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 9.12.2014
 * Time: 9:47
 */

namespace Webron\CoreBundle\Classes;


class WebronError {

    private $errors;

    public function create($code, $element, $text){
        $this->errors[] = array('code'=>$code, 'element'=>$element, 'text'=>$text);
    }

    public function printErrors(){
        $retval = array();
        if(!empty($this->errors)){
            foreach($this->errors as $key=>$value){
                $retval['error'][] = $value;
            }
        }
        return $retval;
    }

    /*
     * 1001 - invalid email
     * 1002 - email already taken
     * 1003 - name is too short
     * 1004 - empty email
     * 1005 - empty password
     * 1006 - nickname is too long
     * 1007 - old password is incorrect
     * 1008 - nickname is already used
     * 1009 - password too short
     * 1010 - password should have at least one capital letter
     * 1011 - password should have at least one small letter
     * 1012 - you have to set password to verify
     * 2001 - insufficient rights
     * 2002 - insufficient rights to set position
     * 3001 - project should have title
     * 3002 - installation should have title
     * 4001 - bad credentials
     * 4002 - invalid code
     * 4003 - app error
     * 4004 - user empty
     * 4005 - restaurant already exists
     * 4006 - invalid request
     */
}
