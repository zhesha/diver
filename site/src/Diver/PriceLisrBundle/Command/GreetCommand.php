<?php
namespace Diver\PriceLisrBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('diver:parsexml')
            ->setDescription('parse XML')
            /*->addArgument(
            'name',
            InputArgument::OPTIONAL,
            'Who do you want to greet?'
        )*/
            /*->addOption(
            'yell',
            null,
            InputOption::VALUE_NONE,
            'If set, the task will yell in uppercase letters'
        )*/
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xmlParser = $this->getApplication()->getKernel()->getContainer()->get('xml_parser');
        $xmlParser->parseFromFile();

        $output->writeln('OK');
    }
}