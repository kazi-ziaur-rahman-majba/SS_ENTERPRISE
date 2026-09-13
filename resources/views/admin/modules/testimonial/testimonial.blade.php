@extends('admin.layouts.app')
@section('title', 'Testimonial')
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
                            <li class="breadcrumb-item active" aria-current="page">Testimonial</li>
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
                                @if (isset($data)) action="{{ route('testimonial.update', [$data->id]) }}" 
                                
                            @else
                                action="{{ route('testimonial.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif


                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        @if (isset($data)) value="{{ $data->name }}" @endif required>
                                </div>

                                <div class="col-md-6">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="name" name="designation"
                                        @if (isset($data)) value="{{ $data->designation }}" @endif required>
                                </div>
                                <div class="col-md-6">
                                    <label for="feedback" class="form-label">Feedback</label>
                                    <textarea name="feedback" id="mytextarea2" rows="3" class="form-control">
                                        @if (isset($data))
{{ $data->feedback }}
@endif
                                    </textarea>

                                </div>

                                <div class="col-md-6">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input type="number" class="form-control" id="rating" name="rating" max="5"
                                        min="1" @if (isset($data)) value="{{ $data->rating }}" @endif
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

@section('extra-script')
    <script>
    // Get the input element
    var ratingInput = document.getElementById('rating');

    // Add an event listener to the input element
    ratingInput.addEventListener('input', function() {
        // Convert the input value to a number
        var rating = parseInt(ratingInput.value);

        // Check if the rating is greater than 5
        if (rating > 5) {
            // If the rating is greater than 5, set the value to 5
            ratingInput.value = 5;
        }
    });
</script>
@endsection