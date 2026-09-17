@extends('admin.layouts.app')
@section('title', 'Faq')
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
                            <li class="breadcrumb-item active" aria-current="page">Faq</li>
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
                                @if (isset($data)) action="{{ route('faq.update', [$data->id]) }}" 
                                
                            @else
                                action="{{ route('faq.store') }}" @endif
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
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        @if (isset($data)) value="{{ $data->title }}" @endif required>
                                </div>


                                <div class="col-md-12">
                                    <label for="title" class="form-label">Faq</label>
                                    <div class="form-group">
                                        @if (isset($data))
                                            @php
                                                $faq = !empty($data->faq) ? (is_array($data->faq) ? $data->faq : json_decode($data->faq, true)) : [];
                                            @endphp
                                        @endif

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="clonetable">

                                                @if (isset($faq))
                                                    @foreach ($faq as $key => $item)
                                                        <tr>
                                                        <tr>
                                                            <td class="sl">{{ $key + 1 }}</td>
                                                            <td>
                                                                <input name="question[]" placeholder="questions"
                                                                    class="form-control" type="text"
                                                                    value="{{ $item['question'] }}">
                                                            </td>
                                                            <td>
                                                                <textarea name="answer[]" placeholder="answer" rows="2" class="form-control">{{ $item['answer'] }}</textarea>
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
                                                            <input name="question[]" placeholder="questions"
                                                                class="form-control" type="text">
                                                        </td>
                                                        <td>
                                                            <textarea name="answer[]" placeholder="answer" rows="2" class="form-control"></textarea>
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
        $(document).ready(function(e) {
            $(".add-new-feature").click(function() {
                var tableBody = $('.clonetable');
                var section = tableBody.children('tr:last').clone();

                // Set input field values to null
                section.find('input, textarea').val('');

                tableBody.append(section);
                updateSerialNumbers(tableBody);
            });

            $('body').on('click', '.delete-feature-row', function() {
                $(this).closest('tr').remove();
                var tableBody = $('.clonetable');
                updateSerialNumbers(tableBody);
            });

            function updateSerialNumbers(tableBody) {
                tableBody.find('tr').each(function(index, row) {
                    $(row).find('.sl').text(index + 1);
                });
            }

            // Initial call to set the serial numbers correctly on page load
            updateSerialNumbers($('.clonetable'));
        });
    </script>
@endsection
