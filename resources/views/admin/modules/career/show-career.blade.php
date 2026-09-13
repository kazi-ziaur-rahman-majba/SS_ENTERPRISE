@extends('admin.layouts.app')
@section('title', 'Carrer Details')
@section('datatable', true)
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                {{-- <div class="breadcrumb-title pe-3">Carrer Details</div> --}}
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Carrer Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            @include('admin.extras.alert')
            <div class="row">
                <div class="col-xl-12">
                    <h6 class="mb-0 text-uppercase">Carrer Details</h6>
                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $data->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $data->email }}</td>
                                    </tr>        
                                    <tr>
                                        <td>File</td>
                                        <td><a href="{{ url($data->file) }}" target="_blank"><i class="fadeIn animated bx bx-file"></i> Download</a></td>
                                    </tr>        
                                    <tr>
                                        <td>Message</td>
                                        <td>{{ $data->message }}</td>
                                    </tr>
                                    <tr>
                                        <td>Created AT</td>
                                        <td>{{ date('d M, Y | h:i:s A', strtotime($data->created_at)) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>