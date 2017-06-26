<?php

namespace Webron\GeographicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Town
 *
 * @ORM\Table(name="zz_webron_town")
 * @ORM\Entity(repositoryClass="Webron\GeographicBundle\Entity\TownRepository")
 */
class Town
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
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=255)
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var integer
     *
     * @ORM\Column(name="district", type="integer")
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="district_name", type="string", length=255)
     */
    private $districtName;

    /**
     * @var string
     *
     * @ORM\Column(name="psc", type="string", length=10)
     */
    private $psc;


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
     * Set town
     *
     * @param string $town
     * @return Town
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Town
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set district
     *
     * @param integer $district
     * @return Town
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return integer 
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set districtName
     *
     * @param string $districtName
     * @return Town
     */
    public function setDistrictName($districtName)
    {
        $this->districtName = $districtName;

        return $this;
    }

    /**
     * Get districtName
     *
     * @return string 
     */
    public function getDistrictName()
    {
        return $this->districtName;
    }

    /**
     * Set psc
     *
     * @param string $psc
     * @return Town
     */
    public function setPsc($psc)
    {
        $this->psc = $psc;

        return $this;
    }

    /**
     * Get psc
     *
     * @return string 
     */
    public function getPsc()
    {
        return $this->psc;
    }
}
