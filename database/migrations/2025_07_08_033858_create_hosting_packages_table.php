<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hosting_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('disk_space');
            $table->string('bandwidth');
            $table->integer('email_accounts');
            $table->integer('databases');
            $table->decimal('price_monthly', 12, 2)->nullable(); 
            $table->decimal('price_yearly', 12, 2)->nullable();              
            $table->decimal('promo_price', 12, 2)->nullable();

            
            $table->boolean('has_ssl')->default(false);
            $table->boolean('has_backup')->default(false);
            $table->boolean('has_wordpress')->default(false);

            
            $table->string('feature_1')->nullable();
            $table->string('feature_2')->nullable();
            $table->string('feature_3')->nullable();
            $table->string('feature_4')->nullable();
            $table->string('feature_5')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hosting_packages');
    }
};
