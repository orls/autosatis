<?php

namespace spec\Orls\Satis\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SatisBuilderCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Orls\Satis\Command\SatisBuilderCommand');
    }
}
