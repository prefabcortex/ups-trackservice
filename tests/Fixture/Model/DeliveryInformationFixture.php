<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\DeliveryInformation;
use Prefabcortex\UpsTrackservice\Validator\DeliveryInformationConstraint;
use Symfony\Component\Validator\Constraint;

final class DeliveryInformationFixture
{
    public static function build(): DeliveryInformation
    {
        return DeliveryInformation::builder()
            ->setLocation('Front Door')
            ->setReceivedBy('')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): DeliveryInformation */
    public static function reader(): callable
    {
        return DeliveryInformation::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return DeliveryInformationConstraint::constraints();
    }
}
