<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Menu_level2;
use App\Models\sub_menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menu, $submenu, $menulevel2;
    function __construct(
        Menu $menus,
        sub_menu $sub_menu,
        Menu_level2 $menulevel2
    ) {
        $this->menu = $menus;
        $this->submenu = $sub_menu;
        $this->menulevel2 = $menulevel2;
    }

    public function getAllMenus()
    {
        $menu_query = $this->menu->getAllMenus()
            ->get();
        return response()->json([
            'menus' => $menu_query
        ]);
    }
    public function getMenus()
    {
        $menus = $this->menu->getMenus();
        return response()->json(["menus" => $menus->get()], 200);
    }

    public function getSubmenus(Request $request)
    {
        $submenu = $this->submenu->getSubMenu_Menu();
        $result = $submenu->get([
            'sub_menus.*',
            'menus.id as menu_id',
            'menus.menu_name'
        ]);
        return response()->json(['submenus' => $result], 200);
    }

    public function getMenulevel2s()
    {
        $menulevel2 = $this->menulevel2->getMenulevel_SubMenu();
        $result = $menulevel2->get();
        return response()->json(['menu_level2s' => $result], 200);
    }
}
