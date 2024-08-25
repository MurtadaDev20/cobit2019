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
        Schema::table('sub_proccesses', function (Blueprint $table) {
            $table->foreignId('mainp_id')->after('desc')->nullable()->constrained('main_proccesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_proccesses', function (Blueprint $table) {
            $table->dropForeign(['mainp_id']);
            $table->dropColumn('mainp_id');
        });
    }
};
