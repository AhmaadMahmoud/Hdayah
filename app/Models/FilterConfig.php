<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterConfig extends Model
{
    protected $fillable = [
        'key',
        'config',
    ];

    protected $casts = [
        'config' => 'array',
    ];

    public static function getConfig(string $key): array
    {
        return (array) static::query()->where('key', $key)->value('config');
    }

    public static function setConfig(string $key, array $config): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['config' => $config]
        );
    }
}

