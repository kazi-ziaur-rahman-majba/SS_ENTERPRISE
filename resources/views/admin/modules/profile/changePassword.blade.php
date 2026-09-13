@extends('admin.layouts.app')
@section('title','Admin Profile')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            @include('admin.extras.alert')
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">

              <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div>
                          <i class="fadeIn animated bx bx-key"></i>
                        </div>
                        <h5 class="mb-0 text-primary"> Change Password</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{ route('changeDoPassword', [$profile->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8 mt-4 mx-auto">
                                
                                
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">New Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control" name="password" value="{{$profile->name}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control" name="password_confirmation" value="{{$profile->designation}}" />
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Update Password" />
                                            </div>
                                        </div>
                                 
                                
                            </div>
                        </div>
                    </form>
                </div>

              </div>
                </div>
            </div>
        
    </div>
</div>
@endsection
@section('footer-js')
<script>

    function readURL(input, id) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "svg")) {
            var reader = new FileReader();
            
            reader.onload = function (e) {                    
                $("#"+id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $("#"+id).attr('src', 'uploads/images/noImage.png');
        }
    }

    function readImgURL(input) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "svg")) {
            var reader = new FileReader();
            reader.onload = function (e) {                    
                $(input).parent().parent().children('td:eq(2)').children('img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            console.log('No Image');
            $(input).parent().parent().children('td:eq(2)').children('img').attr('src', 'uploads/images/noImage.png');
            //$("#"+id).attr('src', 'uploads/images/noImage.png');
        }
    }
</script>

@endsection