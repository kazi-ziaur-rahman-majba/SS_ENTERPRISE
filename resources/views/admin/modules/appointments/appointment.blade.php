@extends('admin.layouts.app')
@section('title', 'Appointment')
@section('datatable', true)
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                {{-- <div class="breadcrumb-title pe-3">Appointment</div> --}}
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Appointment Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            @include('admin.extras.alert')
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Appointment Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>                                                   
                                                    <td>{{ $item->phone }}</td>                                                   
                                                    <td>{{ date('d M, Y | h:i:s A', strtotime($item->created_at)) }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('appointment-list.show', [$item->id]) }}"
                                                            class="btn btn-outline-primary m-1">
                                                            <i class="bx bx-show me-0"></i>
                                                        </a>
                                                        <form action="{{ route('appointment-list.destroy', [$item->id]) }}"
                                                            method="POST" class="m-1">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger"
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
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Contact Date</th>
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
    </div>
@endsection
