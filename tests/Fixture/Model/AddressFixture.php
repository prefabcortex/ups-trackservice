<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Address;
use Prefabcortex\UpsTrackservice\Validator\AddressConstraint;
use Symfony\Component\Validator\Constraint;

final class AddressFixture
{
    public static function build(): Address
    {
        return Address::builder()
            ->setAddressLine1('100 Main St')
            ->setAddressLine2('Warehouse')
            ->setAddressLine3('Building 1')
            ->setCity('Wayne')
            ->setCountry('US')
            ->setCountryCode('US')
            ->setPostalCode('07470')
            ->setStateProvince('NJ')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): Address */
    public static function reader(): callable
    {
        return Address::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return AddressConstraint::constraints();
    }
}
