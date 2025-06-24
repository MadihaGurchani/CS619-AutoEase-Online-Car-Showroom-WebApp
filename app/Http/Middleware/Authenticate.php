<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        // Allow search functionality without authentication
        if ($request->is('search') || $request->is('/') || $request->is('cars/search')) {
            return null;
        }
        
        return $request->expectsJson() ? null : route('login');
    }
}