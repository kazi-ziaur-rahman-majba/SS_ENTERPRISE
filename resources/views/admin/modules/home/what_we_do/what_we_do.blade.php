@extends('admin.layouts.app')
@section('title', 'What we do')
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
                            <li class="breadcrumb-item active" aria-current="page">What we do</li>
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
                                @if (isset($data)) action="{{ route('what-we-do.update', [$data->id]) }}" 
                                
                            @else
                                action="{{ route('what-we-do.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif


                                <div class="col-md-12">
                                    <label for="title" class="form-label">Title (Small Upper Label)</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter title"
                                        name="title" @if (isset($data)) value="{{ $data->title }}" @endif
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <label for="sub_title" class="form-label">Sub title (Main Heading)</label>
                                    <input type="text" class="form-control" id="sub_title" placeholder="Enter sub_title"
                                        name="sub_title"
                                        @if (isset($data)) value="{{ $data->sub_title }}" @endif required>
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Section Description (Top Right)</label>
                                    <textarea class="form-control" id="description" placeholder="Enter section description"
                                        name="description" rows="2">@if (isset($data)){{ $data->description }}@endif</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="image" class="form-label">Image: [ Optional ]
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="col-md-6">
                                    @if (isset($data) && !empty($data->image))
                                        <img src="{{ url($data->image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                        <input type="hidden" name="ex_image" value="{{ $data->image }}">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>




                                <div class="col-md-12">
                                    <label for="title" class="form-label">Work Detail</label>
                                    <div class="form-group">
                                        @if (isset($data))
                                            @php
                                                $works = json_decode($data->works, true);
                                            @endphp
                                        @endif
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Title</th>
                                                    <th>Icon</th>
                                                    <th>Detail</th>
                                                    <th>Link / URL</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="clonetable">
                                                @if (isset($works))
                                                    @foreach ($works as $key => $item)
                                                        <tr>
                                                            <td class="sl">{{ $key + 1 }}</td>
                                                            <td>
                                                                <input name="work_title[]" placeholder="title.."
                                                                    class="form-control" type="text"
                                                                    value="{{ $item['title'] ?? '' }}">
                                                            </td>
                                                            <td>
                                                                <div style="display: flex; align-items: center;">
                                                                    <input name="icon[]" class="form-control" type="file" style="flex-grow: 1;">
                                                                    @if(!empty($item['icon']))
                                                                        <img src="{{ url($item['icon']) }}" height="50px" style="margin-left: 10px; margin-top: 10px;">
                                                                    @endif
                                                                    <input type="hidden" name="old_icons[]" value="{{ $item['icon'] ?? '' }}">
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <textarea name="detail[]" placeholder="Detail.." rows="2" class="form-control">{{ $item['detail'] ?? '' }}</textarea>
                                                            </td>
                                                            <td>
                                                                <input name="link[]" placeholder="Link (e.g. /business)" class="form-control" type="text" value="{{ $item['link'] ?? '' }}">
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
                                                            <input name="work_title[]" placeholder="Title.."
                                                                class="form-control" type="text">
                                                        </td>
                                                        <td>
                                                            <input name="icon[]" class="form-control" type="file">
                                                        </td>
                                                        <td>
                                                            <textarea name="detail[]" placeholder="Detail.." rows="2" class="form-control"></textarea>
                                                        </td>
                                                        <td>
                                                            <input name="link[]" placeholder="Link (e.g. /business)" class="form-control" type="text">
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
                                                    <td colspan="6">
                                                        <button type="button" class="btn btn-sm btn-info add-new-feature"
                                                            style="font-weight: bolder; color:#fff;"> + Add More</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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
                var clone = formGroup.find('.clonetable tr').last()
                    .clone(); // Clone the last row instead of the first
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
