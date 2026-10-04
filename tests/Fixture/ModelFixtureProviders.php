<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture;

use Prefabcortex\UpsTrackservice\Model\AccessPointInformation;
use Prefabcortex\UpsTrackservice\Model\Activity;
use Prefabcortex\UpsTrackservice\Model\Address;
use Prefabcortex\UpsTrackservice\Model\AlternateTrackingNumber;
use Prefabcortex\UpsTrackservice\Model\DeliveryDate;
use Prefabcortex\UpsTrackservice\Model\DeliveryInformation;
use Prefabcortex\UpsTrackservice\Model\DeliveryInformationPod;
use Prefabcortex\UpsTrackservice\Model\DeliveryPhoto;
use Prefabcortex\UpsTrackservice\Model\DeliveryTime;
use Prefabcortex\UpsTrackservice\Model\Dimension;
use Prefabcortex\UpsTrackservice\Model\Error;
use Prefabcortex\UpsTrackservice\Model\ErrorResponse;
use Prefabcortex\UpsTrackservice\Model\InquireNumbers;
use Prefabcortex\UpsTrackservice\Model\Location;
use Prefabcortex\UpsTrackservice\Model\Milestones;
use Prefabcortex\UpsTrackservice\Model\Package;
use Prefabcortex\UpsTrackservice\Model\PackageAddress;
use Prefabcortex\UpsTrackservice\Model\PaymentInformation;
use Prefabcortex\UpsTrackservice\Model\ReferenceNumber;
use Prefabcortex\UpsTrackservice\Model\Response;
use Prefabcortex\UpsTrackservice\Model\SelfNormalizingModel;
use Prefabcortex\UpsTrackservice\Model\Service;
use Prefabcortex\UpsTrackservice\Model\Shipment;
use Prefabcortex\UpsTrackservice\Model\Signature;
use Prefabcortex\UpsTrackservice\Model\Status;
use Prefabcortex\UpsTrackservice\Model\SubMilestone;
use Prefabcortex\UpsTrackservice\Model\TrackApiResponse;
use Prefabcortex\UpsTrackservice\Model\TrackResponse;
use Prefabcortex\UpsTrackservice\Model\Warning;
use Prefabcortex\UpsTrackservice\Model\Weight;
use Prefabcortex\UpsTrackservice\Validator\AccessPointInformationConstraint;
use Prefabcortex\UpsTrackservice\Validator\ActivityConstraint;
use Prefabcortex\UpsTrackservice\Validator\AddressConstraint;
use Prefabcortex\UpsTrackservice\Validator\AlternateTrackingNumberConstraint;
use Prefabcortex\UpsTrackservice\Validator\DeliveryDateConstraint;
use Prefabcortex\UpsTrackservice\Validator\DeliveryInformationConstraint;
use Prefabcortex\UpsTrackservice\Validator\DeliveryInformationPodConstraint;
use Prefabcortex\UpsTrackservice\Validator\DeliveryPhotoConstraint;
use Prefabcortex\UpsTrackservice\Validator\DeliveryTimeConstraint;
use Prefabcortex\UpsTrackservice\Validator\DimensionConstraint;
use Prefabcortex\UpsTrackservice\Validator\ErrorConstraint;
use Prefabcortex\UpsTrackservice\Validator\ErrorResponseConstraint;
use Prefabcortex\UpsTrackservice\Validator\InquireNumbersConstraint;
use Prefabcortex\UpsTrackservice\Validator\LocationConstraint;
use Prefabcortex\UpsTrackservice\Validator\MilestonesConstraint;
use Prefabcortex\UpsTrackservice\Validator\PackageAddressConstraint;
use Prefabcortex\UpsTrackservice\Validator\PackageConstraint;
use Prefabcortex\UpsTrackservice\Validator\PaymentInformationConstraint;
use Prefabcortex\UpsTrackservice\Validator\ReferenceNumberConstraint;
use Prefabcortex\UpsTrackservice\Validator\ResponseConstraint;
use Prefabcortex\UpsTrackservice\Validator\ServiceConstraint;
use Prefabcortex\UpsTrackservice\Validator\ShipmentConstraint;
use Prefabcortex\UpsTrackservice\Validator\SignatureConstraint;
use Prefabcortex\UpsTrackservice\Validator\StatusConstraint;
use Prefabcortex\UpsTrackservice\Validator\SubMilestoneConstraint;
use Prefabcortex\UpsTrackservice\Validator\TrackApiResponseConstraint;
use Prefabcortex\UpsTrackservice\Validator\TrackResponseConstraint;
use Prefabcortex\UpsTrackservice\Validator\WarningConstraint;
use Prefabcortex\UpsTrackservice\Validator\WeightConstraint;
use Symfony\Component\Validator\Constraint;

/**
 * The data providers over ModelFixtures: one schema-conformant instance of every model in this
 * package, and what each is checked against.
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
            ModelFixtures::buildAccessPointInformation(),
            AccessPointInformation::fromArray(...),
        ];
        yield 'Activity' => [ModelFixtures::buildActivity(), Activity::fromArray(...)];
        yield 'Address' => [ModelFixtures::buildAddress(), Address::fromArray(...)];
        yield 'AlternateTrackingNumber' => [
            ModelFixtures::buildAlternateTrackingNumber(),
            AlternateTrackingNumber::fromArray(...),
        ];
        yield 'DeliveryDate' => [ModelFixtures::buildDeliveryDate(), DeliveryDate::fromArray(...)];
        yield 'DeliveryInformation' => [ModelFixtures::buildDeliveryInformation(), DeliveryInformation::fromArray(...)];
        yield 'DeliveryInformationPod' => [
            ModelFixtures::buildDeliveryInformationPod(),
            DeliveryInformationPod::fromArray(...),
        ];
        yield 'DeliveryPhoto' => [ModelFixtures::buildDeliveryPhoto(), DeliveryPhoto::fromArray(...)];
        yield 'DeliveryTime' => [ModelFixtures::buildDeliveryTime(), DeliveryTime::fromArray(...)];
        yield 'Dimension' => [ModelFixtures::buildDimension(), Dimension::fromArray(...)];
        yield 'Error' => [ModelFixtures::buildError(), Error::fromArray(...)];
        yield 'InquireNumbers' => [ModelFixtures::buildInquireNumbers(), InquireNumbers::fromArray(...)];
        yield 'Location' => [ModelFixtures::buildLocation(), Location::fromArray(...)];
        yield 'Milestones' => [ModelFixtures::buildMilestones(), Milestones::fromArray(...)];
        yield 'Package' => [ModelFixtures::buildPackage(), Package::fromArray(...)];
        yield 'PackageAddress' => [ModelFixtures::buildPackageAddress(), PackageAddress::fromArray(...)];
        yield 'PaymentInformation' => [ModelFixtures::buildPaymentInformation(), PaymentInformation::fromArray(...)];
        yield 'ReferenceNumber' => [ModelFixtures::buildReferenceNumber(), ReferenceNumber::fromArray(...)];
        yield 'Response' => [ModelFixtures::buildResponse(), Response::fromArray(...)];
        yield 'ErrorResponse' => [ModelFixtures::buildErrorResponse(), ErrorResponse::fromArray(...)];
        yield 'Service' => [ModelFixtures::buildService(), Service::fromArray(...)];
        yield 'Shipment' => [ModelFixtures::buildShipment(), Shipment::fromArray(...)];
        yield 'Signature' => [ModelFixtures::buildSignature(), Signature::fromArray(...)];
        yield 'Status' => [ModelFixtures::buildStatus(), Status::fromArray(...)];
        yield 'SubMilestone' => [ModelFixtures::buildSubMilestone(), SubMilestone::fromArray(...)];
        yield 'TrackApiResponse' => [ModelFixtures::buildTrackApiResponse(), TrackApiResponse::fromArray(...)];
        yield 'TrackResponse' => [ModelFixtures::buildTrackResponse(), TrackResponse::fromArray(...)];
        yield 'Warning' => [ModelFixtures::buildWarning(), Warning::fromArray(...)];
        yield 'Weight' => [ModelFixtures::buildWeight(), Weight::fromArray(...)];
    }

    /**
     * Each model whose values all pass their constraints, with those constraints.
     *
     * @return iterable<string, array{SelfNormalizingModel, list<Constraint>}>
     */
    public static function modelsWithTheirConstraints(): iterable
    {
        yield 'AccessPointInformation' => [
            ModelFixtures::buildAccessPointInformation(),
            AccessPointInformationConstraint::constraints(),
        ];
        yield 'Activity' => [ModelFixtures::buildActivity(), ActivityConstraint::constraints()];
        yield 'Address' => [ModelFixtures::buildAddress(), AddressConstraint::constraints()];
        yield 'AlternateTrackingNumber' => [
            ModelFixtures::buildAlternateTrackingNumber(),
            AlternateTrackingNumberConstraint::constraints(),
        ];
        yield 'DeliveryDate' => [ModelFixtures::buildDeliveryDate(), DeliveryDateConstraint::constraints()];
        yield 'DeliveryInformation' => [
            ModelFixtures::buildDeliveryInformation(),
            DeliveryInformationConstraint::constraints(),
        ];
        yield 'DeliveryInformationPod' => [
            ModelFixtures::buildDeliveryInformationPod(),
            DeliveryInformationPodConstraint::constraints(),
        ];
        yield 'DeliveryPhoto' => [ModelFixtures::buildDeliveryPhoto(), DeliveryPhotoConstraint::constraints()];
        yield 'DeliveryTime' => [ModelFixtures::buildDeliveryTime(), DeliveryTimeConstraint::constraints()];
        yield 'Dimension' => [ModelFixtures::buildDimension(), DimensionConstraint::constraints()];
        yield 'Error' => [ModelFixtures::buildError(), ErrorConstraint::constraints()];
        yield 'InquireNumbers' => [ModelFixtures::buildInquireNumbers(), InquireNumbersConstraint::constraints()];
        yield 'Location' => [ModelFixtures::buildLocation(), LocationConstraint::constraints()];
        yield 'Milestones' => [ModelFixtures::buildMilestones(), MilestonesConstraint::constraints()];
        yield 'Package' => [ModelFixtures::buildPackage(), PackageConstraint::constraints()];
        yield 'PackageAddress' => [ModelFixtures::buildPackageAddress(), PackageAddressConstraint::constraints()];
        yield 'PaymentInformation' => [
            ModelFixtures::buildPaymentInformation(),
            PaymentInformationConstraint::constraints(),
        ];
        yield 'ReferenceNumber' => [ModelFixtures::buildReferenceNumber(), ReferenceNumberConstraint::constraints()];
        yield 'Response' => [ModelFixtures::buildResponse(), ResponseConstraint::constraints()];
        yield 'ErrorResponse' => [ModelFixtures::buildErrorResponse(), ErrorResponseConstraint::constraints()];
        yield 'Service' => [ModelFixtures::buildService(), ServiceConstraint::constraints()];
        yield 'Shipment' => [ModelFixtures::buildShipment(), ShipmentConstraint::constraints()];
        yield 'Signature' => [ModelFixtures::buildSignature(), SignatureConstraint::constraints()];
        yield 'Status' => [ModelFixtures::buildStatus(), StatusConstraint::constraints()];
        yield 'SubMilestone' => [ModelFixtures::buildSubMilestone(), SubMilestoneConstraint::constraints()];
        yield 'TrackApiResponse' => [ModelFixtures::buildTrackApiResponse(), TrackApiResponseConstraint::constraints()];
        yield 'TrackResponse' => [ModelFixtures::buildTrackResponse(), TrackResponseConstraint::constraints()];
        yield 'Warning' => [ModelFixtures::buildWarning(), WarningConstraint::constraints()];
        yield 'Weight' => [ModelFixtures::buildWeight(), WeightConstraint::constraints()];
    }
}
