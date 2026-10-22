<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Operations;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Prefabcortex\UpsTrackservice\Client;
use Prefabcortex\UpsTrackservice\ClientConfig;
use Prefabcortex\UpsTrackservice\Exception\ApiException;
use Prefabcortex\UpsTrackservice\Http\ValidationMode;
use Prefabcortex\UpsTrackservice\Parameter\GetSingleTrackResponseUsingGETHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\GetSingleTrackResponseUsingGETQueryParameters;
use Prefabcortex\UpsTrackservice\Parameter\ReferenceTrackingAPIHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\ReferenceTrackingAPIQueryParameters;
use Prefabcortex\UpsTrackservice\Parameter\ShipmentTrackingAPIHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\ShipmentTrackingAPIQueryParameters;
use Prefabcortex\UpsTrackservice\Tests\Fixture\CannedResponse;
use Prefabcortex\UpsTrackservice\Tests\Fixture\RecordingHttpClient;
use RuntimeException;

use function sprintf;

/**
 * Every operation called once, against a client that records the request instead of sending it.
 *
 * Nothing leaves the process and no credentials are needed: PSR-18 is one method, so the client is
 * stood in for. What runs is everything up to the wire — the URI assembled, the query string
 * encoded, the body serialised. The client signs nothing.
 *
 * What is watched is the request: its method, and its path up to the first placeholder. These calls
 * go through the `…Raw()` methods, which hand the response back unparsed, so the canned answer
 * never has to match a status or content type from the description — an answer invented from that
 * document would say nothing about a client built from the same one.
 */
final class OperationSmokeTest extends TestCase
{
    private const string BASE_URL = 'https://smoke-test.invalid';

    /**
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETBuildsARequest(): void
    {
        $httpClient = new RecordingHttpClient(CannedResponse::empty());
        try {
            $client = Client::create(
                ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                    ValidationMode::Strict,
                ),
            );
            $client->getSingleTrackResponseUsingGETRaw(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
        } catch (ApiException $error) {
            self::fail(sprintf('%s could not be called: %s', 'getSingleTrackResponseUsingGET', $error->getMessage()));
        }
        $requests = $httpClient->getRequests();
        self::assertCount(1, $requests, 'the operation did not hand exactly one request to the HTTP client');
        foreach ($requests as $request) {
            self::assertSame('GET', $request->getMethod(), 'the request went out with another HTTP method');
            self::assertStringStartsWith(
                self::BASE_URL . '/track/v1/details/',
                (string) $request->getUri(),
                "the request did not go to the operation's path below the configured base URL",
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIBuildsARequest(): void
    {
        $httpClient = new RecordingHttpClient(CannedResponse::empty());
        try {
            $client = Client::create(
                ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                    ValidationMode::Strict,
                ),
            );
            $client->referenceTrackingAPIRaw(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
        } catch (ApiException $error) {
            self::fail(sprintf('%s could not be called: %s', 'referenceTrackingAPI', $error->getMessage()));
        }
        $requests = $httpClient->getRequests();
        self::assertCount(1, $requests, 'the operation did not hand exactly one request to the HTTP client');
        foreach ($requests as $request) {
            self::assertSame('GET', $request->getMethod(), 'the request went out with another HTTP method');
            self::assertStringStartsWith(
                self::BASE_URL . '/track/v1/reference/details/',
                (string) $request->getUri(),
                "the request did not go to the operation's path below the configured base URL",
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIBuildsARequest(): void
    {
        $httpClient = new RecordingHttpClient(CannedResponse::empty());
        try {
            $client = Client::create(
                ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                    ValidationMode::Strict,
                ),
            );
            $client->shipmentTrackingAPIRaw(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
        } catch (ApiException $error) {
            self::fail(sprintf('%s could not be called: %s', 'shipmentTrackingAPI', $error->getMessage()));
        }
        $requests = $httpClient->getRequests();
        self::assertCount(1, $requests, 'the operation did not hand exactly one request to the HTTP client');
        foreach ($requests as $request) {
            self::assertSame('GET', $request->getMethod(), 'the request went out with another HTTP method');
            self::assertStringStartsWith(
                self::BASE_URL . '/track/v1/shipment/details/',
                (string) $request->getUri(),
                "the request did not go to the operation's path below the configured base URL",
            );
        }
    }
}
