<?php

declare(strict_types=1);

namespace Prefabcortex\UpsTrackservice\Tests\Fixture\Model;

use Prefabcortex\UpsTrackservice\Model\Response;
use Prefabcortex\UpsTrackservice\Validator\ResponseConstraint;
use Symfony\Component\Validator\Constraint;

final class ResponseFixture
{
    public static function build(): Response
    {
        return Response::builder()->build();
    }

    /** @return callable(array<int|string, mixed>): Response */
    public static function reader(): callable
    {
        return Response::fromArray(...);
    }

    /** @return list<Constraint> */
    public static function constraints(): array
    {
        return ResponseConstraint::constraints();
    }
}
