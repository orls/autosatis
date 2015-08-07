<?php

namespace Orls\Satis;

class RequirementsMerger
{
    /**
     * Merges together all the requirements and dev-requirements of the input
     * files
     * 
     * @param  mixed $sources a list of parsed composer.json contents
     * @return mixed          an assoc array of package names to version strings
     */
    public function getRequirements($sources)
    {
        $requirements = array();

        foreach ($sources as $sourceFile) {
            foreach (array('require', 'require-dev') as $key) {
                if (!array_key_exists($key, $sourceFile)) {
                    continue;
                }

                foreach ($sourceFile[$key] as $package => $version) {
                    if (!array_key_exists($package, $requirements)) {
                        $requirements[$package] = array();
                    }
                    $requirements[$package] []= $version;
                }
            }
        }

        foreach ($requirements as $package => &$versions) {

            $versions = implode(' || ' , array_unique($versions));
        }

        return $requirements;
    }
}
