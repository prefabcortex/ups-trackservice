<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\DeliveryTime;
use Prefabcortex\UpsTrackservice\Validator\DeliveryTimeConstraint;
use Symfony\Component\Validator\Constraint;

final class DeliveryTimeFixture
{
    public static function build(): DeliveryTime
    {
        return DeliveryTime::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): DeliveryTime */
    public static function reader(): callable
    {
        return DeliveryTime::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return DeliveryTimeConstraint::constraints();
    }
}
