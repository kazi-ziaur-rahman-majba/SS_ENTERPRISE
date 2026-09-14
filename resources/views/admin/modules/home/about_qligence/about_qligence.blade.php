@extends('admin.layouts.app')
@section('title', 'About us')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">About us</li>
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
                            <div class="card-title d-flex align-items-center mb-4">
                                <div>
                                    <i class="bx bxs-pen me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Manage About Us Homepage Section</h5>
                            </div>
                            <hr>

                            <form class="row g-4"
                                @if (isset($data)) action="{{ route('home-about-us.update', [$data->id]) }}"
                                @else action="{{ route('home-about-us.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <!-- Section 1: Main Content -->
                                <div class="col-12">
                                    <h6 class="text-uppercase text-primary fw-bold mb-3"><i class="bx bx-info-circle me-1"></i> Main Content (Left Column)</h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="sub_title" class="form-label font-semibold">Sub Badge Title</label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title"
                                        value="{{ old('sub_title', $data->sub_title ?? 'ABOUT US') }}" placeholder="e.g. ABOUT US">
                                </div>

                                <div class="col-md-6">
                                    <label for="title" class="form-label font-semibold">Main Section Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $data->title ?? '') }}" placeholder="e.g. Building Trust. Delivering Excellence." required>
                                </div>

                                <div class="col-md-12">
                                    <label for="detail" class="form-label font-semibold">Main Description / Detail</label>
                                    <textarea name="detail" id="mytextarea" rows="5" class="form-control">{!! old('detail', $data->detail ?? '') !!}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="button_title" class="form-label font-semibold">Button Title</label>
                                    <input type="text" class="form-control" id="button_title" name="button_title"
                                        value="{{ old('button_title', $data->button_title ?? 'MORE INFORMATION') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="button_link" class="form-label font-semibold">Button Link</label>
                                    <input type="text" class="form-control" id="button_link" name="button_link"
                                        value="{{ old('button_link', $data->button_link ?? '/about-us') }}">
                                </div>

                                <!-- Checkmark Bullet Points -->
                                <div class="col-12 mt-4">
                                    <h6 class="text-uppercase text-primary fw-bold mb-3"><i class="bx bx-check-square me-1"></i> Key Highlights (6 Checkmark Bullet Points)</h6>
                                </div>

                                <div class="col-md-4">
                                    <label for="check_1" class="form-label">Check Item 1</label>
                                    <input type="text" class="form-control" id="check_1" name="check_1"
                                        value="{{ old('check_1', $data->check_1 ?? 'Quality Construction') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="check_2" class="form-label">Check Item 2</label>
                                    <input type="text" class="form-control" id="check_2" name="check_2"
                                        value="{{ old('check_2', $data->check_2 ?? 'Professional Team') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="check_3" class="form-label">Check Item 3</label>
                                    <input type="text" class="form-control" id="check_3" name="check_3"
                                        value="{{ old('check_3', $data->check_3 ?? 'On Time Delivery') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="check_4" class="form-label">Check Item 4</label>
                                    <input type="text" class="form-control" id="check_4" name="check_4"
                                        value="{{ old('check_4', $data->check_4 ?? 'Modern Equipment') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="check_5" class="form-label">Check Item 5</label>
                                    <input type="text" class="form-control" id="check_5" name="check_5"
                                        value="{{ old('check_5', $data->check_5 ?? 'Certified Engineers') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="check_6" class="form-label">Check Item 6</label>
                                    <input type="text" class="form-control" id="check_6" name="check_6"
                                        value="{{ old('check_6', $data->check_6 ?? '24/7 Support') }}">
                                </div>

                                <!-- Section 2: Main Image & Experience Overlay Badge -->
                                <div class="col-12 mt-4">
                                    <hr>
                                    <h6 class="text-uppercase text-primary fw-bold mb-3"><i class="bx bx-image me-1"></i> Section Image & Experience Badge (Middle Column)</h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="first_image" class="form-label">Main Image [ Max Limit 2MB ]</label>
                                    <input type="file" class="form-control" id="first_image" name="first_image">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Current Image Preview</label>
                                    @if (isset($data) && !empty($data->first_image))
                                        <img src="{{ url($data->first_image) }}" height="70" class="rounded border shadow-sm">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="70" class="rounded border">
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="experience_years" class="form-label">Image Badge Years/Count</label>
                                    <input type="text" class="form-control" id="experience_years" name="experience_years"
                                        value="{{ old('experience_years', $data->experience_years ?? '27+') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="experience_label" class="form-label">Image Badge Label</label>
                                    <input type="text" class="form-control" id="experience_label" name="experience_label"
                                        value="{{ old('experience_label', $data->experience_label ?? 'Years of Experience') }}">
                                </div>

                                <!-- Section 3: Interactive Right Column Tabs -->
                                <div class="col-12 mt-4">
                                    <hr>
                                    <h6 class="text-uppercase text-primary fw-bold mb-3"><i class="bx bx-layer me-1"></i> Interactive Tabs Content (Right Column)</h6>
                                </div>

                                <!-- Tab 1: Trust -->
                                <div class="col-12 bg-light p-3 rounded border">
                                    <h6 class="fw-bold text-dark mb-3"><i class="bx bx-shield-check text-primary me-1"></i> 1. Trust Tab</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Trust Item 1 Title</label>
                                            <input type="text" class="form-control" name="trust_title_one" value="{{ old('trust_title_one', $data->trust_title_one ?? 'Proven Track Record') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Trust Item 1 Detail</label>
                                            <textarea name="trust_detail_one" rows="2" class="form-control">{!! old('trust_detail_one', $data->trust_detail_one ?? 'Delivering top-tier quality across complex infrastructure projects.') !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Trust Item 2 Title</label>
                                            <input type="text" class="form-control" name="trust_title_two" value="{{ old('trust_title_two', $data->trust_title_two ?? 'Transparent Process') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Trust Item 2 Detail</label>
                                            <textarea name="trust_detail_two" rows="2" class="form-control">{!! old('trust_detail_two', $data->trust_detail_two ?? 'Clear communication, fair pricing, and full reporting at every phase.') !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Trust Item 3 Title</label>
                                            <input type="text" class="form-control" name="trust_title_three" value="{{ old('trust_title_three', $data->trust_title_three ?? 'Client Satisfaction') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Trust Item 3 Detail</label>
                                            <textarea name="trust_detail_three" rows="2" class="form-control">{!! old('trust_detail_three', $data->trust_detail_three ?? 'Long-term client relationships built on dependability and integrity.') !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 2: Expertise -->
                                <div class="col-12 bg-light p-3 rounded border mt-3">
                                    <h6 class="fw-bold text-dark mb-3"><i class="bx bx-wrench text-primary me-1"></i> 2. Expertise Tab</h6>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Expertise Overview Detail</label>
                                            <textarea name="expertise_detail" rows="2" class="form-control">{!! old('expertise_detail', $data->expertise_detail ?? '') !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Expertise Item 1 Title</label>
                                            <input type="text" class="form-control" name="expertise_title_one" value="{{ old('expertise_title_one', $data->expertise_title_one ?? 'Advanced Engineering') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Expertise Item 1 Detail</label>
                                            <textarea name="expertise_detail_one" rows="2" class="form-control">{!! old('expertise_detail_one', $data->expertise_detail_one ?? 'Utilizing modern structural engineering methodologies.') !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Expertise Item 2 Title</label>
                                            <input type="text" class="form-control" name="expertise_title_two" value="{{ old('expertise_title_two', $data->expertise_title_two ?? 'Skilled Workforce') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Expertise Item 2 Detail</label>
                                            <textarea name="expertise_detail_two" rows="2" class="form-control">{!! old('expertise_detail_two', $data->expertise_detail_two ?? 'Highly trained project managers, site engineers, and specialists.') !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Expertise Item 3 Title</label>
                                            <input type="text" class="form-control" name="expertise_title_three" value="{{ old('expertise_title_three', $data->expertise_title_three ?? 'Quality Control') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Expertise Item 3 Detail</label>
                                            <textarea name="expertise_detail_three" rows="2" class="form-control">{!! old('expertise_detail_three', $data->expertise_detail_three ?? 'Strict quality standards and continuous site inspection.') !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 3: Safety -->
                                <div class="col-12 bg-light p-3 rounded border mt-3">
                                    <h6 class="fw-bold text-dark mb-3"><i class="bx bx-health text-primary me-1"></i> 3. Safety Tab</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="safety_image" class="form-label">Safety Image [ Max Limit 2MB ]</label>
                                            <input type="file" class="form-control" id="safety_image" name="safety_image">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label d-block">Current Safety Image</label>
                                            @if (isset($data) && !empty($data->safety_image))
                                                <img src="{{ url($data->safety_image) }}" height="50" class="rounded border shadow-sm">
                                            @else
                                                <img src="{{ asset('/uploads/images/noImage.png') }}" height="50" class="rounded border">
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Safety Overview Detail</label>
                                            <textarea name="safety_detail" rows="2" class="form-control">{!! old('safety_detail', $data->safety_detail ?? '') !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Safety Item 1 Title</label>
                                            <input type="text" class="form-control" name="safety_title_one" value="{{ old('safety_title_one', $data->safety_title_one ?? 'Zero Accident Policy') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Safety Item 1 Detail</label>
                                            <textarea name="safety_detail_one" rows="2" class="form-control">{!! old('safety_detail_one', $data->safety_detail_one ?? 'Enforcing comprehensive health and safety regulations on all job sites.') !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Safety Item 2 Title</label>
                                            <input type="text" class="form-control" name="safety_title_two" value="{{ old('safety_title_two', $data->safety_title_two ?? 'Certified Protective Gear') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Safety Item 2 Detail</label>
                                            <textarea name="safety_detail_two" rows="2" class="form-control">{!! old('safety_detail_two', $data->safety_detail_two ?? 'Equipping all workers with standard PPE and safety equipment.') !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Safety Item 3 Title</label>
                                            <input type="text" class="form-control" name="safety_title_three" value="{{ old('safety_title_three', $data->safety_title_three ?? 'Regular Safety Audits') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Safety Item 3 Detail</label>
                                            <textarea name="safety_detail_three" rows="2" class="form-control">{!! old('safety_detail_three', $data->safety_detail_three ?? 'Conducting routine risk assessments and emergency protocol training.') !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="bx bx-check font-18 me-1"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
