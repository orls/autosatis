<?php

namespace Orls\Satis;

class RepositoriesMerger
{

    /**
     * Merges together all the VCS repositories from a set of parsed
     * composer.json files
     *
     * @param  mixed $sources a list of parsed composer.json file contents
     * @return mixed          a list of repository definitions
     */
    public function getRepositories($sources)
    {
        $repositories = array();
        foreach ($sources as $source) {
            if (!array_key_exists('repositories', $source)) {
                continue;
            }

            foreach($source['repositories'] as $repo)
            {
                if (!array_key_exists('type', $repo) ||
                    $repo['type'] == 'composer') {
                    continue;
                }
                if (!in_array($repo, $repositories)) {
                    $repositories []= $repo;
                }
            }
        }
        return $repositories;
    }
}
