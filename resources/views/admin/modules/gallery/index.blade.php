@extends('admin.layouts.app')
@section('title', 'Gallery')
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
                            <li class="breadcrumb-item active" aria-current="page">Gallery</li>
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
                                @if (isset($data)) action="{{ route('gallery.update', [$data->id]) }}" 
                                
                            @else
                                action="{{ route('gallery.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <div class="col-md-4">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" class="form-select">
                                        <option value="" disabled selected>Select category</option>
                                        @if (isset($galleryCategory))
                                            @foreach ($galleryCategory as $row)
                                                <option
                                                    @if (isset($data)) @if ($row->id == $data->category_id)
                                                        selected="selected" @endif
                                                    @endif
                                                    value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-8">&nbsp:</div>
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
