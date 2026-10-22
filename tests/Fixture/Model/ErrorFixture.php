<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Error;
use Prefabcortex\UpsTrackservice\Validator\ErrorConstraint;
use Symfony\Component\Validator\Constraint;

final class ErrorFixture
{
    public static function build(): Error
    {
        return Error::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): Error */
    public static function reader(): callable
    {
        return Error::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return ErrorConstraint::constraints();
    }
}
