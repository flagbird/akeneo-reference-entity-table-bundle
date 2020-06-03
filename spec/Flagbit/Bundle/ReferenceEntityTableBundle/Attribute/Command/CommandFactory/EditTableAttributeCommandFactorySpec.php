<?php

namespace spec\Flagbit\Bundle\ReferenceEntityTableBundle\Attribute\Command\CommandFactory;

use Flagbit\Bundle\ReferenceEntityTableBundle\Attribute\Command\CommandFactory\EditTableAttributeCommandFactory;
use Flagbit\Bundle\ReferenceEntityTableBundle\Attribute\Command\EditTableAttributeCommand;
use PhpSpec\ObjectBehavior;

class EditTableAttributeCommandFactorySpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(EditTableAttributeCommandFactory::class);
    }

    public function it_does_support_command(): void
    {
        $this->supports(['table_property' => 'table_property', 'identifier' => 'identifier'])->shouldReturn(true);
    }

    public function it_does_not_support_command(): void
    {
        $this->supports([])->shouldReturn(false);
    }

    public function it_does_create_command(): void
    {
        $command = new EditTableAttributeCommand('identifier', 'table_property');

        $this->create(['table_property' => 'table_property', 'identifier' => 'identifier'])->shouldBeLike($command);
    }
}
