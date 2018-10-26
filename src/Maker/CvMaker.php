<?php

namespace App\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class CvMaker extends AbstractMaker {

    private $rootDir;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * Return the command name for your maker (e.g. make:report).
     *
     * @return string
     */
    public static function getCommandName(): string
    {
        return 'make:cv:theme';
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
            ->setDescription('Creates a new CV Theme class')
            ->addArgument('theme-class', InputArgument::OPTIONAL, sprintf('Choose a name for your Theme class (e.g. <fg=yellow>%sTheme</>)', Str::asClassName(Str::getRandomTerm())))
            ->addArgument('theme-name', InputArgument::OPTIONAL, sprintf('Choose a name for your Theme', Str::getRandomTerm()))
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
        $themeClassNameDetails = $generator->createClassNameDetails($input->getArgument('theme-class'), 'Theme\\Cv\\', 'Theme');
        $generator->generateClass($themeClassNameDetails->getFullName(), $this->rootDir . '/src/Resources/skeleton/theme/CvTheme.tpl.php', [
            'parent_class_name' => 'AbstractTheme',
            'theme_name' => $input->getArgument('theme-name')
        ]);

        $generator->writeChanges();

        $this->writeSuccessMessage($io);

        $io->text('Your Theme is created at ' . $themeClassNameDetails->getFullName());
    }
}