<?php

namespace App\Models;

use App\Http\Traits\QueryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Product Model class
 */
class Product extends Model
{
    use HasFactory;
    use QueryTrait;

    protected $fillable = [
        'product_name', 'product_slug',
        'price', 'quantily',
        'price_discount', 'product_description',
        'category_id', 'imageUrl'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->select([
            'id',
            'name as category_name',
            'slug as category_slug'
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $strip = $model->stripAccents($model->product_name);
            $model->product_slug =  $model->generateSlug($strip); //str_replace(' ', '-', $strip);
        });
    }

    /**
     * get Pro category
     *
     * @return mixed
     */
    public function getProductCategory()
    {
        return $this->with('category');
    }
    public function getByCategorySlug($product_query, $categoryslug)
    {
        return $product_query->whereHas('category', function ($query) use ($categoryslug) {
            $query->where('slug', $categoryslug);
        });
    }
    public function getEager($query, $category_slug)
    {
        return $query->whereHas(
            'category',
            function ($q) use ($category_slug) {
                $q->where('slug', '=', $category_slug);
            }
        );
    }

    public function getProductByCategorySlug($ctgslug)
    {
        return self::with(['category' => function ($q) use ($ctgslug) {
            $q->where('slug', '=', 'banh')->select(['slug']);
        }]);
    }

    public function getProductCategoryById($id)
    {
        return self::getProductCategory()->where('products.id', '=', $id);
    }

    public function getProductByname($query, $name)
    {
        return $query->where('product_name', 'LIKE', "%{$name}%");
    }

    public function getProductDetailBySlug($product_slug)
    {
        $single = self::with('category')->where('product_slug', $product_slug);
        return $single;
    }

    public function getDiscount($query)
    {
        $products = $query->where('price_discount', '>', '0');
        return $products;
    }

    public function getDiscountLast($query, $take)
    {
        $products = $query->orderBy('id', 'desc')->limit($take);
        return $products;
    }

    public function getProductById($id)
    {
        return self::findOrFail($id);
    }

    public function createProduct($data)
    {
        return self::create($data);
    }
}
