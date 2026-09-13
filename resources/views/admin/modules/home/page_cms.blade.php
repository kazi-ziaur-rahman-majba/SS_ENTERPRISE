@extends('admin.layouts.app')
@section('title', 'Home page CMS')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                {{-- <div class="breadcrumb-title pe-3">Configure Site CMS</div> --}}
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Home page CMS</li>
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
                                @if (isset($data)) action="{{ route('home-page-cms.update', [$data->id]) }}" 
                                
                                @else
                                action="{{ route('home-page-cms.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <div class="col-md-6">
                                    <label for="slider_bottom_title" class="form-label">Slider bottom title</label>
                                    <input type="text" class="form-control" id="name" name="slider_bottom_title"
                                        @if (isset($data)) value="{{ $data->slider_bottom_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="slider_bottom_link_title" class="form-label">Slider bottom link title</label>
                                    <input type="text" class="form-control" id="name" name="slider_bottom_link_title"
                                        @if (isset($data)) value="{{ $data->slider_bottom_link_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="slider_bottom_link" class="form-label">Slider bottom link</label>
                                    <input type="text" class="form-control" id="name" name="slider_bottom_link"
                                        @if (isset($data)) value="{{ $data->slider_bottom_link }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="project_title" class="form-label">Project title</label>
                                    <input type="text" class="form-control" id="name" name="project_title"
                                        @if (isset($data)) value="{{ $data->project_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="project_button_title" class="form-label">Project button title</label>
                                    <input type="text" class="form-control" id="name" name="project_button_title"
                                        @if (isset($data)) value="{{ $data->project_button_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="project_button_link" class="form-label">Project button link</label>
                                    <input type="text" class="form-control" id="name" name="project_button_link"
                                        @if (isset($data)) value="{{ $data->project_button_link }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="why_work_us_title" class="form-label">Why work us title</label>
                                    <input type="text" class="form-control" id="name" name="why_work_us_title"
                                        @if (isset($data)) value="{{ $data->why_work_us_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="client_title" class="form-label">Client title</label>
                                    <input type="text" class="form-control" id="name" name="client_title"
                                        @if (isset($data)) value="{{ $data->client_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="news_title" class="form-label">Blog title</label>
                                    <input type="text" class="form-control" id="name" name="news_title"
                                        @if (isset($data)) value="{{ $data->news_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="news_sub_title" class="form-label">Blog sub title</label>
                                    <input type="text" class="form-control" id="name" name="news_sub_title"
                                        @if (isset($data)) value="{{ $data->news_sub_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="news_button_title" class="form-label">Blog button title</label>
                                    <input type="text" class="form-control" id="name" name="news_button_title"
                                        @if (isset($data)) value="{{ $data->news_button_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="news_button_link" class="form-label">Blog button link</label>
                                    <input type="text" class="form-control" id="name" name="news_button_link"
                                        @if (isset($data)) value="{{ $data->news_button_link }}" @endif>
                                </div>
                                
                                
                                <div class="col-md-12">
                                    <label for="meta" class="form-label">Meta</label>
                                    <input type="text" class="form-control" id="name" name="meta"
                                        @if (isset($data)) value="{{ $data->meta }}" @endif required>
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
