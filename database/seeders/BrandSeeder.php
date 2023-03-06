<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
            [
                'id'               => 1,
                'name'             => 'Apple',
                'slug'             => Str::slug('Apple'),
                'description'      => 'Apple is a Japanese multinational consumer electronics and commercial electronics manufacturing company headquartered in Shibuya, Tokyo, Japan. Its products include calculators, mobile phones, digital cameras, electronic musical instruments, analogue and digital watches, and other electronic products.',
                'image'            => 'Apple.png',
                'meta_title'       => Str::limit('Apple', 60),
                'meta_description' => Str::limit('Apple is a Japanese multinational consumer electronics and commercial electronics manufacturing company headquartered in Shibuya, Tokyo, Japan. Its products include calculators, mobile phones, digital cameras, electronic musical instruments, analogue and digital watches, and other electronic products.', 160),
            ],
            [
                'id'               => 2,
                'name'             => 'Samsung',
                'slug'             => Str::slug('Samsung'),
                'description'      => 'Samsung is a Swiss watchmaker based in Biel/Bienne that designs, manufactures, distributes, and sells finished watches, watch movements, and watch-related products. The company is a subsidiary of the Samsung Group, the world’s largest watchmaker.',
                'image'            => 'Samsung.png',
                'meta_title'       => Str::limit('Samsung', 60),
                'meta_description' => Str::limit('Samsung is a Swiss watchmaker based in Biel/Bienne that designs, manufactures, distributes, and sells finished watches, watch movements, and watch-related products. The company is a subsidiary of the Swatch Group, the world’s largest watchmaker.', 160),
            ],
            [
                'id'               => 3,
                'name'             => 'Xiaomi',
                'slug'             => Str::slug('Xiaomi'),
                'description'      => 'Xiaomi Corporation is a Chinese electronics company headquartered in Beijing. Xiaomi makes and invests in smartphones, mobile apps, laptops, bags, earphones, shoes, fitness bands, and many other products.',
                'image'            => 'Xiaomi.png',
                'meta_title'       => Str::limit('Xiaomi', 60),
                'meta_description' => Str::limit('Xiaomi Corporation is a Chinese electronics company headquartered in Beijing. Xiaomi makes and invests in smartphones, mobile apps, laptops, bags, earphones, shoes, fitness bands, and many other products.', 160),
            ],

            [
                'id'               => 4,
                'name'             => 'Oppo',
                'slug'             => Str::slug('Oppo'),
                'description'      => 'Oppo is a Japanese watchmaker founded in 1881. It is one of the largest and most famous watchmakers in the world. Oppo is a subsidiary of the Oppo Holdings Corporation, which is owned by the parent company, the Oppo Group.',
                'image'            => 'Oppo.png',
                'meta_title'       => Str::limit('Oppo', 60),
                'meta_description' => Str::limit('Oppo is a Japanese watchmaker founded in 1881. It is one of the largest and most famous watchmakers in the world. Seiko is a subsidiary of the Seiko Holdings Corporation, which is owned by the parent company, the Seiko Group.', 160),
            ],
        ]);
    }
}
