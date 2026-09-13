@extends('admin.layouts.app')
@section('title', 'Membership Certificate')
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
                            <li class="breadcrumb-item active" aria-current="page">Membership Certificate</li>
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
                                @if (isset($data)) action="{{ route('membership-certificate.update', [$data->id]) }}"
    
    @else
    action="{{ route('membership-certificate.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <div class="col-md-12">
                                    <label for="banner_title" class="form-label">Banner title</label>
                                    <input type="text" class="form-control" id="banner_title" name="banner_title"
                                        @if (isset($data)) value="{{ $data->banner_title }}" @endif required>
                                </div>
                                <div class="col-md-12">
                                    <label for="page_title" class="form-label">Page title</label>
                                    <input type="text" class="form-control" id="page_title" name="page_title"
                                        @if (isset($data)) value="{{ $data->page_title }}" @endif required>
                                </div>
                                <div class="col-md-6">
                                    <label for="banner_image" class="form-label">Banner image: [ Size - 1170 X 640, Max
                                        Limit
                                        200KB ]
                                    </label>
                                    <input type="file" class="form-control" id="banner_image" name="banner_image">
                                </div>
                                <div class="col-md-6">
                                    @if (isset($data))
                                        <img src="{{ url($data->banner_image) }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                        <input type="hidden" name="ex_banner_image" value="{{ $data->banner_image }}">
                                    @else
                                        <img src="{{ asset('/uploads/images/noImage.png') }}" height="50px"
                                            style="margin-left: 30px; margin-top: 10px;">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="member_title" class="form-label">Member title</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Enter member title" name="member_title"
                                        @if (isset($data)) value="{{ $data->member_title }}" @endif required>
                                </div>
                                <div class="col-md-6">
                                    <label for="certificates_title" class="form-label">Certificates title</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Enter certificates title" name="certificates_title"
                                        @if (isset($data)) value="{{ $data->certificates_title }}" @endif
                                        required>
                                </div>




                                <div class="col-md-12">
                                    <label for="title" class="form-label">Member image</label>
                                    <div class="form-group">
                                        @if (isset($data))
                                            @php
                                                $member = json_decode($data->member_image, true);
                                            @endphp
                                        @endif
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Upload file</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="clonetable">
                                                @if (isset($member))
                                                    @foreach ($member as $key => $item)
                                                        <tr>
                                                            <td class="sl">{{ $key + 1 }}</td>
                                                            <td>
                                                                <input name="member_image[]" class="form-control"
                                                                    type="file" accept=".jpg, .png, .jpeg, .svg">
                                                            </td>
                                                            <td>
                                                                <img src="{{ url($item) }}" height="50px"
                                                                    style="margin-left: 30px; margin-top: 10px;">
                                                                <input type="hidden" name="ex_members_image[]"
                                                                    value="{{ $item }}">
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
                                                            <input name="member_image[]" class="form-control" type="file"
                                                                accept=".jpg, .png, .jpeg, .svg">
                                                        </td>
                                                        <td>
                                                            &nbsp;
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
                                    <label for="title" class="form-label">Certifications image</label>
                                    <div class="form-group">
                                        @if (isset($data))
                                            @php
                                                $certifications = json_decode($data->certificates_image, true);
                                            @endphp
                                        @endif
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Upload file</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="clonetable">
                                                @if (isset($certifications))
                                                    @foreach ($certifications as $key => $item)
                                                        <tr>
                                                            <td class="sl">{{ $key + 1 }}</td>
                                                            <td>
                                                                <input name="certification_image[]" class="form-control"
                                                                    type="file" accept=".jpg, .png, .jpeg, .svg">
                                                            </td>
                                                            <td>
                                                                <input name="certification_title[]" class="form-control"
                                                                    type="text" value="{{ $item['title'] }}" >
                                                            </td>
                                                            <td>
                                                                <img src="{{ url($item['image']) }}" height="50px"
                                                                    style="margin-left: 30px; margin-top: 10px;">
                                                                <input type="hidden" name="ex_certifications_image[]"
                                                                    value="{{ $item['image'] }}">
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
                                                            <input name="certification_image[]" class="form-control"
                                                                type="file" accept=".jpg, .png, .jpeg, .svg">
                                                        </td>
                                                        <td>
                                                            &nbsp;
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
            function updateSerialNumbers(formGroup) {
                var rows = formGroup.find('.clonetable tr');
                rows.each(function(index) {
                    $(this).find('.sl').text(index + 1);
                });
                rows.find('.delete-feature-row').show();
                //rows.first().find('.delete-feature-row').hide();
            }

            $(".add-new-feature").click(function() {
                var formGroup = $(this).closest('.form-group');
                var clone = formGroup.find('.clonetable tr').last().clone();
                clone.find('input[name="member_image[]"]').val(''); // Empty the image field value
                clone.find('img').attr('src', ''); // Clear the src attribute of the cloned image, if any
                formGroup.find('.clonetable').append(clone);
                updateSerialNumbers(formGroup);
            });



            $('body').on('click', '.delete-feature-row', function() {
                var formGroup = $(this).closest('.form-group');
                $(this).closest('tr').remove();
                updateSerialNumbers(formGroup);
            });

            $('.form-group').each(function() {
                updateSerialNumbers($(this));
            });
        });
    </script>

    <script>
        $(document).on('change', 'input[name="member_image[]"]', function() {
            var parentRow = $(this).closest('tr');
            parentRow.find('input[name="ex_members_image[]"]').val('');
        });
    </script>
    <script>
        $(document).on('change', 'input[name="certification_image[]"]', function() {
            var parentRow = $(this).closest('tr');
            parentRow.find('input[name="ex_certifications_image[]"]').val('');
        });
    </script>

@endsection
