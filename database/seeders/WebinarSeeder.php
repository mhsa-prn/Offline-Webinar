<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebinarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webinars=[
          ['creator_id'=>19, 'title'=>'وبینار اول', 'description'=>'توضیحات وبینار اول',
              'price'=>'0','video'=>'www.video.com',
              'img'=>'www.img.com','created_at'=>Carbon::now()],
            ['creator_id'=>20, 'title'=>'وبینار دوم', 'description'=>'توضیحات وبینار دوم',
                'price'=>'100000','video'=>'www.video.com',
                'img'=>'www.img.com','created_at'=>Carbon::now()],
            ['creator_id'=>22, 'title'=>'وبینار سوم', 'description'=>'توضیحات وبینار سوم',
                'price'=>'15000','video'=>'www.video.com',
                'img'=>'www.img.com','created_at'=>Carbon::now()]
        ];

        DB::table('webinars')->insert($webinars);
    }
}
