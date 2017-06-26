<?php

namespace Goodjob\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscription
 *
 * @ORM\Table(name="subscription")
 * @ORM\Entity(repositoryClass="Goodjob\AppBundle\Repository\SubscriptionRepository")
 */
class Subscription
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datime_subscription", type="datetime", nullable=true)
     */
    private $datimeSubscription;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datimeSubscription
     *
     * @param \DateTime $datimeSubscription
     *
     * @return Subscription
     */
    public function setDatimeSubscription($datimeSubscription)
    {
        $this->datimeSubscription = $datimeSubscription;

        return $this;
    }

    /**
     * Get datimeSubscription
     *
     * @return \DateTime
     */
    public function getDatimeSubscription()
    {
        return $this->datimeSubscription;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Subscription
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}

