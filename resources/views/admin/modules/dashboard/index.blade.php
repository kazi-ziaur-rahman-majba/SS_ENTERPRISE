@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('datatable', true)
@section('chart', false)
@section('dashboard', false)
@section('content')

    <div class="page-wrapper">
        <div class="page-content">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                <a href="#">
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Admin</p>
                                        <h4 class="my-1">{{ $data['totalAdmin'] }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bxs-data'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Blogs</p>
                                        <h4 class="my-1">{{ $data['totalBlogs'] }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bx-envelope'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Event</p>
                                        <h4 class="my-1">{{ $data['totalEvents'] }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bxs-envelope-open'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Today Appointment</p>
                                        <h4 class="my-1">{{ $data['totalAppointment'] }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bx-mail-send'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{--  <div class="row">
                <div class="col-xl-12">
                    <h2>Appointment list</h2>
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Appointment Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($data['careerAppointment']) > 0)
                                            @foreach ($data['careerAppointment'] as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
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
                                            <th>SL</th>
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
                <div class="col-xl-12">
                    <h2>Career Applicant list</h2>
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

                                        @if (count($data['careerData']) > 0)
                                            @foreach ($data['careerData'] as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="title">{{ $item->career_title }}</td>
                                                    <td class="title">{{ $item->name }}</td>
                                                    <td class="title">{{ $item->email }}</td>
                                                    <td class="title">
                                                        <a href="{{ url($item->file) }}" target="_blank">Download
                                                            resume</a>
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
            </div>  --}}

        </div>

    @endsection
