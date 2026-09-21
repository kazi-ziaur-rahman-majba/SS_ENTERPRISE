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
        Schema::table('service_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('service_categories', 'position')) {
                $table->integer('position')->nullable()->default(0)->after('short_description');
            }
            $table->text('short_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            if (Schema::hasColumn('service_categories', 'position')) {
                $table->dropColumn('position');
            }
            $table->string('short_description', 191)->nullable()->change();
        });
    }
};
