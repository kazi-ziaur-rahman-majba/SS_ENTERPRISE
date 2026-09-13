@extends('admin.layouts.app')
@section('title', 'Slider')
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
                            <li class="breadcrumb-item active" aria-current="page">Slider CMS</li>
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
                                @if (isset($data)) action="{{ route('slider.update', [$data->id]) }}" 
                                    
                                @else
                                    action="{{ route('slider.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif
                                
                                <div class="col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="name" name="title" placeholder="Enter Title"
                                        @if (isset($data)) value="{{ $data->title }}" @endif>
                                </div>
                                <div class="col-md-12">
                                    <label for="sub_title" class="form-label">Sub title</label>
                                    <input type="text" class="form-control" id="name" name="sub_title" placeholder="Enter Sub Title"
                                        @if (isset($data)) value="{{ $data->sub_title }}" @endif>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Image: [ Size - 1920 X 354, Max Limit 200KB ]  </label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="col-md-6">
                                    @if (isset($data))
                                        <img src="{{ url($data->image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                        <input type="hidden" name="ex_image" value="{{ $data->image }}">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>
                      
                                <div class="col-md-6">
                                    <label for="button_text" class="form-label">Button text</label>
                                    <input type="text" class="form-control" id="name" name="button_text" placeholder="Enter Button Name"
                                        @if (isset($data)) value="{{ $data->button_text }}" @endif >
                                </div>
                                <div class="col-md-6">
                                    <label for="button_link" class="form-label">Button link</label>
                                    <input type="text" class="form-control" id="name" name="button_link" placeholder="Enter Button Link"
                                        @if (isset($data)) value="{{ $data->button_link }}" @endif >
                                </div>
                                <div class="col-md-6">
                                    <label for="text_position" class="form-label">Text position</label>
                                    <select class="form-select" name="text_position" required>
                                        <option value="" disabled selected>Select option</option>
                                        <option @if (isset($data) && $data->text_position == 'left') selected @endif value="left">Left</option>
                                        <option @if (isset($data) && $data->text_position == 'right') selected @endif value="right">Right</option>
                                        <option @if (isset($data) && $data->text_position == 'center') selected @endif value="center">Center</option>
                                    </select>
                                    
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
