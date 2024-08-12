<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'images',
        'description',
        'stock',
        'price',
        'sku',
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->BelongsTo(Brand::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
