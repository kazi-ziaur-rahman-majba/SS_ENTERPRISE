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
        Schema::create('contact_page_cms', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title')->nullable()->default('Contact Us');
            $table->string('page_title')->nullable()->default('Contact');
            $table->string('banner_image')->nullable();
            $table->text('meta')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_page_cms');
    }
};
