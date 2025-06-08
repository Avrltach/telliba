<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCrsfToken
{
      protected $except = [
        'api/*',
    ];

}
