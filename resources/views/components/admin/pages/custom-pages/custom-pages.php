<?php

use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Component;

new class extends Component
{
    public bool $showForm = false;

    public ?int $editingId = null;

    public string $h1 = '';

    public string $slug = '';

    public string $meta_title = '';

    public string $meta_description = '';

    public string $body = '';

    public string $status = 'draft';

    /**
     * Slugs already used by named/system routes — a custom page can't take these.
     *
     * @var list<string>
     */
    private array $reservedSlugs = ['blog', 'admin', 'services', 'quote'];

    public function updatedH1(string $value): void
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
        $page = Page::custom()->findOrFail($id);

        $this->editingId = $page->id;
        $this->h1 = $page->h1;
        $this->slug = (string) $page->slug;
        $this->meta_title = (string) $page->meta_title;
        $this->meta_description = (string) $page->meta_description;
        $this->body = (string) $page->body;
        $this->status = $page->status;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate([
            'h1' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                'not_in:'.implode(',', $this->reservedSlugs),
                'unique:pages,slug,'.($this->editingId ?: 'NULL').',id',
            ],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        Page::updateOrCreate(
            ['id' => $this->editingId],
            [
                'type' => 'custom',
                'slug' => $this->slug,
                'h1' => $this->h1,
                'meta_title' => $this->meta_title ?: null,
                'meta_description' => $this->meta_description ?: null,
                'body' => $this->body ?: null,
                'status' => $this->status,
                'published_at' => $this->status === 'published' ? now() : null,
            ]
        );

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        Page::custom()->whereKey($id)->delete();
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'h1', 'slug', 'meta_title', 'meta_description', 'body', 'status']);
        $this->status = 'draft';
        $this->resetErrorBag();
    }

    public function with(): array
    {
        return [
            'customPages' => Page::custom()->latest('updated_at')->get(),
        ];
    }
};
