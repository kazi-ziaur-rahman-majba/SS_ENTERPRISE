@extends('admin.layouts.app')
@section('title', 'Why choose us')
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
                            <li class="breadcrumb-item active" aria-current="page">Why choose us</li>
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
                                @if (isset($data)) action="{{ route('why-choose-us.update', [$data->id]) }}" 
                                
                            @else
                                action="{{ route('why-choose-us.store') }}" @endif
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
                                    <label for="sub_title" class="form-label">Sub title</label>
                                    <input type="text" class="form-control" id="name" name="sub_title"
                                        @if (isset($data)) value="{{ $data->sub_title }}" @endif required>
                                </div>

                                <div class="col-md-6">
                                    <label for="image" class="form-label">Image: [ Size - 385 X 190, Max Limit 500KB ]
                                    </label>
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

                                <div class="col-md-12">
                                    <label for="detail" class="form-label">Detail</label>
                                    <textarea name="detail" id="mytextarea" rows="5" class="form-control">
                                        @if (isset($data))
                                        {{ $data->detail }}
                                        @endif
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="success_rate" class="form-label">Success rate</label>
                                    <input type="text" class="form-control" id="name" name="success_rate"
                                        @if (isset($data)) value="{{ $data->success_rate }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="experience" class="form-label">Experience</label>
                                    <input type="text" class="form-control" id="name" name="experience"
                                        @if (isset($data)) value="{{ $data->experience }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="analyst" class="form-label">Analyst</label>
                                    <input type="text" class="form-control" id="name" name="analyst"
                                        @if (isset($data)) value="{{ $data->analyst }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="collaborations" class="form-label">Collaboration</label>
                                    <input type="text" class="form-control" id="name" name="collaborations"
                                        @if (isset($data)) value="{{ $data->collaborations }}" @endif>
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
