<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\AlternateTrackingNumber;
use Prefabcortex\UpsTrackservice\Validator\AlternateTrackingNumberConstraint;
use Symfony\Component\Validator\Constraint;

final class AlternateTrackingNumberFixture
{
    public static function build(): AlternateTrackingNumber
    {
        return AlternateTrackingNumber::builder()
            ->setNumber('92419900000033499522966220')
            ->setType('USPS_PIC')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): AlternateTrackingNumber */
    public static function reader(): callable
    {
        return AlternateTrackingNumber::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return AlternateTrackingNumberConstraint::constraints();
    }
}
