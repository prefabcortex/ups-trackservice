<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Shipment;
use Prefabcortex\UpsTrackservice\Validator\ShipmentConstraint;
use Symfony\Component\Validator\Constraint;

final class ShipmentFixture
{
    public static function build(): Shipment
    {
        return Shipment::builder()
            ->setInquiryNumber('1Z023E2X0214323462')
            ->setUserRelation(['REPLACE_ME'])
            ->build();
    }

    /** @return callable(array<int|string, mixed>): Shipment */
    public static function reader(): callable
    {
        return Shipment::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return ShipmentConstraint::constraints();
    }
}
