<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="API starships and vehicles",
 *         version="1.0",
 *         description="API for handle inventory of Starships and Vehicles",
 *     ),
 *     @OA\Tag(
 *     name="Vehicles",
 *     description="Endpoints related to vehicle operations",
 *     ),
 *      @OA\Tag(
 *     name="Starships",
 *     description="Endpoints related to starship operations",
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
