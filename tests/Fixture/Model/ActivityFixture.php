<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Activity;
use Prefabcortex\UpsTrackservice\Validator\ActivityConstraint;
use Symfony\Component\Validator\Constraint;

final class ActivityFixture
{
    public static function build(): Activity
    {
        return Activity::builder()
            ->setDate('20210210')
            ->setGmtDate('20210210')
            ->setGmtOffset('-05:00')
            ->setGmtTime('74700')
            ->setTime('071356')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): Activity */
    public static function reader(): callable
    {
        return Activity::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return ActivityConstraint::constraints();
    }
}
