<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    use ApiResponse;

    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $auth */
        $auth = Auth::user();

        if (!$auth->is_admin) {
            return $next($request);
        }

        return $this->failed('Unauthorized', 401);

    }
}
