<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportsAffiliationCms extends Model
{
    use HasFactory;

    protected $table = 'sports_affiliation_cms';

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_stats',
        'hero_slides',
        'partnership_kicker',
        'partnership_title',
        'partnership_subtitle',
        'journey_title',
        'journey_text_1',
        'highlight_title',
        'highlight_list',
        'journey_text_2',
        'company_logo_text',
        'company_logo_subtitle',
        'sports_logo_badge',
        'sports_logo_text',
        'sports_logo_tagline',
        'vision_kicker',
        'vision_title',
        'vision_subtitle',
        'vision_card_title',
        'vision_card_text',
        'mission_card_title',
        'mission_list',
        'tournament_card_title',
        'tournament_list',
        'players_kicker',
        'players_title',
        'players_subtitle',
        'players_list',
        'impact_kicker',
        'impact_title',
        'impact_stats',
        'contact_section_title',
        'contact_cards',
        'excellence_title',
        'excellence_text',
        'excellence_badges',
        'meta',
        'meta_description',
    ];

    protected $casts = [
        'hero_stats' => 'array',
        'hero_slides' => 'array',
        'highlight_list' => 'array',
        'mission_list' => 'array',
        'tournament_list' => 'array',
        'players_list' => 'array',
        'impact_stats' => 'array',
        'contact_cards' => 'array',
        'excellence_badges' => 'array',
    ];
}
