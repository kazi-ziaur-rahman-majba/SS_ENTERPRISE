@extends('admin.layouts.app')
@section('title', 'Our Business Page CMS')
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
                            <li class="breadcrumb-item active" aria-current="page">Our Business Page</li>
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
                                @if (isset($data)) action="{{ route('service-page-cms.update', [$data->id]) }}" 
                                    
                                @else
                                    action="{{ route('service-page-cms.store') }}" @endif
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
                                    <label for="detail_page_title" class="form-label">Detail Page title</label>
                                    <input type="text" class="form-control" id="detail_page_title" name="detail_page_title"
                                        @if (isset($data)) value="{{ $data->detail_page_title }}" @endif >
                                </div>
                                <div class="col-md-6">
                                    <label for="detail_page_banner_image" class="form-label">Detail Page Banner image: [ Size - 1170 X 640, Max
                                        Limit
                                        200KB ]
                                    </label>
                                    <input type="file" class="form-control" id="detail_page_banner_image" name="detail_page_banner_image">
                                </div>
                                <div class="col-md-6">
                                    @if (isset($data))
                                        <img src="{{ url($data->detail_page_banner_image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                        <input type="hidden" name="ex_detail_page_banner_image" value="{{ $data->detail_page_banner_image }}">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="how_it_works_title" class="form-label">How it works title</label>
                                    <input type="text" class="form-control" id="how_it_works_title" name="how_it_works_title"
                                        @if (isset($data)) value="{{ $data->how_it_works_title }}" @endif required>
                                </div>
                                <div class="col-md-6">
                                    <label for="why_qligence_title" class="form-label">Why qligence title</label>
                                    <input type="text" class="form-control" id="why_qligence_title" name="why_qligence_title"
                                        @if (isset($data)) value="{{ $data->why_qligence_title }}" @endif required>
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
