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
use Prefabcortex\UpsTrackservice\Model\Service;
use Prefabcortex\UpsTrackservice\Model\Shipment;
use Prefabcortex\UpsTrackservice\Model\Signature;
use Prefabcortex\UpsTrackservice\Model\Status;
use Prefabcortex\UpsTrackservice\Model\SubMilestone;
use Prefabcortex\UpsTrackservice\Model\TrackApiResponse;
use Prefabcortex\UpsTrackservice\Model\TrackResponse;
use Prefabcortex\UpsTrackservice\Model\Warning;
use Prefabcortex\UpsTrackservice\Model\Weight;

final class ModelFixtures
{
    public static function buildAccessPointInformation(): AccessPointInformation
    {
        return AccessPointInformation::builder()->build();
    }

    public static function buildActivity(): Activity
    {
        return Activity::builder()
            ->setDate('20210210')
            ->setGmtDate('20210210')
            ->setGmtOffset('-05:00')
            ->setGmtTime('74700')
            ->setTime('071356')
            ->build();
    }

    public static function buildAddress(): Address
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

    public static function buildAlternateTrackingNumber(): AlternateTrackingNumber
    {
        return AlternateTrackingNumber::builder()
            ->setNumber('92419900000033499522966220')
            ->setType('USPS_PIC')
            ->build();
    }

    public static function buildDeliveryDate(): DeliveryDate
    {
        return DeliveryDate::builder()->build();
    }

    public static function buildDeliveryInformation(): DeliveryInformation
    {
        return DeliveryInformation::builder()
            ->setLocation('Front Door')
            ->setReceivedBy('')
            ->build();
    }

    public static function buildDeliveryInformationPod(): DeliveryInformationPod
    {
        return DeliveryInformationPod::builder()->build();
    }

    public static function buildDeliveryPhoto(): DeliveryPhoto
    {
        return DeliveryPhoto::builder()->build();
    }

    public static function buildDeliveryTime(): DeliveryTime
    {
        return DeliveryTime::builder()->build();
    }

    public static function buildDimension(): Dimension
    {
        return Dimension::builder()->build();
    }

    public static function buildError(): Error
    {
        return Error::builder()->build();
    }

    public static function buildInquireNumbers(): InquireNumbers
    {
        return InquireNumbers::builder()->build();
    }

    public static function buildLocation(): Location
    {
        return Location::builder()
            ->setSlic('8566')
            ->build();
    }

    public static function buildMilestones(): Milestones
    {
        return Milestones::builder()->build();
    }

    public static function buildPackage(): Package
    {
        return Package::builder()
            ->setAdditionalAttributes(['REPLACE_ME'])
            ->setAdditionalServices(['REPLACE_ME'])
            ->setPackageCount(2)
            ->setSuppressionIndicators(['REPLACE_ME'])
            ->build();
    }

    public static function buildPackageAddress(): PackageAddress
    {
        return PackageAddress::builder()
            ->setName('Sears')
            ->setType('ORIGIN/DESTINATION')
            ->build();
    }

    public static function buildPaymentInformation(): PaymentInformation
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

    public static function buildReferenceNumber(): ReferenceNumber
    {
        return ReferenceNumber::builder()
            ->setNumber('ShipRef123')
            ->setType('SHIPMENT')
            ->build();
    }

    public static function buildResponse(): Response
    {
        return Response::builder()->build();
    }

    public static function buildErrorResponse(): ErrorResponse
    {
        return ErrorResponse::builder()->build();
    }

    public static function buildService(): Service
    {
        return Service::builder()
            ->setCode('518')
            ->setDescription('UPS Ground')
            ->setLevelCode('011')
            ->build();
    }

    public static function buildShipment(): Shipment
    {
        return Shipment::builder()
            ->setInquiryNumber('1Z023E2X0214323462')
            ->setUserRelation(['REPLACE_ME'])
            ->build();
    }

    public static function buildSignature(): Signature
    {
        return Signature::builder()
            ->setImage('encoding Base64')
            ->build();
    }

    public static function buildStatus(): Status
    {
        return Status::builder()
            ->setCode('SR')
            ->setDescription('Your package was released by the customs agency.')
            ->setSimplifiedTextDescription('Delivered')
            ->setStatusCode('003')
            ->setType('X')
            ->build();
    }

    public static function buildSubMilestone(): SubMilestone
    {
        return SubMilestone::builder()->build();
    }

    public static function buildTrackApiResponse(): TrackApiResponse
    {
        return TrackApiResponse::builder()->build();
    }

    public static function buildTrackResponse(): TrackResponse
    {
        return TrackResponse::builder()->build();
    }

    public static function buildWarning(): Warning
    {
        return Warning::builder()->build();
    }

    public static function buildWeight(): Weight
    {
        return Weight::builder()->build();
    }
}
