<?php

namespace Webron\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Webron\UserBundle\Classes\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;


class UserController extends Controller
{
	public function listAction(){
		
		$em = $this->getDoctrine()->getEntityManager();
		$classUser = new User($em);
		$user = $classUser->listUser();
		$serializer = $this->container->get('jms_serializer');
		$response = new Response($serializer->serialize($user, 'json'));
		return $response;
		
	}
	
	public function getAction($id){
		$em = $this->getDoctrine()->getEntityManager();
		$data = array(
        	"user"      => $id,
        );
		
		$classUser = new User($em);
		$user = $classUser->get($data);
		$serializer = $this->container->get('jms_serializer');
		$response = new Response($serializer->serialize($user, 'json'));
		return $response;
		
	}
	
	public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
		$user =  $this->getUser();
		if(!empty($user)){
            $user = $this->getDoctrine()->getEntityManager()->getRepository('WebronUserBundle:User')->findOneByEmail($this->getUser()->getEmail());
            $code = $this->getDoctrine()->getEntityManager()->getRepository('EpsCoreBundle:Restaurant')->getCode($user->getRestaurantId());
			return $this->redirect($this->generateUrl('eps_page_app', array('restaurant'=>$code)) . '#/');
		}

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
		
        return $this->render(
            'WebronUserBundle:User:login.html.twig',
            array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );

    }
    
    /**
     * Function for setting up user details after login
     */
    public function postLoginAction()
    {
    	$request = $this->getRequest();
        $session = $request->getSession();
     	$em = $this->getDoctrine()->getEntityManager();
		$user = $this->getUser();
        if(!empty($user)) {
            $user = $this->getDoctrine()->getEntityManager()->getRepository('WebronUserBundle:User')->findOneByEmail($this->getUser()->getEmail());
        }
        $code = $em->getRepository('EpsCoreBundle:Restaurant')->getCode($user->getRestaurantId());
		return $this->redirect($this->generateUrl('eps_page_app', array('restaurant'=>$code)) . '#/');
    }
    
    /**
     * Creates form for registering User
     */
    public function registerAction(Request $request)
    {
        $form = $this->createFormBuilder()
          ->add('email', 'email')
          ->add('password', 'text')
          ->add('name', 'text')
          ->getForm();
    
        if ($request->isMethod('POST')) {
            $form->bind($request);
       
            if ($form->isValid()) {
                $data = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
    			$user = new User($em, $this);
				$user->register($data['name'], $data['email'], $data['password']);
                return $this->redirect($this->generateUrl('user_login'));
            }
        }

        return $this->render('WebronUserBundle:User:register.html.twig', array('form' => $form->createView()));
    }
    
    protected function register($data)
    {
    }
	
	public function createAction(){
		
		$em = $this->getDoctrine()->getEntityManager();
		 
		$request  = $this->get("request")->getContent();
	    $params = json_decode($request, true);
		$params = $params['data'];
		
		$data = array(
        	"name"    	=> $params['name'],
        	"email"    	=> $params['email'],
        	"password" 	=> $params['password'],
		);
		
		$classUser = new User($em, $this);
		$user = $classUser->create($data);
		$serializer = $this->container->get('jms_serializer');
		$response = new Response($serializer->serialize($user, 'json'));
		return $response;
		
	}
	
	public function saveAction($id){
			
		$em = $this->getDoctrine()->getEntityManager();
		
		$request  = $this->get("request")->getContent();
	    $params = json_decode($request, true);
		$params = $params['data'];
		
		$data = array(
        	"name"    	=> 	$params['name'],
        	"email"    	=> 	$params['email'],
        	"id"		=>	$id,
		);
		
		if(!empty($params['password'])){
			$data['password'] = $params['password'];
		}
		
		$classUser = new User($em,$this);
		$user = $classUser->save($data);
		$serializer = $this->container->get('jms_serializer');
		$response = new Response($serializer->serialize($user, 'json'));
		return $response;
		
	}
	/*
	public function changePasswordAction(Request $request){
		$form = $this->createFormBuilder()
          ->add('id', 'text')
          ->add('password', 'text')
          ->getForm();
    
        if ($request->isMethod('POST')) {
            $form->bind($request);
       
            if ($form->isValid()) {
                $data = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
    			$user = new User($em, $this);
				$user->changePasswordAction($data);
                return $this->redirect($this->generateUrl('webron_index'));
            }
        }

        return $this->render('WebronUserBundle:User:change_password.html.twig', array('form' => $form->createView()));
		
	}
	*/
}
