<?php

namespace App\Actions\Fortify;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        $user = Auth::user();

        // Default fallback redirect
        $redirect = '/dashboard';

        // If the authenticated user is a simple client ('user'), send them to the library
        if ($user && isset($user->role) && $user->role === 'user') {
            // Use named route if available, otherwise fallback to /library
            $redirect = route('library', [], false) ?: '/library';
        } elseif ($user && isset($user->role) && $user->role === 'admin') {
            $redirect = route('admin.dashboard', [], false) ?: '/admin';
        }

        return redirect()->intended($redirect);
    }
}
