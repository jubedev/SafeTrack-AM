<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $demo = Company::query()->where('nit', '901234567-8')->firstOrFail();
        $andina = Company::query()->where('nit', '800987654-1')->firstOrFail();

        $demoCategories = Category::query()
            ->where('company_id', $demo->getKey())
            ->get()
            ->keyBy('name');

        $andinaLaptops = Category::query()
            ->where('company_id', $andina->getKey())
            ->where('name', 'Laptops')
            ->firstOrFail();

        $assets = [
            [
                'company_id' => $demo->getKey(),
                'category_id' => $demoCategories['Laptops']->getKey(),
                'asset_tag' => 'AST-10001',
                'name' => 'ThinkPad L14',
                'brand' => 'Lenovo',
                'model' => 'L14 Gen 3',
                'serial_number' => 'SN-L14-10001',
                'status' => 'asignado',
                'location' => 'Operaciones - Mesa 4',
                'specifications' => [
                    'processor' => 'Intel Core i5 12th Gen',
                    'ram' => '16GB DDR4',
                    'storage' => '512GB SSD NVMe',
                ],
                'purchase_date' => '2024-03-15',
                'warranty_expiration' => '2027-03-15',
                'cost' => 2850000,
            ],
            [
                'company_id' => $demo->getKey(),
                'category_id' => $demoCategories['Monitores']->getKey(),
                'asset_tag' => 'AST-10002',
                'name' => 'Monitor LG 24"',
                'brand' => 'LG',
                'model' => '24MK430H',
                'serial_number' => 'SN-LG-10002',
                'status' => 'asignado',
                'location' => 'Mercado Libre / PUESTO-012',
                'specifications' => [
                    'size' => '24 pulgadas',
                    'resolution' => '1920x1080',
                ],
                'purchase_date' => '2024-06-01',
                'warranty_expiration' => '2026-06-01',
                'cost' => 620000,
            ],
            [
                'company_id' => $demo->getKey(),
                'category_id' => $demoCategories['Laptops']->getKey(),
                'asset_tag' => 'AST-10003',
                'name' => 'HP EliteBook 840',
                'brand' => 'HP',
                'model' => '840 G8',
                'serial_number' => 'SN-HP-10003',
                'status' => 'disponible',
                'location' => 'Bodega Principal',
                'specifications' => [
                    'processor' => 'Intel Core i7 11th Gen',
                    'ram' => '16GB DDR4',
                    'storage' => '512GB SSD NVMe',
                ],
                'purchase_date' => '2023-11-20',
                'warranty_expiration' => '2026-11-20',
                'cost' => 3100000,
            ],
            [
                'company_id' => $demo->getKey(),
                'category_id' => $demoCategories['Laptops']->getKey(),
                'asset_tag' => 'AST-10004',
                'name' => 'Dell Latitude 5420',
                'brand' => 'Dell',
                'model' => '5420',
                'serial_number' => 'SN-DELL-10004',
                'status' => 'en_mantenimiento',
                'location' => 'Taller TI',
                'specifications' => [
                    'processor' => 'Intel Core i5 11th Gen',
                    'ram' => '8GB DDR4',
                    'storage' => '256GB SSD',
                ],
                'purchase_date' => '2023-08-10',
                'warranty_expiration' => '2026-08-10',
                'cost' => 2450000,
            ],
            [
                'company_id' => $demo->getKey(),
                'category_id' => $demoCategories['Periféricos']->getKey(),
                'asset_tag' => 'AST-10005',
                'name' => 'Teclado Logitech K120',
                'brand' => 'Logitech',
                'model' => 'K120',
                'serial_number' => 'SN-LOG-10005',
                'status' => 'disponible',
                'location' => 'Bodega Principal',
                'specifications' => [
                    'connectivity' => 'USB',
                    'layout' => 'ES',
                ],
                'purchase_date' => '2025-01-12',
                'warranty_expiration' => '2026-01-12',
                'cost' => 85000,
            ],
            [
                'company_id' => $andina->getKey(),
                'category_id' => $andinaLaptops->getKey(),
                'asset_tag' => 'AST-20001',
                'name' => 'ThinkPad E14',
                'brand' => 'Lenovo',
                'model' => 'E14 Gen 4',
                'serial_number' => 'SN-AND-20001',
                'status' => 'disponible',
                'location' => 'Bodega Principal',
                'specifications' => [
                    'processor' => 'AMD Ryzen 5 PRO',
                    'ram' => '16GB DDR4',
                    'storage' => '512GB SSD NVMe',
                ],
                'purchase_date' => '2024-09-01',
                'warranty_expiration' => '2027-09-01',
                'cost' => 2680000,
            ],
        ];

        foreach ($assets as $asset) {
            Asset::query()->firstOrCreate(
                [
                    'company_id' => $asset['company_id'],
                    'asset_tag' => $asset['asset_tag'],
                ],
                $asset
            );
        }
    }
}
