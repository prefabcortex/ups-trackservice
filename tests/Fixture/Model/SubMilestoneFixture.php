<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\SubMilestone;
use Prefabcortex\UpsTrackservice\Validator\SubMilestoneConstraint;
use Symfony\Component\Validator\Constraint;

final class SubMilestoneFixture
{
    public static function build(): SubMilestone
    {
        return SubMilestone::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): SubMilestone */
    public static function reader(): callable
    {
        return SubMilestone::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return SubMilestoneConstraint::constraints();
    }
}
