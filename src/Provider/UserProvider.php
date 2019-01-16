<?php

namespace App\Provider;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Description of UserProvider
 *
 * @author gjean
 */
class UserProvider implements UserProviderInterface {

    private $doctrine;

    public function __construct(Registry $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function loadUserByUsername($username): ?UserInterface {
        return $this->doctrine->getRepository(User::class)->findOneByEmail($username);
    }

    public function refreshUser(UserInterface $user): UserInterface {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class): bool {
        return $class === User::class;
    }

}
