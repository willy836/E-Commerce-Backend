<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        // Seed data
        DB::table('product_categories')->insert([
            ['name' => 'Phones', 'slug' => 'phones', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Computers', 'slug' => 'computers', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TVs', 'slug' => 'tvs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Appliances', 'slug' => 'appliances', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fashion', 'slug' => 'fashion', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
