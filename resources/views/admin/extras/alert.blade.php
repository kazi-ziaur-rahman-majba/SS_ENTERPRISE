@if (session('success'))
    <div class="row successPlace">
        <div class="col-xl-12">
            <div class="alert alert-success border-0  bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                    </div>
                    <div class="ms-3">
                        {{-- <h6 class="mb-0 text-white">Success Alerts</h6> --}}
                        <div class="text-white">{!! \Session::get('success') !!}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function(){
            $('.successPlace').fadeOut('slow');
        }, 10000);
    </script>
    <?php 
   Session::forget('success');
    ?>

@endif

@if (session('error'))
    <div class="row allDanger">
        <div class="col-xl-12">
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                    </div>
                    <div class="ms-3">
                        {{-- <h6 class="mb-0 text-white">Danger Alerts</h6> --}}
                        <div class="text-white">{!! \Session::get('error') !!}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        setTimeout(function(){
            $('.allDanger').fadeOut('slow');
        }, 10000);
    </script>
    <?php 
      Session::forget('error');
    ?>
@endif

@if (count($errors) > 0)
     @foreach ($errors->all() as $error)
     <div class="row allDanger">
        <div class="col-xl-12">
            <div class="alert alert-danger border-0 bg-danger  alert-dismissible fade show">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                    </div>
                    <div class="ms-3">
                        {{-- <h6 class="mb-0 text-white">Danger Alerts</h6> --}}
                        <div class="text-white">{{ $error }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
     </div>
    @endforeach
    <script type="text/javascript">
        setTimeout(function(){
            $('.allDanger').fadeOut('slow');
        }, 10000);
    </script>
@endif