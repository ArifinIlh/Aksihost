<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('hosting_package_prices', function (Blueprint $table) {
        $table->integer('duration_days')->after('hosting_package_id');
        $table->dropColumn('duration_months');
    });
}

public function down(): void
{
    Schema::table('hosting_package_prices', function (Blueprint $table) {
        $table->integer('duration_months')->after('hosting_package_id');
        $table->dropColumn('duration_days');
    });
}
};
