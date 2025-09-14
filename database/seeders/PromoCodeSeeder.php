<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromoCode;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing promo codes
        PromoCode::truncate();
        
        // Create the two required promo codes
        PromoCode::create([
            'code' => 'FREE100',
            'discount_percentage' => 100.00,
            'status' => true,
            'description' => 'Free consultation - 100% discount',
            'expires_at' => null, // No expiration
            'usage_limit' => null, // No usage limit
            'used_count' => 0,
        ]);
        
        PromoCode::create([
            'code' => 'HALF50',
            'discount_percentage' => 50.00,
            'status' => true,
            'description' => 'Half price consultation - 50% discount',
            'expires_at' => null, // No expiration
            'usage_limit' => null, // No usage limit
            'used_count' => 0,
        ]);
        
        $this->command->info('Promo codes seeded successfully!');
        $this->command->info('FREE100 - 100% off (Free consultation)');
        $this->command->info('HALF50 - 50% off (Half price consultation)');
    }
}
