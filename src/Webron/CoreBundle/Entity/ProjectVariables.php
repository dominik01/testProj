<?php

namespace Webron\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectVariables
 *
 * @ORM\Table(name="zzy_project_variables")
 * @ORM\Entity(repositoryClass="Webron\CoreBundle\Entity\ProjectVariablesRepository")
 */
class ProjectVariables
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="version", type="float")
     */
    private $version;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set version
     *
     * @param float $version
     * @return ProjectVariables
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return float 
     */
    public function getVersion()
    {
        return $this->version;
    }
}
