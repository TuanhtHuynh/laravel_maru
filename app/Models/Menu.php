<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function sub_menus()
    {
        return $this->hasMany(sub_menu::class);
    }

    public function getMenus()
    {
        $menus = $this->where('status', '=', 'enable')->withCount('sub_menus');
        return $menus;
    }

    public function getAllMenus($status = 'enable')
    {
        return self::where('status', '=', 'enable')
            ->with(["sub_menus.menu_level2s"
            => function ($q) use ($status) {
                $q->where("status", "=", $status)
                    ->orderBy('order', 'asc');
            }]);
    }
}
