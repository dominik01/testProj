<?php
// src/AppBundle/Security/User/WebserviceUserProvider.php
namespace Webron\CryptoBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class SamlUserProvider implements UserProviderInterface
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }
    public function loadUserByUsername($username)
    {
        $userData = $this->em->getRepository('WebronUserBundle:User')->findOneBy(array('email'=>$username));
        if($userData){
            $retval = new SamlUser($userData->getEmail(),$userData->getPassword(), $userData->getSalt(), $userData->getRoles());
            return $retval;
        } else {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof SamlUser) {
            throw new UnsupportedUserException(
            sprintf('Instances of "%s" are not supported.', get_class($user))
        );
    }

        return $this->loadUserByUsername($user->getEmail());
    }

    public function supportsClass($class)
    {
        return $class === 'Webron\UserBundle\Entity\User';
    }
}
?>