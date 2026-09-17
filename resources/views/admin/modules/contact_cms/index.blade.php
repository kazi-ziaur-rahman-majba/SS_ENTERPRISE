@extends('admin.layouts.app')
@section('title', 'Contact Page CMS')

@section('header-css')
<script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
<div class="page-wrapper p-4 sm:p-6 bg-slate-50 min-h-screen">
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight">Contact Page CMS</h1>
            <nav class="flex items-center gap-2 text-xs text-slate-500 mt-1">
                <a href="{{ route('admin_home') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <span>/</span>
                <span class="text-slate-700 font-medium">Contact Page CMS</span>
            </nav>
        </div>
    </div>

    @include('admin.extras.alert')

    <form action="{{ route('contact-page-cms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Banner Settings Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6 overflow-hidden">
            <div class="p-5 bg-gradient-to-r from-blue-50 to-indigo-50/50 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xl shadow-md shadow-blue-500/20">
                        <i class="bx bx-image-alt"></i>
                    </div>
                    <div>
                        <h5 class="font-bold text-slate-900 text-base m-0">Contact Banner Settings</h5>
                        <p class="text-xs text-slate-500 m-0">Manage contact page top banner title, subtitle & background image</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Banner Main Title</label>
                        <input type="text" class="w-full text-sm px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all font-semibold text-slate-800" name="banner_title" value="{{ old('banner_title', $data->banner_title ?? 'Contact Us') }}" placeholder="e.g. Contact Us">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Breadcrumb Title</label>
                        <input type="text" class="w-full text-sm px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all font-semibold text-slate-800" name="page_title" value="{{ old('page_title', $data->page_title ?? 'Contact') }}" placeholder="e.g. Contact">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Banner Background Image</label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                        @if(!empty($data->banner_image))
                            <div class="relative group shrink-0">
                                <img src="{{ asset($data->banner_image) }}" alt="Current Banner" class="w-32 h-20 object-cover rounded-lg border border-slate-300 shadow-xs">
                                <span class="absolute top-1 right-1 bg-slate-900/80 text-white text-[10px] px-1.5 py-0.5 rounded">Current</span>
                            </div>
                        @endif
                        <div class="flex-1 w-full">
                            <input type="file" name="banner_image" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                            <p class="text-[11px] text-slate-400 mt-1.5">Recommended resolution: 1920x400px (Max file size: 5MB)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Meta Settings -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-8 p-6">
            <h6 class="text-xs font-bold text-slate-600 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                <i class="bx bx-search-alt text-base text-blue-600"></i> SEO Meta Configuration
            </h6>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Meta Title (SEO)</label>
                    <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-800" name="meta" value="{{ old('meta', $data->meta ?? '') }}" placeholder="Meta Title">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Meta Description (SEO)</label>
                    <input type="text" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-800" name="meta_description" value="{{ old('meta_description', $data->meta_description ?? '') }}" placeholder="Meta Description">
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-blue-500/25 flex items-center gap-2 cursor-pointer hover:scale-[1.02]">
                    <i class="bx bx-save text-lg"></i> Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
