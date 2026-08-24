<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if ($this->isAuthenticated()) {
            return redirect()->route('admin.pages.index');
        }

        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['password' => 'required|string']);

        if (! hash_equals((string) config('admin.password'), $request->string('password')->value())) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);

        return redirect()->route('admin.pages.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }

    private function isAuthenticated(): bool
    {
        return (bool) session('admin_authenticated');
    }
}
