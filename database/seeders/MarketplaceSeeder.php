<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\ShippingMethod;
use App\Models\User;
use App\Models\SellerProfile;
use App\Models\Product;
use App\Models\ProductImage;

class MarketplaceSeeder extends Seeder
{
    public function run(): void
    {
        // tambah kategori
        $kategori = ['Buket Bunga', 'Hampers', 'Rose', 'Wedding Flower', 'Dekorasi'];
        foreach ($kategori as $k) {
            Category::create([
                'name' => $k,
                'slug' => strtolower(str_replace(' ', '-', $k))
            ]);
        }

        // shipping method
        ShippingMethod::insert([
            ['name' => 'Instant Courier', 'cost' => 20000],
            ['name' => 'Same Day Delivery', 'cost' => 15000],
            ['name' => 'Regular Delivery', 'cost' => 8000],
        ]);

        // seller dummy
        $seller = User::factory()->create([
            'name' => 'Toko Bunga Mawar Indah',
            'email' => 'seller@demo.com',
            'role' => 'seller'
        ]);

        SellerProfile::create([
            'user_id' => $seller->id,
            'shop_name' => 'Florist Demo',
            'phone' => '08123456789',
            'address' => 'Jalan Melati No. 99, Bandung'
        ]);

        // produk dummy
        $produk = Product::create([
            'seller_id' => $seller->id,
            'category_id' => 1,
            'title' => 'Buket Mawar Merah Premium',
            'slug' => 'buket-mawar-merah-premium',
            'description' => 'Buket mawar cantik untuk hadiah.',
            'price' => 150000,
            'stock' => 20
        ]);

        ProductImage::create([
            'product_id' => $produk->id,
            'url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93'
        ]);
    }
}
