@extends('admin.layouts.app')
@section('title', 'Sports Affiliation CMS')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sports Affiliation CMS</li>
                    </ol>
                </nav>
            </div>
        </div>
        @include('admin.extras.alert')

        @php
            $heroStats = !empty($data->hero_stats) ? (is_array($data->hero_stats) ? $data->hero_stats : json_decode($data->hero_stats, true)) : [];
            $heroSlides = !empty($data->hero_slides) ? (is_array($data->hero_slides) ? $data->hero_slides : json_decode($data->hero_slides, true)) : [];
            $highlightList = !empty($data->highlight_list) ? (is_array($data->highlight_list) ? $data->highlight_list : json_decode($data->highlight_list, true)) : [];
            $missionList = !empty($data->mission_list) ? (is_array($data->mission_list) ? $data->mission_list : json_decode($data->mission_list, true)) : [];
            $tournamentList = !empty($data->tournament_list) ? (is_array($data->tournament_list) ? $data->tournament_list : json_decode($data->tournament_list, true)) : [];
            $playersList = !empty($data->players_list) ? (is_array($data->players_list) ? $data->players_list : json_decode($data->players_list, true)) : [];
            $impactStats = !empty($data->impact_stats) ? (is_array($data->impact_stats) ? $data->impact_stats : json_decode($data->impact_stats, true)) : [];
            $contactCards = !empty($data->contact_cards) ? (is_array($data->contact_cards) ? $data->contact_cards : json_decode($data->contact_cards, true)) : [];
            $excellenceBadges = !empty($data->excellence_badges) ? (is_array($data->excellence_badges) ? $data->excellence_badges : json_decode($data->excellence_badges, true)) : [];
        @endphp

        <form action="{{ isset($data->id) && $data->id ? route('sports-affiliation-cms.update', [$data->id]) : route('sports-affiliation-cms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($data->id) && $data->id)
                @method('PUT')
            @endif

            <!-- Hero Section Card -->
            <div class="card border-top border-0 border-4 border-primary mb-4">
                <div class="card-body p-4">
                    <div class="card-title d-flex align-items-center mb-3">
                        <i class="bx bxs-carousel me-2 font-22 text-primary"></i>
                        <h5 class="mb-0 text-primary">1. Hero Section</h5>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Hero Title</label>
                            <input type="text" class="form-control" name="hero_title" value="{{ old('hero_title', $data->hero_title ?? '') }}" placeholder="SS Group × 10-12 Sports">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Hero Subtitle</label>
                            <textarea class="form-control" name="hero_subtitle" rows="2" placeholder="Empowering Bangladesh Cricket Excellence...">{{ old('hero_subtitle', $data->hero_subtitle ?? '') }}</textarea>
                        </div>

                        <!-- Hero Stats -->
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold d-flex justify-content-between align-items-center">
                                Hero Stat Counters
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-hero-stat"><i class="bx bx-plus"></i> Add Stat</button>
                            </label>
                            <div id="hero-stats-container">
                                @if(!empty($heroStats))
                                    @foreach($heroStats as $idx => $stat)
                                        <div class="row g-2 mb-2 hero-stat-row">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="hero_stat_number[]" value="{{ $stat['number'] ?? '' }}" placeholder="Stat Number (e.g. 7+)">
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="hero_stat_label[]" value="{{ $stat['label'] ?? '' }}" placeholder="Stat Label (e.g. Years Partnership)">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-outline-danger w-100 remove-row"><i class="bx bx-trash"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row g-2 mb-2 hero-stat-row">
                                        <div class="col-md-4"><input type="text" class="form-control" name="hero_stat_number[]" placeholder="e.g. 7+"></div>
                                        <div class="col-md-7"><input type="text" class="form-control" name="hero_stat_label[]" placeholder="e.g. Years Partnership"></div>
                                        <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-row"><i class="bx bx-trash"></i></button></div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Hero Slides -->
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold d-flex justify-content-between align-items-center">
                                Hero Image Slider / Carousel
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-hero-slide"><i class="bx bx-plus"></i> Add Slide</button>
                            </label>
                            <div id="hero-slides-container">
                                @if(!empty($heroSlides))
                                    @foreach($heroSlides as $idx => $slide)
                                        <div class="card p-3 mb-2 bg-light hero-slide-row">
                                            <div class="row g-2 align-items-center">
                                                <div class="col-md-3">
                                                    @if(!empty($slide['image']))
                                                        <img src="{{ asset($slide['image']) }}" style="height: 60px; object-fit: cover;" class="rounded mb-1 d-block">
                                                    @endif
                                                    <input type="hidden" name="existing_slide_image[{{ $idx }}]" value="{{ $slide['image'] ?? '' }}">
                                                    <input type="file" class="form-control form-control-sm" name="slide_image[{{ $idx }}]">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control form-control-sm mb-1" name="slide_title[{{ $idx }}]" value="{{ $slide['title'] ?? '' }}" placeholder="Slide Overlay Title">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control form-control-sm" name="slide_subtitle[{{ $idx }}]" value="{{ $slide['subtitle'] ?? '' }}" placeholder="Slide Overlay Subtitle">
                                                </div>
                                                <div class="col-md-1 text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="card p-3 mb-2 bg-light hero-slide-row">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-md-3">
                                                <input type="hidden" name="existing_slide_image[0]" value="">
                                                <input type="file" class="form-control form-control-sm" name="slide_image[0]">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control form-control-sm mb-1" name="slide_title[0]" placeholder="Slide Overlay Title">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control form-control-sm" name="slide_subtitle[0]" placeholder="Slide Overlay Subtitle">
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Strategic Partnership Section Card -->
            <div class="card border-top border-0 border-4 border-success mb-4">
                <div class="card-body p-4">
                    <div class="card-title d-flex align-items-center mb-3">
                        <i class="bx bx-handshake me-2 font-22 text-success"></i>
                        <h5 class="mb-0 text-success">2. Strategic Partnership Section</h5>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Kicker / Small Tagline</label>
                            <input type="text" class="form-control" name="partnership_kicker" value="{{ old('partnership_kicker', $data->partnership_kicker ?? '') }}" placeholder="STRATEGIC PARTNERSHIP">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Section Main Title</label>
                            <input type="text" class="form-control" name="partnership_title" value="{{ old('partnership_title', $data->partnership_title ?? '') }}" placeholder="Building Cricket Excellence Together">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Section Subtitle</label>
                            <textarea class="form-control" name="partnership_subtitle" rows="2">{{ old('partnership_subtitle', $data->partnership_subtitle ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Journey Sub-heading</label>
                            <input type="text" class="form-control" name="journey_title" value="{{ old('journey_title', $data->journey_title ?? '') }}" placeholder="Our Seven-Year Journey">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Highlight Box Title</label>
                            <input type="text" class="form-control" name="highlight_title" value="{{ old('highlight_title', $data->highlight_title ?? '') }}" placeholder="Partnership Highlights (2018-current)">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Paragraph 1 (Before Highlight Box)</label>
                            <textarea class="form-control" name="journey_text_1" rows="3">{{ old('journey_text_1', $data->journey_text_1 ?? '') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Paragraph 2 (After Highlight Box)</label>
                            <textarea class="form-control" name="journey_text_2" rows="3">{{ old('journey_text_2', $data->journey_text_2 ?? '') }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label font-weight-bold d-flex justify-content-between align-items-center">
                                Partnership Highlight Points (Checklist)
                                <button type="button" class="btn btn-sm btn-outline-success" id="add-highlight-item"><i class="bx bx-plus"></i> Add Highlight</button>
                            </label>
                            <div id="highlight-items-container">
                                @if(!empty($highlightList))
                                    @foreach($highlightList as $hItem)
                                        <div class="input-group mb-2 highlight-row">
                                            <span class="input-group-text"><i class="bx bx-check text-success"></i></span>
                                            <input type="text" class="form-control" name="highlight_items[]" value="{{ $hItem }}">
                                            <button type="button" class="btn btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 highlight-row">
                                        <span class="input-group-text"><i class="bx bx-check text-success"></i></span>
                                        <input type="text" class="form-control" name="highlight_items[]" placeholder="Highlight point...">
                                        <button type="button" class="btn btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Company vs Sports Logo Display -->
                        <div class="col-md-6">
                            <div class="border p-3 rounded">
                                <h6>Company Logo Box (Left Side)</h6>
                                <div class="mb-2">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="company_logo_text" value="{{ old('company_logo_text', $data->company_logo_text ?? '') }}" placeholder="SS GROUP">
                                </div>
                                <div>
                                    <label class="form-label">Company Subtitle / Year</label>
                                    <input type="text" class="form-control" name="company_logo_subtitle" value="{{ old('company_logo_subtitle', $data->company_logo_subtitle ?? '') }}" placeholder="Since 2004">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border p-3 rounded">
                                <h6>Sports Logo Box (Right Side)</h6>
                                <div class="mb-2">
                                    <label class="form-label">Sports Badge Text</label>
                                    <input type="text" class="form-control" name="sports_logo_badge" value="{{ old('sports_logo_badge', $data->sports_logo_badge ?? '') }}" placeholder="10-12">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Sports Title</label>
                                    <input type="text" class="form-control" name="sports_logo_text" value="{{ old('sports_logo_text', $data->sports_logo_text ?? '') }}" placeholder="SPORTS">
                                </div>
                                <div>
                                    <label class="form-label">Tagline</label>
                                    <input type="text" class="form-control" name="sports_logo_tagline" value="{{ old('sports_logo_tagline', $data->sports_logo_tagline ?? '') }}" placeholder="Grassroots to Glory">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shared Vision & Mission Section Card -->
            <div class="card border-top border-0 border-4 border-info mb-4">
                <div class="card-body p-4">
                    <div class="card-title d-flex align-items-center mb-3">
                        <i class="bx bx-target-lock me-2 font-22 text-info"></i>
                        <h5 class="mb-0 text-info">3. Shared Vision & Mission Section</h5>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Kicker</label>
                            <input type="text" class="form-control" name="vision_kicker" value="{{ old('vision_kicker', $data->vision_kicker ?? '') }}" placeholder="OUR FOUNDATION">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="vision_title" value="{{ old('vision_title', $data->vision_title ?? '') }}" placeholder="Shared Vision & Mission">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Subtitle</label>
                            <textarea class="form-control" name="vision_subtitle" rows="2">{{ old('vision_subtitle', $data->vision_subtitle ?? '') }}</textarea>
                        </div>

                        <!-- 3 Cards -->
                        <div class="col-md-4">
                            <div class="border p-3 rounded h-100">
                                <h6 class="text-primary"><i class="bx bx-show me-1"></i> Card 1: Vision</h6>
                                <div class="mb-2">
                                    <label class="form-label">Card Title</label>
                                    <input type="text" class="form-control" name="vision_card_title" value="{{ old('vision_card_title', $data->vision_card_title ?? '') }}" placeholder="Our Vision">
                                </div>
                                <div>
                                    <label class="form-label">Vision Description</label>
                                    <textarea class="form-control" name="vision_card_text" rows="5">{{ old('vision_card_text', $data->vision_card_text ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border p-3 rounded h-100">
                                <h6 class="text-success"><i class="bx bx-target-lock me-1"></i> Card 2: Mission</h6>
                                <div class="mb-2">
                                    <label class="form-label">Card Title</label>
                                    <input type="text" class="form-control" name="mission_card_title" value="{{ old('mission_card_title', $data->mission_card_title ?? '') }}" placeholder="Our Mission">
                                </div>
                                <div>
                                    <label class="form-label d-flex justify-content-between align-items-center">
                                        Mission Bullet Points
                                        <button type="button" class="btn btn-sm btn-outline-success" id="add-mission-item"><i class="bx bx-plus"></i> Add</button>
                                    </label>
                                    <div id="mission-items-container">
                                        @if(!empty($missionList))
                                            @foreach($missionList as $mItem)
                                                <div class="input-group mb-2 mission-row">
                                                    <input type="text" class="form-control form-control-sm" name="mission_items[]" value="{{ $mItem }}">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2 mission-row">
                                                <input type="text" class="form-control form-control-sm" name="mission_items[]" placeholder="Mission point...">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border p-3 rounded h-100">
                                <h6 class="text-warning"><i class="bx bx-trophy me-1"></i> Card 3: Tournament Success</h6>
                                <div class="mb-2">
                                    <label class="form-label">Card Title</label>
                                    <input type="text" class="form-control" name="tournament_card_title" value="{{ old('tournament_card_title', $data->tournament_card_title ?? '') }}" placeholder="Tournament Success">
                                </div>
                                <div>
                                    <label class="form-label d-flex justify-content-between align-items-center">
                                        Tournament Achievements
                                        <button type="button" class="btn btn-sm btn-outline-warning" id="add-tournament-item"><i class="bx bx-plus"></i> Add</button>
                                    </label>
                                    <div id="tournament-items-container">
                                        @if(!empty($tournamentList))
                                            @foreach($tournamentList as $tItem)
                                                <div class="input-group mb-2 tournament-row">
                                                    <span class="input-group-text"><i class="bx bx-trophy text-warning"></i></span>
                                                    <input type="text" class="form-control form-control-sm" name="tournament_items[]" value="{{ $tItem }}">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2 tournament-row">
                                                <span class="input-group-text"><i class="bx bx-trophy text-warning"></i></span>
                                                <input type="text" class="form-control form-control-sm" name="tournament_items[]" placeholder="Achievement name...">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notable Players Section Card -->
            <div class="card border-top border-0 border-4 border-warning mb-4">
                <div class="card-body p-4">
                    <div class="card-title d-flex align-items-center mb-3">
                        <i class="bx bx-user-pin me-2 font-22 text-warning"></i>
                        <h5 class="mb-0 text-warning">4. Notable Players Section</h5>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Kicker</label>
                            <input type="text" class="form-control" name="players_kicker" value="{{ old('players_kicker', $data->players_kicker ?? '') }}" placeholder="SUCCESS STORIES">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="players_title" value="{{ old('players_title', $data->players_title ?? '') }}" placeholder="Notable Players">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Subtitle</label>
                            <textarea class="form-control" name="players_subtitle" rows="2">{{ old('players_subtitle', $data->players_subtitle ?? '') }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label font-weight-bold d-flex justify-content-between align-items-center">
                                Players List
                                <button type="button" class="btn btn-sm btn-outline-warning" id="add-player-row"><i class="bx bx-plus"></i> Add Player</button>
                            </label>
                            <div id="players-container">
                                @if(!empty($playersList))
                                    @foreach($playersList as $pIdx => $player)
                                        <div class="card p-3 mb-2 bg-light player-row">
                                            <div class="row g-2 align-items-center">
                                                <div class="col-md-3">
                                                    <label class="form-label form-label-sm mb-1">Player Name</label>
                                                    <input type="text" class="form-control form-control-sm" name="player_name[{{ $pIdx }}]" value="{{ $player['name'] ?? '' }}" placeholder="Player Full Name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label form-label-sm mb-1">Achievement / Teams</label>
                                                    <input type="text" class="form-control form-control-sm" name="player_achievement[{{ $pIdx }}]" value="{{ $player['achievement'] ?? '' }}" placeholder="e.g. BPL, DPL, HP Squad">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label form-label-sm mb-1">Level Tag</label>
                                                    <select class="form-select form-select-sm" name="player_level[{{ $pIdx }}]">
                                                        <option value="National" {{ ($player['level'] ?? '') == 'National' ? 'selected' : '' }}>National</option>
                                                        <option value="Youth" {{ ($player['level'] ?? '') == 'Youth' ? 'selected' : '' }}>Youth</option>
                                                        <option value="Emerging" {{ ($player['level'] ?? '') == 'Emerging' ? 'selected' : '' }}>Emerging</option>
                                                        <option value="Professional" {{ ($player['level'] ?? '') == 'Professional' ? 'selected' : '' }}>Professional</option>
                                                        <option value="Specialist" {{ ($player['level'] ?? '') == 'Specialist' ? 'selected' : '' }}>Specialist</option>
                                                        <option value="Champion" {{ ($player['level'] ?? '') == 'Champion' ? 'selected' : '' }}>Champion</option>
                                                        <option value="T20" {{ ($player['level'] ?? '') == 'T20' ? 'selected' : '' }}>T20</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label form-label-sm mb-1">Photo (Optional)</label>
                                                    <input type="hidden" name="existing_player_image[{{ $pIdx }}]" value="{{ $player['image'] ?? '' }}">
                                                    <input type="file" class="form-control form-control-sm" name="player_image[{{ $pIdx }}]">
                                                </div>
                                                <div class="col-md-1 text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row mt-4"><i class="bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="card p-3 mb-2 bg-light player-row">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-md-3">
                                                <label class="form-label form-label-sm mb-1">Player Name</label>
                                                <input type="text" class="form-control form-control-sm" name="player_name[0]" placeholder="Player Full Name">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label form-label-sm mb-1">Achievement / Teams</label>
                                                <input type="text" class="form-control form-control-sm" name="player_achievement[0]" placeholder="e.g. BPL, DPL, HP Squad">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label form-label-sm mb-1">Level Tag</label>
                                                <select class="form-select form-select-sm" name="player_level[0]">
                                                    <option value="National">National</option>
                                                    <option value="Youth">Youth</option>
                                                    <option value="Emerging">Emerging</option>
                                                    <option value="Professional">Professional</option>
                                                    <option value="Specialist">Specialist</option>
                                                    <option value="Champion">Champion</option>
                                                    <option value="T20">T20</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label form-label-sm mb-1">Photo (Optional)</label>
                                                <input type="hidden" name="existing_player_image[0]" value="">
                                                <input type="file" class="form-control form-control-sm" name="player_image[0]">
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-row mt-4"><i class="bx bx-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Partnership Impact Section Card -->
            <div class="card border-top border-0 border-4 border-danger mb-4">
                <div class="card-body p-4">
                    <div class="card-title d-flex align-items-center mb-3">
                        <i class="bx bx-bar-chart-alt-2 me-2 font-22 text-danger"></i>
                        <h5 class="mb-0 text-danger">5. Partnership Impact Section</h5>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Kicker</label>
                            <input type="text" class="form-control" name="impact_kicker" value="{{ old('impact_kicker', $data->impact_kicker ?? '') }}" placeholder="OUR IMPACT">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="impact_title" value="{{ old('impact_title', $data->impact_title ?? '') }}" placeholder="Partnership Impact">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label font-weight-bold d-flex justify-content-between align-items-center">
                                Impact Counters (4 Items Recommended)
                                <button type="button" class="btn btn-sm btn-outline-danger" id="add-impact-row"><i class="bx bx-plus"></i> Add Impact Stat</button>
                            </label>
                            <div id="impact-container">
                                @if(!empty($impactStats))
                                    @foreach($impactStats as $imp)
                                        <div class="row g-2 mb-2 impact-row align-items-center">
                                            <div class="col-md-2">
                                                <input type="text" class="form-control form-control-sm" name="impact_icon[]" value="{{ $imp['icon'] ?? 'trophy' }}" placeholder="Icon (e.g. users, trophy, calendar, star)">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control form-control-sm" name="impact_count[]" value="{{ $imp['count'] ?? 0 }}" placeholder="Count (e.g. 100)">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control form-control-sm" name="impact_text[]" value="{{ $imp['text'] ?? '' }}" placeholder="Stat Title (e.g. Active Players)">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control form-control-sm" name="impact_desc[]" value="{{ $imp['desc'] ?? '' }}" placeholder="Description (e.g. Across DPL...)">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-row w-100"><i class="bx bx-trash"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row g-2 mb-2 impact-row align-items-center">
                                        <div class="col-md-2"><input type="text" class="form-control form-control-sm" name="impact_icon[]" value="users" placeholder="Icon"></div>
                                        <div class="col-md-2"><input type="number" class="form-control form-control-sm" name="impact_count[]" value="100" placeholder="Count"></div>
                                        <div class="col-md-3"><input type="text" class="form-control form-control-sm" name="impact_text[]" placeholder="Title"></div>
                                        <div class="col-md-4"><input type="text" class="form-control form-control-sm" name="impact_desc[]" placeholder="Description"></div>
                                        <div class="col-md-1"><button type="button" class="btn btn-sm btn-outline-danger remove-row w-100"><i class="bx bx-trash"></i></button></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coordination & Excellence Section Card -->
            <div class="card border-top border-0 border-4 border-secondary mb-4">
                <div class="card-body p-4">
                    <div class="card-title d-flex align-items-center mb-3">
                        <i class="bx bx-phone-call me-2 font-22 text-secondary"></i>
                        <h5 class="mb-0 text-secondary">6. Coordination & Excellence Section</h5>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border p-3 rounded h-100">
                                <h6>Left Box: Partnership Coordination</h6>
                                <div class="mb-3">
                                    <label class="form-label">Section Title</label>
                                    <input type="text" class="form-control" name="contact_section_title" value="{{ old('contact_section_title', $data->contact_section_title ?? '') }}" placeholder="Partnership Coordination">
                                </div>
                                <label class="form-label font-weight-bold d-flex justify-content-between align-items-center">
                                    Contact Persons
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="add-contact-row"><i class="bx bx-plus"></i> Add Contact</button>
                                </label>
                                <div id="contacts-container">
                                    @if(!empty($contactCards))
                                        @foreach($contactCards as $cIdx => $cCard)
                                            <div class="card p-2 mb-2 bg-light contact-row">
                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control form-control-sm mb-1" name="contact_name[]" value="{{ $cCard['name'] ?? '' }}" placeholder="Name">
                                                        <input type="text" class="form-control form-control-sm" name="contact_title[]" value="{{ $cCard['title'] ?? '' }}" placeholder="Designation / Title">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control form-control-sm mb-1" name="contact_phone[]" value="{{ $cCard['phone'] ?? '' }}" placeholder="Phone Number">
                                                        <input type="text" class="form-control form-control-sm" name="contact_role[]" value="{{ $cCard['role'] ?? '' }}" placeholder="Role / Governance">
                                                    </div>
                                                    <div class="col-md-1 text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card p-2 mb-2 bg-light contact-row">
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control form-control-sm mb-1" name="contact_name[]" placeholder="Name">
                                                    <input type="text" class="form-control form-control-sm" name="contact_title[]" placeholder="Title">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control form-control-sm mb-1" name="contact_phone[]" placeholder="Phone">
                                                    <input type="text" class="form-control form-control-sm" name="contact_role[]" placeholder="Role">
                                                </div>
                                                <div class="col-md-1 text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border p-3 rounded h-100">
                                <h6>Right Box: Partnership Excellence</h6>
                                <div class="mb-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="excellence_title" value="{{ old('excellence_title', $data->excellence_title ?? '') }}" placeholder="Partnership Excellence">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Paragraph Text</label>
                                    <textarea class="form-control" name="excellence_text" rows="3">{{ old('excellence_text', $data->excellence_text ?? '') }}</textarea>
                                </div>
                                <label class="form-label font-weight-bold d-flex justify-content-between align-items-center">
                                    Feature Badges (Tags)
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="add-badge-item"><i class="bx bx-plus"></i> Add Tag</button>
                                </label>
                                <div id="badges-container">
                                    @if(!empty($excellenceBadges))
                                        @foreach($excellenceBadges as $bItem)
                                            <div class="input-group mb-2 badge-row">
                                                <input type="text" class="form-control form-control-sm" name="excellence_badges[]" value="{{ $bItem }}">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2 badge-row">
                                            <input type="text" class="form-control form-control-sm" name="excellence_badges[]" placeholder="Tag name (e.g. Grassroots Development)">
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meta & Save Button -->
            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="meta" value="{{ old('meta', $data->meta ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Meta Description</label>
                            <input type="text" class="form-control" name="meta_description" value="{{ old('meta_description', $data->meta_description ?? '') }}">
                        </div>
                        <div class="col-md-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5"><i class="bx bx-save me-1"></i> Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@section('extra-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generic Remove Row
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                const btn = e.target.closest('.remove-row');
                const row = btn.closest('.hero-stat-row, .hero-slide-row, .highlight-row, .mission-row, .tournament-row, .player-row, .impact-row, .contact-row, .badge-row');
                if (row) row.remove();
            }
        });

        // Add Hero Stat
        const addHeroStatBtn = document.getElementById('add-hero-stat');
        if (addHeroStatBtn) {
            addHeroStatBtn.addEventListener('click', function() {
                const container = document.getElementById('hero-stats-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'row g-2 mb-2 hero-stat-row';
                div.innerHTML = `
                    <div class="col-md-4"><input type="text" class="form-control" name="hero_stat_number[]" placeholder="e.g. 7+"></div>
                    <div class="col-md-7"><input type="text" class="form-control" name="hero_stat_label[]" placeholder="e.g. Years Partnership"></div>
                    <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100 remove-row"><i class="bx bx-trash"></i></button></div>
                `;
                container.appendChild(div);
            });
        }

        // Add Hero Slide
        let slideIndex = {{ count($heroSlides) > 0 ? count($heroSlides) : 1 }};
        const addHeroSlideBtn = document.getElementById('add-hero-slide');
        if (addHeroSlideBtn) {
            addHeroSlideBtn.addEventListener('click', function() {
                const container = document.getElementById('hero-slides-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'card p-3 mb-2 bg-light hero-slide-row';
                div.innerHTML = `
                    <div class="row g-2 align-items-center">
                        <div class="col-md-3">
                            <input type="hidden" name="existing_slide_image[${slideIndex}]" value="">
                            <input type="file" class="form-control form-control-sm" name="slide_image[${slideIndex}]">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm mb-1" name="slide_title[${slideIndex}]" placeholder="Slide Overlay Title">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" name="slide_subtitle[${slideIndex}]" placeholder="Slide Overlay Subtitle">
                        </div>
                        <div class="col-md-1 text-end">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                `;
                container.appendChild(div);
                slideIndex++;
            });
        }

        // Add Highlight Item
        const addHighlightItemBtn = document.getElementById('add-highlight-item');
        if (addHighlightItemBtn) {
            addHighlightItemBtn.addEventListener('click', function() {
                const container = document.getElementById('highlight-items-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'input-group mb-2 highlight-row';
                div.innerHTML = `
                    <span class="input-group-text"><i class="bx bx-check text-success"></i></span>
                    <input type="text" class="form-control" name="highlight_items[]" placeholder="Highlight point...">
                    <button type="button" class="btn btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                `;
                container.appendChild(div);
            });
        }

        // Add Mission Item
        const addMissionItemBtn = document.getElementById('add-mission-item');
        if (addMissionItemBtn) {
            addMissionItemBtn.addEventListener('click', function() {
                const container = document.getElementById('mission-items-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'input-group mb-2 mission-row';
                div.innerHTML = `
                    <input type="text" class="form-control form-control-sm" name="mission_items[]" placeholder="Mission point...">
                    <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                `;
                container.appendChild(div);
            });
        }

        // Add Tournament Item
        const addTournamentItemBtn = document.getElementById('add-tournament-item');
        if (addTournamentItemBtn) {
            addTournamentItemBtn.addEventListener('click', function() {
                const container = document.getElementById('tournament-items-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'input-group mb-2 tournament-row';
                div.innerHTML = `
                    <span class="input-group-text"><i class="bx bx-trophy text-warning"></i></span>
                    <input type="text" class="form-control form-control-sm" name="tournament_items[]" placeholder="Achievement name...">
                    <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                `;
                container.appendChild(div);
            });
        }

        // Add Player Row
        let playerIndex = {{ count($playersList) > 0 ? count($playersList) : 1 }};
        const addPlayerRowBtn = document.getElementById('add-player-row');
        if (addPlayerRowBtn) {
            addPlayerRowBtn.addEventListener('click', function() {
                const container = document.getElementById('players-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'card p-3 mb-2 bg-light player-row';
                div.innerHTML = `
                    <div class="row g-2 align-items-center">
                        <div class="col-md-3">
                            <label class="form-label form-label-sm mb-1">Player Name</label>
                            <input type="text" class="form-control form-control-sm" name="player_name[${playerIndex}]" placeholder="Player Full Name">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label form-label-sm mb-1">Achievement / Teams</label>
                            <input type="text" class="form-control form-control-sm" name="player_achievement[${playerIndex}]" placeholder="e.g. BPL, DPL, HP Squad">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label form-label-sm mb-1">Level Tag</label>
                            <select class="form-select form-select-sm" name="player_level[${playerIndex}]">
                                <option value="National">National</option>
                                <option value="Youth">Youth</option>
                                <option value="Emerging">Emerging</option>
                                <option value="Professional">Professional</option>
                                <option value="Specialist">Specialist</option>
                                <option value="Champion">Champion</option>
                                <option value="T20">T20</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label form-label-sm mb-1">Photo (Optional)</label>
                            <input type="hidden" name="existing_player_image[${playerIndex}]" value="">
                            <input type="file" class="form-control form-control-sm" name="player_image[${playerIndex}]">
                        </div>
                        <div class="col-md-1 text-end">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row mt-4"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                `;
                container.appendChild(div);
                playerIndex++;
            });
        }

        // Add Impact Row
        const addImpactRowBtn = document.getElementById('add-impact-row');
        if (addImpactRowBtn) {
            addImpactRowBtn.addEventListener('click', function() {
                const container = document.getElementById('impact-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'row g-2 mb-2 impact-row align-items-center';
                div.innerHTML = `
                    <div class="col-md-2"><input type="text" class="form-control form-control-sm" name="impact_icon[]" value="trophy" placeholder="Icon"></div>
                    <div class="col-md-2"><input type="number" class="form-control form-control-sm" name="impact_count[]" value="0" placeholder="Count"></div>
                    <div class="col-md-3"><input type="text" class="form-control form-control-sm" name="impact_text[]" placeholder="Title"></div>
                    <div class="col-md-4"><input type="text" class="form-control form-control-sm" name="impact_desc[]" placeholder="Description"></div>
                    <div class="col-md-1"><button type="button" class="btn btn-sm btn-outline-danger remove-row w-100"><i class="bx bx-trash"></i></button></div>
                `;
                container.appendChild(div);
            });
        }

        // Add Contact Row
        const addContactRowBtn = document.getElementById('add-contact-row');
        if (addContactRowBtn) {
            addContactRowBtn.addEventListener('click', function() {
                const container = document.getElementById('contacts-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'card p-2 mb-2 bg-light contact-row';
                div.innerHTML = `
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm mb-1" name="contact_name[]" placeholder="Name">
                            <input type="text" class="form-control form-control-sm" name="contact_title[]" placeholder="Title">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control form-control-sm mb-1" name="contact_phone[]" placeholder="Phone">
                            <input type="text" class="form-control form-control-sm" name="contact_role[]" placeholder="Role">
                        </div>
                        <div class="col-md-1 text-end">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        // Add Badge Item
        const addBadgeItemBtn = document.getElementById('add-badge-item');
        if (addBadgeItemBtn) {
            addBadgeItemBtn.addEventListener('click', function() {
                const container = document.getElementById('badges-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'input-group mb-2 badge-row';
                div.innerHTML = `
                    <input type="text" class="form-control form-control-sm" name="excellence_badges[]" placeholder="Tag name...">
                    <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bx bx-trash"></i></button>
                `;
                container.appendChild(div);
            });
        }
    });
</script>
@endsection
