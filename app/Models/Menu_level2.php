<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_level2 extends Model
{
    use HasFactory;

    public function sub_menu()
    {
        return $this->belongsTo(sub_menu::class);
    }

    public function getMenulevel_SubMenu()
    {
        $level = $this::with('sub_menu')->where('status', '=', 'enable');
        return $level;
    }
}
