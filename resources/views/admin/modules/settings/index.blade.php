@extends('admin.layouts.app')
@section('title', 'Site settings')
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
                            <li class="breadcrumb-item active" aria-current="page">Site Settings CMS</li>
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
                                @if (isset($data)) action="{{ route('site-settings.update', [$data->id]) }}"
    @else action="{{ route('site-settings.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Site Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        @if (isset($data)) value="{{ $data->name }}" @endif required>
                                </div>
                                <div class="col-md-6">
                                    <label for="logo" class="form-label">Logo: [ Size - 146 X 62, Max Limit 200KB
                                        ]</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                </div>
                                <div class="col-md-6">
                                    @if (isset($data))
                                        <img src="{{ url( $data->logo) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                        <input type="hidden" name="ex_logo" value="{{ $data->logo }}">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        @if (isset($data)) value="{{ $data->email }}" @endif required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        @if (isset($data)) value="{{ $data->phone }}" @endif>
                                </div>
                                <div class="col-md-12">
                                    <label for="about_us" class="form-label">About us</label>
                                    <textarea name="about_us" id="mytextarea" rows="3" class="form-control">
                                                    @if (isset($data))
                                        {{ $data->about_us }}
                                        @endif
                                    </textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="corporate_office_address" class="form-label">Corporate Office
                                        Address</label>
                                    <input type="text" class="form-control" id="facebook_link"
                                        name="corporate_office_address"
                                        @if (isset($data)) value="{{ $data->corporate_office_address }}" @endif>
                                </div>
                                <div class="col-md-12">
                                    <label for="registered_office_address" class="form-label">Registered Office
                                        Address</label>
                                    <input type="text" class="form-control" id="facebook_link"
                                        name="registered_office_address"
                                        @if (isset($data)) value="{{ $data->registered_office_address }}" @endif>
                                </div>
                                <div class="col-md-12">
                                    <label for="uk_office_address" class="form-label">UK Office Address</label>
                                    <input type="text" class="form-control" id="facebook_link" name="uk_office_address"
                                        @if (isset($data)) value="{{ $data->uk_office_address }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="facebook_link" class="form-label">Facebook link</label>
                                    <input type="text" class="form-control" id="facebook_link" name="facebook_link"
                                        @if (isset($data)) value="{{ $data->facebook_link }}" @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="linkedin_link" class="form-label">Linkedink Link</label>
                                    <input type="text" class="form-control" id="linkedin_link" name="linkedin_link"
                                        @if (isset($data)) value="{{ $data->linkedin_link }}" @endif
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="instagram_link" class="form-label">Instagram Link</label>
                                    <input type="text" class="form-control" id="instagram_link" name="instagram_link"
                                        @if (isset($data)) value="{{ $data->instagram_link }}" @endif
                                        required>
                                </div>
                                {{--  <div class="col-md-12">
                                    <label for="appointment_email" class="form-label">Appointment email</label>
                                    <input type="text" class="form-control" id="appointment_email" name="appointment_email"
                                        @if (isset($data)) value="{{ $data->appointment_email }}" @endif
                                        required>
                                </div>  --}}
                                <div class="col-md-12">
                                    <label for="contact_email" class="form-label">Contact email</label>
                                    <input type="text" class="form-control" id="contact_email" name="contact_email"
                                        @if (isset($data)) value="{{ $data->contact_email }}" @endif
                                        required>
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
