<?php

namespace App\Http\Traits;

use App\Models\Category;
use App\Models\Product;

/**
 * 
 */
trait QueryTrait
{
    public function ProductJoinCategory()
    {
        return Product::join('categories', 'categories.id', '=', 'products.category_id');
    }
    public function getProductDetailBySlug($product_slug)
    {
        $single = Product::where('product_slug', $product_slug);
        return $single;
    }

    public function getCategoryProductBySlug($slug)
    {
        $category = Category::where('slug', '=', $slug);
        return $category;
    }

    public function stripAccents($str)
    {
        return strtr(
            utf8_decode($str),
            utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'),
            'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'
        );
    }

    public function generateSlug($str)
    {
        return strtolower(preg_replace(['/[\s\W]+/', '/\s+/'], [' ', '-'], $str));
    }
}
