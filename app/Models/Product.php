<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasBlocks, HasSlug, HasMedias, HasFiles, HasRevisions;

    protected $fillable = [
        'published',
        'title',
        'description',
        'price',
        'sale_price',
        'in_stock',
        'stock_quantity',
        'production_code',
        'is_featured',
    ];

    public $slugAttributes = [
        'title',
    ];

    public $mediasParams = [
        'picture' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => null,
                ],
            ],
        ],
        'cover' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 16 / 9,
                ],
            ],
            'mobile' => [
                [
                    'name' => 'mobile',
                    'ratio' => 1,
                ],
            ],
        ],
    ];
    public $filesParams = ['file_role', 'file_role1', 'file_role2', 'files', 'videos'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if ($product->isDirty('published') && $product->published == 0) {
                // Product is being unpublished, delete associated cart items
                DB::table('carts')->where('product_id', $product->id)->delete();
                DB::table('favorites')->where('product_id', $product->id)->delete();
            }
        });
    }
}
