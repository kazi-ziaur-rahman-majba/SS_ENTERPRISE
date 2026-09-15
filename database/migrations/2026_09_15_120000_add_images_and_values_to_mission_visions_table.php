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
        Schema::table('mission_visions', function (Blueprint $table) {
            $table->string('mission_image')->nullable()->after('mission_details');
            $table->string('vision_image')->nullable()->after('vision_details');
            $table->string('core_values_image')->nullable()->after('core_values_details');
            $table->json('core_values_items')->nullable()->after('core_values_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mission_visions', function (Blueprint $table) {
            $table->dropColumn([
                'mission_image',
                'vision_image',
                'core_values_image',
                'core_values_items',
            ]);
        });
    }
};
