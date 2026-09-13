@php
if(!Auth::user()->email)
{
    @endphp
    <script type="text/javascript">
        window.location.href = '{{url("login")}}';
    </script>
    @php
}
$checkProfile = App\Models\UserProfile::where('email', Auth::user()->email)->count();
$profile_image = "img/users.jpg";
if($checkProfile > 0)
{
    $profInfo = App\Models\UserProfile::where('email', Auth::user()->email)->first();
    $profile_image = url('uploads/images/'.$profInfo->image);
}

$authProf = '';
@endphp
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                {{-- <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div> --}}
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">

                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
    
              <img
                  src="{{$profile_image}}"
                  alt="..." class="user-img"
                />
                       
              
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>

                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ url('admin/profile') }}"><i
                                class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('admin/change-password') }}"><i
                                class="bx bx-key"></i><span>Change Password</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item  logout" href="javascript:void(0);"><i
                                class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="d-none">
        <form action="{{ url('logout') }}" id="logoutsubmit" method="post">
            @csrf
            <button type="submit" class="logoutsubmit">Submit</button>
        </form>
    </div>
</header>
