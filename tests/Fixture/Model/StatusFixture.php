<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Status;
use Prefabcortex\UpsTrackservice\Validator\StatusConstraint;
use Symfony\Component\Validator\Constraint;

final class StatusFixture
{
    public static function build(): Status
    {
        return Status::builder()
            ->setCode('SR')
            ->setDescription('Your package was released by the customs agency.')
            ->setSimplifiedTextDescription('Delivered')
            ->setStatusCode('003')
            ->setType('X')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): Status */
    public static function reader(): callable
    {
        return Status::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return StatusConstraint::constraints();
    }
}
