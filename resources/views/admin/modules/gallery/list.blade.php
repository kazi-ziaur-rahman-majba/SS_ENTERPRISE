@extends('admin.layouts.app')
@section('title', 'Gallery')
@section('datatable', true)
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                {{-- <div class="breadcrumb-title pe-3">About Page</div> --}}
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Gallery List</li>
                        </ol>
                    </nav>
                </div>
                
                <div class="ms-auto">
                    <div class="">
                        <a class="btn btn-primary split-bg-primary" href="{{ route('gallery.create') }}">Create New</a>
                    </div>
                </div>
            </div>
            @include('admin.extras.alert')
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>SL</th>
                                            <th>Category name</th>
                                            <th>Image</th>
                                            <th>Created AT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="title">{{ $item->category_name }}</td>
                                                    <td class="title">
                                                    <img src="{{ url($item->image) }}" height="50px"
                                                            style="margin-left: 30px; margin-top: 10px;">
                                                    </td>
                                                    <td>{{ date('F j, Y', strtotime($item->created_at)) }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('gallery.edit', [$item->id]) }}"
                                                            class="btn btn-sm btn-outline-primary m-1">
                                                            <i class="bx bx-edit-alt me-0"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('gallery.destroy', [$item->id]) }}"
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
                                                <td colspan="5">
                                                    <h4 class="text-center" style="color:red;">No Data Found!!</h4>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category name</th>
                                            <th>Image</th>
                                            <th>Created AT</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
