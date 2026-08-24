<div>
    @if ($subscribed)
        <p class="flex items-center gap-2 text-sm font-medium text-emerald-700 dark:text-emerald-400">
            <svg class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
            </svg>
            You're subscribed — thanks for joining.
        </p>
    @else
        <form wire:submit="subscribe" class="flex flex-col gap-3 sm:flex-row sm:items-start">
            <div class="flex-1">
                <label for="newsletter-email" class="sr-only">Email address</label>
                <input
                    wire:model="email"
                    id="newsletter-email"
                    type="email"
                    placeholder="you@company.com"
                    autocomplete="email"
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder-slate-500"
                >
                @error('email')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="subscribe"
                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 disabled:opacity-60 dark:bg-emerald-500 dark:hover:bg-emerald-400"
            >
                <span wire:loading.remove wire:target="subscribe">Subscribe</span>
                <span wire:loading wire:target="subscribe">Subscribing…</span>
            </button>
        </form>
    @endif
</div>
