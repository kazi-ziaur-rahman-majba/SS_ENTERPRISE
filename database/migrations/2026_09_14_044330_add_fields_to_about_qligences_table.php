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
        Schema::table('about_qligences', function (Blueprint $table) {
            $table->string('sub_title')->nullable();
            $table->string('check_1')->nullable();
            $table->string('check_2')->nullable();
            $table->string('check_3')->nullable();
            $table->string('check_4')->nullable();
            $table->string('check_5')->nullable();
            $table->string('check_6')->nullable();
            $table->string('experience_years')->nullable()->default('27+');
            $table->string('experience_label')->nullable()->default('Years of Experience');
            $table->string('expertise_title_three')->nullable();
            $table->text('expertise_detail_three')->nullable();
            $table->string('safety_title_one')->nullable();
            $table->text('safety_detail_one')->nullable();
            $table->string('safety_title_two')->nullable();
            $table->text('safety_detail_two')->nullable();
            $table->string('safety_title_three')->nullable();
            $table->text('safety_detail_three')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_qligences', function (Blueprint $table) {
            $table->dropColumn([
                'sub_title',
                'check_1',
                'check_2',
                'check_3',
                'check_4',
                'check_5',
                'check_6',
                'experience_years',
                'experience_label',
                'expertise_title_three',
                'expertise_detail_three',
                'safety_title_one',
                'safety_detail_one',
                'safety_title_two',
                'safety_detail_two',
                'safety_title_three',
                'safety_detail_three',
            ]);
        });
    }
};
