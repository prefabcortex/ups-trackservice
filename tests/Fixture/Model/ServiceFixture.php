<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Service;
use Prefabcortex\UpsTrackservice\Validator\ServiceConstraint;
use Symfony\Component\Validator\Constraint;

final class ServiceFixture
{
    public static function build(): Service
    {
        return Service::builder()
            ->setCode('518')
            ->setDescription('UPS Ground')
            ->setLevelCode('011')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): Service */
    public static function reader(): callable
    {
        return Service::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return ServiceConstraint::constraints();
    }
}
