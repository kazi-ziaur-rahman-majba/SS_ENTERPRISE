@extends('admin.layouts.app')
@section('title', 'Admin')
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
                            <li class="breadcrumb-item active" aria-current="page">Admin CMS</li>
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
                            <form method="post" enctype="multipart/form-data"
                                @if (isset($data)) action="{{ route('admins.update', [$data->id]) }}" 
                                    
                                @else
                                    action="{{ route('admins.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <h5 class="mb-0 mt-4">Admin Information</h5>
                                <hr />
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name"
                                            placeholder="Enter first name"
                                            @if (isset($data)) value="{{ $profInfo->first_name }}" @endif  required/>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                            placeholder="Enter last name"
                                            @if (isset($data)) value="{{ $profInfo->last_name }}" @endif required/>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            @if (isset($data)) value="{{ $data->email }}" @endif
                                            placeholder="Enter email address" required/>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="Enter mobile number"
                                            @if (isset($data)) value="{{ $profInfo->phone }}" @endif  required />
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">Role</label>
                                        <select class="form-select" name="role_id">
                                            <option value='' disabled>Select Role</option>
                                            @if (isset($adminRole))
                                                @foreach ($adminRole as $row)
                                                    <option
                                                         @if (isset($data))
                                                            @if($row->id == $data->role_id)
                                                                selected="selected"
                                                            @endif
                                                         @endif
                                                     value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Enter address"
                                            @if (isset($data)) value="{{ $profInfo->address }}" @endif />
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="password" value="">

                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            value="" >
                                    </div>
                                </div>
                                <div class="text-start mt-3">
                                    <button type="submit" class="btn btn-primary"> <i
                                            class="fadeIn animated bx bx-check"></i>
                                        @if (isset($edit))
                                            update
                                        @else
                                            Save changes
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
