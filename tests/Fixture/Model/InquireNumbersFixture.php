<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\InquireNumbers;
use Prefabcortex\UpsTrackservice\Validator\InquireNumbersConstraint;
use Symfony\Component\Validator\Constraint;

final class InquireNumbersFixture
{
    public static function build(): InquireNumbers
    {
        return InquireNumbers::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): InquireNumbers */
    public static function reader(): callable
    {
        return InquireNumbers::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return InquireNumbersConstraint::constraints();
    }
}
