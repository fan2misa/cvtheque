<?php

namespace App\Service;

use App\Entity\Cv;
use App\Entity\Experience;
use App\Entity\Formation;
use App\Entity\Theme;
use App\ImageFilter\CvAvatarImageFilter;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Filesystem\Filesystem;
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

    private $imageManager;

    private $appPath;

    private $publicPath;

    private $parameters;

    private $fileSystem;

    public function __construct(Registry $doctrine, Packages $packages, ImageManager $imageManager, $app_path, $parameters) {
        $this->doctrine = $doctrine;
        $this->packages = $packages;
        $this->imageManager = $imageManager;
        $this->appPath = $app_path;
        $this->publicPath = $this->appPath . '/public';
        $this->parameters = $parameters;
        $this->fileSystem = new Filesystem();
    }

    public function create(): Cv {
        $cv = new Cv();
        $cv->setTheme($this->getThemeStandard());
        return $cv;
    }

    public function save(Cv $cv) {
        $this->uploadAvatar($cv);
        $this->doctrine->getManager()->persist($cv);
        $this->doctrine->getManager()->flush();
    }

    public function getAvatar(Cv $cv) {
        return $cv->getAvatarPath() && !($cv->getAvatarPath() instanceof UploadedFile)
            ? $this->packages->getUrl($this->imageManager->get($cv->getAvatarPath(), CvAvatarImageFilter::class))
            : $this->getDefaultAvatar($cv);
    }

    public function getDefaultAvatar(Cv $cv) {
        return $cv->getUser()->getAvatarPath()
            ? $this->packages->getUrl($this->imageManager->get($cv->getUser()->getAvatarPath(), CvAvatarImageFilter::class))
            : "https://dummyimage.com/200x250/ecf0f1/7f8c8d";
    }

    public function hasCustomTemplateEdition(Cv $cv): bool {
        return null !==  $cv->getTheme()->getTemplatePathEdition()
            && file_exists($this->appPath . '/templates/' . $cv->getTheme()->getTemplatePathEdition());
    }

    public function getTemplatePath(Cv $cv): string {
        return $this->hasCustomTemplateEdition($cv) ? $cv->getTheme()->getTemplatePath() : '.inc/theme';
    }

    public function getTemplateEdition(Cv $cv): string {
        return $this->getTemplatePath($cv) . '/edition.html.twig';
    }

    public function getExperiencePeriode(Experience $experience) {
        return $experience->getInformationsGenerales()->enCours()
            ? "Depuis le " . $experience->getInformationsGenerales()->getDateDebut()->format('d/m/Y')
            : "Du " . $experience->getInformationsGenerales()->getDateDebut()->format('d/m/Y') . " au " . $experience->getInformationsGenerales()->getDateFin()->format('d/m/Y');
    }

    public function getFormationPeriode(Formation $formation) {
        return "Du " . $formation->getDateDebut()->format('d/m/Y') . " au " . $formation->getDateFin()->format('d/m/Y');
    }

    public function getThemeStandard(): Theme
    {
        return $this->doctrine->getRepository(Theme::class)->findOneBySlug($this->parameters['theme']['standard']);
    }

    private function uploadAvatar(Cv $cv) {
        if ($cv->getAvatarPath() instanceof UploadedFile) {
            $filename = $this->uploadFile($cv->getAvatarPath());
            $cv->setAvatarPath($filename);
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
