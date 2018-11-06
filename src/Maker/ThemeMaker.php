<?php

namespace App\Maker;

use App\Entity\Theme;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class ThemeMaker extends AbstractMaker {

    private $doctrine;

    private $rootDir;

    public function __construct(Registry $doctrine, $rootDir)
    {
        $this->doctrine = $doctrine;
        $this->rootDir = $rootDir;
    }

    /**
     * Return the command name for your maker (e.g. make:report).
     *
     * @return string
     */
    public static function getCommandName(): string
    {
        return 'make:themes';
    }

    /**
     * Configure the command: set description, input arguments, options, etc.
     *
     * By default, all arguments will be asked interactively. If you want
     * to avoid that, use the $inputConfig->setArgumentAsNonInteractive() method.
     *
     * @param Command $command
     * @param InputConfiguration $inputConfig
     */
    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $command
            ->setDescription('Creates a new CV Theme')
            ->addArgument('themes-name', InputArgument::OPTIONAL, sprintf('Choose a name for your Theme', Str::getRandomTerm()))
            ->addArgument('themes-description', InputArgument::OPTIONAL, sprintf('Set a description for your Theme'))
        ;
    }

    /**
     * Configure any library dependencies that your maker requires.
     *
     * @param DependencyBuilder $dependencies
     */
    public function configureDependencies(DependencyBuilder $dependencies)
    {

    }

    /**
     * Called after normal code generation: allows you to do anything.
     *
     * @param InputInterface $input
     * @param ConsoleStyle $io
     * @param Generator $generator
     */
    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        $entity = $this->generateEntity($input, $io, $generator);
        $this->generateTemplateEdition($entity, $input, $io, $generator);
        $this->generateTemplateVisualisation($entity, $input, $io, $generator);
        $this->generateCssFiles($entity, $input, $io, $generator);

        $generator->writeChanges();

        $this->writeSuccessMessage($io);

        $io->text('Your Theme is created with name : ' . $entity->getNom());
        $io->text('You can find template at : ' . $entity->getTemplatePath());
        $io->text('You can find css files at : ' . $entity->getPublicPath());
    }

    private function generateEntity(InputInterface $input, ConsoleStyle $io, Generator $generator): Theme {
        $entity = new Theme();
        $entity
            ->setNom($input->getArgument('themes-name'))
            ->setDescription($input->getArgument('themes-description'))
            ->setSlug(Str::asSnakeCase($entity->getNom()))
            ->setTemplatePath(Str::asFilePath('themes/' . $entity->getSlug()))
            ->setPublicPath(Str::asFilePath('themes/' . $entity->getSlug()));

        $this->doctrine->getManager()->persist($entity);
        $this->doctrine->getManager()->flush();

        return $entity;
    }

    private function generateCssFiles(Theme $theme, InputInterface $input, ConsoleStyle $io, Generator $generator): void {
        $generator->generateFile($this->getTargetPublicPath($theme->getCssPathGlobal()), $this->getTemplateName('theme'), [
            'theme_name' => $input->getArgument('themes-name')
        ]);
        $generator->generateFile($this->getTargetPublicPath($theme->getCssPathEdition()), $this->getTemplateName('theme-edition'), [
            'theme_name' => $input->getArgument('themes-name')
        ]);
        $generator->generateFile($this->getTargetPublicPath($theme->getCssPathVisualisation()), $this->getTemplateName('theme-visualisation'), [
            'theme_name' => $input->getArgument('themes-name')
        ]);
    }

    private function generateTemplateEdition(Theme $theme, InputInterface $input, ConsoleStyle $io, Generator $generator): void {
        $generator->generateFile($this->getTargetTemplatePath($theme->getTemplatePathEdition()), $this->getTemplateName('edition'), [
            'theme_name' => $input->getArgument('themes-name')
        ]);
    }

    private function generateTemplateVisualisation(Theme $theme, InputInterface $input, ConsoleStyle $io, Generator $generator): void {
        $generator->generateFile($this->getTargetTemplatePath($theme->getTemplatePathVisualisation()), $this->getTemplateName('visualisation'), [
            'parent_class_name' => 'AbstractTheme',
            'theme_name' => $input->getArgument('themes-name')
        ]);
    }

    private function getTargetTemplatePath($path) {
        return 'templates/' . $path;
    }

    private function getTargetPublicPath($path) {
        return 'public/' . $path;
    }

    private function getTemplateName($filename) {
        return $this->rootDir . '/src/Resources/skeleton/theme/' . $filename . '.tpl.php';
    }
}