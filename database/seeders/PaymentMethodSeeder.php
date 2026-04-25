<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'name' => 'Transfer BCA',
                'type' => 'bank',
                'description' => 'Transfer ke rekening BCA kami',
                'account_number' => '1234567890',
                'account_holder' => 'PT Toko E-Book',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Transfer BRI',
                'type' => 'bank',
                'description' => 'Transfer ke rekening BRI kami',
                'account_number' => '0987654321',
                'account_holder' => 'PT Toko E-Book',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'OVO',
                'type' => 'e-wallet',
                'description' => 'Pembayaran melalui aplikasi OVO',
                'account_number' => '081234567890',
                'account_holder' => 'Toko E-Book',
                'fee_percentage' => 2.5,
                'fee_fixed' => 0,
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'name' => 'DANA',
                'type' => 'e-wallet',
                'description' => 'Pembayaran melalui aplikasi DANA',
                'account_number' => '081234567890',
                'account_holder' => 'Toko E-Book',
                'fee_percentage' => 2,
                'fee_fixed' => 0,
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'name' => 'GCash',
                'type' => 'e-wallet',
                'description' => 'Pembayaran melalui GCash (Filipina)',
                'account_number' => '+63XXXXXXXXXX',
                'account_holder' => 'Toko E-Book',
                'fee_percentage' => 2,
                'fee_fixed' => 0,
                'is_active' => false,
                'display_order' => 5,
            ],
            [
                'name' => 'Bayar di Tempat',
                'type' => 'cash',
                'description' => 'Pembayaran tunai saat pengambilan',
                'fee_percentage' => 0,
                'fee_fixed' => 0,
                'is_active' => false,
                'display_order' => 6,
            ],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}
