<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\CustomField;
use App\Models\CustomFieldCategory;
use App\Models\CustomFieldsTranslation;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Seeds a vehicle hierarchy (brands → model lines) and optional dropdown custom fields
 * on the seeded "Cars" category so listings inherit them via parent category lookup.
 *
 * Usage:
 *   php artisan db:seed --class=VehicleCatalogSeeder
 *
 * Optional .env:
 *   VEHICLE_SEED_PARENT_SLUG=autos   Prefer this slug when attaching (must exist unless seeder creates root below).
 *   If unset or slug not found, tries "autos" next, then creates slug "autos" only when no candidate exists.
 */
class VehicleCatalogSeeder extends Seeder
{
    private const PLACEHOLDER_STORAGE_PATH = 'category/seed-vehicle-placeholder.png';

    private const SEED_ROOT_SLUG = 'autos';

    private const SEED_CARS_SLUG = 'autos-cars';

    /** @var array<string, list<string>> */
    private const BRANDS = [
        'BMW' => ['1 Series', '3 Series', '5 Series', '7 Series', 'X1', 'X3', 'X5', 'X6'],
        'Audi' => ['A1', 'A3', 'A4', 'A6', 'A8', 'Q3', 'Q5', 'Q7'],
        'Mercedes-Benz' => ['A-Class', 'C-Class', 'E-Class', 'S-Class', 'GLA', 'GLC', 'GLE', 'GLS'],
        'Volkswagen' => ['Polo', 'Golf', 'Passat', 'Tiguan', 'Touareg'],
    ];

    public function run(): void
    {
        $this->ensurePlaceholderImage();

        $root = $this->resolveVehicleCatalogRootCategory();
        if (! $root) {
            $this->command?->error('Could not resolve or create a parent category for the vehicle catalog.');

            return;
        }

        $cars = Category::firstOrCreate(
            ['slug' => self::SEED_CARS_SLUG],
            [
                'name' => 'Cars',
                'image' => self::PLACEHOLDER_STORAGE_PATH,
                'parent_category_id' => $root->id,
                'description' => 'Seeded passenger cars',
                'status' => 1,
                'is_job_category' => 0,
                'price_optional' => 0,
                'is_featured' => 0,
            ]
        );
        $this->syncCategoryTranslations($cars, 'Cars');

        foreach (self::BRANDS as $brandName => $models) {
            $brandSlug = 'km-vc-brand-'.Str::slug($brandName);
            $brand = Category::firstOrCreate(
                ['slug' => $brandSlug],
                [
                    'name' => $brandName,
                    'image' => self::PLACEHOLDER_STORAGE_PATH,
                    'parent_category_id' => $cars->id,
                    'description' => null,
                    'status' => 1,
                    'is_job_category' => 0,
                    'price_optional' => 0,
                    'is_featured' => 0,
                ]
            );
            $this->syncCategoryTranslations($brand, $brandName);

            foreach ($models as $modelName) {
                $modelSlug = 'km-vc-model-'.Str::slug($brandName).'-'.Str::slug($modelName);
                $model = Category::firstOrCreate(
                    ['slug' => $modelSlug],
                    [
                        'name' => $modelName,
                        'image' => self::PLACEHOLDER_STORAGE_PATH,
                        'parent_category_id' => $brand->id,
                        'description' => null,
                        'status' => 1,
                        'is_job_category' => 0,
                        'price_optional' => 0,
                        'is_featured' => 0,
                    ]
                );
                $this->syncCategoryTranslations($model, $modelName);
            }
        }

        $this->seedVehicleCustomFields($cars->id);

        $this->command?->info('Vehicle catalog seeded under category ID '.$cars->id.' (slug: '.self::SEED_CARS_SLUG.').');
    }

    /**
     * Use existing category (env slug, then "autos") or create root {@see SEED_ROOT_SLUG}.
     * Stops failing when e.g. VEHICLE_SEED_PARENT_SLUG=vehicle but the site only has "autos".
     */
    private function resolveVehicleCatalogRootCategory(): ?Category
    {
        $candidates = array_values(array_unique(array_filter([
            trim((string) env('VEHICLE_SEED_PARENT_SLUG', '')),
            self::SEED_ROOT_SLUG,
        ], fn ($v) => $v !== '')));

        foreach ($candidates as $slug) {
            $found = Category::where('slug', $slug)->first();
            if ($found) {
                $this->command?->info("Vehicle catalog: attaching under existing category \"{$slug}\" (id {$found->id}).");

                return $found;
            }
        }

        $root = Category::firstOrCreate(
            ['slug' => self::SEED_ROOT_SLUG],
            [
                'name' => 'Vehicles (catalog)',
                'image' => self::PLACEHOLDER_STORAGE_PATH,
                'parent_category_id' => null,
                'description' => 'Seeded vehicle catalog root',
                'status' => 1,
                'is_job_category' => 0,
                'price_optional' => 0,
                'is_featured' => 0,
            ]
        );

        if ($root->wasRecentlyCreated) {
            $this->syncCategoryTranslations($root, 'Vehicles (catalog)');
            $this->command?->info('Vehicle catalog: created root category "'.self::SEED_ROOT_SLUG.'".');
        }

        return $root;
    }

    private function ensurePlaceholderImage(): void
    {
        $fullPath = storage_path('app/public/'.self::PLACEHOLDER_STORAGE_PATH);
        if (File::exists($fullPath)) {
            return;
        }
        File::ensureDirectoryExists(dirname($fullPath));
        $source = public_path('assets/images/logo/placeholder.png');
        if (! File::exists($source)) {
            throw new \RuntimeException('Missing public placeholder at: '.$source);
        }
        File::copy($source, $fullPath);
    }

    private function syncCategoryTranslations(Category $category, string $defaultName): void
    {
        foreach (Language::query()->get(['id', 'code']) as $language) {
            CategoryTranslation::updateOrCreate(
                [
                    'category_id' => $category->id,
                    'language_id' => $language->id,
                ],
                [
                    'name' => $defaultName,
                    'description' => null,
                ]
            );
        }
    }

    private function seedVehicleCustomFields(int $carsCategoryId): void
    {
        $image = self::PLACEHOLDER_STORAGE_PATH;

        $definitions = [
            [
                'name' => 'km_vc_condition',
                'label' => 'Condition',
                'type' => 'dropdown',
                'required' => 1,
                'values' => ['new', 'used', 'certified_pre_owned', 'for_parts'],
                'labels' => ['New', 'Used', 'Certified pre-owned', 'For parts / repair'],
            ],
            [
                'name' => 'km_vc_fuel',
                'label' => 'Fuel type',
                'type' => 'dropdown',
                'required' => 1,
                'values' => ['petrol', 'diesel', 'electric', 'hybrid', 'plugin_hybrid', 'lpg_cng'],
                'labels' => ['Petrol', 'Diesel', 'Electric', 'Hybrid', 'Plug-in hybrid', 'LPG / CNG'],
            ],
            [
                'name' => 'km_vc_transmission',
                'label' => 'Transmission',
                'type' => 'dropdown',
                'required' => 1,
                'values' => ['manual', 'automatic', 'cvt'],
                'labels' => ['Manual', 'Automatic', 'CVT'],
            ],
            [
                'name' => 'km_vc_body_type',
                'label' => 'Body type',
                'type' => 'dropdown',
                'required' => 0,
                'values' => ['sedan', 'suv', 'coupe', 'wagon', 'convertible', 'van', 'pickup', 'hatchback'],
                'labels' => ['Sedan', 'SUV', 'Coupe', 'Wagon / Estate', 'Convertible', 'Van', 'Pickup', 'Hatchback'],
            ],
            [
                'name' => 'km_vc_year',
                'label' => 'Model year',
                'type' => 'dropdown',
                'required' => 0,
                'values' => array_map('strval', range((int) date('Y'), 1990, -1)),
                'labels' => array_map('strval', range((int) date('Y'), 1990, -1)),
            ],
        ];

        foreach ($definitions as $def) {
            $field = CustomField::updateOrCreate(
                ['name' => $def['name']],
                [
                    'type' => $def['type'],
                    'image' => $image,
                    'required' => $def['required'],
                    'status' => 1,
                    'values' => json_encode(array_values($def['values']), JSON_THROW_ON_ERROR),
                    'min_length' => null,
                    'max_length' => null,
                ]
            );

            CustomFieldCategory::firstOrCreate([
                'category_id' => $carsCategoryId,
                'custom_field_id' => $field->id,
            ]);

            foreach (Language::query()->get(['id']) as $language) {
                $translatedLabels = $def['labels'];
                CustomFieldsTranslation::updateOrCreate(
                    [
                        'custom_field_id' => $field->id,
                        'language_id' => $language->id,
                    ],
                    [
                        'name' => $def['label'],
                        'value' => json_encode(array_values($translatedLabels), JSON_THROW_ON_ERROR),
                    ]
                );
            }
        }
    }
}
