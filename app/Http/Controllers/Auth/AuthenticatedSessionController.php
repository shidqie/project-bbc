<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $url = '/';
        if ($request->user()->role === 'kasir') {
            $url = route('kasir.dashboard', absolute: false);
        } elseif ($request->user()->role === 'dapur') {
            $url = route('dapur.dashboard', absolute: false);
        } elseif ($request->user()->role === 'manager') {
            $url = route('manager.dashboard', absolute: false);
        } elseif ($request->user()->role === 'pemilik') {
            $url = route('pemilik.dashboard', absolute: false);
        }

        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
