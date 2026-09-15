@extends('admin.layouts.app')
@section('title', 'Mission Vision CMS')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mission Vision & Core Values</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @include('admin.extras.alert')
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div>
                                    <i class="bx bxs-pen me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Manage Mission, Vision & Core Values Page</h5>
                            </div>
                            <hr>
                            <form class="row g-3"
                                @if (isset($data)) action="{{ route('mission-vision.update', [$data->id]) }}" 
                                @else
                                    action="{{ route('mission-vision.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <!-- Page & Banner Info -->
                                <div class="col-md-6">
                                    <label for="banner_title" class="form-label font-weight-bold">Banner Title</label>
                                    <input type="text" class="form-control" id="banner_title" name="banner_title"
                                        value="{{ old('banner_title', $data->banner_title ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="page_title" class="form-label font-weight-bold">Page Title (Breadcrumb)</label>
                                    <input type="text" class="form-control" id="page_title" name="page_title"
                                        value="{{ old('page_title', $data->page_title ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="banner_image" class="form-label font-weight-bold">Banner Image [Recommended: 1920 x 500]</label>
                                    <input type="file" class="form-control" id="banner_image" name="banner_image">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Current Banner Image</label>
                                    @if (isset($data) && $data->banner_image)
                                        <img src="{{ asset($data->banner_image) }}" height="60px" class="rounded border p-1">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="60px" class="rounded border p-1">
                                    @endif
                                </div>

                                <div class="col-12"><hr><h5 class="text-primary mb-0">1. Mission Section</h5></div>

                                <div class="col-md-12">
                                    <label for="mission_title" class="form-label font-weight-bold">Mission Title</label>
                                    <input type="text" class="form-control" id="mission_title" name="mission_title"
                                        value="{{ old('mission_title', $data->mission_title ?? 'Our Mission') }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="mission_details" class="form-label font-weight-bold">Mission Details</label>
                                    <textarea name="mission_details" id="editor1" rows="5" class="form-control tinymce-editor">{!! old('mission_details', $data->mission_details ?? '') !!}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="mission_image" class="form-label font-weight-bold">Mission Section Image [Recommended: 800 x 550]</label>
                                    <input type="file" class="form-control" id="mission_image" name="mission_image">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Current Mission Image</label>
                                    @if (isset($data) && $data->mission_image)
                                        <img src="{{ asset($data->mission_image) }}" height="70px" class="rounded border p-1">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="70px" class="rounded border p-1">
                                    @endif
                                </div>

                                <div class="col-12"><hr><h5 class="text-primary mb-0">2. Vision Section</h5></div>

                                <div class="col-md-12">
                                    <label for="vision_title" class="form-label font-weight-bold">Vision Title</label>
                                    <input type="text" class="form-control" id="vision_title" name="vision_title"
                                        value="{{ old('vision_title', $data->vision_title ?? 'Our Vision') }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="vision_details" class="form-label font-weight-bold">Vision Details</label>
                                    <textarea name="vision_details" id="editor2" rows="5" class="form-control tinymce-editor">{!! old('vision_details', $data->vision_details ?? '') !!}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="vision_image" class="form-label font-weight-bold">Vision Section Image [Recommended: 800 x 550]</label>
                                    <input type="file" class="form-control" id="vision_image" name="vision_image">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Current Vision Image</label>
                                    @if (isset($data) && $data->vision_image)
                                        <img src="{{ asset($data->vision_image) }}" height="70px" class="rounded border p-1">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="70px" class="rounded border p-1">
                                    @endif
                                </div>

                                <div class="col-12"><hr><h5 class="text-primary mb-0">3. Core Values Section</h5></div>

                                <div class="col-md-12">
                                    <label for="core_values_title" class="form-label font-weight-bold">Core Values Section Title</label>
                                    <input type="text" class="form-control" id="core_values_title" name="core_values_title"
                                        value="{{ old('core_values_title', $data->core_values_title ?? 'Core Values') }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="core_values_details" class="form-label font-weight-bold">Core Values Intro / Overview Text</label>
                                    <textarea name="core_values_details" id="editor3" rows="4" class="form-control tinymce-editor">{!! old('core_values_details', $data->core_values_details ?? '') !!}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="core_values_image" class="form-label font-weight-bold">Core Values Image [Recommended: 800 x 550]</label>
                                    <input type="file" class="form-control" id="core_values_image" name="core_values_image">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Current Core Values Image</label>
                                    @if (isset($data) && $data->core_values_image)
                                        <img src="{{ asset($data->core_values_image) }}" height="70px" class="rounded border p-1">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="70px" class="rounded border p-1">
                                    @endif
                                </div>

                                <!-- Dynamic Core Values Items Repeater -->
                                <div class="col-12 mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 text-dark font-weight-bold">Individual Core Value Items (Grid Layout)</h6>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-value-btn">
                                            <i class="bx bx-plus"></i> Add New Value Item
                                        </button>
                                    </div>
                                    <div id="core-values-container" class="row g-3">
                                        @php
                                            $defaultItems = [
                                                ['title' => 'Excellence', 'description' => 'We strive for excellence in all that we do.', 'icon' => 'Star'],
                                                ['title' => 'Accountability', 'description' => 'We take responsibility for our actions and outcomes.', 'icon' => 'Users'],
                                                ['title' => 'Integrity', 'description' => 'We conduct ourselves with honesty and integrity at all times.', 'icon' => 'ShieldCheck'],
                                                ['title' => 'Customer Focus', 'description' => 'We prioritize the needs and satisfaction of our customers.', 'icon' => 'UserCheck'],
                                                ['title' => 'Innovation', 'description' => 'We embrace innovation to drive continuous improvement.', 'icon' => 'Lightbulb'],
                                                ['title' => 'Growth', 'description' => 'We are committed to personal and professional growth for our team members.', 'icon' => 'TrendingUp']
                                            ];
                                            $items = (isset($data) && !empty($data->core_values_items)) ? $data->core_values_items : $defaultItems;
                                        @endphp
                                        @foreach ($items as $index => $item)
                                            <div class="col-md-6 value-item-row" data-index="{{ $index }}">
                                                <div class="card border mb-0">
                                                    <div class="card-body p-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="badge bg-primary">Item #<span class="item-number">{{ $index + 1 }}</span></span>
                                                            <button type="button" class="btn btn-sm btn-outline-danger remove-value-btn">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small mb-1">Title</label>
                                                            <input type="text" class="form-control form-control-sm" name="core_values_items[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" placeholder="e.g. Excellence">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small mb-1">Icon Name (Lucide Icon)</label>
                                                            <select class="form-select form-select-sm" name="core_values_items[{{ $index }}][icon]">
                                                                <option value="Star" {{ ($item['icon'] ?? '') == 'Star' ? 'selected' : '' }}>Star (Excellence)</option>
                                                                <option value="Users" {{ ($item['icon'] ?? '') == 'Users' ? 'selected' : '' }}>Users (Accountability)</option>
                                                                <option value="ShieldCheck" {{ ($item['icon'] ?? '') == 'ShieldCheck' ? 'selected' : '' }}>ShieldCheck (Integrity)</option>
                                                                <option value="UserCheck" {{ ($item['icon'] ?? '') == 'UserCheck' ? 'selected' : '' }}>UserCheck (Customer Focus)</option>
                                                                <option value="Lightbulb" {{ ($item['icon'] ?? '') == 'Lightbulb' ? 'selected' : '' }}>Lightbulb (Innovation)</option>
                                                                <option value="TrendingUp" {{ ($item['icon'] ?? '') == 'TrendingUp' ? 'selected' : '' }}>TrendingUp (Growth)</option>
                                                                <option value="Award" {{ ($item['icon'] ?? '') == 'Award' ? 'selected' : '' }}>Award</option>
                                                                <option value="CheckCircle" {{ ($item['icon'] ?? '') == 'CheckCircle' ? 'selected' : '' }}>CheckCircle</option>
                                                                <option value="Heart" {{ ($item['icon'] ?? '') == 'Heart' ? 'selected' : '' }}>Heart</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="form-label small mb-1">Short Description</label>
                                                            <textarea class="form-control form-control-sm" name="core_values_items[{{ $index }}][description]" rows="2" placeholder="Brief details about this value...">{{ $item['description'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Objective (Optional/Legacy) -->
                                <div class="col-12"><hr><h5 class="text-secondary mb-0">4. Objective / General Settings</h5></div>
                                <div class="col-md-12">
                                    <label for="objective_title" class="form-label font-weight-bold">Objective Title</label>
                                    <input type="text" class="form-control" id="objective_title" name="objective_title"
                                        value="{{ old('objective_title', $data->objective_title ?? 'Our Objective') }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="objective_details" class="form-label font-weight-bold">Objective Detail</label>
                                    <textarea name="objective_details" id="mytextarea" rows="4" class="form-control tinymce-editor">{!! old('objective_details', $data->objective_details ?? '') !!}</textarea>
                                </div>

                                <!-- SEO / Meta -->
                                <div class="col-12"><hr><h5 class="text-secondary mb-0">5. SEO / Meta Tag Settings</h5></div>
                                <div class="col-md-12">
                                    <label for="meta" class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta" name="meta"
                                        value="{{ old('meta', $data->meta ?? '') }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="3" class="form-control">{{ old('meta_description', $data->meta_description ?? '') }}</textarea>
                                </div>
                                
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary px-5 btn-lg">
                                        <i class="fadeIn animated bx bx-check me-1"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('core-values-container');
            const addBtn = document.getElementById('add-value-btn');

            function updateItemNumbers() {
                const rows = container.querySelectorAll('.value-item-row');
                rows.forEach((row, idx) => {
                    row.querySelector('.item-number').textContent = idx + 1;
                    row.querySelectorAll('[name]').forEach(input => {
                        const name = input.getAttribute('name');
                        input.setAttribute('name', name.replace(/core_values_items\[\d+\]/, `core_values_items[${idx}]`));
                    });
                });
            }

            addBtn.addEventListener('click', function() {
                const index = container.querySelectorAll('.value-item-row').length;
                const newCard = document.createElement('div');
                newCard.className = 'col-md-6 value-item-row';
                newCard.setAttribute('data-index', index);
                newCard.innerHTML = `
                    <div class="card border mb-0">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary">Item #<span class="item-number">${index + 1}</span></span>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-value-btn">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Title</label>
                                <input type="text" class="form-control form-control-sm" name="core_values_items[${index}][title]" placeholder="e.g. Excellence">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Icon Name (Lucide Icon)</label>
                                <select class="form-select form-select-sm" name="core_values_items[${index}][icon]">
                                    <option value="Star">Star (Excellence)</option>
                                    <option value="Users">Users (Accountability)</option>
                                    <option value="ShieldCheck">ShieldCheck (Integrity)</option>
                                    <option value="UserCheck">UserCheck (Customer Focus)</option>
                                    <option value="Lightbulb">Lightbulb (Innovation)</option>
                                    <option value="TrendingUp">TrendingUp (Growth)</option>
                                    <option value="Award">Award</option>
                                    <option value="CheckCircle">CheckCircle</option>
                                    <option value="Heart">Heart</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label small mb-1">Short Description</label>
                                <textarea class="form-control form-control-sm" name="core_values_items[${index}][description]" rows="2" placeholder="Brief details about this value..."></textarea>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(newCard);
                updateItemNumbers();
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-value-btn')) {
                    const row = e.target.closest('.value-item-row');
                    if (row) {
                        row.remove();
                        updateItemNumbers();
                    }
                }
            });

            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    if (typeof tinymce !== 'undefined') {
                        tinymce.triggerSave();
                    }
                });
            }
        });
    </script>
@endsection
