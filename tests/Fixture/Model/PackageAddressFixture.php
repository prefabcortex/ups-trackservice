<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\PackageAddress;
use Prefabcortex\UpsTrackservice\Validator\PackageAddressConstraint;
use Symfony\Component\Validator\Constraint;

final class PackageAddressFixture
{
    public static function build(): PackageAddress
    {
        return PackageAddress::builder()
            ->setName('Sears')
            ->setType('ORIGIN/DESTINATION')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): PackageAddress */
    public static function reader(): callable
    {
        return PackageAddress::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return PackageAddressConstraint::constraints();
    }
}
