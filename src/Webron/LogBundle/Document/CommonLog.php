<?php

namespace Webron\LogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(
 * collection="common_log"
 * )
 *
 */

class CommonLog
{

    /**
     * @MongoDB\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $name;

    /**
     * @MongoDB\Date
     */
    protected $datetime;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDate()
    {
        $this->datetime = new \DateTime();
    }

    public function getDate()
    {
        return $this->datetime;
    }

}