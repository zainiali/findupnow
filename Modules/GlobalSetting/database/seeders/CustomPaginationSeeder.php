<?php

namespace Modules\GlobalSetting\database\seeders;

use Illuminate\Database\Seeder;
use Modules\GlobalSetting\app\Models\CustomPagination;

class CustomPaginationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item3 = new CustomPagination();
        $item3->section_name = 'Language List';
        $item3->item_qty = 10;
        $item3->save();
    }
}
