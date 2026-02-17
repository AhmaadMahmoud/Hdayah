<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GiftOptionType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'selection_mode',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public const SELECTION_SINGLE = 'single';
    public const SELECTION_MULTIPLE = 'multiple';
    public const SELECTION_OPTIONAL_SINGLE = 'optional_single';

    public function options(): HasMany
    {
        return $this->hasMany(GiftOption::class, 'gift_option_type_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
