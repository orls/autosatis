<?php

namespace spec\Orls\Satis;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequirementsMergerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Orls\Satis\RequirementsMerger');
    }

    function it_merges_all_requirements_from_all_inputs($in1, $in2)
    {
        $in1 = array(
            'require' => array(
                "package/a" => "0.1",
                "package/b" => "0.2"
            )
        );

        $in2 = array(
            'require' => array(
                "package/a" => "0.2",
                "package/c" => "0.2"
            ),
            'require-dev' => array(
                "package/d" => "0.2"
            )
        );  

        $results = $this->getRequirements(array($in1, $in2));

        $results->shouldHaveCount(4);
        $results->shouldHaveKeyWithValue('package/a', '0.1 || 0.2');
        $results->shouldHaveKeyWithValue('package/b', '0.2');
        $results->shouldHaveKeyWithValue('package/c', '0.2');
        $results->shouldHaveKeyWithValue('package/d', '0.2');
    }
}
