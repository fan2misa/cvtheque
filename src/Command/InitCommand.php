<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArrayInput;

class InitCommand extends Command {

    protected static $defaultName = 'app:init';

    protected function configure() {
        $this
                ->setDescription('Add a short description for your command')
                ->addOption('test', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);

        $this->removeFiles($io, $output);
        $this->dropDatabase($io, $output);
        $this->createDatabase($io, $output);
        $this->executeSchema($io, $output);
        $this->executeMigration($io, $output);

        if ($input->getOption('test')) {
            $this->executeFixture($io, $output);
        }
    }

    private function removeFiles(SymfonyStyle $io, OutputInterface $output) {
        $io->section("Suppression des fichiers");
        $fileSystem = new \Symfony\Component\Filesystem\Filesystem();
        $folders = [];
                
        foreach ($folders as $folder) {
            $fileSystem->remove($folder);
            $fileSystem->mkdir($folder);
        }
    }
    
    private function dropDatabase(SymfonyStyle $io, OutputInterface $output) {
        $io->section("Drop de la base de données");
        $command = $this->getApplication()->find('doctrine:database:drop');
        $argument = new ArrayInput(['--force' => true]);
        $command->run($argument, $output);
    }

    private function createDatabase(SymfonyStyle $io, OutputInterface $output) {
        $io->section("Création de la base de données");
        $command = $this->getApplication()->find('doctrine:database:create');
        $argument = new ArrayInput([]);
        $command->run($argument, $output);
    }

    private function executeSchema(SymfonyStyle $io, OutputInterface $output) {
        $io->section("Création des tables dans la base de données");
        $command = $this->getApplication()->find('doctrine:schema:create');
        $argument = new ArrayInput([]);
        $argument->setInteractive(false);
        $command->run($argument, $output);
    }
    
    private function executeMigration(SymfonyStyle $io, OutputInterface $output) {
        $io->section("Execution des migrations");
        $command = $this->getApplication()->find('doctrine:migrations:version');
        $argument = new ArrayInput([
            '--add' => true,
            '--all' => true
        ]);
        $argument->setInteractive(false);
        $command->run($argument, $output);
    }
    
    private function executeFixture(SymfonyStyle $io, OutputInterface $output) {
        $io->section("Ajout du jeu de test");
        $command = $this->getApplication()->find('doctrine:fixtures:load');
        $argument = new ArrayInput([
            '--append' => true
        ]);
        $command->run($argument, $output);
    }
}
