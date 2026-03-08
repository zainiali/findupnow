<?php

use Modules\CustomMenu\app\Models\Menu;
use Modules\CustomMenu\app\Models\MenuItem;

if (!function_exists('mainMenu')) {
    /**
     * @param $slug
     */
    function mainMenu($slug)
    {
        return menuGetBySlug($slug);
    }
}

if (!function_exists('menuGetBySlug')) {
    /**
     * @param $slug
     */
    function menuGetBySlug($slug)
    {
        try {
            $menu = Menu::bySlug($slug);

            return is_null($menu) ? [] : menuGetById($menu->id);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('menuGetById')) {
    /**
     * @param  $menu_id
     * @return mixed
     */
    function menuGetById($menu_id)
    {
        $menuItem  = new MenuItem;
        $menu_list = $menuItem->getAll($menu_id);

        $roots = $menu_list->where('menu_id', (int) $menu_id)->where('parent_id', 0);

        $items = menuTree($roots, $menu_list);

        return $items;
    }
}

if (!function_exists('menuTree')) {
    /**
     * @param  $items
     * @param  $all_items
     * @return mixed
     */
    function menuTree($items, $all_items)
    {
        $data_arr = [];
        $i        = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find         = $all_items->where('parent_id', $item->id);

            $data_arr[$i]['child'] = [];

            if ($find->count()) {
                $data_arr[$i]['child'] = menuTree($find, $all_items);
            }

            $i++;
        }

        return $data_arr;
    }
}
