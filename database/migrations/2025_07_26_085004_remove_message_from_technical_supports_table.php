<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('technical_supports', function (Blueprint $table) {
        $table->dropColumn('message');
    });
}

public function down()
{
    Schema::table('technical_supports', function (Blueprint $table) {
        $table->text('message')->nullable(); // opsional saat rollback
    });
}

};
