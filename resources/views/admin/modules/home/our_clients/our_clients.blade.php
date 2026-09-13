@extends('admin.layouts.app')
@section('title', 'Our clients')
@section('select2', true)
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
                            <li class="breadcrumb-item active" aria-current="page">Our clients CMS</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @include('admin.extras.alert')
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-lg-12">
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Our clients List</h4>
                            <div class="data-tables datatable-primary">
                                <table id="all_user_table" class="table table-default">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>ID</th>
                                            <th>title</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>
                                                        <img src="{{ url($item->image) }}" class="form-control small-image" />
                                                    </td>

                                                    <td class="d-flex">
                                                        <a href="{{ route('our-clients.edit', [$item->id]) }}"
                                                            class="btn btn-sm btn-outline-primary m-1">
                                                            <i class="bx bx-edit-alt me-0"></i>
                                                        </a>
                                                        <form action="{{ route('our-clients.destroy', [$item->id]) }}"
                                                            method="POST" class="m-1">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Are you sure?')"> <i
                                                                    class="bx bx-trash me-0"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">
                                                    <h4 class="text-center" style="color:red;">No Data Found!!</h4>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Add New Admin Role</h4>

                            <form class="row g-3"
                                @if (isset($edit)) action="{{ route('our-clients.update', [$edit->id]) }}" 
                                    
                                @else
                                    action="{{ route('our-clients.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($edit))
                                    @method('PUT')
                                @endif
                                <div class="col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        @if (isset($edit)) value="{{ $edit->title }}" @endif required>
                                </div>
                                
                                <div class="col-md-8">
                                    <label for="image" class="form-label">Image: [ Size - 198 X 105, Max
                                        Limit
                                        200KB ]
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="col-md-4">
                                    @if (isset($edit))
                                        <img src="{{ url($edit->image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                        <input type="hidden" name="ex_image" value="{{ $edit->image }}">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary"> <i
                                            class="fadeIn animated bx bx-check"></i>
                                        @if (isset($edit))
                                            update
                                        @else
                                            Save
                                        @endif
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
@section('header-css')
    <style>
        .small-image {
            width: 90px;
        }
        
    </style>
@endsection
