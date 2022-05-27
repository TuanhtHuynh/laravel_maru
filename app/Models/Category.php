<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getCategories()
    {
        $categories = self::query();
        return $categories;
    }

    public function getByName($query, $name)
    {
        $categories = $query->where("name", "like", "%{$name}%");
        return $categories;
    }

    public function OrderById($query, $sort)
    {
        $categories = $query->orderBy('id', $sort);
        return $categories;
    }

    public function Offset($query, $page, $perpage)
    {
        $categories = $query->offset(($page - 1) * $perpage)
            ->limit($perpage)->get();
        return $categories;
    }

    public function getById($id)
    {
        $category = self::find($id);
        return $category;
    }

    public function createCategory($data)
    {
        $category = self::create($data);
        return $category;
    }
}
