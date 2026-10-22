<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Operations;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Prefabcortex\UpsTrackservice\Client;
use Prefabcortex\UpsTrackservice\ClientConfig;
use Prefabcortex\UpsTrackservice\Exception\ApiException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETBadRequestException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETForbiddenException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETInternalServerErrorException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETNotFoundException;
use Prefabcortex\UpsTrackservice\Exception\GetSingleTrackResponseUsingGETServiceUnavailableException;
use Prefabcortex\UpsTrackservice\Exception\MalformedDataException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPIBadRequestException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPIForbiddenException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPIInternalServerErrorException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPINotFoundException;
use Prefabcortex\UpsTrackservice\Exception\ReferenceTrackingAPIServiceUnavailableException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPIBadRequestException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPIForbiddenException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPIInternalServerErrorException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPINotFoundException;
use Prefabcortex\UpsTrackservice\Exception\ShipmentTrackingAPIServiceUnavailableException;
use Prefabcortex\UpsTrackservice\Exception\UnexpectedContentTypeException;
use Prefabcortex\UpsTrackservice\Exception\UnexpectedStatusCodeException;
use Prefabcortex\UpsTrackservice\Http\JsonBody;
use Prefabcortex\UpsTrackservice\Http\ValidationMode;
use Prefabcortex\UpsTrackservice\Parameter\GetSingleTrackResponseUsingGETHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\GetSingleTrackResponseUsingGETQueryParameters;
use Prefabcortex\UpsTrackservice\Parameter\ReferenceTrackingAPIHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\ReferenceTrackingAPIQueryParameters;
use Prefabcortex\UpsTrackservice\Parameter\ShipmentTrackingAPIHeaderParameters;
use Prefabcortex\UpsTrackservice\Parameter\ShipmentTrackingAPIQueryParameters;
use Prefabcortex\UpsTrackservice\Tests\Fixture\CannedResponse;
use Prefabcortex\UpsTrackservice\Tests\Fixture\Model\ResponseFixture;
use Prefabcortex\UpsTrackservice\Tests\Fixture\Model\TrackApiResponseFixture;
use Prefabcortex\UpsTrackservice\Tests\Fixture\RecordingHttpClient;
use RuntimeException;

use function sprintf;

/**
 * Every response an operation reads, answered once through the method that reads it.
 *
 * A recorded client answers with the status and content type of one branch and a body built from
 * the model fixtures; the test checks that the model comes back, or the declared exception with the
 * response still readable. A status no response declares and a declared status under the wrong
 * content type are answered too.
 *
 * What this cannot show: that the service sends these documents. They come from the same
 * description the client came from, so this proves the package reads what it promises.
 */
final class OperationResponseTest extends TestCase
{
    private const string BASE_URL = 'https://response-test.invalid';

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETReads200(): void
    {
        $body = JsonBody::encode(TrackApiResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(200, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $result = $client->getSingleTrackResponseUsingGET(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf(
                    '%s answered %d with %s: %s',
                    'getSingleTrackResponseUsingGET',
                    200,
                    $error::class,
                    $error->getMessage(),
                ),
            );
        }
        self::assertEquals(TrackApiResponseFixture::build(), $result);
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETReads400(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(400, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->getSingleTrackResponseUsingGET(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw GetSingleTrackResponseUsingGETBadRequestException for its %d response',
                    'getSingleTrackResponseUsingGET',
                    400,
                ),
            );
        } catch (GetSingleTrackResponseUsingGETBadRequestException $exception) {
            self::assertSame(400, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf(
                    '%s answered %d with %s: %s',
                    'getSingleTrackResponseUsingGET',
                    400,
                    $error::class,
                    $error->getMessage(),
                ),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETReads403(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(403, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->getSingleTrackResponseUsingGET(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw GetSingleTrackResponseUsingGETForbiddenException for its %d response',
                    'getSingleTrackResponseUsingGET',
                    403,
                ),
            );
        } catch (GetSingleTrackResponseUsingGETForbiddenException $exception) {
            self::assertSame(403, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf(
                    '%s answered %d with %s: %s',
                    'getSingleTrackResponseUsingGET',
                    403,
                    $error::class,
                    $error->getMessage(),
                ),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETReads404(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(404, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->getSingleTrackResponseUsingGET(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw GetSingleTrackResponseUsingGETNotFoundException for its %d response',
                    'getSingleTrackResponseUsingGET',
                    404,
                ),
            );
        } catch (GetSingleTrackResponseUsingGETNotFoundException $exception) {
            self::assertSame(404, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf(
                    '%s answered %d with %s: %s',
                    'getSingleTrackResponseUsingGET',
                    404,
                    $error::class,
                    $error->getMessage(),
                ),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETReads500(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(500, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->getSingleTrackResponseUsingGET(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw GetSingleTrackResponseUsingGETInternalServerErrorException for its %d response',
                    'getSingleTrackResponseUsingGET',
                    500,
                ),
            );
        } catch (GetSingleTrackResponseUsingGETInternalServerErrorException $exception) {
            self::assertSame(500, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf(
                    '%s answered %d with %s: %s',
                    'getSingleTrackResponseUsingGET',
                    500,
                    $error::class,
                    $error->getMessage(),
                ),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETReads503(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(503, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->getSingleTrackResponseUsingGET(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw GetSingleTrackResponseUsingGETServiceUnavailableException for its %d response',
                    'getSingleTrackResponseUsingGET',
                    503,
                ),
            );
        } catch (GetSingleTrackResponseUsingGETServiceUnavailableException $exception) {
            self::assertSame(503, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf(
                    '%s answered %d with %s: %s',
                    'getSingleTrackResponseUsingGET',
                    503,
                    $error::class,
                    $error->getMessage(),
                ),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETRejectsAnUndeclaredStatus(): void
    {
        $httpClient = new RecordingHttpClient(
            CannedResponse::answering(
                599,
                'text/html',
                '<html><body>Served by something in front of the API</body></html>',
            ),
        );
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->getSingleTrackResponseUsingGET(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw UnexpectedStatusCodeException for a %d response it cannot read',
                    'getSingleTrackResponseUsingGET',
                    599,
                ),
            );
        } catch (UnexpectedStatusCodeException $exception) {
            self::assertSame(
                '<html><body>Served by something in front of the API</body></html>',
                $exception->getResponse()->getBody()->getContents(),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf(
                    '%s answered %d with %s: %s',
                    'getSingleTrackResponseUsingGET',
                    599,
                    $error::class,
                    $error->getMessage(),
                ),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testGetSingleTrackResponseUsingGETRejectsAnUndeclaredContentType(): void
    {
        $httpClient = new RecordingHttpClient(
            CannedResponse::answering(
                200,
                'text/html',
                '<html><body>Served by something in front of the API</body></html>',
            ),
        );
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->getSingleTrackResponseUsingGET(
                'smoke-test',
                new GetSingleTrackResponseUsingGETQueryParameters(),
                new GetSingleTrackResponseUsingGETHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw UnexpectedContentTypeException for a %d response it cannot read',
                    'getSingleTrackResponseUsingGET',
                    200,
                ),
            );
        } catch (UnexpectedContentTypeException $exception) {
            self::assertSame(
                '<html><body>Served by something in front of the API</body></html>',
                $exception->getResponse()->getBody()->getContents(),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf(
                    '%s answered %d with %s: %s',
                    'getSingleTrackResponseUsingGET',
                    200,
                    $error::class,
                    $error->getMessage(),
                ),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIReads200(): void
    {
        $body = JsonBody::encode(TrackApiResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(200, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $result = $client->referenceTrackingAPI(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'referenceTrackingAPI', 200, $error::class, $error->getMessage()),
            );
        }
        self::assertEquals(TrackApiResponseFixture::build(), $result);
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIReads400(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(400, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->referenceTrackingAPI(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ReferenceTrackingAPIBadRequestException for its %d response',
                    'referenceTrackingAPI',
                    400,
                ),
            );
        } catch (ReferenceTrackingAPIBadRequestException $exception) {
            self::assertSame(400, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'referenceTrackingAPI', 400, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIReads403(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(403, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->referenceTrackingAPI(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ReferenceTrackingAPIForbiddenException for its %d response',
                    'referenceTrackingAPI',
                    403,
                ),
            );
        } catch (ReferenceTrackingAPIForbiddenException $exception) {
            self::assertSame(403, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'referenceTrackingAPI', 403, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIReads404(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(404, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->referenceTrackingAPI(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ReferenceTrackingAPINotFoundException for its %d response',
                    'referenceTrackingAPI',
                    404,
                ),
            );
        } catch (ReferenceTrackingAPINotFoundException $exception) {
            self::assertSame(404, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'referenceTrackingAPI', 404, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIReads500(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(500, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->referenceTrackingAPI(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ReferenceTrackingAPIInternalServerErrorException for its %d response',
                    'referenceTrackingAPI',
                    500,
                ),
            );
        } catch (ReferenceTrackingAPIInternalServerErrorException $exception) {
            self::assertSame(500, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'referenceTrackingAPI', 500, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIReads503(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(503, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->referenceTrackingAPI(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ReferenceTrackingAPIServiceUnavailableException for its %d response',
                    'referenceTrackingAPI',
                    503,
                ),
            );
        } catch (ReferenceTrackingAPIServiceUnavailableException $exception) {
            self::assertSame(503, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'referenceTrackingAPI', 503, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIRejectsAnUndeclaredStatus(): void
    {
        $httpClient = new RecordingHttpClient(
            CannedResponse::answering(
                599,
                'text/html',
                '<html><body>Served by something in front of the API</body></html>',
            ),
        );
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->referenceTrackingAPI(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw UnexpectedStatusCodeException for a %d response it cannot read',
                    'referenceTrackingAPI',
                    599,
                ),
            );
        } catch (UnexpectedStatusCodeException $exception) {
            self::assertSame(
                '<html><body>Served by something in front of the API</body></html>',
                $exception->getResponse()->getBody()->getContents(),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'referenceTrackingAPI', 599, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testReferenceTrackingAPIRejectsAnUndeclaredContentType(): void
    {
        $httpClient = new RecordingHttpClient(
            CannedResponse::answering(
                200,
                'text/html',
                '<html><body>Served by something in front of the API</body></html>',
            ),
        );
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->referenceTrackingAPI(
                'smoke-test',
                new ReferenceTrackingAPIQueryParameters(),
                new ReferenceTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw UnexpectedContentTypeException for a %d response it cannot read',
                    'referenceTrackingAPI',
                    200,
                ),
            );
        } catch (UnexpectedContentTypeException $exception) {
            self::assertSame(
                '<html><body>Served by something in front of the API</body></html>',
                $exception->getResponse()->getBody()->getContents(),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'referenceTrackingAPI', 200, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIReads200(): void
    {
        $body = JsonBody::encode(TrackApiResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(200, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $result = $client->shipmentTrackingAPI(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'shipmentTrackingAPI', 200, $error::class, $error->getMessage()),
            );
        }
        self::assertEquals(TrackApiResponseFixture::build(), $result);
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIReads400(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(400, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->shipmentTrackingAPI(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ShipmentTrackingAPIBadRequestException for its %d response',
                    'shipmentTrackingAPI',
                    400,
                ),
            );
        } catch (ShipmentTrackingAPIBadRequestException $exception) {
            self::assertSame(400, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'shipmentTrackingAPI', 400, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIReads403(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(403, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->shipmentTrackingAPI(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ShipmentTrackingAPIForbiddenException for its %d response',
                    'shipmentTrackingAPI',
                    403,
                ),
            );
        } catch (ShipmentTrackingAPIForbiddenException $exception) {
            self::assertSame(403, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'shipmentTrackingAPI', 403, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIReads404(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(404, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->shipmentTrackingAPI(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ShipmentTrackingAPINotFoundException for its %d response',
                    'shipmentTrackingAPI',
                    404,
                ),
            );
        } catch (ShipmentTrackingAPINotFoundException $exception) {
            self::assertSame(404, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'shipmentTrackingAPI', 404, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIReads500(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(500, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->shipmentTrackingAPI(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ShipmentTrackingAPIInternalServerErrorException for its %d response',
                    'shipmentTrackingAPI',
                    500,
                ),
            );
        } catch (ShipmentTrackingAPIInternalServerErrorException $exception) {
            self::assertSame(500, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'shipmentTrackingAPI', 500, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIReads503(): void
    {
        $body = JsonBody::encode(ResponseFixture::build());
        $httpClient = new RecordingHttpClient(CannedResponse::answering(503, 'application/json', $body));
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->shipmentTrackingAPI(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw ShipmentTrackingAPIServiceUnavailableException for its %d response',
                    'shipmentTrackingAPI',
                    503,
                ),
            );
        } catch (ShipmentTrackingAPIServiceUnavailableException $exception) {
            self::assertSame(503, $exception->getResponse()->getStatusCode());
            self::assertEquals(ResponseFixture::build(), $exception->getResponseObject());
            self::assertSame($body, $exception->getRawResponse());
            self::assertSame($body, $exception->getResponse()->getBody()->getContents());
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'shipmentTrackingAPI', 503, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIRejectsAnUndeclaredStatus(): void
    {
        $httpClient = new RecordingHttpClient(
            CannedResponse::answering(
                599,
                'text/html',
                '<html><body>Served by something in front of the API</body></html>',
            ),
        );
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->shipmentTrackingAPI(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw UnexpectedStatusCodeException for a %d response it cannot read',
                    'shipmentTrackingAPI',
                    599,
                ),
            );
        } catch (UnexpectedStatusCodeException $exception) {
            self::assertSame(
                '<html><body>Served by something in front of the API</body></html>',
                $exception->getResponse()->getBody()->getContents(),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'shipmentTrackingAPI', 599, $error::class, $error->getMessage()),
            );
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws MalformedDataException
     * @throws RuntimeException
     */
    public function testShipmentTrackingAPIRejectsAnUndeclaredContentType(): void
    {
        $httpClient = new RecordingHttpClient(
            CannedResponse::answering(
                200,
                'text/html',
                '<html><body>Served by something in front of the API</body></html>',
            ),
        );
        $client = Client::create(
            ClientConfig::forBaseUrl(self::BASE_URL)->withHttpClient($httpClient)->withValidation(
                ValidationMode::Strict,
            ),
        );
        try {
            $client->shipmentTrackingAPI(
                'smoke-test',
                new ShipmentTrackingAPIQueryParameters(),
                new ShipmentTrackingAPIHeaderParameters('smoke-test', 'smoke-test'),
            );
            self::fail(
                sprintf(
                    '%s did not throw UnexpectedContentTypeException for a %d response it cannot read',
                    'shipmentTrackingAPI',
                    200,
                ),
            );
        } catch (UnexpectedContentTypeException $exception) {
            self::assertSame(
                '<html><body>Served by something in front of the API</body></html>',
                $exception->getResponse()->getBody()->getContents(),
            );
        } catch (ApiException $error) {
            self::fail(
                sprintf('%s answered %d with %s: %s', 'shipmentTrackingAPI', 200, $error::class, $error->getMessage()),
            );
        }
    }
}
