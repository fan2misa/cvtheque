<?php

namespace App\Service;

use App\Entity\CV;
use App\Entity\Experience;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of CVService
 *
 * @author gjean
 */
class CVService {

    private $doctrine;
    
    private $packages;
    
    private $publicPath;
    
    private $parameters;

    public function __construct(Registry $doctrine, Packages $packages, $public_path, $parameters) {
        $this->doctrine = $doctrine;
        $this->packages = $packages;
        $this->publicPath = $public_path;
        $this->parameters = $parameters;
    }

    public function save(CV $cv) {
        $this->uploadAvatar($cv);
        $this->doctrine->getManager()->persist($cv);
        $this->doctrine->getManager()->flush();
    }

    public function getAvatar(CV $cv) {
        return $cv->getAvatarPath()
                ? $this->packages->getUrl($cv->getAvatarPath())
                : $this->getDefaultAvatar($cv);
    }
    
    public function getDefaultAvatar(CV $cv) {
        return $cv->getUser()->getAvatarPath() 
                ? $this->packages->getUrl($cv->getUser()->getAvatarPath())
                : "https://dummyimage.com/200x250/ecf0f1/7f8c8d";
    }
    
    public function getExperiencePeriode(Experience $experience) {
        return $experience->getInformationsGenerales()->enCours()
                ? "Depuis le " . $experience->getInformationsGenerales()->getDateDebut()->format('d/m/Y')
                : "Du " . $experience->getInformationsGenerales()->getDateDebut()->format('d/m/Y') . " au " . $experience->getInformationsGenerales()->getDateFin()->format('d/m/Y');
    }
    
    private function uploadAvatar(CV $cv) {
        if ($cv->getAvatarPath() instanceof UploadedFile) {
            $filename = $this->uploadFile($cv->getAvatarPath());
            $cv->setAvatarPath($filename);
        }
    }
    
    private function uploadFile(File $file) {
        $filename =  md5(uniqid()) . '.' . $file->guessExtension();
        $filepath = rtrim($this->parameters['avatar_path'], '/');
        $file->move($this->getAvatarDirectory() . '/' . $filepath, $filename);
        return $filepath . '/' . $filename;
    }
    
    private function getAvatarDirectory() {
        return rtrim($this->publicPath, '/');
    }
}
