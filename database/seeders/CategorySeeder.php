<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
        ['name'=>'دسته بندی اول' , 'parent_id'=>null],
        ['name'=>'دسته بندی دوم' , 'parent_id'=>null],
        ['name'=>'دسته بندی سوم' , 'parent_id'=>null],
        ['name'=>'زیر دسته اول' , 'parent_id'=>1],
        ['name'=>'زیر دسته دوم' , 'parent_id'=>2],
        ['name'=>'زیر دسته سوم' , 'parent_id'=>3],
        ];
        DB::table('categories')->insert($categories);
    }
}
