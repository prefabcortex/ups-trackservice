<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Weight;
use Prefabcortex\UpsTrackservice\Validator\WeightConstraint;
use Symfony\Component\Validator\Constraint;

final class WeightFixture
{
    public static function build(): Weight
    {
        return Weight::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): Weight */
    public static function reader(): callable
    {
        return Weight::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return WeightConstraint::constraints();
    }
}
