<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\ErrorResponse;
use Prefabcortex\UpsTrackservice\Validator\ErrorResponseConstraint;
use Symfony\Component\Validator\Constraint;

final class ErrorResponseFixture
{
    public static function build(): ErrorResponse
    {
        return ErrorResponse::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): ErrorResponse */
    public static function reader(): callable
    {
        return ErrorResponse::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return ErrorResponseConstraint::constraints();
    }
}
