<?php

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

new class extends Component
{
    public string $name = '';

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        $this->reset('name');
    }

    public function delete(int $id): void
    {
        Category::whereKey($id)->delete();
    }

    public function with(): array
    {
        return [
            'categories' => Category::withCount('posts')->orderBy('name')->get(),
        ];
    }
};
