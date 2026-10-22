<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Dimension;
use Prefabcortex\UpsTrackservice\Validator\DimensionConstraint;
use Symfony\Component\Validator\Constraint;

final class DimensionFixture
{
    public static function build(): Dimension
    {
        return Dimension::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): Dimension */
    public static function reader(): callable
    {
        return Dimension::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return DimensionConstraint::constraints();
    }
}
