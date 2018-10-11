<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Twig_Environment;

/**
 * Description of UserInscriptionService
 *
 * @author gjean
 */
class UserService {

    private $doctrine;
    
    private $passwordEncoder;
    
    private $mailer;
    
    private $twig;

    public function __construct(Registry $doctrine, UserPasswordEncoder $passwordEncoder, Swift_Mailer $mailer, Twig_Environment $twig) {
        $this->doctrine = $doctrine;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function registration(User $user) {
        $user->setTokenInscription($this->generateToken());
        $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
        $this->doctrine->getManager()->persist($user);
        $this->doctrine->getManager()->flush();
        $this->sendMailConfirmationInscription($user);
    }
    
    public function enable(User $user) {
        $user->setEnabled(TRUE);
        $user->setTokenInscription(NULL);
        $this->doctrine->getManager()->persist($user);
        $this->doctrine->getManager()->flush();
    }
    
    public function getAvatar(User $user) {
        return $user->getAvatarPath()
                ? $user->getAvatarPath()
                : "https://dummyimage.com/100x120/ecf0f1/7f8c8d";
    }

    private function sendMailConfirmationInscription(User $user) {
        $message = (new Swift_Message('Hello Email'))
                ->setFrom('send@example.com')
                ->setTo('recipient@example.com')
                ->setBody($this->getTemplateConfirmationInscription($user), 'text/html');
        
        $this->mailer->send($message);
    }
    
    private function getTemplateConfirmationInscription(User $user) {
        return $this->twig->render('mails/inscription.html.twig', [
            'user' => $user
        ]);
    }

    private function generateToken() {
        return uniqid();
    }
}
