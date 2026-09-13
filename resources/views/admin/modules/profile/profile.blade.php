@php
    $checkProfile = App\Models\UserProfile::where('email', Auth::user()->email)->count();
    $profile_image = "https://png.pngtree.com/element_our/png_detail/20181206/users-vector-icon-png_260862.jpg";
    if($checkProfile > 0)
    {
        $profInfo = App\Models\UserProfile::where('email', Auth::user()->email)->first();
        $profile_image = url('uploads/images/'.$profInfo->image);
    }
@endphp
@extends('admin.layouts.app')
@section('title', 'Profile update')
@section('content')
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
          <div class="card overflow-hidden radius-10">
            <div class="profile-cover bg-dark position-relative mb-4">
              <div
                class="
                  user-profile-avatar
                  shadow
                  position-absolute
                  top-50
                  start-0
                  translate-middle-x
                "
              >
              @if(isset($data)) 
             
              <img
                  src="{{$profile_image}}"
                  alt="..."
                />
              @else
                <img
                  src="https://png.pngtree.com/element_our/png_detail/20181206/users-vector-icon-png_260862.jpg"
                  alt="..."
                />
                @endif
              </div>
            </div>
            <div class="card-body">
              <div
                class="
                  mt-5
                  d-flex
                  flex-column flex-sm-row
                  align-items-start
                  justify-content-between
                  gap-3 gap-sm-0
                "
              >
                <div class="">
                  <h3 class="mb-2">
                    {{ Auth::user()->name }}
                  </h3>
                  <p class="mb-1">
                    <strong>Email:</strong>
                    {{ Auth::user()->email }}
                  </p>
                </div>
                <div class="">
                  
                  <a
                    href="{{url('admin/change-password')}}"
                    class="btn btn_primary"
                  >
                    <i class="bx bxs-key"></i>
                    Change Password</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div  class="card radius-10">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" action="{{ url('admin/profile-update') }}">
                @csrf
                <h5 class="mb-3">Edit Profile</h5>
                {{--  <h5 class="mb-0 mt-4">User Information</h5>  --}}
                <hr />
                <div class="row g-3">
                  <div class="col-12 col-sm-6">
                    <label class="form-label">First Name</label>
                    <input
                      type="text"
                      class="form-control"
                      name="first_name"
                      placeholder="N/A"
                      @if(isset($data)) value="{{ $data->first_name}}" @endif
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <label class="form-label">Last Name</label>
                    <input
                      type="text"
                      class="form-control"
                     name="last_name"
                      placeholder="N/A"
                      @if(isset($data)) value="{{ $data->last_name}}" @endif
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <label class="form-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      email="email"
                      disabled
                      value="{{ Auth::user()->email }}"
                      placeholder="N/A"
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <label class="form-label">Mobile Number</label>
                    <input
                      type="text"
                      class="form-control"
                      name="phone"
                      placeholder="N/A"
                      @if(isset($data)) value="{{ $data->phone}}" @endif
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <label class="form-label">Full Address</label>
                    <input
                      type="text"
                      class="form-control"
                      name="address"
                      placeholder="N/A"
                      @if(isset($data)) value="{{ $data->address}}" @endif
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <label class="form-label">City</label>
                    <input
                      type="text"
                      class="form-control"
                     name="city"
                      placeholder="N/A"
                      @if(isset($data)) value="{{ $data->city}}" @endif
                    />
                  </div>

                  <div class="col-12 col-sm-6">
                    <label class="form-label">Postal Code</label>
                    <input
                      type="text"
                      class="form-control"
                     name="post_code"
                      placeholder="N/A"
                      @if(isset($data)) value="{{ $data->post_code}}" @endif
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <label class="form-label">Country</label>
                    <input
                      type="text"
                      class="form-control"
                     name="country"
                      placeholder="N/A"
                      @if(isset($data)) value="{{ $data->country}}" @endif
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <label class="form-label">Image</label>
                    <input
                      type="file"
                      class="form-control"
                     name="image"
                      placeholder="N/A"
                    />
                    <input type="hidden" name="ex_photo" @if(isset($data)) value="{{ $profInfo->image }}" @endif>
                  </div>
                </div>
                <div class="text-start mt-3">
                  <button
                    type="submit"
                    class="btn btn_primary px-4"
                  >
                    Save Changes
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
  <style type="text/css">
    .radius-10 {
    border-radius: 10px !important;
}

.profile-cover {
    background-image: url({{asset("admin/img/Qligence3.png")}});
    background-size: cover;
    height: 10rem;
    background-position: center;
}
.user-profile-avatar {
    background-color: #ffffff;
    width: 160px;
    height: 160px;
    padding: 5px;
    border-radius: 50%;
    margin-left: 6.5rem;
}
.user-profile-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
}
.btn_primary {
    color: #fff;
    background-color: #037de2;
    border-color: #037de2;
}
.btn_primary:hover {
    color: #fff;
    background-color: #8436a8;
    border-color: #8436a8;
}
.btn_primary:focus {
    color: #fff;
    background-color: #8436a8;
    border-color: #8436a8;
    box-shadow: 0 0 0 0.25rem rgb(132 54 168 / 50%);
}
.btn_outline_primary {
    color: #923eb9;
    border-color: #923eb9;
}
.btn_outline_primary:hover {
    color: #fff;
    background-color: #923eb9;
    border-color: #923eb9;
}
.btn_outline_primary:focus {
    box-shadow: 0 0 0 0.25rem rgb(84 55 145 / 50%);
}
.user-change-photo {
    background-color: #ffffff;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    padding: 5px;
}
.user-change-photo img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

  </style>
  @endsection
