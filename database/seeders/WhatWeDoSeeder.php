<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhatWeDo;

class WhatWeDoSeeder extends Seeder
{
    public function run(): void
    {
        $whatWeDo = WhatWeDo::first() ?? new WhatWeDo();
        $whatWeDo->title = 'WHAT WE DO';
        $whatWeDo->sub_title = 'Our Core Services';
        $whatWeDo->description = 'Collaboratively administrate empowered markets via plug and play networks.';
        $whatWeDo->image = $whatWeDo->image ?? '';

        $works = [
            [
                'title' => 'Construction',
                'icon' => '',
                'detail' => 'We specialize in building durable and innovative infrastructure projects that enhance urban development and connectivity.',
                'link' => '/business',
            ],
            [
                'title' => 'Land Development',
                'icon' => '',
                'detail' => 'Our expertise in land development transforms raw land into sustainable and functional spaces for various uses.',
                'link' => '/business',
            ],
            [
                'title' => 'River Dredging',
                'icon' => '',
                'detail' => 'We provide environmentally responsible river dredging services, ensuring navigational safety and reducing flood risks.',
                'link' => '/business',
            ],
            [
                'title' => 'Electro-Medical Equipment & Medical Furniture Supply',
                'icon' => '',
                'detail' => 'We supply high-quality electro-medical equipment and furniture, supporting healthcare facilities with cutting edge solutions.',
                'link' => '/business',
            ],
            [
                'title' => 'Import & Export',
                'icon' => '',
                'detail' => 'Facilitating global trade, we import and export a diverse range of goods, fostering international business and economic growth.',
                'link' => '/business',
            ],
            [
                'title' => 'Trading',
                'icon' => '',
                'detail' => 'Our trading division offers a broad spectrum of products, ensuring quality, reliability, and timely delivery to meet market demands.',
                'link' => '/business',
            ],
        ];

        $whatWeDo->works = json_encode($works);
        $whatWeDo->save();
    }
}
