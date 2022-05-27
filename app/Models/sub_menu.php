<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_menus.*', 'menus.id as menu_id', 'menus.menu_name'
    ];
    public function menu_level2s()
    {
        return $this->hasMany(Menu_level2::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function getSubMenu_Menu()
    {
        $sub_menu = self::join('menus', 'menus.id', '=', 'sub_menus.menu_id')
            ->where('sub_menus.status', '=', 'enable');
        return $sub_menu;
    }
}
