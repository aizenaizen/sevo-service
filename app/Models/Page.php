<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'route_name', 'slug', 'h1', 'meta_title', 'meta_description', 'body', 'status', 'published_at'])]
class Page extends Model
{
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function isCustom(): bool
    {
        return $this->type === 'custom';
    }

    public function scopeSystem($query)
    {
        return $query->where('type', 'system');
    }

    public function scopeCustom($query)
    {
        return $query->where('type', 'custom');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
