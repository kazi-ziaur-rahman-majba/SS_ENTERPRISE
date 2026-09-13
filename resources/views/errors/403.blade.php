@extends('layouts.app')
@section('title', 'Error Page')
@section('content')
<section id="main-container" class="main-container">
    <div class="container">
        <div class="row">

            <div class="error-page text-center">
                <div class="error-code">
                    <h2><strong>403</strong></h2>
                </div>
                <div class="error-message">
                    <h3>Oops... Page Not Found!</h3>
                </div>
                <div class="error-body">
                    <h4 class="text-md">Access Denied !</h4>
                    <h4 class="text-sm text-sm-btm">You don’t have access to this area of application. Speak to
                        your administrator to unblock this feature. You can go back to
                        <a href="{{ url('/') }}" class="btn btn-primary">Home page</a>
                </div>
            </div>
        
        </div><!-- Content row -->
    </div><!-- Conatiner end -->
</section><!-- Main container end -->

@endsection
