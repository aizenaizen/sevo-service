<?php

use App\Models\Page;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    /** @var array<int, array{id: int, route_name: string, h1: string, meta_title: string, meta_description: string}> */
    public array $pages = [];

    public ?int $savedIndex = null;

    public function mount(): void
    {
        $this->loadPages();
    }

    public function loadPages(): void
    {
        $this->pages = Page::system()
            ->orderByRaw("field(route_name, 'home', 'services', 'quote')")
            ->get()
            ->map(fn (Page $page) => [
                'id' => $page->id,
                'route_name' => $page->route_name,
                'h1' => $page->h1,
                'meta_title' => (string) $page->meta_title,
                'meta_description' => (string) $page->meta_description,
            ])
            ->toArray();
    }

    public function save(int $index): void
    {
        $this->validate([
            "pages.$index.h1" => 'required|string|max:255',
            "pages.$index.meta_title" => 'nullable|string|max:255',
            "pages.$index.meta_description" => 'nullable|string|max:500',
        ]);

        $data = $this->pages[$index];

        Page::whereKey($data['id'])->update([
            'h1' => $data['h1'],
            'meta_title' => $data['meta_title'] ?: null,
            'meta_description' => $data['meta_description'] ?: null,
        ]);

        $this->savedIndex = $index;
    }
};
