<?php

namespace App\Http\Controllers;

use App\Models\SportsAffiliationCms;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class SportsAffiliationCmsController extends Controller
{
    /**
     * Display the CMS form for Sports Affiliation.
     */
    public function index()
    {
        $data = SportsAffiliationCms::latest()->first();

        // If no data exists yet, create default empty instance
        if (!$data) {
            $data = new SportsAffiliationCms();
        }

        return view('admin.modules.sports_affiliation.index', compact('data'));
    }

    /**
     * Store or update Sports Affiliation CMS content.
     */
    public function store(Request $request)
    {
        return $this->update($request, 0);
    }

    /**
     * Update Sports Affiliation CMS content.
     */
    public function update(Request $request, $id = 0)
    {
        $validatedData = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'partnership_kicker' => 'nullable|string|max:255',
            'partnership_title' => 'nullable|string|max:255',
            'partnership_subtitle' => 'nullable|string',
            'journey_title' => 'nullable|string|max:255',
            'journey_text_1' => 'nullable|string',
            'highlight_title' => 'nullable|string|max:255',
            'journey_text_2' => 'nullable|string',
            'company_logo_text' => 'nullable|string|max:255',
            'company_logo_subtitle' => 'nullable|string|max:255',
            'sports_logo_badge' => 'nullable|string|max:255',
            'sports_logo_text' => 'nullable|string|max:255',
            'sports_logo_tagline' => 'nullable|string|max:255',
            'vision_kicker' => 'nullable|string|max:255',
            'vision_title' => 'nullable|string|max:255',
            'vision_subtitle' => 'nullable|string',
            'vision_card_title' => 'nullable|string|max:255',
            'vision_card_text' => 'nullable|string',
            'mission_card_title' => 'nullable|string|max:255',
            'tournament_card_title' => 'nullable|string|max:255',
            'players_kicker' => 'nullable|string|max:255',
            'players_title' => 'nullable|string|max:255',
            'players_subtitle' => 'nullable|string',
            'impact_kicker' => 'nullable|string|max:255',
            'impact_title' => 'nullable|string|max:255',
            'contact_section_title' => 'nullable|string|max:255',
            'excellence_title' => 'nullable|string|max:255',
            'excellence_text' => 'nullable|string',
            'meta' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $sportsCms = SportsAffiliationCms::find($id) ?? SportsAffiliationCms::latest()->first();

        if (!$sportsCms) {
            $sportsCms = new SportsAffiliationCms();
        }

        // Process Hero Stats
        $heroStats = [];
        if ($request->has('hero_stat_number')) {
            foreach ($request->hero_stat_number as $index => $number) {
                if (!empty($number) || !empty($request->hero_stat_label[$index] ?? '')) {
                    $heroStats[] = [
                        'number' => $number,
                        'label' => $request->hero_stat_label[$index] ?? ''
                    ];
                }
            }
        }
        $validatedData['hero_stats'] = $heroStats;

        // Process Hero Slides
        $heroSlides = [];
        $filesystem = new Filesystem();
        if ($request->has('slide_title')) {
            foreach ($request->slide_title as $key => $title) {
                $imagePath = $request->existing_slide_image[$key] ?? '';
                if ($request->hasFile("slide_image.{$key}") && $request->file("slide_image.{$key}")->isValid()) {
                    $file = $request->file("slide_image.{$key}");
                    $filename = 'hero_' . date('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/sports');
                    $file->move($destinationPath, $filename);
                    $imagePath = 'uploads/sports/' . $filename;

                    if (!empty($request->existing_slide_image[$key])) {
                        $oldPath = public_path($request->existing_slide_image[$key]);
                        if ($filesystem->exists($oldPath)) {
                            $filesystem->delete($oldPath);
                        }
                    }
                }

                $heroSlides[] = [
                    'image' => $imagePath,
                    'title' => $title,
                    'subtitle' => $request->slide_subtitle[$key] ?? ''
                ];
            }
        }
        $validatedData['hero_slides'] = $heroSlides;

        // Process Highlight List
        $highlightList = array_values(array_filter($request->highlight_items ?? [], function($val) {
            return !empty(trim($val));
        }));
        $validatedData['highlight_list'] = $highlightList;

        // Process Mission List
        $missionList = array_values(array_filter($request->mission_items ?? [], function($val) {
            return !empty(trim($val));
        }));
        $validatedData['mission_list'] = $missionList;

        // Process Tournament List
        $tournamentList = array_values(array_filter($request->tournament_items ?? [], function($val) {
            return !empty(trim($val));
        }));
        $validatedData['tournament_list'] = $tournamentList;

        // Process Players List
        $playersList = [];
        if ($request->has('player_name')) {
            foreach ($request->player_name as $key => $name) {
                if (!empty(trim($name))) {
                    $playerImage = $request->existing_player_image[$key] ?? '';
                    if ($request->hasFile("player_image.{$key}") && $request->file("player_image.{$key}")->isValid()) {
                        $file = $request->file("player_image.{$key}");
                        $filename = 'player_' . date('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/sports/players');
                        $file->move($destinationPath, $filename);
                        $playerImage = 'uploads/sports/players/' . $filename;
                    }

                    $playersList[] = [
                        'name' => $name,
                        'achievement' => $request->player_achievement[$key] ?? '',
                        'level' => $request->player_level[$key] ?? 'National',
                        'image' => $playerImage
                    ];
                }
            }
        }
        $validatedData['players_list'] = $playersList;

        // Process Impact Stats
        $impactStats = [];
        if ($request->has('impact_count')) {
            foreach ($request->impact_count as $key => $count) {
                if (!empty($count) || !empty($request->impact_text[$key] ?? '')) {
                    $impactStats[] = [
                        'icon' => $request->impact_icon[$key] ?? 'trophy',
                        'count' => (int)$count,
                        'text' => $request->impact_text[$key] ?? '',
                        'desc' => $request->impact_desc[$key] ?? ''
                    ];
                }
            }
        }
        $validatedData['impact_stats'] = $impactStats;

        // Process Contact Cards
        $contactCards = [];
        if ($request->has('contact_name')) {
            foreach ($request->contact_name as $key => $cName) {
                if (!empty(trim($cName))) {
                    $contactCards[] = [
                        'name' => $cName,
                        'title' => $request->contact_title[$key] ?? '',
                        'phone' => $request->contact_phone[$key] ?? '',
                        'role' => $request->contact_role[$key] ?? '',
                        'icon' => $request->contact_icon[$key] ?? 'user-tie'
                    ];
                }
            }
        }
        $validatedData['contact_cards'] = $contactCards;

        // Process Excellence Badges
        $excellenceBadges = array_values(array_filter($request->excellence_badges ?? [], function($val) {
            return !empty(trim($val));
        }));
        $validatedData['excellence_badges'] = $excellenceBadges;

        if ($sportsCms->exists) {
            $sportsCms->update($validatedData);
        } else {
            SportsAffiliationCms::create($validatedData);
        }

        \Illuminate\Support\Facades\Cache::forget('sports_affiliation_cms_data');

        return redirect()->back()->with('success', 'Sports Affiliation CMS updated successfully.');
    }
}
