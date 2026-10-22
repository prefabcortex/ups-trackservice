<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Signature;
use Prefabcortex\UpsTrackservice\Validator\SignatureConstraint;
use Symfony\Component\Validator\Constraint;

final class SignatureFixture
{
    public static function build(): Signature
    {
        return Signature::builder()
            ->setImage('encoding Base64')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): Signature */
    public static function reader(): callable
    {
        return Signature::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return SignatureConstraint::constraints();
    }
}
