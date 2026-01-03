<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;

class GiftOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'price',
        'image_path',
        'icon',
        'is_default',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public const TYPE_BOX = 'box';
    public const TYPE_ADDON = 'addon';
    public const TYPE_CARD = 'card';

    /**
     * Scope active options.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope by type.
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Convenience accessor for public image URL.
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->image_path ? asset('storage/' . ltrim($this->image_path, '/')) : null;
        });
    }
}
