@extends('admin.layouts.app')
@section('title', 'Our Business')
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
                            <li class="breadcrumb-item active" aria-current="page">Our Business</li>
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
                                @if (isset($data)) action="{{ route('service.update', [$data->id]) }}" 
                                
                            @else
                                action="{{ route('service.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <div class="col-md-4">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" class="form-select">
                                        <option value="" disabled selected>Select category</option>
                                        @if (isset($category))
                                            @foreach ($category as $row)
                                                <option
                                                    @if (isset($data)) @if ($row->id == $data->category_id) 
                                                            selected="selected" @endif
                                                    @endif
                                                    value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-8">&nbsp:</div>
                                <div class="col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter title"
                                        name="title" @if (isset($data)) value="{{ $data->title }}" @endif
                                        required>
                                </div>
                                @if (isset($data))
                                    <div class="col-md-12">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                            value="{{ $data->slug }}">
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <label for="title" class="form-label">Image</label>
                                    <div class="form-group">
                                        @if (isset($data))
                                            @php
                                                $img = json_decode($data->image, true);
                                            @endphp
                                        @endif
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="clonetable">
                                                @if (isset($img))
                                                    @foreach ($img as $key => $item)
                                                        <tr>
                                                            <td class="sl">{{ $key + 1 }}</td>
                                                            <td>
                                                                <input name="about_image_title[]"
                                                                    placeholder="About image title" class="form-control"
                                                                    type="text" value="{{ $item['title'] }}">
                                                            </td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <input name="about_image_files[]"
                                                                        class="form-control-file" type="file">
                                                                    <img src="{{ url($item['image']) }}" height="50px"
                                                                        class="ml-3 mt-2">
                                                                    <input type="hidden" name="ex_about_image[]"
                                                                        value="{{ $item['image'] }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-danger delete-feature-row"
                                                                    style="font-weight: bolder;">X</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="sl">1</td>
                                                        <td>
                                                            <input name="about_image_title[]"
                                                                placeholder="Image title" class="form-control"
                                                                type="text" value="">
                                                        </td>
                                                        <td>
                                                            <input name="about_image_files[]"
                                                                class="form-control-file float-right" type="file">
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger delete-feature-row"
                                                                style="font-weight: bolder;">X</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">
                                                        <button type="button" class="btn btn-sm btn-info add-new-feature"
                                                            style="font-weight: bolder; color:#fff;"> + Add More</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="detail" class="form-label">Detail</label>
                                    <textarea name="detail" id="mytextarea" rows="5" class="form-control">
                                        @if (isset($data))
{{ $data->detail }}
@endif
                                    </textarea>

                                </div>
                                
                                <div class="col-md-12">
                                    <label for="meta" class="form-label">Meta</label>
                                    <input type="text" class="form-control" id="name" name="meta"
                                        @if (isset($data)) value="{{ $data->meta }}" @endif >
                                </div>
                                <div class="col-md-12">
                                    <label for="meta_description" class="form-label">Meta description</label>
                                    <textarea name="meta_description" rows="5" class="form-control">
                                        @if (isset($data)) {{ $data->meta_description }} @endif
                                    </textarea>
                                </div>



                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary"> <i
                                            class="fadeIn animated bx bx-check"></i>
                                        Save</button>
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
    <script>
        $(document).ready(function() {
    // Function to update the serial numbers
    function updateSerialNumbers(formGroup) {
        var rows = formGroup.find('.clonetable tr');
        rows.each(function(index) {
            $(this).find('.sl').text(index + 1);
        });
        rows.find('.delete-feature-row').show();
        rows.first().find('.delete-feature-row').hide(); // Hide delete button for the first row
    }

    // Add new feature row
    $(".add-new-feature").click(function() {
        var formGroup = $(this).closest('.form-group');
        var clone = formGroup.find('.clonetable tr').last().clone(); // Clone the last row instead of the first
        clone.find('input, textarea').val(''); // Clear the values
        formGroup.find('.clonetable').append(clone);
        updateSerialNumbers(formGroup);
    });

    // Delete feature row
    $('body').on('click', '.delete-feature-row', function() {
        var formGroup = $(this).closest('.form-group');
        $(this).closest('tr').remove();
        updateSerialNumbers(formGroup);
    });

    // Initialize serial numbers
    $('.form-group').each(function() {
        updateSerialNumbers($(this));
    });
});
    </script>
@endsection
