<?php

namespace Orls\Satis\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Composer\Json\JsonFile;

use Orls\Satis\RequirementsMerger;
use Orls\Satis\RepositoriesMerger;

class SatisBuilderCommand extends Command
{
    protected function configure()
    {
        $this->setName('build');
        $this->addArgument(
            'satisTemplate',
            InputArgument::REQUIRED,
            'The skeleton satis.json file(s) to build'
        );
        $this->addArgument(
            'composerJson',
            InputArgument::IS_ARRAY | InputArgument::REQUIRED,
            'The composer.json file(s) to build the satis conf for (separate' .
            'multiple files with spaces)'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $satisTemplatePath = $input->getArgument('satisTemplate');
        $sourcePaths = $input->getArgument('composerJson');

        $templateJson = new JsonFile($satisTemplatePath);
        $satisFile = $templateJson->read();

        $sources = array();
        foreach ($sourcePaths as $sourcePath) {
            $jsonFile = new JsonFile($sourcePath);
            $sources []= $jsonFile->read();
        }

        $reqsMerger = new RequirementsMerger();
        $reposMerger = new RepositoriesMerger();

        $reqs = $reqsMerger->getRequirements($sources);
        $repos = $reposMerger->getRepositories($sources);

        // always append packagist
        $repos []= array("type" => "composer","url" => "http://packagist.org");

        $satisFile['require-all'] = false;
        $satisFile['require'] = $reqs;
        $satisFile['repositories'] = $repos;

        $output->write(JsonFile::encode($satisFile));
    }
}
