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
        Schema::create('sports_affiliation_cms', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->longText('hero_stats')->nullable();
            $table->longText('hero_slides')->nullable();

            // Strategic Partnership Section
            $table->string('partnership_kicker')->nullable();
            $table->string('partnership_title')->nullable();
            $table->text('partnership_subtitle')->nullable();
            $table->string('journey_title')->nullable();
            $table->text('journey_text_1')->nullable();
            $table->string('highlight_title')->nullable();
            $table->longText('highlight_list')->nullable();
            $table->text('journey_text_2')->nullable();
            $table->string('company_logo_text')->nullable();
            $table->string('company_logo_subtitle')->nullable();
            $table->string('sports_logo_badge')->nullable();
            $table->string('sports_logo_text')->nullable();
            $table->string('sports_logo_tagline')->nullable();

            // Shared Vision & Mission Section
            $table->string('vision_kicker')->nullable();
            $table->string('vision_title')->nullable();
            $table->text('vision_subtitle')->nullable();
            $table->string('vision_card_title')->nullable();
            $table->text('vision_card_text')->nullable();
            $table->string('mission_card_title')->nullable();
            $table->longText('mission_list')->nullable();
            $table->string('tournament_card_title')->nullable();
            $table->longText('tournament_list')->nullable();

            // Notable Players Section
            $table->string('players_kicker')->nullable();
            $table->string('players_title')->nullable();
            $table->text('players_subtitle')->nullable();
            $table->longText('players_list')->nullable();

            // Partnership Impact Section
            $table->string('impact_kicker')->nullable();
            $table->string('impact_title')->nullable();
            $table->longText('impact_stats')->nullable();

            // Coordination & Excellence Section
            $table->string('contact_section_title')->nullable();
            $table->longText('contact_cards')->nullable();
            $table->string('excellence_title')->nullable();
            $table->text('excellence_text')->nullable();
            $table->longText('excellence_badges')->nullable();

            // SEO & Meta
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
        Schema::dropIfExists('sports_affiliation_cms');
    }
};
