<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Examples\Operations;

use Prefabcortex\UpsTrackservice\Client;
use Prefabcortex\UpsTrackservice\Exception\ApiException;
use Prefabcortex\UpsTrackservice\Exception\MalformedResponseException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPIBadRequestException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPIForbiddenException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPIInternalServerErrorException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPINotFoundException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPIServiceUnavailableException;
use Prefabcortex\UpsTrackservice\Exception\ResponseValidationException;
use Prefabcortex\UpsTrackservice\Exception\TransportException;
use Prefabcortex\UpsTrackservice\Exception\UnexpectedContentTypeException;
use Prefabcortex\UpsTrackservice\Exception\UnexpectedStatusCodeException;
use Prefabcortex\UpsTrackservice\Exception\UnsupportedValueException;
use Prefabcortex\UpsTrackservice\Model\TrackApiResponse;
use Prefabcortex\UpsTrackservice\Parameter\ReferenceTrackingAPIHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\ReferenceTrackingAPIQueryParameters;

final class ReferenceTrackingAPIExample
{
    /**
     * Usage: pass an already-authenticated Client (see examples/Auth/).
     *
     *   $client = Client::withOAuth($token, $config); // see examples/Auth/
     *   $queryParameters = new ReferenceTrackingAPIQueryParameters();
     *   $headerParameters = new ReferenceTrackingAPIHeaderParameters($transId, $transactionSrc);
     *   ReferenceTrackingAPIExample::referenceTrackingAPI($client, $referenceNumber, $queryParameters, $headerParameters);
     *
     * @throws ApiException
     * @throws UnsupportedValueException
     * @throws TransportException
     * @throws ResponseValidationException
     * @throws MalformedResponseException
     * @throws ReferenceTrackingAPIBadRequestException
     * @throws ReferenceTrackingAPIForbiddenException
     * @throws ReferenceTrackingAPINotFoundException
     * @throws ReferenceTrackingAPIInternalServerErrorException
     * @throws ReferenceTrackingAPIServiceUnavailableException
     * @throws UnexpectedContentTypeException
     * @throws UnexpectedStatusCodeException
     */
    public static function referenceTrackingAPI(
        Client $client,
        string $referenceNumber,
        ReferenceTrackingAPIQueryParameters $queryParameters,
        ReferenceTrackingAPIHeaderParameters $headerParameters,
    ): TrackApiResponse {
        return $client->referenceTrackingAPI(
            $referenceNumber,
            $queryParameters,
            $headerParameters,
        );
    }
}
