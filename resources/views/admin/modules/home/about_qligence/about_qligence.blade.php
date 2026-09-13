@extends('admin.layouts.app')
@section('title', 'About us')
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
                            <div class="card-title d-flex align-items-center">
                                <div>
                                    <i class="bx bxs-pen me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Please Fillup All The Require Fields</h5>
                            </div>
                            <hr>
                            <form class="row g-3"
                                @if (isset($data)) action="{{ route('home-about-us.update', [$data->id]) }}" 
                                
                            @else
                                action="{{ route('home-about-us.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif


                                <div class="col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="name" name="title"
                                        @if (isset($data)) value="{{ $data->title }}" @endif required>
                                </div>
                                <div class="col-md-12">
                                    <label for="detail" class="form-label">Detail</label>
                                    <textarea name="detail" id="mytextarea" rows="5" class="form-control">
                                        @if (isset($data)) {!! $data->detail !!} @endif
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="button_title" class="form-label">Button title</label>
                                    <input type="text" class="form-control" id="name" name="button_title"
                                        @if (isset($data)) value="{{ $data->button_title }}" @endif >
                                </div>
                                <div class="col-md-6">
                                    <label for="button_link" class="form-label">Button link</label>
                                    <input type="text" class="form-control" id="name" name="button_link"
                                        @if (isset($data)) value="{{ $data->button_link }}" @endif >
                                </div>

                                {{--  <div class="col-md-6">
                                    <label for="first_image" class="form-label">
                                        First image: [ Size - 220 X 280, Max Limit 500KB ]
                                    </label>
                                    <input type="file" class="form-control" id="first_image" name="first_image">
                                </div>
                                <div class="col-md-6">
                                    @if (isset($data) && is_string($data->first_image))
                                        <img src="{{ url($data->first_image) }}" height="50px" style="margin-left: 30px; margin-top: 10px;">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px" style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="second_image" class="form-label">Second image: [ Size - 220 X 280, Max Limit 500KB ]
                                    </label>
                                    <input type="file" class="form-control" id="second_image" name="second_image">
                                </div>
                                <div class="col-md-6">
                                     @if (isset($data) && is_string($data->second_image))
                                        <img src="{{ url($data->second_image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="third_image" class="form-label">Third image: [ Size - 220 X 280, Max Limit 500KB ]
                                    </label>
                                    <input type="file" class="form-control" id="third_image" name="third_image">
                                </div>
                                <div class="col-md-6">
                                     @if (isset($data) && is_string($data->third_image))
                                        <img src="{{ url($data->third_image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>  --}}
                                <div class="col-md-6">
                                    <label for="trust_title_one" class="form-label">Trust title one</label>
                                    <input type="text" class="form-control" id="name" name="trust_title_one"
                                        @if (isset($data)) value="{{ $data->trust_title_one }}" @endif >
                                </div>
                                <div class="col-md-6">
                                    <label for="trust_detail_one" class="form-label">Trust detail one</label>
                                    <textarea name="trust_detail_one" rows="1" class="form-control">
                                        @if (isset($data)) {!! $data->trust_detail_one !!} @endif
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="trust_title_two" class="form-label">Trust title two</label>
                                    <input type="text" class="form-control" id="name" name="trust_title_two"
                                        @if (isset($data)) value="{{ $data->trust_title_two }}" @endif >
                                </div>
                                <div class="col-md-6">
                                    <label for="trust_detail_two" class="form-label">Trust detail two</label>
                                    <textarea name="trust_detail_two" rows="1" class="form-control">
                                        @if (isset($data)) {!! $data->trust_detail_two !!} @endif
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="trust_title_three" class="form-label">Trust title three</label>
                                    <input type="text" class="form-control" id="name" name="trust_title_three"
                                        @if (isset($data)) value="{{ $data->trust_title_three }}" @endif >
                                </div>
                                <div class="col-md-6">
                                    <label for="trust_detail_three" class="form-label">Trust detail three</label>
                                    <textarea name="trust_detail_three" rows="1" class="form-control">
                                        @if (isset($data)) {!! $data->trust_detail_three !!} @endif
                                    </textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="expertise_detail" class="form-label">Expertise detail</label>
                                    <textarea name="expertise_detail" rows="2" class="form-control">
                                        @if (isset($data)) {!! $data->expertise_detail !!} @endif
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="expertise_title_one" class="form-label">Expertise title one</label>
                                    <input type="text" class="form-control" id="name" name="expertise_title_one"
                                        @if (isset($data)) value="{{ $data->expertise_title_one }}" @endif >
                                </div>
                                <div class="col-md-6">
                                    <label for="expertise_detail_one" class="form-label">Expertise detail one</label>
                                    <textarea name="expertise_detail_one" rows="1" class="form-control">
                                        @if (isset($data)) {!! $data->expertise_detail_one !!} @endif
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="expertise_title_two" class="form-label">Expertise title two</label>
                                    <input type="text" class="form-control" id="name" name="expertise_title_two"
                                        @if (isset($data)) value="{{ $data->expertise_title_two }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="expertise_detail_two" class="form-label">Expertise detail two</label>
                                    <textarea name="expertise_detail_two" rows="1" class="form-control">
                                        @if (isset($data)) {!! $data->expertise_detail_two !!} @endif
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="image_title" class="form-label">Image title</label>
                                    <input type="text" class="form-control" id="name" name="image_title"
                                        @if (isset($data)) value="{{ $data->image_title }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="safety_detail" class="form-label">Safety detail</label>
                                    <textarea name="safety_detail" rows="1" class="form-control">
                                        @if (isset($data)) {!! $data->safety_detail !!} @endif
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="safety_image" class="form-label">Safety image: [ Size - 220 X 280, Max Limit 500KB ]
                                    </label>
                                    <input type="file" class="form-control" id="safety_image" name="safety_image">
                                </div>
                                <div class="col-md-6">
                                     @if (isset($data) && is_string($data->safety_image))
                                        <img src="{{ url($data->safety_image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
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

