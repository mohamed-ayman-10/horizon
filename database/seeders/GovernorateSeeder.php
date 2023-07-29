<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('governorates')->delete();

        $data = [
            ['title' => ['en' => 'Cairo', 'ar' => 'القاهرة']],
            ['title' => ['en' => 'Giza', 'ar' => 'الجيزة']],
            ['title' => ['en' => 'Alexandria', 'ar' => 'الإسكندرية']],
            ['title' => ['en' => 'Beheira', 'ar' => 'البحيرة']],
            ['title' => ['en' => 'Kafr El Sheikh', 'ar' => 'كفر الشيخ']],
            ['title' => ['en' => 'Dakahlia', 'ar' => 'الدقهلية']],
            ['title' => ['en' => 'Sharqia', 'ar' => 'الشرقية']],
            ['title' => ['en' => 'Port Said', 'ar' => 'بورسعيد']],
            ['title' => ['en' => 'Ismailia', 'ar' => 'الإسماعيلية']],
            ['title' => ['en' => 'Suez', 'ar' => 'السويس']],
            ['title' => ['en' => 'Damietta', 'ar' => 'دمياط']],
            ['title' => ['en' => 'Gharbia', 'ar' => 'الغربية']],
            ['title' => ['en' => 'Monufia', 'ar' => 'المنوفية']],
            ['title' => ['en' => 'Sharkia', 'ar' => 'الشرقية']],
            ['title' => ['en' => 'Beni Suef', 'ar' => 'بني سويف']],
            ['title' => ['en' => 'Faiyum', 'ar' => 'الفيوم']],
            ['title' => ['en' => 'Minya', 'ar' => 'المنيا']],
            ['title' => ['en' => 'Assiut', 'ar' => 'أسيوط']],
            ['title' => ['en' => 'Sohag', 'ar' => 'سوهاج']],
            ['title' => ['en' => 'Qena', 'ar' => 'قنا']],
            ['title' => ['en' => 'Luxor', 'ar' => 'الأقصر']],
            ['title' => ['en' => 'Aswan', 'ar' => 'أسوان']],
            ['title' => ['en' => 'Red Sea', 'ar' => 'البحر الأحمر']],
            ['title' => ['en' => 'New Valley', 'ar' => 'الوادي الجديد']],
            ['title' => ['en' => 'Matrouh', 'ar' => 'مطروح']],
            ['title' => ['en' => 'North Sinai', 'ar' => 'شمال سيناء']],
            ['title' => ['en' => 'South Sinai', 'ar' => 'جنوب سيناء']],
        ];

        foreach ($data as $data) {
            Governorate::query()->create($data);
        }
    }
}
