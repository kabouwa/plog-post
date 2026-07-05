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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image_path')->after('description')->default("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnZ4O3VpT6KLEor7p9qOhECRton0f4jcewKQCOfzFU6Dmk6Vnvk7X7Xec&s=10");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
