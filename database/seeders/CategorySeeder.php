<?php

namespace Database\Seeders;

use App\Models\Category;
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
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $categories = [
            ['name'=>'Design',
             'image'=> env('APP_URL').'/images/categories/c1.jpg',
             'description'=> 'Toutes réalisations visuelles telles que la création de logo, flyers, carte de visite, dessin, peinture ...',
            ],
            ['name'=>'Développement',
             'image'=> env('APP_URL').'/images/categories/c2.jpeg',
             'description'=> 'Toutes réalisations liées aux codes et languages de programmation telles que la réalisation d\'application, site web ...',
            ],

        ];
        //Insert data in the table
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'image' => $category['image'],
                'description' => $category['description'],
            ]);
        }
    }
}
