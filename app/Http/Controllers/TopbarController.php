<?php

namespace App\Http\Controllers;

use App\Models\Topbar;
use Illuminate\Http\Request;

class TopbarController extends Controller
{
    var $topbar;
    function __construct(Topbar $topbar)
    {
        $this->topbar = $topbar;
    }

    public function getTopbarImage()
    {
        $images = $this->topbar->getTopbars();
        return response()->json(
            [
                'topbars' => $images
            ],
            200
        );
    }
}
