<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_names = [
            "ACER NITRO 5 2020 GAMING LAPTOP / I5-10300H / GTX 1650 / 8GB RAM",
            "DELL INSPIRON 3501 LAPTOP | I5 11TH GEN 8 GB 256 GB SSD WIN 10 G",
            "ACER SWIFT 3 AMD RYZEN 5 8GB RAM 256GB SSD 14″ FHD DISPLAY",
            "Dell Vostro 3500 I5 11th Gen / 4GB RAM / 1TB HDD / 15.6 FHD Dis",
            "Dell Vostro 3500 I7 11th Gen / 8GB RAM / 512GB SSD / Nvidia MX33",
            "Dell Inspiron 7391 I5 10th Gen / 8GB RAM / 256GB SSD / 13.3'' FH",
            "Dell Inspiron 7300 2-In-1 I5 10th Gen / 8GB RAM / 512GB SSD / 13",
            "Anker PowerLine Micro USB (3ft)",
            "Soundcore Earbuds Q20",
            "Anker Soundcore Spirit X2"
        ];

        for($i=0; $i<500; $i++){
            DB::table('products')->insert([
                'name' => $product_names[array_rand($product_names)]." ".Str::random(5),
                'slug' => Str::random(10),
                'product_code' => Str::random(7),
                'product_images' => random_int(1, 40).'.jpg',
                'short_description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'description' => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from de Finibus Bonorum et Malorum by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.",
                'stock' => random_int(500, 6000),
                'original_price' => random_int(1500, 50000),
                'discount' => false,
                'category_id' => random_int(0, 10),
                'brand_id' => random_int(0, 10),
                'status' => true,
                'is_featured' => true,
            ]);
        }
    }
}
