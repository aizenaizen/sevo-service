<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public bool $showForm = false;

    public ?int $editingId = null;

    public string $title = '';

    public string $slug = '';

    public string $excerpt = '';

    public string $body = '';

    public $featuredImage = null;

    public ?string $existingImage = null;

    public string $meta_title = '';

    public string $meta_description = '';

    public string $status = 'draft';

    /** @var array<int, int> */
    public array $selectedCategories = [];

    public function updatedTitle(string $value): void
    {
        if (! $this->editingId) {
            $this->slug = Str::slug($value);
        }
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $post = Post::with('categories')->findOrFail($id);

        $this->editingId = $post->id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->excerpt = (string) $post->excerpt;
        $this->body = $post->body;
        $this->existingImage = $post->featured_image;
        $this->featuredImage = null;
        $this->meta_title = (string) $post->meta_title;
        $this->meta_description = (string) $post->meta_description;
        $this->status = $post->status;
        $this->selectedCategories = $post->categories->pluck('id')->all();
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|alpha_dash|unique:posts,slug,'.($this->editingId ?: 'NULL').',id',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'featuredImage' => 'nullable|image|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'selectedCategories' => 'array',
            'selectedCategories.*' => 'exists:categories,id',
        ]);

        $imagePath = $this->existingImage;

        if ($this->featuredImage) {
            $imagePath = $this->featuredImage->store('blog', 'public');
        }

        $existing = $this->editingId ? Post::find($this->editingId) : null;

        $post = Post::updateOrCreate(
            ['id' => $this->editingId],
            [
                'title' => $this->title,
                'slug' => $this->slug,
                'excerpt' => $this->excerpt ?: null,
                'body' => $this->body,
                'featured_image' => $imagePath,
                'meta_title' => $this->meta_title ?: null,
                'meta_description' => $this->meta_description ?: null,
                'status' => $this->status,
                'published_at' => $this->status === 'published' ? ($existing?->published_at ?? now()) : null,
            ]
        );

        $post->categories()->sync($this->selectedCategories);

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        $post = Post::findOrFail($id);

        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->reset([
            'editingId', 'title', 'slug', 'excerpt', 'body', 'featuredImage',
            'existingImage', 'meta_title', 'meta_description', 'status', 'selectedCategories',
        ]);
        $this->status = 'draft';
        $this->resetErrorBag();
    }

    public function with(): array
    {
        return [
            'posts' => Post::with('categories')->latest('updated_at')->get(),
            'categories' => Category::orderBy('name')->get(),
        ];
    }
};
