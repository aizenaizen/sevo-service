<div class="space-y-6">
    @foreach ($pages as $index => $page)
        <form wire:submit="save({{ $index }})" wire:key="system-page-{{ $page['id'] }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">{{ ucfirst($page['route_name']) }} page</h3>
                <a href="{{ route($page['route_name']) }}" target="_blank" class="text-xs font-medium text-blue-600 hover:underline">View page &rarr;</a>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">H1 heading</label>
                    <input type="text" wire:model="pages.{{ $index }}.h1"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                    @error("pages.$index.h1") <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Meta title <span class="font-normal text-slate-400">(optional)</span></label>
                    <input type="text" wire:model="pages.{{ $index }}.meta_title"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Meta description <span class="font-normal text-slate-400">(optional)</span></label>
                    <input type="text" wire:model="pages.{{ $index }}.meta_description"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                </div>
            </div>

            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Save
                </button>
                @if ($savedIndex === $index)
                    <span class="text-sm font-medium text-emerald-600">Saved.</span>
                @endif
            </div>
        </form>
    @endforeach
</div>
