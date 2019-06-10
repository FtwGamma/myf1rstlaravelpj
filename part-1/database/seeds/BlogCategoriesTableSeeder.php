<?php

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $cName = "Без котегории";
        $categories[] = [
            'title' => $cName,
            'slug' => Str::slug($cName),
            'parent_id' => 0,
        ];

        for($i=2; $i <=11; $i++){
            $cName = 'Категория #'.$i;
            $parentId = ($i > 5) ? rand(2,5) : 2;

            $categories[]= [
                'title' => $cName,
                'slug' => Str::slug($cName),
                'parent_id' => $parentId,
            ];
        }
        \DB::table('blog_categories')->insert($categories);
    }
}