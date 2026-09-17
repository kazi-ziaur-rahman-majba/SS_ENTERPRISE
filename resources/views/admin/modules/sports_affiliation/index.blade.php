@extends('admin.layouts.app')
@section('title', 'Sports Affiliation CMS')

@section('header-css')
<script src="https://cdn.tailwindcss.com"></script>
@endsection

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

            <!-- 1. HERO SECTION CARD -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">
                <div class="p-5 bg-gradient-to-r from-blue-50 to-indigo-50/50 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xl shadow-md shadow-blue-500/20">
                            <i class="bx bxs-carousel"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-900 text-base m-0">1. Hero Section</h5>
                            <p class="text-xs text-slate-500 m-0">Manage main hero banner titles, statistics, and carousel slides</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Hero Main Title</label>
                            <input type="text" class="w-full text-sm px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all font-semibold text-slate-800" name="hero_title" value="{{ old('hero_title', $data->hero_title ?? '') }}" placeholder="e.g. SS Group × 10-12 Sports">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Hero Subtitle</label>
                            <textarea class="w-full text-sm px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-600" name="hero_subtitle" rows="2" placeholder="Empowering Bangladesh Cricket Excellence...">{{ old('hero_subtitle', $data->hero_subtitle ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Hero Stats -->
                    <div class="border-t border-slate-100 pt-5">
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Hero Stat Counters</label>
                            <button type="button" id="add-hero-stat" class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold text-xs rounded-lg transition-all flex items-center gap-1 cursor-pointer">
                                <i class="bx bx-plus text-base"></i> Add Stat
                            </button>
                        </div>
                        <div id="hero-stats-container" class="space-y-2">
                            @if(!empty($heroStats))
                                @foreach($heroStats as $idx => $stat)
                                    <div class="flex items-center gap-3 p-2 bg-slate-50 rounded-xl border border-slate-200/80 hero-stat-row">
                                        <div class="w-1/3">
                                            <input type="text" class="w-full text-xs px-3 py-2 bg-white border border-slate-200 rounded-lg outline-none font-bold text-blue-600" name="hero_stat_number[]" value="{{ $stat['number'] ?? '' }}" placeholder="Number (e.g. 7+)">
                                        </div>
                                        <div class="flex-1">
                                            <input type="text" class="w-full text-xs px-3 py-2 bg-white border border-slate-200 rounded-lg outline-none text-slate-700" name="hero_stat_label[]" value="{{ $stat['label'] ?? '' }}" placeholder="Label (e.g. Years Partnership)">
                                        </div>
                                        <button type="button" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row shrink-0" title="Delete Stat"><i class="bx bx-trash text-base"></i></button>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center gap-3 p-2 bg-slate-50 rounded-xl border border-slate-200/80 hero-stat-row">
                                    <div class="w-1/3"><input type="text" class="w-full text-xs px-3 py-2 bg-white border border-slate-200 rounded-lg outline-none font-bold text-blue-600" name="hero_stat_number[]" placeholder="e.g. 7+"></div>
                                    <div class="flex-1"><input type="text" class="w-full text-xs px-3 py-2 bg-white border border-slate-200 rounded-lg outline-none text-slate-700" name="hero_stat_label[]" placeholder="e.g. Years Partnership"></div>
                                    <button type="button" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row shrink-0" title="Delete Stat"><i class="bx bx-trash text-base"></i></button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Hero Slides -->
                    <div class="border-t border-slate-100 pt-5">
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Hero Carousel Slides</label>
                            <button type="button" id="add-hero-slide" class="px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-lg transition-all shadow-xs flex items-center gap-1 cursor-pointer">
                                <i class="bx bx-plus text-base"></i> Add Slide
                            </button>
                        </div>
                        <div id="hero-slides-container" class="space-y-3">
                            @if(!empty($heroSlides))
                                @foreach($heroSlides as $idx => $slide)
                                    <div class="bg-slate-50/80 rounded-xl p-3.5 border border-slate-200/80 hover:border-blue-300 transition-all hero-slide-row">
                                        <div class="flex flex-col md:flex-row items-center justify-between gap-3">
                                            <div class="flex items-center gap-3 w-full md:w-64 shrink-0">
                                                <div class="w-16 h-14 rounded-lg bg-white border border-slate-200 overflow-hidden flex items-center justify-center shrink-0 shadow-2xs">
                                                    @if(!empty($slide['image']))
                                                        <img src="{{ asset($slide['image']) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <i class="bx bx-image text-slate-400 text-2xl"></i>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Image File</label>
                                                    <input type="hidden" name="existing_slide_image[{{ $idx }}]" value="{{ $slide['image'] ?? '' }}">
                                                    <input type="file" class="block w-full text-[11px] text-slate-500 file:mr-2 file:py-0.5 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" name="slide_image[{{ $idx }}]">
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 flex-1 w-full">
                                                <div>
                                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Overlay Title</label>
                                                    <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 outline-none" name="slide_title[{{ $idx }}]" value="{{ $slide['title'] ?? '' }}" placeholder="Slide Overlay Title">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Overlay Subtitle</label>
                                                    <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 outline-none" name="slide_subtitle[{{ $idx }}]" value="{{ $slide['subtitle'] ?? '' }}" placeholder="Slide Overlay Subtitle">
                                                </div>
                                            </div>

                                            <div class="shrink-0 flex items-center justify-end w-full md:w-auto">
                                                <button type="button" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row" title="Delete Slide"><i class="bx bx-trash text-base"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="bg-slate-50/80 rounded-xl p-3.5 border border-slate-200/80 hover:border-blue-300 transition-all hero-slide-row">
                                    <div class="flex flex-col md:flex-row items-center justify-between gap-3">
                                        <div class="flex items-center gap-3 w-full md:w-64 shrink-0">
                                            <div class="w-16 h-14 rounded-lg bg-white border border-slate-200 overflow-hidden flex items-center justify-center shrink-0 shadow-2xs">
                                                <i class="bx bx-image text-slate-400 text-2xl"></i>
                                            </div>
                                            <div class="flex-1">
                                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Image File</label>
                                                <input type="hidden" name="existing_slide_image[0]" value="">
                                                <input type="file" class="block w-full text-[11px] text-slate-500 file:mr-2 file:py-0.5 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" name="slide_image[0]">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 flex-1 w-full">
                                            <div>
                                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Overlay Title</label>
                                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 outline-none" name="slide_title[0]" placeholder="Slide Overlay Title">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Overlay Subtitle</label>
                                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 outline-none" name="slide_subtitle[0]" placeholder="Slide Overlay Subtitle">
                                            </div>
                                        </div>
                                        <div class="shrink-0 flex items-center justify-end w-full md:w-auto">
                                            <button type="button" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row" title="Delete Slide"><i class="bx bx-trash text-base"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. STRATEGIC PARTNERSHIP CARD -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">
                <div class="p-5 bg-gradient-to-r from-emerald-50 to-teal-50/50 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-xl shadow-md shadow-emerald-500/20">
                            <i class="bx bx-handshake"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-900 text-base m-0">2. Strategic Partnership Section</h5>
                            <p class="text-xs text-slate-500 m-0">Edit strategic partnership text blocks, highlights checklist, and dynamic logos</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Section Kicker</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 outline-none font-bold text-emerald-600 uppercase" name="partnership_kicker" value="{{ old('partnership_kicker', $data->partnership_kicker ?? '') }}" placeholder="STRATEGIC PARTNERSHIP">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Section Main Title</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 outline-none font-bold text-slate-800" name="partnership_title" value="{{ old('partnership_title', $data->partnership_title ?? '') }}" placeholder="Building Cricket Excellence Together">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Section Subtitle</label>
                            <textarea class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 outline-none text-slate-600" name="partnership_subtitle" rows="2">{{ old('partnership_subtitle', $data->partnership_subtitle ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t border-slate-100 pt-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Journey Sub-heading</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 outline-none font-bold text-slate-800" name="journey_title" value="{{ old('journey_title', $data->journey_title ?? '') }}" placeholder="Our Seven-Year Journey">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mt-3 mb-1.5">Paragraph 1 (Before Highlight Box)</label>
                            <textarea class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 outline-none text-slate-600" name="journey_text_1" rows="3">{{ old('journey_text_1', $data->journey_text_1 ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Highlight Box Title</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 outline-none font-bold text-emerald-700" name="highlight_title" value="{{ old('highlight_title', $data->highlight_title ?? '') }}" placeholder="Partnership Highlights (2018-current)">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mt-3 mb-1.5">Paragraph 2 (After Highlight Box)</label>
                            <textarea class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 outline-none text-slate-600" name="journey_text_2" rows="3">{{ old('journey_text_2', $data->journey_text_2 ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Highlight List -->
                    <div class="border-t border-slate-100 pt-4">
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Highlight Checklist Points</label>
                            <button type="button" id="add-highlight-item" class="px-3 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold text-xs rounded-lg transition-all flex items-center gap-1 cursor-pointer">
                                <i class="bx bx-plus text-base"></i> Add Highlight
                            </button>
                        </div>
                        <div id="highlight-items-container" class="space-y-2">
                            @if(!empty($highlightList))
                                @foreach($highlightList as $hItem)
                                    <div class="flex items-center gap-2 highlight-row">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 font-bold text-sm">✓</div>
                                        <input type="text" class="flex-1 text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg outline-none text-slate-700 focus:bg-white focus:border-emerald-500" name="highlight_items[]" value="{{ $hItem }}">
                                        <button type="button" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row shrink-0" title="Delete Point"><i class="bx bx-trash text-base"></i></button>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center gap-2 highlight-row">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 font-bold text-sm">✓</div>
                                    <input type="text" class="flex-1 text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg outline-none text-slate-700 focus:bg-white focus:border-emerald-500" name="highlight_items[]" placeholder="Highlight point...">
                                    <button type="button" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row shrink-0" title="Delete Point"><i class="bx bx-trash text-base"></i></button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Logo Showcase Card Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t border-slate-100 pt-4">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200/80">
                            <h6 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">Company Logo Showcase (Left)</h6>
                            <div class="space-y-2">
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-blue-700" name="company_logo_text" value="{{ old('company_logo_text', $data->company_logo_text ?? '') }}" placeholder="Company Name (e.g. SS GROUP)">
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-500" name="company_logo_subtitle" value="{{ old('company_logo_subtitle', $data->company_logo_subtitle ?? '') }}" placeholder="Subtitle (e.g. Since 2004)">
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200/80">
                            <h6 class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-2">Sports Logo Showcase (Right)</h6>
                            <div class="grid grid-cols-2 gap-2 mb-2">
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-emerald-600" name="sports_logo_badge" value="{{ old('sports_logo_badge', $data->sports_logo_badge ?? '') }}" placeholder="Badge Text (e.g. 10-12)">
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800" name="sports_logo_text" value="{{ old('sports_logo_text', $data->sports_logo_text ?? '') }}" placeholder="Sports Title (e.g. SPORTS)">
                            </div>
                            <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-500" name="sports_logo_tagline" value="{{ old('sports_logo_tagline', $data->sports_logo_tagline ?? '') }}" placeholder="Tagline (e.g. Grassroots to Glory)">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. SHARED VISION & MISSION CARD -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">
                <div class="p-5 bg-gradient-to-r from-sky-50 to-indigo-50/50 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center font-bold text-xl shadow-md shadow-sky-500/20">
                            <i class="bx bx-target-lock"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-900 text-base m-0">3. Shared Vision & Mission Section</h5>
                            <p class="text-xs text-slate-500 m-0">Manage 3-card foundation grid (Vision, Mission points, and Tournament Success)</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Kicker</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sky-600 uppercase" name="vision_kicker" value="{{ old('vision_kicker', $data->vision_kicker ?? '') }}" placeholder="OUR FOUNDATION">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Section Title</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800" name="vision_title" value="{{ old('vision_title', $data->vision_title ?? '') }}" placeholder="Shared Vision & Mission">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Section Subtitle</label>
                            <textarea class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-600" name="vision_subtitle" rows="2">{{ old('vision_subtitle', $data->vision_subtitle ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-slate-100 pt-4">
                        <!-- Vision Card -->
                        <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200/80 flex flex-col justify-between">
                            <div>
                                <h6 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2 flex items-center gap-1.5"><i class="bx bx-show text-base"></i> Card 1: Our Vision</h6>
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 mb-2" name="vision_card_title" value="{{ old('vision_card_title', $data->vision_card_title ?? '') }}" placeholder="Card Title">
                                <textarea class="w-full text-xs px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-600" name="vision_card_text" rows="5" placeholder="Vision description text...">{{ old('vision_card_text', $data->vision_card_text ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Mission Card -->
                        <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200/80 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <h6 class="text-xs font-bold text-emerald-600 uppercase tracking-wider flex items-center gap-1.5 m-0"><i class="bx bx-target-lock text-base"></i> Card 2: Our Mission</h6>
                                    <button type="button" id="add-mission-item" class="px-2 py-0.5 bg-emerald-100 text-emerald-700 font-bold text-[10px] rounded hover:bg-emerald-200 cursor-pointer">+ Add</button>
                                </div>
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 mb-2" name="mission_card_title" value="{{ old('mission_card_title', $data->mission_card_title ?? '') }}" placeholder="Card Title">
                                <div id="mission-items-container" class="space-y-1.5">
                                    @if(!empty($missionList))
                                        @foreach($missionList as $mItem)
                                            <div class="flex items-center gap-1.5 mission-row">
                                                <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600" name="mission_items[]" value="{{ $mItem }}">
                                                <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex items-center gap-1.5 mission-row">
                                            <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600" name="mission_items[]" placeholder="Mission point...">
                                            <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Tournament Card -->
                        <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200/80 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <h6 class="text-xs font-bold text-amber-600 uppercase tracking-wider flex items-center gap-1.5 m-0"><i class="bx bx-trophy text-base"></i> Card 3: Success</h6>
                                    <button type="button" id="add-tournament-item" class="px-2 py-0.5 bg-amber-100 text-amber-800 font-bold text-[10px] rounded hover:bg-amber-200 cursor-pointer">+ Add</button>
                                </div>
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 mb-2" name="tournament_card_title" value="{{ old('tournament_card_title', $data->tournament_card_title ?? '') }}" placeholder="Card Title">
                                <div id="tournament-items-container" class="space-y-1.5">
                                    @if(!empty($tournamentList))
                                        @foreach($tournamentList as $tItem)
                                            <div class="flex items-center gap-1.5 tournament-row">
                                                <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-700 font-medium" name="tournament_items[]" value="{{ $tItem }}">
                                                <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex items-center gap-1.5 tournament-row">
                                            <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-700 font-medium" name="tournament_items[]" placeholder="Achievement name...">
                                            <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. NOTABLE PLAYERS CARD -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">
                <div class="p-5 bg-gradient-to-r from-amber-50 to-orange-50/50 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center font-bold text-xl shadow-md shadow-amber-500/20">
                            <i class="bx bx-user-pin"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-900 text-base m-0">4. Notable Players Section</h5>
                            <p class="text-xs text-slate-500 m-0">Add & edit player profile cards, achievements, category tags, and optional photos</p>
                        </div>
                    </div>
                    <button type="button" id="add-player-row" class="px-3.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded-lg transition-all shadow-xs flex items-center gap-1 cursor-pointer">
                        <i class="bx bx-plus text-base"></i> Add Player
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Kicker</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl font-bold text-amber-600 uppercase" name="players_kicker" value="{{ old('players_kicker', $data->players_kicker ?? '') }}" placeholder="SUCCESS STORIES">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Title</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800" name="players_title" value="{{ old('players_title', $data->players_title ?? '') }}" placeholder="Notable Players">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Subtitle</label>
                            <textarea class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-600" name="players_subtitle" rows="2">{{ old('players_subtitle', $data->players_subtitle ?? '') }}</textarea>
                        </div>
                    </div>

                    <div id="players-container" class="space-y-3 border-t border-slate-100 pt-4">
                        @if(!empty($playersList))
                            @foreach($playersList as $pIdx => $player)
                                <div class="bg-slate-50/80 rounded-xl p-3.5 border border-slate-200/80 hover:border-amber-300 transition-all player-row">
                                    <div class="flex flex-col md:flex-row items-center gap-3">
                                        <div class="w-full md:w-1/4">
                                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Player Name</label>
                                            <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 outline-none" name="player_name[{{ $pIdx }}]" value="{{ $player['name'] ?? '' }}" placeholder="Player Full Name">
                                        </div>
                                        <div class="w-full md:w-1/3">
                                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Achievement / Teams</label>
                                            <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 outline-none" name="player_achievement[{{ $pIdx }}]" value="{{ $player['achievement'] ?? '' }}" placeholder="e.g. BPL, DPL, HP Squad">
                                        </div>
                                        <div class="w-full md:w-1/6">
                                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Level Tag</label>
                                            <select class="w-full text-xs px-2 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-700 outline-none" name="player_level[{{ $pIdx }}]">
                                                <option value="National" {{ ($player['level'] ?? '') == 'National' ? 'selected' : '' }}>National</option>
                                                <option value="Youth" {{ ($player['level'] ?? '') == 'Youth' ? 'selected' : '' }}>Youth</option>
                                                <option value="Emerging" {{ ($player['level'] ?? '') == 'Emerging' ? 'selected' : '' }}>Emerging</option>
                                                <option value="Professional" {{ ($player['level'] ?? '') == 'Professional' ? 'selected' : '' }}>Professional</option>
                                                <option value="Specialist" {{ ($player['level'] ?? '') == 'Specialist' ? 'selected' : '' }}>Specialist</option>
                                                <option value="Champion" {{ ($player['level'] ?? '') == 'Champion' ? 'selected' : '' }}>Champion</option>
                                                <option value="T20" {{ ($player['level'] ?? '') == 'T20' ? 'selected' : '' }}>T20</option>
                                            </select>
                                        </div>
                                        <div class="w-full md:w-1/5">
                                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Photo (Optional)</label>
                                            <input type="hidden" name="existing_player_image[{{ $pIdx }}]" value="{{ $player['image'] ?? '' }}">
                                            <input type="file" class="block w-full text-[11px] text-slate-500 file:mr-2 file:py-0.5 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer" name="player_image[{{ $pIdx }}]">
                                        </div>
                                        <div class="shrink-0 flex items-center justify-end w-full md:w-auto self-end pb-0.5">
                                            <button type="button" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row" title="Delete Player"><i class="bx bx-trash text-base"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-slate-50/80 rounded-xl p-3.5 border border-slate-200/80 hover:border-amber-300 transition-all player-row">
                                <div class="flex flex-col md:flex-row items-center gap-3">
                                    <div class="w-full md:w-1/4">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Player Name</label>
                                        <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 outline-none" name="player_name[0]" placeholder="Player Full Name">
                                    </div>
                                    <div class="w-full md:w-1/3">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Achievement / Teams</label>
                                        <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 outline-none" name="player_achievement[0]" placeholder="e.g. BPL, DPL, HP Squad">
                                    </div>
                                    <div class="w-full md:w-1/6">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Level Tag</label>
                                        <select class="w-full text-xs px-2 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-700 outline-none" name="player_level[0]">
                                            <option value="National">National</option>
                                            <option value="Youth">Youth</option>
                                            <option value="Emerging">Emerging</option>
                                            <option value="Professional">Professional</option>
                                            <option value="Specialist">Specialist</option>
                                            <option value="Champion">Champion</option>
                                            <option value="T20">T20</option>
                                        </select>
                                    </div>
                                    <div class="w-full md:w-1/5">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Photo (Optional)</label>
                                        <input type="hidden" name="existing_player_image[0]" value="">
                                        <input type="file" class="block w-full text-[11px] text-slate-500 file:mr-2 file:py-0.5 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer" name="player_image[0]">
                                    </div>
                                    <div class="shrink-0 flex items-center justify-end w-full md:w-auto self-end pb-0.5">
                                        <button type="button" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row" title="Delete Player"><i class="bx bx-trash text-base"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 5. PARTNERSHIP IMPACT CARD -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">
                <div class="p-5 bg-gradient-to-r from-red-50 to-rose-50/50 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-red-600 text-white flex items-center justify-center font-bold text-xl shadow-md shadow-red-500/20">
                            <i class="bx bx-bar-chart-alt-2"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-900 text-base m-0">5. Partnership Impact Section</h5>
                            <p class="text-xs text-slate-500 m-0">Edit bottom impact metrics counters, titles, icons, and descriptions</p>
                        </div>
                    </div>
                    <button type="button" id="add-impact-row" class="px-3.5 py-1.5 bg-red-600 hover:bg-red-700 text-white font-bold text-xs rounded-lg transition-all shadow-xs flex items-center gap-1 cursor-pointer">
                        <i class="bx bx-plus text-base"></i> Add Impact Stat
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Kicker</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl font-bold text-red-600 uppercase" name="impact_kicker" value="{{ old('impact_kicker', $data->impact_kicker ?? '') }}" placeholder="OUR IMPACT">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Title</label>
                            <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800" name="impact_title" value="{{ old('impact_title', $data->impact_title ?? '') }}" placeholder="Partnership Impact">
                        </div>
                    </div>

                    <div id="impact-container" class="space-y-2 border-t border-slate-100 pt-4">
                        @if(!empty($impactStats))
                            @foreach($impactStats as $imp)
                                <div class="flex flex-col md:flex-row items-center gap-2.5 p-2.5 bg-slate-50/80 rounded-xl border border-slate-200/80 impact-row">
                                    <div class="w-full md:w-1/6">
                                        <input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-semibold text-slate-700" name="impact_icon[]" value="{{ $imp['icon'] ?? 'trophy' }}" placeholder="Icon">
                                    </div>
                                    <div class="w-full md:w-1/6">
                                        <input type="number" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-bold text-red-600" name="impact_count[]" value="{{ $imp['count'] ?? 0 }}" placeholder="Count">
                                    </div>
                                    <div class="w-full md:w-1/3">
                                        <input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-bold text-slate-800" name="impact_text[]" value="{{ $imp['text'] ?? '' }}" placeholder="Title">
                                    </div>
                                    <div class="w-full md:w-1/3">
                                        <input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none text-slate-500" name="impact_desc[]" value="{{ $imp['desc'] ?? '' }}" placeholder="Description">
                                    </div>
                                    <button type="button" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete Stat"><i class="bx bx-trash text-sm"></i></button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex flex-col md:flex-row items-center gap-2.5 p-2.5 bg-slate-50/80 rounded-xl border border-slate-200/80 impact-row">
                                <div class="w-full md:w-1/6"><input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-semibold text-slate-700" name="impact_icon[]" value="users" placeholder="Icon"></div>
                                <div class="w-full md:w-1/6"><input type="number" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-bold text-red-600" name="impact_count[]" value="100" placeholder="Count"></div>
                                <div class="w-full md:w-1/3"><input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-bold text-slate-800" name="impact_text[]" placeholder="Title"></div>
                                <div class="w-full md:w-1/3"><input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none text-slate-500" name="impact_desc[]" placeholder="Description"></div>
                                <button type="button" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete Stat"><i class="bx bx-trash text-sm"></i></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 6. COORDINATION & EXCELLENCE CARD -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">
                <div class="p-5 bg-gradient-to-r from-purple-50 to-slate-50/50 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center font-bold text-xl shadow-md shadow-purple-500/20">
                            <i class="bx bx-phone-call"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-900 text-base m-0">6. Coordination & Excellence Section</h5>
                            <p class="text-xs text-slate-500 m-0">Manage contact person details and bottom partnership excellence tags</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Box: Contacts -->
                        <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200/80 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <h6 class="text-xs font-bold text-purple-700 uppercase tracking-wider flex items-center gap-1.5 m-0"><i class="bx bx-user text-base"></i> Partnership Coordination</h6>
                                    <button type="button" id="add-contact-row" class="px-2.5 py-1 bg-purple-100 text-purple-700 font-bold text-[11px] rounded-md hover:bg-purple-200 cursor-pointer">+ Add Contact</button>
                                </div>
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 mb-3" name="contact_section_title" value="{{ old('contact_section_title', $data->contact_section_title ?? '') }}" placeholder="Section Title">

                                <div id="contacts-container" class="space-y-2">
                                    @if(!empty($contactCards))
                                        @foreach($contactCards as $cIdx => $cCard)
                                            <div class="p-3 bg-white rounded-lg border border-slate-200 contact-row">
                                                <div class="flex items-center gap-2">
                                                    <div class="flex-1 space-y-1.5">
                                                        <div class="grid grid-cols-2 gap-1.5">
                                                            <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded font-bold text-slate-800" name="contact_name[]" value="{{ $cCard['name'] ?? '' }}" placeholder="Name">
                                                            <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-emerald-600 font-semibold" name="contact_title[]" value="{{ $cCard['title'] ?? '' }}" placeholder="Title">
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-1.5">
                                                            <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-slate-600" name="contact_phone[]" value="{{ $cCard['phone'] ?? '' }}" placeholder="Phone">
                                                            <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-slate-500 italic" name="contact_role[]" value="{{ $cCard['role'] ?? '' }}" placeholder="Role">
                                                        </div>
                                                    </div>
                                                    <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="p-3 bg-white rounded-lg border border-slate-200 contact-row">
                                            <div class="flex items-center gap-2">
                                                <div class="flex-1 space-y-1.5">
                                                    <div class="grid grid-cols-2 gap-1.5">
                                                        <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded font-bold text-slate-800" name="contact_name[]" placeholder="Name">
                                                        <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-emerald-600 font-semibold" name="contact_title[]" placeholder="Title">
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-1.5">
                                                        <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-slate-600" name="contact_phone[]" placeholder="Phone">
                                                        <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-slate-500 italic" name="contact_role[]" placeholder="Role">
                                                    </div>
                                                </div>
                                                <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Box: Badges -->
                        <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200/80 flex flex-col justify-between">
                            <div>
                                <h6 class="text-xs font-bold text-purple-700 uppercase tracking-wider mb-2 flex items-center gap-1.5"><i class="bx bx-star text-base"></i> Partnership Excellence</h6>
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 mb-2" name="excellence_title" value="{{ old('excellence_title', $data->excellence_title ?? '') }}" placeholder="Title">
                                <textarea class="w-full text-xs px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-600 mb-3" name="excellence_text" rows="3" placeholder="Paragraph text...">{{ old('excellence_text', $data->excellence_text ?? '') }}</textarea>

                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Feature Tag Badges</label>
                                    <button type="button" id="add-badge-item" class="px-2 py-0.5 bg-purple-100 text-purple-700 font-bold text-[10px] rounded hover:bg-purple-200 cursor-pointer">+ Add Tag</button>
                                </div>
                                <div id="badges-container" class="space-y-1.5">
                                    @if(!empty($excellenceBadges))
                                        @foreach($excellenceBadges as $bItem)
                                            <div class="flex items-center gap-1.5 badge-row">
                                                <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-700 font-bold" name="excellence_badges[]" value="{{ $bItem }}">
                                                <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex items-center gap-1.5 badge-row">
                                            <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-700 font-bold" name="excellence_badges[]" placeholder="Tag name (e.g. Grassroots Development)">
                                            <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO META & SAVE ACTION CARD -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-8 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Meta Title (SEO)</label>
                        <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-800" name="meta" value="{{ old('meta', $data->meta ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Meta Description (SEO)</label>
                        <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-800" name="meta_description" value="{{ old('meta_description', $data->meta_description ?? '') }}">
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-blue-500/25 flex items-center gap-2 cursor-pointer hover:scale-[1.02]">
                        <i class="bx bx-save text-lg"></i> Save All Changes
                    </button>
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

        const deleteBtnClasses = "w-9 h-9 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row";

        // Add Hero Stat
        const addHeroStatBtn = document.getElementById('add-hero-stat');
        if (addHeroStatBtn) {
            addHeroStatBtn.addEventListener('click', function() {
                const container = document.getElementById('hero-stats-container');
                if (!container) return;
                const div = document.createElement('div');
                div.className = 'flex items-center gap-3 p-2 bg-slate-50 rounded-xl border border-slate-200/80 hero-stat-row';
                div.innerHTML = `
                    <div class="w-1/3"><input type="text" class="w-full text-xs px-3 py-2 bg-white border border-slate-200 rounded-lg outline-none font-bold text-blue-600" name="hero_stat_number[]" placeholder="e.g. 7+"></div>
                    <div class="flex-1"><input type="text" class="w-full text-xs px-3 py-2 bg-white border border-slate-200 rounded-lg outline-none text-slate-700" name="hero_stat_label[]" placeholder="e.g. Years Partnership"></div>
                    <button type="button" class="${deleteBtnClasses} shrink-0" title="Delete Stat"><i class="bx bx-trash text-base"></i></button>
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
                div.className = 'bg-slate-50/80 rounded-xl p-3.5 border border-slate-200/80 hover:border-blue-300 transition-all hero-slide-row';
                div.innerHTML = `
                    <div class="flex flex-col md:flex-row items-center justify-between gap-3">
                        <div class="flex items-center gap-3 w-full md:w-64 shrink-0">
                            <div class="w-16 h-14 rounded-lg bg-white border border-slate-200 overflow-hidden flex items-center justify-center shrink-0 shadow-2xs">
                                <i class="bx bx-image text-slate-400 text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Image File</label>
                                <input type="hidden" name="existing_slide_image[${slideIndex}]" value="">
                                <input type="file" class="block w-full text-[11px] text-slate-500 file:mr-2 file:py-0.5 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" name="slide_image[${slideIndex}]">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 flex-1 w-full">
                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Overlay Title</label>
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 outline-none" name="slide_title[${slideIndex}]" placeholder="Slide Overlay Title">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Overlay Subtitle</label>
                                <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 outline-none" name="slide_subtitle[${slideIndex}]" placeholder="Slide Overlay Subtitle">
                            </div>
                        </div>
                        <div class="shrink-0 flex items-center justify-end w-full md:w-auto">
                            <button type="button" class="${deleteBtnClasses}" title="Delete Slide"><i class="bx bx-trash text-base"></i></button>
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
                div.className = 'flex items-center gap-2 highlight-row';
                div.innerHTML = `
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 font-bold text-sm">✓</div>
                    <input type="text" class="flex-1 text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg outline-none text-slate-700 focus:bg-white focus:border-emerald-500" name="highlight_items[]" placeholder="Highlight point...">
                    <button type="button" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-200 hover:scale-105 shadow-xs cursor-pointer remove-row shrink-0" title="Delete Point"><i class="bx bx-trash text-base"></i></button>
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
                div.className = 'flex items-center gap-1.5 mission-row';
                div.innerHTML = `
                    <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600" name="mission_items[]" placeholder="Mission point...">
                    <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
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
                div.className = 'flex items-center gap-1.5 tournament-row';
                div.innerHTML = `
                    <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-700 font-medium" name="tournament_items[]" placeholder="Achievement name...">
                    <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
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
                div.className = 'bg-slate-50/80 rounded-xl p-3.5 border border-slate-200/80 hover:border-amber-300 transition-all player-row';
                div.innerHTML = `
                    <div class="flex flex-col md:flex-row items-center gap-3">
                        <div class="w-full md:w-1/4">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Player Name</label>
                            <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-800 outline-none" name="player_name[${playerIndex}]" placeholder="Player Full Name">
                        </div>
                        <div class="w-full md:w-1/3">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Achievement / Teams</label>
                            <input type="text" class="w-full text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 outline-none" name="player_achievement[${playerIndex}]" placeholder="e.g. BPL, DPL, HP Squad">
                        </div>
                        <div class="w-full md:w-1/6">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Level Tag</label>
                            <select class="w-full text-xs px-2 py-1.5 bg-white border border-slate-200 rounded-lg font-bold text-slate-700 outline-none" name="player_level[${playerIndex}]">
                                <option value="National">National</option>
                                <option value="Youth">Youth</option>
                                <option value="Emerging">Emerging</option>
                                <option value="Professional">Professional</option>
                                <option value="Specialist">Specialist</option>
                                <option value="Champion">Champion</option>
                                <option value="T20">T20</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/5">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Photo (Optional)</label>
                            <input type="hidden" name="existing_player_image[${playerIndex}]" value="">
                            <input type="file" class="block w-full text-[11px] text-slate-500 file:mr-2 file:py-0.5 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer" name="player_image[${playerIndex}]">
                        </div>
                        <div class="shrink-0 flex items-center justify-end w-full md:w-auto self-end pb-0.5">
                            <button type="button" class="${deleteBtnClasses}" title="Delete Player"><i class="bx bx-trash text-base"></i></button>
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
                div.className = 'flex flex-col md:flex-row items-center gap-2.5 p-2.5 bg-slate-50/80 rounded-xl border border-slate-200/80 impact-row';
                div.innerHTML = `
                    <div class="w-full md:w-1/6"><input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-semibold text-slate-700" name="impact_icon[]" value="trophy" placeholder="Icon"></div>
                    <div class="w-full md:w-1/6"><input type="number" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-bold text-red-600" name="impact_count[]" value="0" placeholder="Count"></div>
                    <div class="w-full md:w-1/3"><input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none font-bold text-slate-800" name="impact_text[]" placeholder="Title"></div>
                    <div class="w-full md:w-1/3"><input type="text" class="w-full text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg outline-none text-slate-500" name="impact_desc[]" placeholder="Description"></div>
                    <button type="button" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete Stat"><i class="bx bx-trash text-sm"></i></button>
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
                div.className = 'p-3 bg-white rounded-lg border border-slate-200 contact-row';
                div.innerHTML = `
                    <div class="flex items-center gap-2">
                        <div class="flex-1 space-y-1.5">
                            <div class="grid grid-cols-2 gap-1.5">
                                <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded font-bold text-slate-800" name="contact_name[]" placeholder="Name">
                                <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-emerald-600 font-semibold" name="contact_title[]" placeholder="Title">
                            </div>
                            <div class="grid grid-cols-2 gap-1.5">
                                <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-slate-600" name="contact_phone[]" placeholder="Phone">
                                <input type="text" class="w-full text-xs px-2.5 py-1 bg-slate-50 border border-slate-200 rounded text-slate-500 italic" name="contact_role[]" placeholder="Role">
                            </div>
                        </div>
                        <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
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
                div.className = 'flex items-center gap-1.5 badge-row';
                div.innerHTML = `
                    <input type="text" class="flex-1 text-xs px-2.5 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-700 font-bold" name="excellence_badges[]" placeholder="Tag name...">
                    <button type="button" class="w-7 h-7 inline-flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-all remove-row shrink-0" title="Delete"><i class="bx bx-trash text-xs"></i></button>
                `;
                container.appendChild(div);
            });
        }
    });
</script>
@endsection
@endsection
