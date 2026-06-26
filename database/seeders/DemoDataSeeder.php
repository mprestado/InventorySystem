<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Setting;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use App\Support\NumberGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // ----- Users for each role -----
        $users = [
            ['Owner', 'owner@houseware.test', 'Owner'],
            ['Manager', 'manager@houseware.test', 'Manager'],
            ['Cashier', 'cashier@houseware.test', 'Cashier'],
            ['Inventory Staff', 'inventory@houseware.test', 'Inventory Staff'],
        ];

        foreach ($users as [$name, $email, $role]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => Hash::make('password'), 'status' => 'active']
            );
            $user->syncRoles([$role]);
        }

        // ----- Settings -----
        Setting::set('shop_name', 'Houseware Shop');
        Setting::set('currency', '₱');
        Setting::set('tax_rate', '12');
        Setting::set('address', '123 Market Street, Manila, Philippines');
        Setting::set('phone', '+63 900 000 0000');

        // ----- Units -----
        $unitData = [['Piece', 'pc'], ['Box', 'box'], ['Set', 'set'], ['Pack', 'pack'], ['Dozen', 'dz']];
        $units = [];
        foreach ($unitData as [$n, $a]) {
            $units[$a] = Unit::firstOrCreate(['name' => $n], ['abbreviation' => $a]);
        }

        // ----- Categories -----
        $categoryNames = [
            'Kitchenware', 'Bathroom', 'Cleaning Supplies', 'Plastic Products',
            'Storage Boxes', 'Home Decor', 'Furniture', 'Lighting', 'Appliances', 'Hardware',
        ];
        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = Category::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name), 'status' => 'active']
            );
        }

        // ----- Brands -----
        $brandNames = ['Lock & Lock', 'Tupperware', 'Orocan', 'Home Basics', 'Generic'];
        $brands = [];
        foreach ($brandNames as $name) {
            $brands[$name] = Brand::firstOrCreate(['name' => $name], ['status' => 'active']);
        }

        // ----- Suppliers -----
        $supplierData = [
            ['Metro Wholesale Trading', 'Juan Dela Cruz', '+63 917 111 2222', 'sales@metrowholesale.test'],
            ['Luzon Houseware Distributors', 'Maria Santos', '+63 918 333 4444', 'orders@luzonhouseware.test'],
            ['Pacific Plastics Inc.', 'Pedro Reyes', '+63 919 555 6666', 'info@pacificplastics.test'],
        ];
        $suppliers = [];
        foreach ($supplierData as [$n, $c, $p, $e]) {
            $suppliers[] = Supplier::firstOrCreate(
                ['name' => $n],
                ['contact_person' => $c, 'phone' => $p, 'email' => $e, 'address' => 'Metro Manila', 'status' => 'active']
            );
        }

        // ----- Customers -----
        $customerData = [
            ['Walk-in Customer', null, null],
            ['Ana Lim', '+63 920 123 4567', 'Quezon City'],
            ['Robert Tan', '+63 921 765 4321', 'Makati City'],
        ];
        foreach ($customerData as [$n, $p, $a]) {
            Customer::firstOrCreate(['name' => $n], ['phone' => $p, 'address' => $a]);
        }

        // ----- Products with variants -----
        $products = [
            [
                'name' => 'Plastic Storage Box', 'category' => 'Storage Boxes', 'brand' => 'Orocan',
                'unit' => 'pc', 'variants' => [
                    ['Small', 120, 199, 40], ['Medium', 180, 299, 30], ['Large', 250, 399, 25],
                ],
            ],
            [
                'name' => 'Non-Stick Frying Pan', 'category' => 'Kitchenware', 'brand' => 'Home Basics',
                'unit' => 'pc', 'variants' => [
                    ['24cm', 320, 549, 15], ['28cm', 420, 699, 12], ['32cm', 520, 849, 8],
                ],
            ],
            [
                'name' => 'Microfiber Cleaning Cloth', 'category' => 'Cleaning Supplies', 'brand' => 'Generic',
                'unit' => 'pack', 'variants' => [
                    ['Pack of 3', 60, 120, 50], ['Pack of 6', 110, 220, 6],
                ],
            ],
            [
                'name' => 'Airtight Food Container', 'category' => 'Kitchenware', 'brand' => 'Lock & Lock',
                'unit' => 'set', 'variants' => [
                    ['500ml', 85, 159, 40], ['1L', 120, 219, 0], ['2L', 160, 289, 18],
                ],
            ],
            [
                'name' => 'LED Desk Lamp', 'category' => 'Lighting', 'brand' => 'Home Basics',
                'unit' => 'pc', 'variants' => [
                    ['White', 380, 649, 20], ['Black', 380, 649, 9],
                ],
            ],
            [
                'name' => 'Bathroom Organizer Rack', 'category' => 'Bathroom', 'brand' => 'Generic',
                'unit' => 'pc', 'variants' => [
                    ['2-Tier', 290, 499, 14], ['3-Tier', 390, 649, 7],
                ],
            ],
            [
                'name' => 'Stainless Steel Dish Rack', 'category' => 'Kitchenware', 'brand' => 'Home Basics',
                'unit' => 'pc', 'variants' => [
                    ['Standard', 450, 799, 11],
                ],
            ],
            [
                'name' => 'Decorative Wall Clock', 'category' => 'Home Decor', 'brand' => 'Generic',
                'unit' => 'pc', 'variants' => [
                    ['Round 30cm', 220, 399, 0], ['Square 25cm', 200, 369, 13],
                ],
            ],
        ];

        foreach ($products as $data) {
            $base = NumberGenerator::sku();
            $product = Product::create([
                'name' => $data['name'],
                'sku' => $base,
                'barcode' => NumberGenerator::barcode(),
                'category_id' => $categories[$data['category']]->id,
                'brand_id' => $brands[$data['brand']]->id,
                'supplier_id' => $suppliers[array_rand($suppliers)]->id,
                'unit_id' => $units[$data['unit']]->id,
                'cost_price' => $data['variants'][0][1],
                'selling_price' => $data['variants'][0][2],
                'description' => 'Quality '.$data['name'].' for everyday household use.',
                'has_variants' => count($data['variants']) > 1,
                'status' => 'active',
            ]);

            foreach ($data['variants'] as $i => [$vname, $cost, $price, $qty]) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'name' => $vname,
                    'sku' => NumberGenerator::variantSku($base, $vname),
                    'barcode' => NumberGenerator::barcode(),
                    'attributes' => ['variant' => $vname],
                    'cost_price' => $cost,
                    'selling_price' => $price,
                    'stock_quantity' => $qty,
                    'reorder_level' => 10,
                    'is_default' => $i === 0,
                    'status' => 'active',
                ]);
            }
        }
    }
}
