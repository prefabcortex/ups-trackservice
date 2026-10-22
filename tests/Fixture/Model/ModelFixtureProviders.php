<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\SelfNormalizingModel;
use Symfony\Component\Validator\Constraint;

/**
 * The data providers over the fixture classes beside them: one schema-conformant instance of every
 * model in this package, and what each is checked against.
 *
 * Values are the ones the API description states — `example` or `default` where it gives one, a
 * typed placeholder where it does not. They are shaped like real data, not equal to it: nothing
 * here has been sent to the service, so a value being accepted by the schema says nothing about it
 * being accepted by the server.
 */
final class ModelFixtureProviders
{
    /**
     * Every model that could be built and reads back what it writes, keyed by class name so a
     * failure names the model.
     *
     * @return iterable<string, array{SelfNormalizingModel, callable(array<int|string, mixed>): SelfNormalizingModel}>
     */
    public static function roundTrips(): iterable
    {
        yield 'AccessPointInformation' => [
            AccessPointInformationFixture::build(),
            AccessPointInformationFixture::reader(),
        ];
        yield 'Activity' => [ActivityFixture::build(), ActivityFixture::reader()];
        yield 'Address' => [AddressFixture::build(), AddressFixture::reader()];
        yield 'AlternateTrackingNumber' => [
            AlternateTrackingNumberFixture::build(),
            AlternateTrackingNumberFixture::reader(),
        ];
        yield 'DeliveryDate' => [DeliveryDateFixture::build(), DeliveryDateFixture::reader()];
        yield 'DeliveryInformation' => [DeliveryInformationFixture::build(), DeliveryInformationFixture::reader()];
        yield 'DeliveryInformationPod' => [
            DeliveryInformationPodFixture::build(),
            DeliveryInformationPodFixture::reader(),
        ];
        yield 'DeliveryPhoto' => [DeliveryPhotoFixture::build(), DeliveryPhotoFixture::reader()];
        yield 'DeliveryTime' => [DeliveryTimeFixture::build(), DeliveryTimeFixture::reader()];
        yield 'Dimension' => [DimensionFixture::build(), DimensionFixture::reader()];
        yield 'Error' => [ErrorFixture::build(), ErrorFixture::reader()];
        yield 'InquireNumbers' => [InquireNumbersFixture::build(), InquireNumbersFixture::reader()];
        yield 'Location' => [LocationFixture::build(), LocationFixture::reader()];
        yield 'Milestones' => [MilestonesFixture::build(), MilestonesFixture::reader()];
        yield 'Package' => [PackageFixture::build(), PackageFixture::reader()];
        yield 'PackageAddress' => [PackageAddressFixture::build(), PackageAddressFixture::reader()];
        yield 'PaymentInformation' => [PaymentInformationFixture::build(), PaymentInformationFixture::reader()];
        yield 'ReferenceNumber' => [ReferenceNumberFixture::build(), ReferenceNumberFixture::reader()];
        yield 'Response' => [ResponseFixture::build(), ResponseFixture::reader()];
        yield 'ErrorResponse' => [ErrorResponseFixture::build(), ErrorResponseFixture::reader()];
        yield 'Service' => [ServiceFixture::build(), ServiceFixture::reader()];
        yield 'Shipment' => [ShipmentFixture::build(), ShipmentFixture::reader()];
        yield 'Signature' => [SignatureFixture::build(), SignatureFixture::reader()];
        yield 'Status' => [StatusFixture::build(), StatusFixture::reader()];
        yield 'SubMilestone' => [SubMilestoneFixture::build(), SubMilestoneFixture::reader()];
        yield 'TrackApiResponse' => [TrackApiResponseFixture::build(), TrackApiResponseFixture::reader()];
        yield 'TrackResponse' => [TrackResponseFixture::build(), TrackResponseFixture::reader()];
        yield 'Warning' => [WarningFixture::build(), WarningFixture::reader()];
        yield 'Weight' => [WeightFixture::build(), WeightFixture::reader()];
    }

    /**
     * Each model whose values all pass their constraints, with those constraints.
     *
     * @return iterable<string, array{SelfNormalizingModel, list<Constraint>}>
     */
    public static function modelsWithTheirConstraints(): iterable
    {
        yield 'AccessPointInformation' => [
            AccessPointInformationFixture::build(),
            AccessPointInformationFixture::constraints(),
        ];
        yield 'Activity' => [ActivityFixture::build(), ActivityFixture::constraints()];
        yield 'Address' => [AddressFixture::build(), AddressFixture::constraints()];
        yield 'AlternateTrackingNumber' => [
            AlternateTrackingNumberFixture::build(),
            AlternateTrackingNumberFixture::constraints(),
        ];
        yield 'DeliveryDate' => [DeliveryDateFixture::build(), DeliveryDateFixture::constraints()];
        yield 'DeliveryInformation' => [DeliveryInformationFixture::build(), DeliveryInformationFixture::constraints()];
        yield 'DeliveryInformationPod' => [
            DeliveryInformationPodFixture::build(),
            DeliveryInformationPodFixture::constraints(),
        ];
        yield 'DeliveryPhoto' => [DeliveryPhotoFixture::build(), DeliveryPhotoFixture::constraints()];
        yield 'DeliveryTime' => [DeliveryTimeFixture::build(), DeliveryTimeFixture::constraints()];
        yield 'Dimension' => [DimensionFixture::build(), DimensionFixture::constraints()];
        yield 'Error' => [ErrorFixture::build(), ErrorFixture::constraints()];
        yield 'InquireNumbers' => [InquireNumbersFixture::build(), InquireNumbersFixture::constraints()];
        yield 'Location' => [LocationFixture::build(), LocationFixture::constraints()];
        yield 'Milestones' => [MilestonesFixture::build(), MilestonesFixture::constraints()];
        yield 'Package' => [PackageFixture::build(), PackageFixture::constraints()];
        yield 'PackageAddress' => [PackageAddressFixture::build(), PackageAddressFixture::constraints()];
        yield 'PaymentInformation' => [PaymentInformationFixture::build(), PaymentInformationFixture::constraints()];
        yield 'ReferenceNumber' => [ReferenceNumberFixture::build(), ReferenceNumberFixture::constraints()];
        yield 'Response' => [ResponseFixture::build(), ResponseFixture::constraints()];
        yield 'ErrorResponse' => [ErrorResponseFixture::build(), ErrorResponseFixture::constraints()];
        yield 'Service' => [ServiceFixture::build(), ServiceFixture::constraints()];
        yield 'Shipment' => [ShipmentFixture::build(), ShipmentFixture::constraints()];
        yield 'Signature' => [SignatureFixture::build(), SignatureFixture::constraints()];
        yield 'Status' => [StatusFixture::build(), StatusFixture::constraints()];
        yield 'SubMilestone' => [SubMilestoneFixture::build(), SubMilestoneFixture::constraints()];
        yield 'TrackApiResponse' => [TrackApiResponseFixture::build(), TrackApiResponseFixture::constraints()];
        yield 'TrackResponse' => [TrackResponseFixture::build(), TrackResponseFixture::constraints()];
        yield 'Warning' => [WarningFixture::build(), WarningFixture::constraints()];
        yield 'Weight' => [WeightFixture::build(), WeightFixture::constraints()];
    }
}
