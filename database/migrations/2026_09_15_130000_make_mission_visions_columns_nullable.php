<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE `mission_visions` MODIFY `banner_title` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `page_title` VARCHAR(2048) NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `objective_title` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `objective_details` LONGTEXT NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `mission_title` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `mission_details` LONGTEXT NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `vision_title` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `vision_details` LONGTEXT NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `core_values_title` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `mission_visions` MODIFY `core_values_details` LONGTEXT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
