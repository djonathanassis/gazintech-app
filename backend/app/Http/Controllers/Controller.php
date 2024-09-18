<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Tech Dev API",
 *     description="API desenvolvida para o desafio da Gazin-tech",
 *     @OA\Contact(
 *          email="caiogrechic50@gmail.com"
 *     )
 * )
 */
abstract class Controller
{
    use AuthorizesRequests, HttpResponses;
}
