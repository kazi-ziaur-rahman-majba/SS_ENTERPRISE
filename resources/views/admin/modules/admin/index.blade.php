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
                <div class="col-lg-12">
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">All Admin Role</h4>
                            <div class="data-tables datatable-primary">
                                <table id="all_user_table" class="table table-default">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>ID</th>
                                            <th>Role</th>
                                            <th>Permissions</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <div class="permission-show">
                                                            @php
                                                                $permissions = json_decode($item->permissions, true);
                                                            @endphp

                                                            @foreach ($permissions as $permission)
                                                                <span class="text text-success">{{ $permission }}</span>
                                                            @endforeach
                                                        </div>
                                                    </td>

                                                    <td class="d-flex">
                                                        <a href="{{ route('admin-role.edit', [$item->id]) }}"
                                                            class="btn btn-sm btn-outline-primary m-1">
                                                            <i class="bx bx-edit-alt me-0"></i>
                                                        </a>
                                                        <form action="{{ route('admin-role.destroy', [$item->id]) }}"
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
                            <h4 class="header-title">Add New Admin Role</h4>

                            <form class="row g-3"
                                @if (isset($edit)) action="{{ route('admin-role.update', [$edit->id]) }}" 
                                    
                                @else
                                    action="{{ route('admin-role.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($edit))
                                    @method('PUT')
                                @endif
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Role name"
                                            @if (isset($edit)) value="{{ $edit->name }}" @endif>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="permission">Permissions</label>
                                        <select name="permissions[]" class="multiple-select"
                                            data-placeholder="Choose anything" multiple="multiple">
                                            @if (isset($menu))
                                                @foreach ($menu as $row)
                                                    @php
                                                        $selectedPermissions = isset($edit)
                                                            ? json_decode($edit->permissions_id)
                                                            : [];
                                                        $isSelected = in_array($row->id, $selectedPermissions);
                                                    @endphp
                                                    <option value="{{ $row->id }}" {{ $isSelected ? 'selected' : '' }}>
                                                        {{ $row->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>


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
