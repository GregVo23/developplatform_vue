<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
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
        SubCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        //Define data
        $subCategories = [
            ['name'=>'Réalisation de flyer',
             'image'=> env('APP_URL').'/images/subcategories/s1.jpg',
             'category_id' => 1,
             'description'=> 'Toutes réalisations visuelles de flyers d\'invitation, publicitaire, et autres destinés à l\'impresion.',
            ],  
            ['name'=>'Carte de visite',
             'image'=> env('APP_URL').'/images/subcategories/s2.jpg',
             'category_id' => 1,
             'description'=> 'Toutes réalisations de carte de visite, en différent format tel que paysage ou portrait.',
            ],  
            ['name'=>'Création de logo',
             'image'=> env('APP_URL').'/images/subcategories/s3.jpg',
             'category_id' => 1,
             'description'=> 'Réalisation de logo pour une enseigne, un pictogramme spécifique, un dessin vectoriel simple...',
            ],  
            ['name'=>'Bannière web',
             'image'=> env('APP_URL').'/images/subcategories/s4.jpg',
             'category_id' => 1,
             'description'=> 'Bannières destinées à un usage sur internet que ce soit sur des réseaux sociaux ou autres publicité.',
            ],  
            ['name'=>'Template site web',
             'image'=> env('APP_URL').'/images/subcategories/s5.jpg',
             'category_id' => 1,
             'description'=> 'L\'aspect visuel d\'un site web sous forme d\'image, que ce soit une page ou un élément de page.',
            ],  
            ['name'=>'Peinture et dessin',
             'image'=> env('APP_URL').'/images/subcategories/s6.jpg',
             'category_id' => 1,
             'description'=> 'Peintures en tout genre comme l\'aquarelle, la peinture à l\'huile et autres dessins réalisés au crayon, pastel... ',
            ],  
            ['name'=>'Vidéo',
             'image'=> env('APP_URL').'/images/subcategories/s7.jpg',
             'category_id' => 1,
             'description'=> 'Toutes réalisations de vidéos, que ce soit sous forme de film ou de dessin animé.',
            ],  
            ['name'=>'Application software',
             'image'=> env('APP_URL').'/images/subcategories/s8.jpg',
             'category_id' => 2,
             'description'=> 'Développement sur mesure de software compatible Linux, Windows...',
            ],  
            ['name'=>'Application mobile',
             'image'=> env('APP_URL').'/images/subcategories/s9.jpg',
             'category_id' => 2,
             'description'=> 'Toutes applications destinées à un usage sur mobile notament Android et Iphone.',
            ],  
            ['name'=>'Site web',
             'image'=> env('APP_URL').'/images/subcategories/s10.jpg',
             'category_id' => 2,
             'description'=> 'Réalisation de site web, vitrine ou e-commerce, via un CMS ou un framework ...',
            ],  
            ['name'=>'Correction de code',
             'image'=> env('APP_URL').'/images/subcategories/s11.jpg',
             'category_id' => 2,
             'description'=> 'Toutes corrections de code déjà implémentés et nécessitant diverses retouches ou corrections.',
            ],  
            ['name'=>'Référencement web',
             'image'=> env('APP_URL').'/images/subcategories/s12.jpg',
             'category_id' => 2,
             'description'=> 'Audit et conseils en vue d\'un meilleur référencement sur les moteurs de recherches.',
            ], 
        ];
        //Insert data in the table
        foreach ($subCategories as $subCategory) {     
            DB::table('sub_categories')->insert([
                'name' => $subCategory['name'],
                'image' => $subCategory['image'],
                'description' => $subCategory['description'],
                'category_id' => $subCategory['category_id'],
            ]);
        }
    }
}
