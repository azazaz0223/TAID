<?php

namespace App\Http\Controllers;

use App\Trait\JsonResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use JsonResponseTrait, AuthorizesRequests;
}
