@extends('admin.layouts.app')
@section('title', 'Menu')
@section('select2', true)
@section('datatable', true)
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
                            <li class="breadcrumb-item active" aria-current="page">Menu CMS</li>
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
                            <h4 class="header-title">All Menu List</h4>
                            <div class="data-tables datatable-primary">
                                <table id="example" class="table table-default">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->name }}</td>

                                                    <td class="d-flex">
                                                        <a href="{{ route('menu.edit', [$item->id]) }}"
                                                            class="btn btn-sm btn-outline-primary m-1">
                                                            <i class="bx bx-edit-alt me-0"></i>
                                                        </a>
                                                        <form action="{{ route('menu.destroy', [$item->id]) }}"
                                                            method="POST" class="m-1">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                @if ($item->isDeleted == 'false') disabled @endif
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
                            <h4 class="header-title">Add New Menu</h4>

                            <form class="row g-3"
                                @if (isset($edit)) action="{{ route('menu.update', [$edit->id]) }}" 
                                    
                                @else
                                    action="{{ route('menu.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($edit))
                                    @method('PUT')
                                @endif
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter name"
                                            @if (isset($edit)) value="{{ $edit->name }}" @endif>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="path">Path</label>
                                        <input type="text" class="form-control" id="path" name="path"
                                            placeholder="Enter page path"
                                            @if (isset($edit)) value="{{ $edit->path }}" @endif>
                                    </div>
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
        .permission-show span:after {
            position: static;
            content: ", ";
            padding-right: 5px;
        }
    </style>
@endsection
