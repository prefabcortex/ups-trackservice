<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Milestones;
use Prefabcortex\UpsTrackservice\Validator\MilestonesConstraint;
use Symfony\Component\Validator\Constraint;

final class MilestonesFixture
{
    public static function build(): Milestones
    {
        return Milestones::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): Milestones */
    public static function reader(): callable
    {
        return Milestones::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return MilestonesConstraint::constraints();
    }
}
