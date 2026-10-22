<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Location;
use Prefabcortex\UpsTrackservice\Validator\LocationConstraint;
use Symfony\Component\Validator\Constraint;

final class LocationFixture
{
    public static function build(): Location
    {
        return Location::builder()
            ->setSlic('8566')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): Location */
    public static function reader(): callable
    {
        return Location::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return LocationConstraint::constraints();
    }
}
