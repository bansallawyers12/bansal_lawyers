<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $rows = [
            [
                'title' => 'Half Off',
                'code' => 'HALF50',
                'discount_percentage' => 50,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Free Appointment',
                'code' => 'FREE100',
                'discount_percentage' => 100,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($rows as $row) {
            $exists = DB::table('promo_codes')->where('code', $row['code'])->exists();
            if (!$exists) {
                DB::table('promo_codes')->insert($row);
            }
        }
    }
}


