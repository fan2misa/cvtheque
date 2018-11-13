<?php

namespace App\Service;

use App\Entity\User;
use App\ImageFilter\UserAvatarImageFilter;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

    private $packages;

    private $imageManager;

    private $appPath;

    private $publicPath;

    private $parameters;

    private $fileSystem;

    public function __construct(Registry $doctrine, UserPasswordEncoder $passwordEncoder, Swift_Mailer $mailer, Twig_Environment $twig, Packages $packages, ImageManager $imageManager, $app_path, $parameters) {
        $this->doctrine = $doctrine;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->packages = $packages;
        $this->imageManager = $imageManager;
        $this->appPath = $app_path;
        $this->publicPath = $this->appPath . '/public';
        $this->parameters = $parameters;
        $this->fileSystem = new Filesystem();
    }

    public function registration(User $user) {
        $user->setTokenInscription($this->generateToken());
        $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
        $this->doctrine->getManager()->persist($user);
        $this->doctrine->getManager()->flush();
        $this->sendMailConfirmationInscription($user);
    }

    public function save(User $user) {
        $this->uploadAvatar($user);
        $this->doctrine->getManager()->persist($user);
        $this->doctrine->getManager()->flush();
    }
    
    public function enable(User $user) {
        $user->setEnabled(TRUE);
        $user->setTokenInscription(NULL);
        $this->doctrine->getManager()->persist($user);
        $this->doctrine->getManager()->flush();
    }
    
    public function getAvatar(User $user) {
        return $user->getAvatarPath() && !($user->getAvatarPath() instanceof UploadedFile)
            ? $this->imageManager->get($user->getAvatarPath(), UserAvatarImageFilter::class)
            : $this->getDefaultAvatar();
    }

    public function getDefaultAvatar() {
        $avatar = $this->parameters['default'];
        if (!preg_match('/^(http|https)/', $avatar)) {
            $avatar = $this->imageManager->get($avatar, UserAvatarImageFilter::class);
        }
        return $avatar;
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

    private function uploadAvatar(User $user) {
        if ($user->getAvatarPath() instanceof UploadedFile) {
            $filename = $this->uploadFile($user->getAvatarPath());
            $user->setAvatarPath($filename);
        }
    }

    private function uploadFile(File $file) {
        $filename =  md5(uniqid()) . '.' . $file->guessExtension();
        $filepath = rtrim($this->parameters['avatar_path'], '/');
        $this->fileSystem->mkdir($this->getAvatarDirectory() . '/' . $filepath);
        $file->move($this->getAvatarDirectory() . '/' . $filepath, $filename);
        return $filepath . '/' . $filename;
    }

    private function getAvatarDirectory() {
        return rtrim($this->publicPath, '/');
    }
}
