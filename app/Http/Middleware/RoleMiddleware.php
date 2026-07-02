<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $hakAkses = auth()->user()?->hak_akses;

        if ($hakAkses === 'Super Admin') {
            return $next($request);
        }

        if (!in_array($hakAkses, $roles)) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        return $next($request);
    }
}
