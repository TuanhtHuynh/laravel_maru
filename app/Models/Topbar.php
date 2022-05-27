<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topbar extends Model
{
    use HasFactory;

    public function getTopbars()
    {
        $topbars = $this->all();
        return $topbars;
    }
}
