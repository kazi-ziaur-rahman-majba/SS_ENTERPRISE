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
        Schema::table('what_we_dos', function (Blueprint $table) {
            if (!Schema::hasColumn('what_we_dos', 'description')) {
                $table->text('description')->nullable()->after('sub_title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('what_we_dos', function (Blueprint $table) {
            if (Schema::hasColumn('what_we_dos', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
