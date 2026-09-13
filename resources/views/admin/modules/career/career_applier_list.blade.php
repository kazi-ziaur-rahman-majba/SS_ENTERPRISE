@extends('admin.layouts.app')
@section('title', 'Applicant list')
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
                            <li class="breadcrumb-item active" aria-current="page">Applicant list List</li>
                        </ol>
                    </nav>
                </div>
                
                {{--  <div class="ms-auto">
                    <div class="">
                        <a class="btn btn-primary split-bg-primary" href="{{ route('blog.create') }}">Create New</a>
                    </div>
                </div>  --}}
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
                                            <th>Career title</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>File</th>
                                            <th>Applied date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="title">{{ $item->career_title }}</td>
                                                    <td class="title">{{ $item->name }}</td>
                                                    <td class="title">{{ $item->email }}</td>
                                                    <td class="title">
                                                        <a href="{{ url($item->file) }}" target="_blank">Download resume</a>
                                                    </td>
                                                    <td>{{ date('F j, Y', strtotime($item->created_at)) }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('applicant-list.edit', [$item->id]) }}"
                                                            class="btn btn-sm btn-outline-primary m-1">
                                                            <i class="bx bx-show me-0"></i>
                                                        </a>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">
                                                    <h4 class="text-center" style="color:red;">No Data Found!!</h4>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Career title</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>File</th>
                                            <th>Applied date</th>
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
