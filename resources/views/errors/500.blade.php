@extends('layouts.app')
@section('title', 'Error Page')
@section('content')

    <section class="team-section">
        <div class="error-page-area default-padding">
            <div class="container">
                <div class="row align-center text-center">
                    <div class="col-lg-8 offset-lg-2">
                        <div id="wrap">
                            <div class="hand hand-left">
                                <span class='hand-part part-top'></span>
                                <span class='hand-part part-middle'></span>
                                <span class='hand-part part-bottom'></span>
                            </div>
                            <div class="hand hand-right">
                                <span class='hand-part part-top'></span>
                                <span class='hand-part part-middle'></span>
                                <span class='hand-part part-bottom'></span>
                            </div>
                            <div class='line line-1'>
                                <div class="ball">5</div>
                            </div>
                            <div class='line line-2'>
                                <div class="ball">0</div>
                            </div>
                            <div class='line line-3'>
                                <div class="ball">0</div>
                            </div>
                            <div id="server">
                                <div class="eye eye-left"><span></span></div>
                                <div class="eye eye-right"><span></span></div>
                                <div class="block">
                                    <div class="light"></div>
                                </div>
                                <div class="block">
                                    <div class="light"></div>
                                </div>
                                <div class="block">
                                    <div class="light"></div>
                                </div>
                                <div class="block">
                                    <div class="light"></div>
                                </div>
                                <div class="block">
                                    <div class="light"></div>
                                </div>
                                <div id="bottom-block">
                                    <div class="bottom-line"></div>
                                    <div id="bottom-light"></div>
                                </div>
                            </div>
                        </div>

                        <div id="code-error">
                            <h1>Internal Server Error!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
