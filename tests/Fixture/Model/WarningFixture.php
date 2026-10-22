<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Warning;
use Prefabcortex\UpsTrackservice\Validator\WarningConstraint;
use Symfony\Component\Validator\Constraint;

final class WarningFixture
{
    public static function build(): Warning
    {
        return Warning::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): Warning */
    public static function reader(): callable
    {
        return Warning::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return WarningConstraint::constraints();
    }
}
