<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

/**
 * Description of FormLoginAuthenticator
 *
 * @author gjean
 */
class FormLoginAuthenticator extends AbstractFormLoginAuthenticator {

    protected function getLoginUrl(): string {
        dump('getLoginUrl'); exit;
    }

    public function checkCredentials($credentials, UserInterface $user): bool {
        dump('checkCredentials'); exit;
    }

    public function getCredentials(Request $request) {
        dump('getCredentials'); exit;
    }

    public function getUser($credentials, UserProviderInterface $userProvider) {
        dump('getUser'); exit;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) {
        dump('onAuthenticationSuccess'); exit;
    }

    public function supports(Request $request): bool {
        dump('supports'); exit;
    }

}
