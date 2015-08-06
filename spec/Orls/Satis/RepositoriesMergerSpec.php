<?php

namespace spec\Orls\Satis;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositoriesMergerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Orls\Satis\RepositoriesMerger');
    }

    function it_merges_all_vcs_repositories($in1, $in2)
    {
        $in1 = array(
            'repositories' => array(
                array(
                  "type" => "vcs",
                  "url" => "git@github.com:repo/one.git"
                ),
                array(
                  "type" => "composer",
                  "url" => "http://some.satis.host/"
                ),
            )
        );

        $in2 = array(
            'repositories' => array(
                array(
                  "type" => "vcs",
                  "url" => "git@github.com:repo/one.git"
                ),
                array(
                  "type" => "vcs",
                  "url" => "git@github.com:repo/two.git"
                )
            )
        );  

        $in3 = array(
        );

        $results = $this->getRepositories(array($in1, $in2));

        $results->shouldHaveCount(2);
        $results->shouldContain(array(
              "type" => "vcs",
              "url" => "git@github.com:repo/one.git"
        ));
        $results->shouldContain(array(
              "type" => "vcs",
              "url" => "git@github.com:repo/two.git"
        ));
    }

}
