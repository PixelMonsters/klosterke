<?php

namespace App\Models;

use App\Enum\ProductCategory;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property int $quality
 * @property int $sells_before
 * @property ProductCategory $category
 */
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'quality',
        'sells_before',
        'category',
    ];

    protected function casts(): array
    {
        return [
            'quality' => 'integer',
            'sells_before' => 'integer',
            'category' => ProductCategory::class,
        ];
    }
}
