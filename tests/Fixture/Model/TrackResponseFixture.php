<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\TrackResponse;
use Prefabcortex\UpsTrackservice\Validator\TrackResponseConstraint;
use Symfony\Component\Validator\Constraint;

final class TrackResponseFixture
{
    public static function build(): TrackResponse
    {
        return TrackResponse::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): TrackResponse */
    public static function reader(): callable
    {
        return TrackResponse::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return TrackResponseConstraint::constraints();
    }
}
