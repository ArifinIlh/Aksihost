<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // relasi ke orders
            $table->string('product_type'); // misalnya: domain, hosting, dll
            $table->string('product_name'); // misalnya: ipinweb.com
            $table->integer('price');  
            $table->enum('status', ['unpaid', 'paid', 'active', 'inactive', 'pending'])->default('unpaid');
            $table->text('meta')->nullable(); // info tambahan seperti extension_id, masa aktif, dll
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
