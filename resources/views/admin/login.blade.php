@extends('layouts.admin')

@section('title', 'Log in')

@section('content')
<div class="mx-auto max-w-sm">
    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <h1 class="text-xl font-bold text-slate-900">SEVO Admin</h1>
        <p class="mt-1 text-sm text-slate-500">Enter the admin password to continue.</p>

        <form method="POST" action="{{ route('admin.login.store') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" id="password" autofocus
                    class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                Log in
            </button>
        </form>
    </div>
</div>
@endsection
