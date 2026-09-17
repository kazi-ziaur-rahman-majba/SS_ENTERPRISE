<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportsAffiliationCms;

class SportsAffiliationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (SportsAffiliationCms::count() === 0) {
            SportsAffiliationCms::create([
                // Hero Section
                'hero_title' => 'SS Group × 10-12 Sports',
                'hero_subtitle' => "Empowering Bangladesh Cricket Excellence Since 2018. A proud partnership fostering grassroots talent and building pathways to professional cricket.",
                'hero_stats' => json_encode([
                    ['number' => '7+', 'label' => 'Years Partnership'],
                    ['number' => '100+', 'label' => 'Active Players'],
                    ['number' => '5', 'label' => 'Major Championships'],
                ]),
                'hero_slides' => json_encode([
                    [
                        'image' => 'assets/images/sports/482248727_630090159807679_1759744023289367802_n.jpg',
                        'title' => 'Cricket Excellence',
                        'subtitle' => 'Empowering grassroots talent across Bangladesh'
                    ],
                    [
                        'image' => 'assets/images/sports/497750612_679129711570390_6929261868971358590_n.jpg',
                        'title' => 'Partnership Success',
                        'subtitle' => '7+ years of successful collaboration'
                    ],
                    [
                        'image' => 'assets/images/sports/488250225_649535181196510_5133201489674523724_n.jpg',
                        'title' => 'Tournament Victory',
                        'subtitle' => '5 major championships won together'
                    ]
                ]),

                // Strategic Partnership
                'partnership_kicker' => 'STRATEGIC PARTNERSHIP',
                'partnership_title' => 'Building Cricket Excellence Together',
                'partnership_subtitle' => "Since 2018, SS Group has been proudly affiliated with 10-12 Sports, supporting Bangladesh's cricket development ecosystem",
                'journey_title' => 'Our Seven-Year Journey',
                'journey_text_1' => "Our partnership with 10-12 Sports represents a commitment to transforming grassroots cricket in Bangladesh. Together, we've created opportunities for underprivileged and rural talent to reach professional levels.",
                'highlight_title' => 'Partnership Highlights (2018-current)',
                'highlight_list' => json_encode([
                    'Supporting 100+ active cricketers in DPL, First & Second Division',
                    'Enabling pathways to BPL, U-19, and National teams',
                    'Facilitating grassroots coaching and scouting programs',
                    'Organizing franchise-style tournaments'
                ]),
                'journey_text_2' => "Through this partnership, we've witnessed remarkable success stories - from rural discoveries to national team selections, proving that talent knows no geographical boundaries.",
                'company_logo_text' => 'SS GROUP',
                'company_logo_subtitle' => 'Since 2004',
                'sports_logo_badge' => '10-12',
                'sports_logo_text' => 'SPORTS',
                'sports_logo_tagline' => 'Grassroots to Glory',

                // Shared Vision & Mission
                'vision_kicker' => 'OUR FOUNDATION',
                'vision_title' => 'Shared Vision & Mission',
                'vision_subtitle' => 'United in our commitment to cricket excellence and social impact',
                'vision_card_title' => 'Our Vision',
                'vision_card_text' => "To be a catalyst for local cricket excellence in Bangladesh by creating structured opportunities and long-term support systems for players beyond Dhaka's elite leagues.",
                'mission_card_title' => 'Our Mission',
                'mission_list' => json_encode([
                    'Organize high-quality tournaments for emerging players',
                    'Develop local talent through coaching and scouting',
                    'Promote cricket as a tool for empowerment',
                    'Build infrastructure for long-term excellence',
                    'Develop cricket academies for talent enrichment'
                ]),
                'tournament_card_title' => 'Tournament Success',
                'tournament_list' => json_encode([
                    '3× Mash Champion Trophy',
                    'GULZER T20 Season 7 Champions',
                    'PKSP Academy Cup Champions',
                    'City Cup Champions',
                    'Royal Champion Trophy'
                ]),

                // Notable Players
                'players_kicker' => 'SUCCESS STORIES',
                'players_title' => 'Notable Players',
                'players_subtitle' => 'Celebrating talent nurtured through our partnership',
                'players_list' => json_encode([
                    ['name' => 'Habibur Rahman Sohan', 'achievement' => 'BPL, DPL, HP Squad', 'level' => 'National', 'image' => ''],
                    ['name' => 'Mahfijul Rahman Robin', 'achievement' => 'U19, HP, DPL', 'level' => 'Youth', 'image' => ''],
                    ['name' => 'Rayan Rafsan Rahman', 'achievement' => 'U19, Emerging Team, DPL', 'level' => 'Emerging', 'image' => ''],
                    ['name' => 'AB Jibon', 'achievement' => 'D1 consistent performer', 'level' => 'Professional', 'image' => ''],
                    ['name' => 'AKM Husna Habib', 'achievement' => 'DPL all-rounder (both-arm bowler)', 'level' => 'Specialist', 'image' => ''],
                    ['name' => 'Shariful Islam', 'achievement' => 'Man of the Tournament, National Championship', 'level' => 'Champion', 'image' => ''],
                    ['name' => 'Rafsan Al Mahmud', 'achievement' => 'U19, highest scorer in D1', 'level' => 'Youth', 'image' => ''],
                    ['name' => 'Mahidul Islam Ankon', 'achievement' => 'Gulzar T20 performer', 'level' => 'T20', 'image' => '']
                ]),

                // Impact Stats
                'impact_kicker' => 'OUR IMPACT',
                'impact_title' => 'Partnership Impact',
                'impact_stats' => json_encode([
                    ['icon' => 'users', 'count' => 100, 'text' => 'Active Players', 'desc' => 'Across DPL, First & Second Division'],
                    ['icon' => 'trophy', 'count' => 8, 'text' => 'Major Championships', 'desc' => 'Tournament victories achieved'],
                    ['icon' => 'calendar-alt', 'count' => 7, 'text' => 'Years Partnership', 'desc' => 'Continuous collaboration since 2018'],
                    ['icon' => 'star', 'count' => 15, 'text' => 'National Selections', 'desc' => 'Players reached national level']
                ]),

                // Coordination & Excellence
                'contact_section_title' => 'Partnership Coordination',
                'contact_cards' => json_encode([
                    [
                        'name' => 'Md. Milon Mondal (Abir)',
                        'title' => 'Managing Director - 10-12 Sports',
                        'phone' => '01776426880',
                        'role' => '',
                        'icon' => 'user-tie'
                    ],
                    [
                        'name' => 'Fokhrul Islam Robin',
                        'title' => 'Chairman - 10-12 Sporting Club',
                        'phone' => '',
                        'role' => 'Strategic Leadership & Governance',
                        'icon' => 'crown'
                    ]
                ]),
                'excellence_title' => 'Partnership Excellence',
                'excellence_text' => 'Our collaboration with 10-12 Sports has created a sustainable ecosystem for cricket development in Bangladesh. Together, we continue to identify, nurture, and promote talented cricketers from grassroots to professional levels.',
                'excellence_badges' => json_encode([
                    'Grassroots Development',
                    'Professional Pathways',
                    'Social Impact',
                    'Tournament Excellence'
                ]),

                'meta' => 'Sports Affiliation - SS Group',
                'meta_description' => 'SS Group partnership with 10-12 Sports for Bangladesh Cricket Excellence.'
            ]);
        }
    }
}
