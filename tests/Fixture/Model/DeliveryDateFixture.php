<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\DeliveryDate;
use Prefabcortex\UpsTrackservice\Validator\DeliveryDateConstraint;
use Symfony\Component\Validator\Constraint;

final class DeliveryDateFixture
{
    public static function build(): DeliveryDate
    {
        return DeliveryDate::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): DeliveryDate */
    public static function reader(): callable
    {
        return DeliveryDate::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return DeliveryDateConstraint::constraints();
    }
}
