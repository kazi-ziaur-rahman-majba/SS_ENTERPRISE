@extends('layouts.app')
@section('title', 'Contact Us')
@section('meta')
    <meta name="description" content="{!! $pageCms->meta_description !!}" />
    <meta property="og:title" content="{{ $pageCms->meta }} " />
    <meta property="og:description" content="{!! $pageCms->meta_description !!}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $pageCms->meta }} " />
    <meta name="twitter:description" content="{!! $pageCms->meta_description !!}" />
@endsection
@section('content')
    <div id="banner-area" class="banner-area"
        style="background-image:url({{ asset('assets/') }}/images/banner/banner1.jpg)">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="banner-heading">
                            <h1 class="border-title border-left">Contact Us</h1>
                            <ol class="breadcrumb">
                                <li>Home</li>
                                <li>Contact</li>
                            </ol>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <section id="main-container" class="main-container">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="ts-service-box text-center">
                        <span class="ts-service-icon icon-squre">
                            <i class="fa fa-map"></i>
                        </span>
                        <div class="ts-service-box-content">
                            <h4>Visit Us</h4>
                            <p>{!! $siteSetting->corporate_office_address !!}</p>
                        </div>
                    </div>
                </div><!-- Col 1 end -->

                <div class="col-md-4">
                    <div class="ts-service-box text-center">
                        <span class="ts-service-icon icon-squre">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <div class="ts-service-box-content">
                            <h4>Email Us</h4>
                            <p><a href="mailto:{{ $siteSetting->email }}" class="__cf_email__">{{ $siteSetting->email }}</a>
                            </p>
                        </div>
                    </div>
                </div><!-- Col 2 end -->

                <div class="col-md-4">
                    <div class="ts-service-box text-center">
                        <span class="ts-service-icon icon-squre">
                            <i class="fa fa-phone-square"></i>
                        </span>
                        <div class="ts-service-box-content">
                            <h4>Call Us</h4>
                            <p>{{ $siteSetting->phone }}</p>
                        </div>
                    </div>
                </div><!-- Col 3 end -->

            </div><!-- 1st row end -->

            <div class="gap-40"></div>

            <!-- <div id="map" class="map"></div> -->

            {{--  <div class="map"></div>  --}}
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d138588.10800925622!2d90.263797!3d23.7809194!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sbd!4v1755592405118!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <div class="gap-40"></div>

            <div class="row">

                <div class="col-md-12">
                    <h3 class="border-title border-left">We love to hear</h3>
                    <form method="post" action="{{ route('contact-request.store') }}" id="getContact"role="form">
                        @csrf
                        <div class="error-container"></div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control form-control-name" name="name" id="name"
                                        placeholder="Fulll name.." type="text" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control form-control-email" name="email" id="email"
                                        placeholder="Email.." type="email" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input class="form-control form-control-subject" name="subject" id="subject"
                                        placeholder="Subject.." required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control form-control-phone" name="phone" id="phone"
                                        placeholder="Phone number.." required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control form-control-message" name="message" id="message" placeholder="Message.." rows="10"
                                required></textarea>
                        </div>
                        <div class="text-right"><br>
                            <button class="g-recaptcha btn btn-primary solid blank"
                            data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                            data-callback="onSubmit" data-action="submitContact" type="button">Send Message</button>
                        </div>
                    </form>
                </div>

            </div><!-- Content row -->
        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection

@section('js')
    <script src="{{ url('/') }}/assets/js/sweetalert2@11.js"></script>
    <script>
        function onSubmit(token) {
            // Prevent default form submission
            event.preventDefault();

            // Select the form element
            var form = document.getElementById('getContact');

            var name = form.elements['name'].value;
            var email = form.elements['email'].value;
            var phone = form.elements['phone'].value;
            var subject = form.elements['subject'].value;
            var message = form.elements['message'].value;
            // Perform validation checks
            if (!name || !email || !phone || !message || !subject) {
                // Show error message with SweetAlert if validation fails
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields.',
                });
                return; // Exit the function if validation fails
            }

            // Show loader
            var loader = Swal.fire({
                title: 'Please wait...',
                html: 'Submitting your request',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            // Create a FormData object from the form
            var formData = new FormData(form);

            // Append the reCAPTCHA token to the FormData object
            formData.append('g-recaptcha-response', token);

            // Fetch the form action URL with POST method and FormData
            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Close the loader
                    loader.close();

                    if (data.success) {
                        // If the server indicates success, show a success message with SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                        }).then(() => {
                            // Reset the form
                            form.reset();
                        });
                    } else {
                        // If the server indicates failure, show an error message with SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                            footer: data.errors && data.errors.phone ? data.errors.phone[0] : ''
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Close the loader
                    loader.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing your request.',
                    });
                });
        }
    </script>
@endsection
