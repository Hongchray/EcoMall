<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE `products` MODIFY `unit_price` DOUBLE(20,2) NOT NULL');
        DB::statement('ALTER TABLE `products` MODIFY `purchase_price` DOUBLE(20,2) DEFAULT NULL');
        DB::statement('ALTER TABLE `product_stocks` MODIFY `price` DOUBLE(20,2) NOT NULL DEFAULT 0.00');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE `products` MODIFY `unit_price` DOUBLE(20,3) NOT NULL');
        DB::statement('ALTER TABLE `products` MODIFY `purchase_price` DOUBLE(20,3) DEFAULT NULL');
        DB::statement('ALTER TABLE `product_stocks` MODIFY `price` DOUBLE(20,3) NOT NULL DEFAULT 0.000');
    }
};
