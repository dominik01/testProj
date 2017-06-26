<?php
namespace Webron\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;
	
    /**
     * @ORM\Column(type="string", length=40, unique=true, nullable=true)
     */
    protected $email;
	
	/**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $surname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=16, unique=true, nullable=true)
     */
    protected $mobile_key;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $password;
	
	/**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;
		
	/**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $verification;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $verified;
	
	/**
     * @ORM\Column(type="datetime", name="date_registered")
     */
	protected $dateRegistered;
	
	/**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
	protected $country;
	
	/**
    	 * @ORM\Column(type="string", length=50, nullable=true)
	   	*/ 
    protected $type;

    /**
     * @ORM\Column(name="position_id", type="integer", nullable=true)
     */
    protected $positionId;

    /**
     * @ORM\Column(name="trainer_id", type="integer", nullable=true)
     */
    protected $trainerId;

    /**
     * @ORM\Column(type="integer", options={"comment":"1-part time, 2-fulltime"}, nullable=true)
     */
    protected $contract;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $role;

    /**
     * @ORM\Column(type="integer", options={"comment":"1-aktivny, 2-neaktivny, 3-materska"}, nullable=true)
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="date", name="date_of_birth", nullable=true)
     */
    protected $dateOfBirth;

    /**
     * @ORM\Column(type="datetime", name="medical_card", nullable=true)
     */
    protected $medicalCard;

    /**
     * @ORM\Column(type="datetime", name="medical_review", nullable=true)
     */
    protected $medicalReview;

    /**
     * @ORM\Column(name="restaurant_id", type="integer", nullable=true)
     */
    protected $restaurantId;

    /**
     * @ORM\Column(type="datetime", name="last_work_report", nullable=true)
     */
    protected $lastWorkReport;

    /**
     * @ORM\Column(type="datetime", name="next_work_report", nullable=true)
     */
    protected $nextWorkReport;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $deleted;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    protected $language;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $hashCode;

    /**
     * @ORM\Column(type="string", name="restaurant_sms_id_user_sms_id", length=50, nullable=true)
     */
    protected $restaurantSmsIdUserSmsId;

    /**
     * @ORM\Column(type="string", name="sex", length=50, nullable=true)
     */
    protected $sex;

    /**
     * @ORM\Column(name="datetime_sms_imported", type="datetime", nullable=true)
     */
    protected $datetimeSmsImported;

    /**
     * @ORM\Column(type="integer", name="import_id", nullable=true)
     */
    protected $importId;

    /**
     * @ORM\Column(type="smallint", name="personal_data", options={"comment":"1-vsetci, 2-manazeri"}, nullable=true)
     */
    protected $personalData;

    /**
     * @var array
     * @ORM\Column(type="json_array", nullable=true)
     */
    protected $roles;

    /**
     * @ORM\Column(type="datetime", name="contract_termination", nullable=true)
     */
    protected $contractTermination;

    /**
     * @ORM\Column(type="integer", name="fund_working_hours", nullable=true)
     */
    protected $fundWorkingHours;

		
	public function __construct() 
	{
        $this->salt = md5(uniqid(null, true));
		$this->verified = 0;
	}
	
	
	/**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function setUsername()
    {
        return $this->username;
    }
	
    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
        return '';
    }
		
		/**
     * @inheritDoc
     */
    public function getVerification()
    {
        return $this->verification;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }
	
    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }


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
     * Set email
     *
     * @param string $email
     * @return User
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
	
	/**
     * Set country
     *
     * @param string $country
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }
	
	/**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set verification
     *
     * @param string $verification
     * @return User
     */
    public function setVerification($verification)
    {
        $this->verification = $verification;
    
        return $this;
    }

    /**
     * Set verified
     *
     * @param $verified
     * @return User
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
    
        return $this;
    }

    /**
     * Get verified
     *
     * @return
     */
    public function getVerified()
    {
        return $this->verified;
    }
    
    public function getMobileKey()
    {
      return $this->mobile_key;
    }
    
    public function setMobileKey($key)
    {
      $this->mobile_key = $key;
    }
	
	 public function getDateRegistered()
	  {
	    return $this->dateRegistered;
	  }
	  
	  public function setDateRegistered($dateRegistered)
	  {
	    $this->dateRegistered = $dateRegistered;
	    return $this;
	  }
	  
	   public function getType()
	  {
	    return $this->type;
	  }
	  
	  public function setType($type)
	  {
	    $this->type = $type;
	  }

	  public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }

    /**
     * Set positionId
     *
     * @param integer $positionId
     * @return User
     */
    public function setPositionId($positionId)
    {
        $this->positionId = $positionId;

        return $this;
    }

    /**
     * Get positionId
     *
     * @return integer 
     */
    public function getPositionId()
    {
        return $this->positionId;
    }

    /**
     * Set trainerId
     *
     * @param integer $trainerId
     * @return User
     */
    public function setTrainerId($trainerId)
    {
        $this->trainerId = $trainerId;

        return $this;
    }

    /**
     * Get trainerId
     *
     * @return integer 
     */
    public function getTrainerId()
    {
        return $this->trainerId;
    }

    /**
     * Set contract
     *
     * @param integer $contract
     * @return User
     */
    public function setContract($contract)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return integer 
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set role
     *
     * @param integer $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return User
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set medicalCard
     *
     * @param \DateTime $medicalCard
     * @return User
     */
    public function setMedicalCard($medicalCard)
    {
        $this->medicalCard = $medicalCard;

        return $this;
    }

    /**
     * Get medicalCard
     *
     * @return \DateTime 
     */
    public function getMedicalCard()
    {
        return $this->medicalCard;
    }

    /**
     * Set medicalReview
     *
     * @param \DateTime $medicalReview
     * @return User
     */
    public function setMedicalReview($medicalReview)
    {
        $this->medicalReview = $medicalReview;

        return $this;
    }

    /**
     * Get medicalReview
     *
     * @return \DateTime 
     */
    public function getMedicalReview()
    {
        return $this->medicalReview;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set restaurantId
     *
     * @param integer $restaurantId
     * @return User
     */
    public function setRestaurantId($restaurantId)
    {
        $this->restaurantId = $restaurantId;

        return $this;
    }

    /**
     * Get restaurantId
     *
     * @return integer
     */
    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    /**
     * Set lastWorkReport
     *
     * @param \DateTime $lastWorkReport
     * @return User
     */
    public function setLastWorkReport($lastWorkReport)
    {
        $this->lastWorkReport = $lastWorkReport;

        return $this;
    }

    /**
     * Get lastWorkReport
     *
     * @return \DateTime 
     */
    public function getLastWorkReport()
    {
        return $this->lastWorkReport;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return User
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set deleted
     *
     * @param integer $language
     * @return User
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set nextWorkReport
     *
     * @param \DateTime $nextWorkReport
     * @return User
     */
    public function setNextWorkReport($nextWorkReport)
    {
        $this->nextWorkReport = $nextWorkReport;

        return $this;
    }

    /**
     * Get nextWorkReport
     *
     * @return \DateTime 
     */
    public function getNextWorkReport()
    {
        return $this->nextWorkReport;
    }

    /**
     * Set hashCode
     *
     * @param string $hashCode
     * @return User
     */
    public function setHashCode($hashCode)
    {
        $this->hashCode = $hashCode;

        return $this;
    }

    /**
     * Get hashCode
     *
     * @return string 
     */
    public function getHashCode()
    {
        return $this->hashCode;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set importId
     *
     * @param integer $importId
     * @return User
     */
    public function setImportId($importId)
    {
        $this->importId = $importId;

        return $this;
    }

    /**
     * Get importId
     *
     * @return integer 
     */
    public function getImportId()
    {
        return $this->importId;
    }

    /**
     * Set datetimeSmsImported
     *
     * @param \DateTime $datetimeSmsImported
     * @return User
     */
    public function setDatetimeSmsImported($datetimeSmsImported)
    {
        $this->datetimeSmsImported = $datetimeSmsImported;

        return $this;
    }

    /**
     * Get datetimeSmsImported
     *
     * @return \DateTime 
     */
    public function getDatetimeSmsImported()
    {
        return $this->datetimeSmsImported;
    }

    /**
     * Set restaurantSmsIdUserSmsId
     *
     * @param string $restaurantSmsIdUserSmsId
     * @return User
     */
    public function setRestaurantSmsIdUserSmsId($restaurantSmsIdUserSmsId)
    {
        $this->restaurantSmsIdUserSmsId = $restaurantSmsIdUserSmsId;

        return $this;
    }

    /**
     * Get restaurantSmsIdUserSmsId
     *
     * @return string 
     */
    public function getRestaurantSmsIdUserSmsId()
    {
        return $this->restaurantSmsIdUserSmsId;
    }

    /**
     * Set personalData
     *
     * @param integer $personalData
     * @return User
     */
    public function setPersonalData($personalData)
    {
        $this->personalData = $personalData;

        return $this;
    }

    /**
     * Get personalData
     *
     * @return integer 
     */
    public function getPersonalData()
    {
        return $this->personalData;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $this->roles = $this->getRoles();
        return serialize([$this->id, $this->username, $this->roles]);
    }

    /**
     * @return void
     */
    public function unserialize($serialized)
    {
        $this->roles = $this->getRoles();
        list($this->id, $this->username, $this->roles) = unserialize($serialized);
    }




    /**
     * Set contractTermination
     *
     * @param \DateTime $contractTermination
     * @return User
     */
    public function setContractTermination($contractTermination)
    {
        $this->contractTermination = $contractTermination;

        return $this;
    }

    /**
     * Get contractTermination
     *
     * @return \DateTime 
     */
    public function getContractTermination()
    {
        return $this->contractTermination;
    }



    /**
     * Set fundWorkingHours
     *
     * @param integer $fundWorkingHours
     * @return User
     */
    public function setFundWorkingHours($fundWorkingHours)
    {
        $this->fundWorkingHours = $fundWorkingHours;

        return $this;
    }

    /**
     * Get fundWorkingHours
     *
     * @return integer 
     */
    public function getFundWorkingHours()
    {
        return $this->fundWorkingHours;
    }
}
