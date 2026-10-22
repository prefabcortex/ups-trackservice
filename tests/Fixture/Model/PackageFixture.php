<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Package;
use Prefabcortex\UpsTrackservice\Validator\PackageConstraint;
use Symfony\Component\Validator\Constraint;

final class PackageFixture
{
    public static function build(): Package
    {
        return Package::builder()
            ->setAdditionalAttributes(['SENSOR_EVENT'])
            ->setAdditionalServices([
                'ADULT_SIGNATURE_REQUIRED',
                'SIGNATURE_REQUIRED',
                'ADDITIONAL_HANDLING',
                'CARBON_NEUTRAL',
                'UPS_PREMIER_SILVER',
                'UPS_PREMIER_GOLD',
                'UPS_PREMIER_PLATINUM',
            ])
            ->setPackageCount(2)
            ->setSuppressionIndicators(['REPLACE_ME'])
            ->build();
    }

    /** @return callable(array<int|string, mixed>): Package */
    public static function reader(): callable
    {
        return Package::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return PackageConstraint::constraints();
    }
}
