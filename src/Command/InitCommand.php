<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Filesystem\Filesystem;

class InitCommand extends Command {

    private $rootDir;

    protected static $defaultName = 'app:init';

    public function __construct($rootDir) {
      parent::__construct();
      $this->rootDir = $rootDir;
    }

    protected function configure() {
        $this
                ->setDescription('Add a short description for your command')
                ->addOption('test', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);
        $io->section("Initialisation de l'application");

        $this->removeFiles($io, $output);
        $this->dropDatabase($io, $output);
        $this->createDatabase($io, $output);
        $this->executeMigration($io, $output);
        $this->addThemeStandard($io, $output);

        if ($input->getOption('test')) {
            $this->executeFixture($io, $output);
        }
    }

    private function removeFiles(SymfonyStyle $io, OutputInterface $output) {
        $folders = [
            $this->rootDir . '/public/media',
            $this->rootDir . '/templates/themes',
        ];

        $fileSystem = new Filesystem();
        foreach ($folders as $folder) {
            $fileSystem->remove($folder);
            $fileSystem->mkdir($folder);
        }
        $io->success("Suppression des fichiers effectué");
    }

    private function dropDatabase(SymfonyStyle $io, OutputInterface $output) {
        $command = $this->getApplication()->find('doctrine:database:drop');
        $argument = new ArrayInput([
            '--force' => true
        ]);
        $command->run($argument, $output);
        $io->success("Drop de la base de données effectué");
    }

    private function createDatabase(SymfonyStyle $io, OutputInterface $output) {
        $command = $this->getApplication()->find('doctrine:database:create');
        $argument = new ArrayInput([]);
        $command->run($argument, $output);
        $io->success("Création de la base de données effectué");
    }

    private function executeMigration(SymfonyStyle $io, OutputInterface $output) {
        $command = $this->getApplication()->find('doctrine:migrations:migrate');
        $argument = new ArrayInput([
            '--no-interaction' => true
        ]);
        $argument->setInteractive(false);
        $command->run($argument, $output);
        $io->success("Execution des migrations effectué");
    }

    private function addThemeStandard(SymfonyStyle $io, OutputInterface $output) {
        $command = $this->getApplication()->find('make:theme');
        $argument = new ArrayInput([
            'theme-name' => 'Standard'
        ]);
        $argument->setInteractive(false);
        $command->run($argument, $output);
        $io->success("Création du thème Standard effectué");
    }

    private function executeFixture(SymfonyStyle $io, OutputInterface $output) {
        $command = $this->getApplication()->find('doctrine:fixtures:load');
        $argument = new ArrayInput([
            '--append' => true
        ]);
        $command->run($argument, $output);
        $io->success("Ajout du jeu de test effectué");
    }

}
