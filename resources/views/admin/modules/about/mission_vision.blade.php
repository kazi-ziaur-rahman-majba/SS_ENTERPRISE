@extends('admin.layouts.app')
@section('title', 'Mission Vision CMS')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                {{-- <div class="breadcrumb-title pe-3">mission-vision</div> --}}
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mission Vision</li>
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
                                <h5 class="mb-0 text-primary">Please Fillup All The Require Fields</h5>
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
                                <div class="col-md-12">
                                    <label for="banner_title" class="form-label">Banner title</label>
                                    <input type="text" class="form-control" id="banner_title" name="banner_title"
                                        @if (isset($data)) value="{{ $data->banner_title }}" @endif required>
                                </div>
                                <div class="col-md-12">
                                    <label for="page_title" class="form-label">Page title</label>
                                    <input type="text" class="form-control" id="page_title" name="page_title"
                                        @if (isset($data)) value="{{ $data->page_title }}" @endif required>
                                </div>
                                <div class="col-md-6">
                                    <label for="banner_image" class="form-label">Banner image: [ Size - 1170 X 640, Max
                                        Limit
                                        200KB ]
                                    </label>
                                    <input type="file" class="form-control" id="banner_image" name="banner_image">
                                </div>
                                <div class="col-md-6">
                                    @if (isset($data))
                                        <img src="{{ url($data->banner_image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                        <input type="hidden" name="ex_banner_image" value="{{ $data->banner_image }}">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <label for="objective_title" class="form-label">Objective title</label>
                                    <input type="text" class="form-control" id="objective_title" name="objective_title"
                                        @if (isset($data)) value="{{ $data->objective_title }}" @endif required>
                                </div>
                                <div class="col-md-12">
                                    <label for="objective_details" class="form-label">Objective detail</label>
                                    <textarea name="objective_details" id="mytextarea" rows="3" class="form-control">
                                        @if (isset($data))
                                            {{ $data->objective_details }}
                                            @endif
                                    </textarea>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="mission_title" class="form-label">Mission title</label>
                                    <input type="text" class="form-control" id="mission_title" name="mission_title"
                                        @if (isset($data)) value="{{ $data->mission_title }}" @endif required>
                                </div>
                                <div class="col-md-12">
                                    <label for="mission_details" class="form-label">Mission detail</label>
                                    <textarea name="mission_details" id="mytextarea" rows="3" class="form-control">
                                        @if (isset($data))
                                            {{ $data->mission_details }}
                                            @endif
                                    </textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="vision_title" class="form-label">Vision title</label>
                                    <input type="text" class="form-control" id="vision_title" name="vision_title"
                                        @if (isset($data)) value="{{ $data->vision_title }}" @endif required>
                                </div>
                                <div class="col-md-12">
                                    <label for="vision_details" class="form-label">Vision detail</label>
                                    <textarea name="vision_details" id="mytextarea" rows="3" class="form-control">
                                        @if (isset($data))
                                            {{ $data->vision_details }}
                                            @endif
                                    </textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="core_values_title" class="form-label">Core Values title</label>
                                    <input type="text" class="form-control" id="core_values_title" name="core_values_title"
                                        @if (isset($data)) value="{{ $data->core_values_title }}" @endif required>
                                </div>
                                <div class="col-md-12">
                                    <label for="core_values_details" class="form-label">Core Values detail</label>
                                    <textarea name="core_values_details" id="mytextarea" rows="3" class="form-control">
                                        @if (isset($data))
                                            {{ $data->core_values_details }}
                                            @endif
                                    </textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="meta" class="form-label">Meta</label>
                                    <input type="text" class="form-control" id="name" name="meta"
                                        @if (isset($data)) value="{{ $data->meta }}" @endif >
                                </div>
                                <div class="col-md-12">
                                    <label for="meta_description" class="form-label">Meta description</label>
                                    <textarea name="meta_description" rows="5" class="form-control">
                                        @if (isset($data)) {{ $data->meta_description }} @endif
                                    </textarea>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary"> <i
                                            class="fadeIn animated bx bx-check"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
