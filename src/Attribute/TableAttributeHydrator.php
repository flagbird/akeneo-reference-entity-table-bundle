<?php

namespace Flagbit\Bundle\ReferenceEntityTableBundle\Attribute;

use Akeneo\ReferenceEntity\Domain\Model\Attribute\AbstractAttribute;
use Akeneo\ReferenceEntity\Domain\Model\Attribute\AttributeCode;
use Akeneo\ReferenceEntity\Domain\Model\Attribute\AttributeIdentifier;
use Akeneo\ReferenceEntity\Domain\Model\Attribute\AttributeIsRequired;
use Akeneo\ReferenceEntity\Domain\Model\Attribute\AttributeOrder;
use Akeneo\ReferenceEntity\Domain\Model\Attribute\AttributeValuePerChannel;
use Akeneo\ReferenceEntity\Domain\Model\Attribute\AttributeValuePerLocale;
use Akeneo\ReferenceEntity\Domain\Model\LabelCollection;
use Akeneo\ReferenceEntity\Domain\Model\ReferenceEntity\ReferenceEntityIdentifier;
use Akeneo\ReferenceEntity\Infrastructure\Persistence\Sql\Attribute\Hydrator\AbstractAttributeHydrator;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Flagbit\Bundle\ReferenceEntityTableBundle\Property\TableProperty;

class TableAttributeHydrator extends AbstractAttributeHydrator
{
    protected function getExpectedProperties(): array
    {
        return [
            'identifier',
            'reference_entity_identifier',
            'code',
            'labels',
            'attribute_order',
            'is_required',
            'value_per_locale',
            'value_per_channel',
            'attribute_type',
            'table_property'
        ];
    }

    protected function convertAdditionalProperties(AbstractPlatform $platform, array $row): array
    {
        $row['table_property'] = Type::getType(Types::STRING)->convertToPhpValue(
            $row['additional_properties']['table_property'],
            $platform
        );

        return $row;
    }

    protected function hydrateAttribute(array $row): AbstractAttribute
    {
        return TableAttribute::create(
            AttributeIdentifier::fromString($row['identifier']),
            ReferenceEntityIdentifier::fromString($row['reference_entity_identifier']),
            AttributeCode::fromString($row['code']),
            LabelCollection::fromArray($row['labels']),
            AttributeOrder::fromInteger($row['attribute_order']),
            AttributeIsRequired::fromBoolean($row['is_required']),
            AttributeValuePerChannel::fromBoolean($row['value_per_channel']),
            AttributeValuePerLocale::fromBoolean($row['value_per_locale']),
            TableProperty::fromArray($row['table_property'])
        );
    }

    public function supports(array $result): bool
    {
        return isset($result['attribute_type']) && TableAttribute::ATTRIBUTE_TYPE_NAME === $result['attribute_type'];
    }
}
