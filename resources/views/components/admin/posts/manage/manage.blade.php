<div>
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900">Blog posts</h2>
        @unless ($showForm)
            <button type="button" wire:click="create" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                + New post
            </button>
        @endunless
    </div>

    @if ($showForm)
        <form wire:submit="save" enctype="multipart/form-data" class="mt-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Title</label>
                    <input type="text" wire:model.live="title"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                    @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Slug (URL: /blog/{slug})</label>
                    <input type="text" wire:model="slug"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                    @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Excerpt <span class="font-normal text-slate-400">(optional, shown on the blog index)</span></label>
                    <textarea wire:model="excerpt" rows="2"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"></textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Body (HTML)</label>
                    <textarea wire:model="body" rows="10"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 font-mono text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"></textarea>
                    @error('body') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Featured image <span class="font-normal text-slate-400">(optional)</span></label>
                    <input type="file" wire:model="featuredImage" accept="image/*"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                    @error('featuredImage') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

                    <div wire:loading wire:target="featuredImage" class="mt-1 text-xs text-slate-400">Uploading&hellip;</div>

                    @if ($featuredImage)
                        <img src="{{ $featuredImage->temporaryUrl() }}" class="mt-2 h-24 w-auto rounded-lg border border-slate-200 object-cover">
                    @elseif ($existingImage)
                        <img src="{{ asset('storage/'.$existingImage) }}" class="mt-2 h-24 w-auto rounded-lg border border-slate-200 object-cover">
                    @endif
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Meta title <span class="font-normal text-slate-400">(optional)</span></label>
                    <input type="text" wire:model="meta_title"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Meta description <span class="font-normal text-slate-400">(optional)</span></label>
                    <input type="text" wire:model="meta_description"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Categories</label>
                    <div class="flex flex-wrap gap-3 rounded-lg border border-slate-300 px-3.5 py-2.5">
                        @forelse ($categories as $category)
                            <label class="flex items-center gap-1.5 text-sm text-slate-700">
                                <input type="checkbox" value="{{ $category->id }}" wire:model="selectedCategories" class="rounded border-slate-300">
                                {{ $category->name }}
                            </label>
                        @empty
                            <span class="text-sm text-slate-400">No categories yet — add some on the Categories page.</span>
                        @endforelse
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Status</label>
                    <select wire:model="status"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>

            <div class="mt-5 flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    {{ $editingId ? 'Update post' : 'Create post' }}
                </button>
                <button type="button" wire:click="cancel" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">
                    Cancel
                </button>
            </div>
        </form>
    @endif

    <div class="mt-6 overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Categories</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($posts as $post)
                    <tr wire:key="post-{{ $post->id }}">
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $post->title }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $post->categories->pluck('name')->join(', ') ?: '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $post->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            @if ($post->status === 'published')
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="mr-3 text-xs font-medium text-blue-600 hover:underline">View</a>
                            @endif
                            <button type="button" wire:click="edit({{ $post->id }})" class="mr-3 text-xs font-medium text-blue-600 hover:underline">Edit</button>
                            <button type="button" wire:click="delete({{ $post->id }})" wire:confirm="Delete this post? This can't be undone." class="text-xs font-medium text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-slate-400">No posts yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
