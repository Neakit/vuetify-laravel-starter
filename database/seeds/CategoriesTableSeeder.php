<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Подгруппа продукта',
                'description' => 'Подгруппа продукта (описание)',
                'created_at' => new DateTime,
                'updated_at' => null,
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
