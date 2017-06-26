<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 5.8.2015
 * Time: 14:44
 */

namespace Webron\CoreBundle\Classes;


class WebronCoreClass {

    private $em = null;

    protected function __construct($em) {
        $this->em = $em;
    }

    protected function getRepo($name, $special=0){
        if(empty($special)){
            $repo = $this->em->getRepository('EpsCoreBundle:'.ucfirst($name));
        } else {
            $repo = $this->em->getRepository($special . ':'.ucfirst($name));
        }
        return $repo;
    }
}
