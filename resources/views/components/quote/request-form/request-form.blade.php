<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 dark:border-slate-800 dark:bg-slate-900">
    @if ($submitted)
        <div class="flex flex-col items-center gap-3 py-8 text-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                <svg class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Request received</h3>
            <p class="max-w-sm text-sm text-slate-600 dark:text-slate-400">
                Thanks — we'll review your goals and get back to you with a tailored quote within one business day.
            </p>
        </div>
    @else
        <form wire:submit="submit" class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div class="sm:col-span-1">
                <label for="quote-name" class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                <input wire:model="name" id="quote-name" type="text" autocomplete="name"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                @error('name') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-1">
                <label for="quote-email" class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Email *</label>
                <input wire:model="email" id="quote-email" type="email" autocomplete="email"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                @error('email') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-1">
                <label for="quote-phone" class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Phone</label>
                <input wire:model="phone" id="quote-phone" type="tel" autocomplete="tel"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                @error('phone') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-1">
                <label for="quote-company" class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Company</label>
                <input wire:model="company" id="quote-company" type="text" autocomplete="organization"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                @error('company') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="quote-website" class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Website URL</label>
                <input wire:model="website_url" id="quote-website" type="url" placeholder="https://"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                @error('website_url') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <span class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Which services are you interested in? *</span>
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                    @foreach ($serviceOptions as $value => $label)
                        <label class="flex cursor-pointer items-start gap-2 rounded-lg border border-slate-300 p-3 text-sm text-slate-700 hover:border-blue-400 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 dark:border-slate-700 dark:text-slate-300 dark:hover:border-emerald-500 dark:has-[:checked]:border-emerald-500 dark:has-[:checked]:bg-emerald-500/10">
                            <input type="checkbox" wire:model="services" value="{{ $value }}" class="mt-0.5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800">
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
                @error('services') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="quote-budget" class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Monthly budget</label>
                <select wire:model="budget_range" id="quote-budget"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                    <option value="">Select a range…</option>
                    @foreach ($budgetOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('budget_range') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="quote-message" class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Tell us about your goals</label>
                <textarea wire:model="message" id="quote-message" rows="4"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
                @error('message') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 disabled:opacity-60 sm:w-auto dark:bg-emerald-500 dark:hover:bg-emerald-400"
                >
                    <span wire:loading.remove wire:target="submit">Request my quote</span>
                    <span wire:loading wire:target="submit">Sending…</span>
                </button>
            </div>
        </form>
    @endif
</div>
