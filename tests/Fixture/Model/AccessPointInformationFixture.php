<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\AccessPointInformation;
use Prefabcortex\UpsTrackservice\Validator\AccessPointInformationConstraint;
use Symfony\Component\Validator\Constraint;

final class AccessPointInformationFixture
{
    public static function build(): AccessPointInformation
    {
        return AccessPointInformation::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): AccessPointInformation */
    public static function reader(): callable
    {
        return AccessPointInformation::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return AccessPointInformationConstraint::constraints();
    }
}
