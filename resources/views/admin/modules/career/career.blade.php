@extends('admin.layouts.app')
@section('title', 'Career')
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
                            <li class="breadcrumb-item active" aria-current="page">Career</li>
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
                                @if (isset($data)) action="{{ route('career.update', [$data->id]) }}" 
                                
                            @else
                                action="{{ route('career.store') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <div class="col-md-4">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" class="form-select">
                                        <option value="" disabled selected>Select category</option>
                                        @if (isset($careerCategory))
                                            @foreach ($careerCategory as $row)
                                                <option
                                                    @if (isset($data)) @if ($row->id == $data->category_id)
                                                        selected="selected" @endif
                                                    @endif
                                                    value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="name" name="title"
                                        @if (isset($data)) value="{{ $data->title }}" @endif required>
                                </div>
                                @if (isset($data))
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                            value="{{ $data->slug }}">
                                    </div>
                                @endif
                                <div class="col-md-3">
                                    <label for="vacancy" class="form-label">Total vacancy</label>
                                    <input type="text" class="form-control" id="vacancy" name="vacancy"
                                        @if (isset($data)) value="{{ $data->vacancy }}" @endif required>
                                </div>
                                <div class="col-md-3">
                                    <label for="job_type" class="form-label">Job type</label>
                                    <select name="job_type" id="job_type" class="form-select" required>
                                        <option @if (isset($data) && $data->job_type == 'Full-Time') selected @endif value="Full-Time">
                                            Full-Time</option>
                                        <option @if (isset($data) && $data->job_type == 'Part-Time') selected @endif value="Part-Time">
                                            Part-Time</option>
                                        <option @if (isset($data) && $data->job_type == 'Project Based') selected @endif value="Project Based">
                                            Project Based</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option @if (isset($data) && $data->gender == 'Male') selected @endif value="Male">Male
                                        </option>
                                        <option @if (isset($data) && $data->gender == 'Female') selected @endif value="Female">Female
                                        </option>
                                        <option @if (isset($data) && $data->gender == 'Both') selected @endif value="Both">Both
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="total_experience" class="form-label">Total experience</label>
                                    <input type="text" class="form-control" id="total_experience" name="total_experience"
                                        @if (isset($data)) value="{{ $data->total_experience }}" @endif
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="job_location" class="form-label">Job location</label>
                                    <input type="text" class="form-control" id="job_location" name="job_location"
                                        @if (isset($data)) value="{{ $data->job_location }}" @endif
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="job_location_map" class="form-label">Job location map</label>
                                    <input type="text" class="form-control" id="job_location_map" name="job_location_map"
                                        @if (isset($data)) value="{{ $data->job_location_map }}" @endif
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="deadline" class="form-label">Deadline</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline"
                                        @if (isset($data)) value="{{ $data->deadline }}" @endif required>
                                </div>
                                <div class="col-md-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary"
                                        @if (isset($data)) value="{{ $data->salary }}" @endif required>
                                </div>

                                <div class="col-md-12">
                                    <label for="job_description" class="form-label">Job description</label>
                                    <textarea name="job_description" id="mytextarea" rows="5" class="form-control">
                                        @if (isset($data)){{ $data->job_description }}@endif
                                    </textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="key_responsibilities" class="form-label">Key responsibilities</label>
                                    <textarea name="key_responsibilities" id="mytextarea" rows="5" class="form-control">
                                    @if (isset($data)){{ $data->key_responsibilities }}@endif
                                    </textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="skill_experience" class="form-label">Skill and experience</label>
                                    <textarea name="skill_experience" id="mytextarea" rows="5" class="form-control">
                                        @if (isset($data)){{ $data->skill_experience }}@endif
                                    </textarea>
                                </div>
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="Publish" @if (isset($data) && $data->status == 'Publish') selected @endif>Publish
                                        </option>
                                        <option value="Draft" @if (isset($data) && $data->status == 'Draft') selected @endif>Draft
                                        </option>
                                    </select>
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
