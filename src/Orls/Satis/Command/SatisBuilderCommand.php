<?php

namespace Orls\Satis\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SatisBuilderCommand extends Command
{
    protected function configure()
    {
        $this->setName('build');
        $this->addArgument(
            'sources',
            InputArgument::IS_ARRAY,
            'The composer.json file(s) to build the satis conf for (separate' .
            'multiple files with spaces)'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<error>Not yet implemented</error>");
    }
}
