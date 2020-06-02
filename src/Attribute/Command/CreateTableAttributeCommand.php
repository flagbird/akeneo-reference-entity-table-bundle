<?php

namespace Flagbit\Bundle\ReferenceEntityTableBundle\Attribute\Command;

use Akeneo\ReferenceEntity\Application\Attribute\CreateAttribute\AbstractCreateAttributeCommand;

class CreateTableAttributeCommand extends AbstractCreateAttributeCommand
{
    /** @var string */
    public $tableProperty;

    public function __construct(
        string $referenceEntityIdentifier,
        string $code,
        array $labels,
        bool $isRequired,
        bool $valuePerChannel,
        bool $valuePerLocale,
        string $tableProperty
    ) {
        parent::__construct(
            $referenceEntityIdentifier,
            $code,
            $labels,
            $isRequired,
            $valuePerChannel,
            $valuePerLocale
        );

        $this->tableProperty = $tableProperty;
    }
}
