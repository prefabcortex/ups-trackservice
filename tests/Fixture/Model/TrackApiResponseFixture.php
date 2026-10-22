<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\TrackApiResponse;
use Prefabcortex\UpsTrackservice\Validator\TrackApiResponseConstraint;
use Symfony\Component\Validator\Constraint;

final class TrackApiResponseFixture
{
    public static function build(): TrackApiResponse
    {
        return TrackApiResponse::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): TrackApiResponse */
    public static function reader(): callable
    {
        return TrackApiResponse::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return TrackApiResponseConstraint::constraints();
    }
}
