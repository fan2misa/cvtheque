<?php

namespace App\Command;

use App\Entity\Theme;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBag;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;


class InitCommand extends Command
{
    private $doctrine;

    private $rootDir;

    private $parameterBag;

    protected static $defaultName = 'app:init';

    public function __construct(Registry $doctrine, $rootDir, ContainerBag $parameterBag)
    {
        parent::__construct();
        $this->doctrine = $doctrine;
        $this->rootDir = $rootDir;
        $this->parameterBag = $parameterBag;
    }

    protected function configure()
    {
        $this
            ->setDescription('Initialisation de l\'application')
            ->addOption('group', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Execute fixture in this group');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        ini_set('memory_limit', '-1');
        $this->doctrine->getManager()->getConnection()->getConfiguration()->setSQLLogger(null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start = microtime(true);

        $io = new SymfonyStyle($input, $output);
        $io->section("Initialisation de l'application");

        $this->removeFiles($io, $output);
        $this->dropDatabase($io, $output);
        $this->createDatabase($io, $output);

        $this->executeMigration($io, $output);
        $this->resetTemplates($io, $output);

        $this->executeFixture($io, $output, $input->getOption('group'));

        $end = microtime(true);

        $io->success("Temps d'execution de la commande : " . round(($end - $start) / 60, 2) . " min");
    }

    private function removeFiles(SymfonyStyle $io, OutputInterface $output)
    {
        $folders = [
            $this->rootDir . '/public/' . trim($this->parameterBag->get('media')['directory'], '/'),
        ];

        $fileSystem = new Filesystem();
        foreach ($folders as $folder) {
            $fileSystem->remove($folder);
            $fileSystem->mkdir($folder);
        }

        $io->success("Suppression des fichiers effectué");
    }

    private function dropDatabase(SymfonyStyle $io, OutputInterface $output)
    {
        $command = $this->getApplication()->find('doctrine:database:drop');
        $argument = new ArrayInput([
            '--force' => true
        ]);
        $command->run($argument, $output);
        $io->success("Drop de la base de données effectué");
    }

    private function createDatabase(SymfonyStyle $io, OutputInterface $output)
    {
        $command = $this->getApplication()->find('doctrine:database:create');
        $argument = new ArrayInput([]);
        $command->run($argument, $output);
        $io->success("Création de la base de données effectué");
    }

    private function executeMigration(SymfonyStyle $io, OutputInterface $output)
    {
        $command = $this->getApplication()->find('doctrine:migrations:migrate');
        $argument = new ArrayInput([
            '--no-interaction' => true
        ]);
        $argument->setInteractive(false);
        $command->run($argument, $output);
        $io->success("Execution des migrations effectué");
    }

    private function resetTemplates(SymfonyStyle $io, OutputInterface $output) {
        $folders = [
            $this->rootDir . '/public/themes',
            $this->rootDir . '/templates/themes',
        ];

        $fileSystem = new Filesystem();
        $finder = new Finder();
        $finder
            ->directories()
            ->in($folders)
            ->depth(0);

        foreach ($finder as $folder) {
            if (!in_array($folder->getRelativePathname(), ['standard'])) {
                $fileSystem->remove($folder);
            }
        }

        $io->success("Suppression des templates de thème effectué");

        $entity = new Theme();
        $entity
            ->setNom('Standard')
            ->setDescription('Thème standard du site. Ce Thème est prévu pour tenir sur une seul page.')
            ->setSlug(Str::asSnakeCase($entity->getNom()))
            ->setTemplatePath(Str::asFilePath('themes/' . $entity->getSlug()))
            ->setPublicPath(Str::asFilePath('themes/' . $entity->getSlug()));

        $this->doctrine->getManager()->persist($entity);
        $this->doctrine->getManager()->flush();

        $io->success("Création du thème standard effectué");
    }

    private function executeFixture(SymfonyStyle $io, OutputInterface $output, array $groups = [])
    {
        $command = $this->getApplication()->find('doctrine:fixtures:load');
        $argument = new ArrayInput([
            '--append' => true,
            '--group' => array_merge(['initial'], $groups)
        ]);
        $command->run($argument, $output);
        $io->success("Ajout du jeu de test effectué");
    }
}
