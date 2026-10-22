<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\DeliveryPhoto;
use Prefabcortex\UpsTrackservice\Validator\DeliveryPhotoConstraint;
use Symfony\Component\Validator\Constraint;

final class DeliveryPhotoFixture
{
    public static function build(): DeliveryPhoto
    {
        return DeliveryPhoto::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): DeliveryPhoto */
    public static function reader(): callable
    {
        return DeliveryPhoto::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return DeliveryPhotoConstraint::constraints();
    }
}
