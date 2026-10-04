<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Examples\Operations;

use Prefabcortex\UpsTrackservice\Client;
use Prefabcortex\UpsTrackservice\Exception\ApiException;
use Prefabcortex\UpsTrackservice\Exception\MalformedResponseException;
use Prefabcortex\UpsTrackservice\Exception\ResponseValidationException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPIBadRequestException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPIForbiddenException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPIInternalServerErrorException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPINotFoundException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPIServiceUnavailableException;
use Prefabcortex\UpsTrackservice\Exception\TransportException;
use Prefabcortex\UpsTrackservice\Exception\UnexpectedContentTypeException;
use Prefabcortex\UpsTrackservice\Exception\UnexpectedStatusCodeException;
use Prefabcortex\UpsTrackservice\Exception\UnsupportedValueException;
use Prefabcortex\UpsTrackservice\Model\TrackApiResponse;
use Prefabcortex\UpsTrackservice\Parameter\ShipmentTrackingAPIHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\ShipmentTrackingAPIQueryParameters;

final class ShipmentTrackingAPIExample
{
    /**
     * Usage: pass an already-authenticated Client (see examples/Auth/).
     *
     *   $client = Client::withOAuth($token, $config); // see examples/Auth/
     *   $queryParameters = new ShipmentTrackingAPIQueryParameters();
     *   $headerParameters = new ShipmentTrackingAPIHeaderParameters($transId, $transactionSrc);
     *   ShipmentTrackingAPIExample::shipmentTrackingAPI($client, $inquiryNumber, $queryParameters, $headerParameters);
     *
     * @throws ApiException
     * @throws UnsupportedValueException
     * @throws TransportException
     * @throws ResponseValidationException
     * @throws MalformedResponseException
     * @throws ShipmentTrackingAPIBadRequestException
     * @throws ShipmentTrackingAPIForbiddenException
     * @throws ShipmentTrackingAPINotFoundException
     * @throws ShipmentTrackingAPIInternalServerErrorException
     * @throws ShipmentTrackingAPIServiceUnavailableException
     * @throws UnexpectedContentTypeException
     * @throws UnexpectedStatusCodeException
     */
    public static function shipmentTrackingAPI(
        Client $client,
        string $inquiryNumber,
        ShipmentTrackingAPIQueryParameters $queryParameters,
        ShipmentTrackingAPIHeaderParameters $headerParameters,
    ): TrackApiResponse {
        return $client->shipmentTrackingAPI(
            $inquiryNumber,
            $queryParameters,
            $headerParameters,
        );
    }
}
