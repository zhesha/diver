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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xmlParser = $this->getApplication()->getKernel()->getContainer()->get('xml_parser');
        $xmlParser->parseFromFile(__DIR__.'/../../../../web/upload/dylerprice.xml');

        $output->writeln('OK');
    }
}