<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiftOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'gift_option_type_id',
        'name',
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

    public function giftOptionType(): BelongsTo
    {
        return $this->belongsTo(GiftOptionType::class, 'gift_option_type_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType(Builder $query, $typeOrId): Builder
    {
        if (is_numeric($typeOrId)) {
            return $query->where('gift_option_type_id', $typeOrId);
        }
        return $query->whereHas('giftOptionType', fn (Builder $q) => $q->where('slug', $typeOrId));
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->image_path ? asset('storage/' . ltrim($this->image_path, '/')) : null;
        });
    }
}
