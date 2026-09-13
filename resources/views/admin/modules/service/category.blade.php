@extends('admin.layouts.app')
@section('title', 'Our Business Category')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Our Business Category CMS</li>
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
                            <h4 class="header-title">All Our Business Category List</h4>
                            <div class="data-tables datatable-primary">
                                <table id="all_user_table" class="table table-default">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable">
                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $item)
                                                <tr data-id="{{ $item->id }}">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('service-category.edit', [$item->id]) }}"
                                                            class="btn btn-sm btn-outline-primary m-1">
                                                            <i class="bx bx-edit-alt me-0"></i>
                                                        </a>
                                                        <form action="{{ route('service-category.destroy', [$item->id]) }}"
                                                            method="POST" class="m-1">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                @if ($item->isDeleted == 'false') disabled @endif
                                                                onclick="return confirm('Are you sure?')"> 
                                                                <i class="bx bx-trash me-0"></i>
                                                            </button>
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
                            <h4 class="header-title">Add New Category</h4>

                            <form class="row g-3"
                                @if (isset($edit)) action="{{ route('service-category.update', [$edit->id]) }}" 
                                    
                                @else
                                    action="{{ route('service-category.store') }}" @endif
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
                                <div class="col-md-9">
                                    <label for="icon" class="form-label">Icon: [ Size - 60 X 60, Max
                                        Limit
                                        200KB ]
                                    </label>
                                    <input type="file" class="form-control" id="icon" name="icon">
                                </div>
                                <div class="col-md-3">
                                    @if (isset($edit))
                                        <img src="{{ url($edit->icon) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                        <input type="hidden" name="ex_icon" value="{{ $edit->icon }}">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>
                                
                                <div class="col-md-9">
                                    <label for="image" class="form-label">Image: [ Size - 360 X 250, Max
                                        Limit
                                        200KB ]
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="col-md-3">
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
                                    <div class="form-group">
                                        <label for="name">Short description</label>
                                        <input type="text" class="form-control" id="short_description" name="short_description"
                                            placeholder="Enter short description"
                                            @if (isset($edit)) value="{{ $edit->short_description }}" @endif>
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
@section('extra-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sortable = new Sortable(document.getElementById('sortable'), {
            animation: 150,
            onEnd: function (/**Event*/evt) {
                var order = [];
                // Get the updated order of IDs
                document.querySelectorAll('#sortable tr').forEach(function (row) {
                    order.push(row.getAttribute('data-id'));
                });

                // Send the updated order to the server
                fetch('{{ route("service-category.updateOrder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            title: 'Success!',
                            text: 'Order updated successfully',
                            icon: 'success',
                            position: 'top-end',  // This ensures the alert is centered
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false // This ensures the confirm button is shown
                        });
                        
                    } else {
                        Swal.fire({
                            toast: true,
                            title: 'Error!',
                            text: 'Failed to update order',
                            icon: 'error',
                            position: 'top-end',  // This ensures the alert is centered
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false 
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while updating the order',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error('Error:', error);
                });
            }
        });
    });
</script>


@endsection