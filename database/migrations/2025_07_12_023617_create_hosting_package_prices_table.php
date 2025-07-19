<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hosting_package_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hosting_package_id')->constrained()->onDelete('cascade');
            $table->integer('duration_months'); // Contoh: 6, 12, 24
            $table->decimal('original_price', 12, 2);
            $table->decimal('discounted_price', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosting_package_prices');
    }
};
