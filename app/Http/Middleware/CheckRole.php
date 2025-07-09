<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Proposta;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('welcome');
        }

        if ($roles !== null) {
            $rolesArray = explode('.', $roles);

            $rolesArray = array_map('trim', $rolesArray);
            $rolesArray = array_map('intval', $rolesArray);

            if (!in_array((int)$user->role_id, $rolesArray)) {
                abort(403, 'Acesso negado.');
            }
        }

        return $next($request);
    }
}
