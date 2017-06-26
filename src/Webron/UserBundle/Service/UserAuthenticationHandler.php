<?php

namespace Webron\UserBundle\Service;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class UserAuthenticationHandler implements LogoutSuccessHandlerInterface
{
  
    protected $dm;

    public function __construct($dm, $router)
    {
        $this->dm = $dm;
        $this->router = $router;
    }   

    public function onLogoutSuccess(Request $request) 
    {
        
        //throw new \Exception('test');
        return new RedirectResponse($this->router->generate('user_login'));
    }
}
