@extends('web.layouts.app')
@section('content')
    <section class="nhpc-banner">
        <div class="owl-carousel owl-theme" id="owl1">
            <div class="item">
                <img src="https://nhpc.gov.np/beta/uploads/banners/3a328588b60ac51d1c09ae4b786fab36.jpg" alt="">
            </div>
            <div class="item">
                <img src="https://nhpc.gov.np/beta/uploads/banners/4a7dcdc3bd0d003a2330ea5b4a7742a9.jpg"  alt="">
            </div>
            <div class="item">
                <img src="https://nhpc.gov.np/beta/uploads/banners/3a328588b60ac51d1c09ae4b786fab36.jpg" alt="">
            </div>
        </div>
    </section>
    <section>
        <div class="main-menu">
            <div class="container-fluid">
                <div class="row">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    </nav>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="about_nhpc container mt-2 text-center">
            <h1>Nepal Health Professional Council</h1>
            <p>Nepal Health Professional Council (NHPC) is a autonomous body established under the Nepal
                Health Professional Council Act 2053. The aim of this council is to register all the
                "health professionals" other than medical doctors and nurses according to their qualification;
                and bring them into a legal system as to make their services effective and timely, and in a scientific manner.
            </p>
        </div>
    </section>


    <section>
        <div class="about_nhpc  mt-2  ml-5 mr-5">
            <h3 class="text-center">News and Result</h3>
            <div class="card" style="width: 10rem; height: 14rem">
                <img class="img-responsive" style="height:8rem;" src="https://nhpc.gov.np/beta/uploads/news/5d002e419a3e1305106b68db24c81bc9.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Retotaling Notice</h5>
                </div>
            </div>

        </div>
    </section>
{{--        <section class="bipad-notice section-padding mt-3">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="bipad-notice__tabs wow animated fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">--}}
{{--                        <ul class="nav nav-tabs" id="myTab" role="tablist">--}}

{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"--}}
{{--                                   aria-controls="home" aria-selected="true">समाचार तथा जानकारी</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="daily-bp-tab" data-toggle="tab" href="#daily-bp" role="tab"--}}
{{--                                   aria-controls="daily-bp" aria-selected="false">दैनिक बुलेटिन</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="working-process-tab" data-toggle="tab" href="#working-process" role="tab"--}}
{{--                                   aria-controls="working-process" aria-selected="false">निर्देशिाका/कार्यविधि</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="download-tab" data-toggle="tab" href="#download" role="tab"--}}
{{--                                   aria-controls="download" aria-selected="false">डाउनलोड</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="program-info-tab" data-toggle="tab" href="#program-info" role="tab"--}}
{{--                                   aria-controls="program-info" aria-selected="false">कार्यक्रमहरुको सूची</a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                        <div class="tab-content" id="myTabContent">--}}
{{--                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-6">--}}
{{--                                        <ul class="list-unstyled">--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg-6">--}}
{{--                                        <ul class="list-unstyled">--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="vm-btn">थप हेर्नुहोस् <i class="fa fa-angle-right"></i></a>--}}
{{--                            </div>--}}
{{--                            <div class="tab-pane fade" id="daily-bp" role="tabpanel" aria-labelledby="daily-bp-tab">--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-6">--}}
{{--                                        <ul class="list-unstyled">--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg-6">--}}
{{--                                        <ul class="list-unstyled">--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                            <a href="" target="_blank">--}}
{{--                                                <li>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <span class="col-lg-2"><img src="images/flag.gif" alt=""></span>--}}
{{--                                                        <div class="col-lg-9"><span>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना </span>--}}
{{--                                                            <p>फ्युमिगेसन सीट खरिद सम्बन्धी गोप्य शिलवन्दी दरभाउपत्र आह्वानकोे सूचना</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </a>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="vm-btn">थप हेर्नुहोस् <i class="fa fa-angle-right"></i></a>--}}



{{--                            </div>--}}
{{--                            <div class="tab-pane fade" id="working-process" role="tabpanel" aria-labelledby="working-process-tab">--}}
{{--                                <ul class="list-unstyled">--}}

{{--                                </ul>--}}
{{--                                <a href="#" class="vm-btn">थप हेर्नुहोस् <i class="fa fa-angle-right"></i> </a>--}}
{{--                            </div>--}}
{{--                            <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">--}}
{{--                                <ul class="list-unstyled">--}}

{{--                                </ul>--}}
{{--                                <a href="#" class="vm-btn">थप हेर्नुहोस् <i class="fa fa-angle-right"></i> </a>--}}
{{--                            </div>--}}
{{--                            <div class="tab-pane fade" id="program-info" role="tabpanel" aria-labelledby="program-info-tab">--}}
{{--                                <ul class="list-unstyled">--}}

{{--                                </ul>--}}
{{--                                <a href="#" class="vm-btn">थप हेर्नुहोस् <i class="fa fa-angle-right"></i> </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}






@endsection
@push('script')
    <script>
        $(document).ready(function() {

            $('#owl1').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });
        });


        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            autoplay: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>

    @endpush
