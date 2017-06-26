<?php

namespace Webron\UserBundle\Classes;

use Eps\CoreBundle\Entity\UserRestaurant;
use Webron\CoreBundle\Classes\WebronCoreClass;
use Webron\CoreBundle\Classes\WebronError;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\EventDispatcher\EventDispatcher,
    Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken,
    Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


class User extends WebronCoreClass
{

	protected $em;
	protected $controller;
	
	public function __construct($em = null, $controller = null)
	{
		$this->em = $em;
		$this->controller = $controller;

        parent::__construct($em);
	}
	
	
	public function loginAction()
    {
        $this->login();
        
        return $this->redirect($this->generateUrl('user_login'));
		
    }
	
	public function loginPageAction()
    {
        $request = $this->getRequest();
            $session = $request->getSession();

            if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                $error = $request->attributes->get(
                    SecurityContext::AUTHENTICATION_ERROR
                );
            } else {
                $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            }
    
            return $this->render(
                array(
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error'         => $error,
                )
            );
        
    }
	
	 public function login()
     {
       
        $usr= $this->get('security.context')->getToken()->getUser();
        $session = new Session();
        
     }
	
	public function getUser($id){
		$user = $this->em->getRepository('\Webron\UserBundle\Entity\User')->findOneById($id);
		return $user;
	}

    public function getUserByEmail($email){
        $user = $this->em->getRepository('\Webron\UserBundle\Entity\User')->findOneBy(array('email'=>$email));
        return $user;
    }
	
	public function listUser(){
		
		$retval = array();
		$users = $this->em->getRepository('\Webron\UserBundle\Entity\User')->findAll();
		foreach ($users as $key => $value) {
			$retval[] = array("id"=>$value->getId(), "title"=>$value->getName());
		}
		return $retval;
		
	}
	
	public function get($data){
		$retval = array();
		$user = $this->getUser($data['user']);
		if(!empty($user)){
			$retval['data']['name'] = $user->getName();
			$retval['data']['email'] = $user->getEmail();
		}
		return $retval;	
	}
	
	public function register($name, $email, $password)
	 {
	    $em = $this->em;
         $classError = new WebronError();

	    /*if (strlen($password) < 6) {
            echo 'coze';
            $classError->create('1009', 'password', 'Password should have at least 6 characters.');
            return $classError->printErrors();
	      //throw new InvalidEmailException();
	    }

        if (strtolower($password) == $password){
         $classError->create('1010', 'password', 'Password should have at least one upper letter.');
         return $classError->printErrors();
         //throw new InvalidEmailException();
        }

         if (strtoupper($password) == $password){
             $classError->create('1011', 'password', 'Password should have at least one lower letter.');
             return $classError->printErrors();
             //throw new InvalidEmailException();
         }*/

        /* Overime email */
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $classError->create('1001', 'email', 'invalid-email');
         return $classError->printErrors();
         //throw new InvalidEmailException();
        }
    
   	 	// vyhladame tento email v DB a ak uz existuje, je to zle
    	if ($em->getRepository('Webron\UserBundle\Entity\User')->findOneBy(array('email' => $email))) {
            $classError->create('1002', 'email', 'email-already-taken');
            return $classError->printErrors();
       		//throw new EmailAlreadyUsedException();
    	}
    
    	$userEntity = new \Webron\UserBundle\Entity\User();
		
		/* Teraz pracujeme s MySQL */
		$userEntity->setEmail($email);
		$userEntity->setName($name['name']);
        $userEntity->setSurname($name['surname']);
		$userEntity->setDateRegistered(new \DateTime());
         $userEntity->setVerified(0);
		/* Zahashovanie hesla */
	    $encoder = $this->controller->get('security.encoder_factory')->getEncoder($userEntity);
	    $pass = $encoder->encodePassword($password, $userEntity->getSalt());
		$userEntity->setPassword($pass);
		
	    $em->persist($userEntity);
	    $em->flush();
        /*
        $token = new UsernamePasswordToken($userEntity, null, 'secured_area', $userEntity->getRoles());
        $this->controller->get('security.context')->setToken($token);
        $this->controller->get('session')->set('_security_main',serialize($token));*/
	   return $userEntity;
	}

	public function create($data){
		$user = $this->register($data['name'],$data['email'],$data['password']);
        if(is_object($user)){
            $userRestaurantData = array();
            $userRestaurantData['userId'] = $user->getId();
            $userRestaurantData['restaurantId'] = $data['restaurant'];
            $userRestaurantData['active'] = 1;
            $this->em->getRepository('EpsCoreBundle:UserRestaurant')->upsert($userRestaurantData, 0);
            return $user->getId();
        }
        return $user;
	}
	
	protected function changePassword($data){
        $classError = new WebronError();
        $password = $data['password'];
        if (strlen($password) < 6) {
            $classError->create('1009', 'password', 'password-at-least-6-characters');
            return $classError->printErrors();
            //throw new InvalidEmailException();
        }

        if (strtolower($password) == $password){
            $classError->create('1010', 'password', 'password-at-least-one-upper-letter');
            return $classError->printErrors();
            //throw new InvalidEmailException();
        }

        if (strtoupper($password) == $password){
            $classError->create('1011', 'password', 'password-at-least-one-lower-letter');
            return $classError->printErrors();
            //throw new InvalidEmailException();
        }

		$user = $this->em->getRepository('Webron\UserBundle\Entity\User')->findOneBy(array('id' => $data['id']));
		if(empty($user)) return 0;
		$encoder = $this->controller->get('security.encoder_factory')->getEncoder($user);
	    $pass = $encoder->encodePassword($data['password'], $user->getSalt());
		$user->setPassword($pass);
		$this->em->persist($user);
		$this->em->flush();
		return 1;
	}
	
	public function save($data){
		if(!empty($data['password'])){
			$this->changePassword($data);
		}
		$user = $this->em->getRepository('Webron\UserBundle\Entity\User')->findOneById($data['id']);
		if(!empty($user)){
			$user->setName($data['name']);
			$user->setEmail($data['email']);
			$this->em->persist($user);
			$this->em->flush();
		}
		return 1;
	}
	
	public function changePasswordAction($data){
		$retval = 0;
		if(!empty($data['password']) && !empty($data['id'])){
			$retval = $this->changePassword($data);
		}
		return $retval;
	}

	public function changePasswordUserAction($data){
		$retval = 0;
		if(!empty($data['password']) && !empty($data['id'])){
			$userEntity = $this->em->getRepository('WebronUserBundle:User')->findOneBy(array('id'=>$data['id']));
			$encoder = $this->controller->get('security.encoder_factory')->getEncoder($userEntity);
			$pass = $encoder->encodePassword($data['password_old'], $userEntity->getSalt());
			$oldPass = $userEntity->getPassword();
			if($pass===$oldPass){
				$retval = $this->changePassword($data);
			} else {
				return 0;;
			}
		}
		return $retval;
	}

    public function generatePassword(){
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function checkPassword($userId, $password){
        $user = $this->em->getRepository('WebronUserBundle:User')->findOneById($userId);
        if ($user) {
            // Get the encoder for the users password
            $encoder_service = $this->controller->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($user);
            // Note the difference
            if ($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
                // Get profile list
                return 1;
            } else {
                // Password bad
                return 0;
            }
        } else {
            // Username bad
            return 0;
        }
    }

    public function getName($id){
        $name = '';
        $obj = $this->em->getRepository('WebronUserBundle:User')->findOneById($id);
        if(empty($obj)) return $name;
        $name = $obj->getName() . ' ' . $obj->getSurname();
        return $name;
    }

    public function loadUserByUsername($username){
        $obj = $this->em->getRepository('WebronUserBundle:User')->findOneBy(array('email'=>$username));
        $obj->setPassword('');
        $obj->setSalt('');
        return $obj;
    }
}
class InvalidEmailException extends \Exception {}
class EmailAlreadyUsedException extends \Exception {}
