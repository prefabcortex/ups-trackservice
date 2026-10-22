<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\PaymentInformation;
use Prefabcortex\UpsTrackservice\Validator\PaymentInformationConstraint;
use Symfony\Component\Validator\Constraint;

final class PaymentInformationFixture
{
    public static function build(): PaymentInformation
    {
        return PaymentInformation::builder()
            ->setAmount('243.5')
            ->setCurrency('EUR')
            ->setId('3S35571M1L381K5O0P316L0M1R2E6H14')
            ->setPaid(false)
            ->setPaymentMethod('C0, C1, ... C9')
            ->setType('ICOD/COD')
            ->build();
    }

    /** @return callable(array<int|string, mixed>): PaymentInformation */
    public static function reader(): callable
    {
        return PaymentInformation::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return PaymentInformationConstraint::constraints();
    }
}
