<?php

namespace Modules\CustomMenu\database\seeders;

use Illuminate\Database\Seeder;
use Modules\CustomMenu\app\Models\Menu;
use Modules\CustomMenu\app\Models\MenuItem;
use Modules\CustomMenu\app\Models\MenuItemTranslation;
use Modules\CustomMenu\app\Models\MenuTranslation;

class CustomMenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function processMenuItems($menuItems, $menuId, $parentId = 0)
        {
            foreach ($menuItems as $item) {
                $menuItem = new MenuItem();
                $menuItem->label = $item['translations'][0]['label'];
                $menuItem->link = $item['link'];
                $menuItem->menu_id = $menuId;
                $menuItem->parent_id = $parentId;
                $menuItem->sort = $item['sort'];

                if ($menuItem->save()) {
                    foreach ($item['translations'] as $translate_item) {
                        MenuItemTranslation::create([
                            'menu_item_id' => $menuItem->id,
                            'lang_code' => $translate_item['lang_code'],
                            'label' => $translate_item['label'],
                        ]);
                    }

                    if (isset($item['menu_items']) && is_array($item['menu_items'])) {
                        processMenuItems($item['menu_items'], $menuId, $menuItem->id);
                    }
                }
            }
        }
        // Menu list
        $menu_list = [
            [
                'slug' => 'main-menu',
                'translations' => [
                    ['lang_code' => 'en', 'name' => 'Main Menu'],
                ],
                'menu_items' => [
                    [
                        'link' => '/',
                        'sort' => 0,
                        'translations' => [
                            ['lang_code' => 'en', 'label' => 'Home'],
                        ],
                        'menu_items' => [
                            [
                                'link' => '/?homepage=1',
                                'sort' => 1,
                                'translations' => [
                                    ['lang_code' => 'en', 'label' => 'Home 1'],
                                ],
                            ],
                            [
                                'link' => '/?homepage=2',
                                'sort' => 1,
                                'translations' => [
                                    ['lang_code' => 'en', 'label' => 'Home 2'],
                                ],
                            ],
                        ],
                    ],
                    [
                        'link' => '/about-us',
                        'sort' => 2,
                        'translations' => [
                            ['lang_code' => 'en', 'label' => 'About Us'],
                        ],
                    ],
                    [
                        'link' => '#',
                        'sort' => 3,
                        'translations' => [
                            ['lang_code' => 'en', 'label' => 'Pages'],
                        ],
                        'menu_items' => [
                            [
                                'link' => '/privacy-policy',
                                'sort' => 4,
                                'translations' => [
                                    ['lang_code' => 'en', 'label' => 'Privacy Policy'],
                                ],
                            ],
                        ],
                    ],
                    [
                        'link' => '/contact-us',
                        'sort' => 5,
                        'translations' => [
                            ['lang_code' => 'en', 'label' => 'Contact'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'secondary-menu',
                'translations' => [
                    ['lang_code' => 'en', 'name' => 'Secondary Menu'],
                ],
                'menu_items' => [
                    [
                        'link' => '/about-us',
                        'sort' => 0,
                        'translations' => [
                            ['lang_code' => 'en', 'label' => 'About Us'],
                        ],
                    ],
                    [
                        'link' => '/contact-us',
                        'sort' => 1,
                        'translations' => [
                            ['lang_code' => 'en', 'label' => 'Contact Us'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($menu_list as $menu) {
            $data = new Menu();
            $data->name = $menu['translations'][0]['name'];
            $data->slug = $menu['slug'];

            if ($data->save()) {
                foreach ($menu['translations'] as $translate) {
                    MenuTranslation::create([
                        'menu_id' => $data->id,
                        'lang_code' => $translate['lang_code'],
                        'name' => $translate['name'],
                    ]);
                }

                if (isset($menu['menu_items']) && is_array($menu['menu_items'])) {
                    processMenuItems($menu['menu_items'], $data->id, 0);
                }
            }
        }
    }
}
