<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\DeliveryInformationPod;
use Prefabcortex\UpsTrackservice\Validator\DeliveryInformationPodConstraint;
use Symfony\Component\Validator\Constraint;

final class DeliveryInformationPodFixture
{
    public static function build(): DeliveryInformationPod
    {
        return DeliveryInformationPod::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): DeliveryInformationPod */
    public static function reader(): callable
    {
        return DeliveryInformationPod::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return DeliveryInformationPodConstraint::constraints();
    }
}
