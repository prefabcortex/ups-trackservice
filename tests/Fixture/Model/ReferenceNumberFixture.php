<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\ReferenceNumber;
use Prefabcortex\UpsTrackservice\Validator\ReferenceNumberConstraint;
use Symfony\Component\Validator\Constraint;

final class ReferenceNumberFixture
{
    public static function build(): ReferenceNumber
    {
        return ReferenceNumber::builder()
            ->setNumber('ShipRef123')
            ->setType('SHIPMENT')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): ReferenceNumber */
    public static function reader(): callable
    {
        return ReferenceNumber::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return ReferenceNumberConstraint::constraints();
    }
}
