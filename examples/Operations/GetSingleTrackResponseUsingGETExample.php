<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Examples\Operations;

use Prefabcortex\UpsTrackservice\Client;
use Prefabcortex\UpsTrackservice\Exception\ApiException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETBadRequestException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETForbiddenException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETInternalServerErrorException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETNotFoundException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETServiceUnavailableException;
use Prefabcortex\UpsTrackservice\Exception\MalformedResponseException;
use Prefabcortex\UpsTrackservice\Exception\ResponseValidationException;
use Prefabcortex\UpsTrackservice\Exception\TransportException;
use Prefabcortex\UpsTrackservice\Exception\UnexpectedContentTypeException;
use Prefabcortex\UpsTrackservice\Exception\UnexpectedStatusCodeException;
use Prefabcortex\UpsTrackservice\Exception\UnsupportedValueException;
use Prefabcortex\UpsTrackservice\Model\TrackApiResponse;
use Prefabcortex\UpsTrackservice\Parameter\GetSingleTrackResponseUsingGETHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\GetSingleTrackResponseUsingGETQueryParameters;

final class GetSingleTrackResponseUsingGETExample
{
    /**
     * Usage: pass an already-authenticated Client (see examples/Auth/).
     *
     *   $client = Client::withOAuth($token, $config); // see examples/Auth/
     *   $queryParameters = new GetSingleTrackResponseUsingGETQueryParameters();
     *   $headerParameters = new GetSingleTrackResponseUsingGETHeaderParameters($transId, $transactionSrc);
     *   GetSingleTrackResponseUsingGETExample::getSingleTrackResponseUsingGET($client, $inquiryNumber, $queryParameters, $headerParameters);
     *
     * @throws ApiException
     * @throws UnsupportedValueException
     * @throws TransportException
     * @throws ResponseValidationException
     * @throws MalformedResponseException
     * @throws GetSingleTrackResponseUsingGETBadRequestException
     * @throws GetSingleTrackResponseUsingGETForbiddenException
     * @throws GetSingleTrackResponseUsingGETNotFoundException
     * @throws GetSingleTrackResponseUsingGETInternalServerErrorException
     * @throws GetSingleTrackResponseUsingGETServiceUnavailableException
     * @throws UnexpectedContentTypeException
     * @throws UnexpectedStatusCodeException
     */
    public static function getSingleTrackResponseUsingGET(
        Client $client,
        string $inquiryNumber,
        GetSingleTrackResponseUsingGETQueryParameters $queryParameters,
        GetSingleTrackResponseUsingGETHeaderParameters $headerParameters,
    ): TrackApiResponse {
        return $client->getSingleTrackResponseUsingGET(
            $inquiryNumber,
            $queryParameters,
            $headerParameters,
        );
    }
}
