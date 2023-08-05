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


{{--    <section class="banner-sec">--}}
{{--        <div class="container-fluid p-3">--}}
{{--                <h3 class="text-center">News and Notice</h3>--}}
{{--            <div class="row p-3">--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="card"> <img class="img-fluid" src="http://grafreez.com/wp-content/temp_demos/river/img/politics.jpg" alt="">--}}
{{--                        <div class="card-img-overlay"> <span class="badge badge-pill badge-danger">News</span> </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="news-title">--}}
{{--                                <h2 class=" title-small"><a href="#">Syria war: Why the battle for Aleppo matters</a></h2>--}}
{{--                            </div>--}}
{{--                            <p class="card-text"><small class="text-time"><em>3 mins ago</em></small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card"> <img class="img-fluid" src="http://grafreez.com/wp-content/temp_demos/river/img/travel.jpg" alt="">--}}
{{--                        <div class="card-img-overlay"> <span class="badge badge-pill badge-danger">Politics</span> </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="news-title">--}}
{{--                                <h2 class=" title-small"><a href="#">Key Republicans sign letter warning against</a></h2>--}}
{{--                            </div>--}}
{{--                            <p class="card-text"><small class="text-time"><em>3 mins ago</em></small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="card"> <img class="img-fluid" src="http://grafreez.com/wp-content/temp_demos/river/img/business1.jpg" alt="">--}}
{{--                        <div class="card-img-overlay"> <span class="badge badge-pill badge-danger">Travel</span> </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="news-title">--}}
{{--                                <h2 class=" title-small"><a href="#">Obamacare Appears to Be Making People Healthier</a></h2>--}}
{{--                            </div>--}}
{{--                            <p class="card-text"><small class="text-time"><em>3 mins ago</em></small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card"> <img class="img-fluid" src="http://grafreez.com/wp-content/temp_demos/river/img/food.jpg" alt="">--}}
{{--                        <div class="card-img-overlay"> <span class="badge badge-pill badge-danger">News</span> </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="news-title">--}}
{{--                                <h2 class=" title-small"><a href="#">‘S.N.L.’ to Lose Two Longtime Cast Members</a></h2>--}}
{{--                            </div>--}}
{{--                            <p class="card-text"><small class="text-time"><em>3 mins ago</em></small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="card"> <img class="img-fluid" src="http://grafreez.com/wp-content/temp_demos/river/img/business1.jpg" alt="">--}}
{{--                        <div class="card-img-overlay"> <span class="badge badge-pill badge-danger">Travel</span> </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="news-title">--}}
{{--                                <h2 class=" title-small"><a href="#">Obamacare Appears to Be Making People Healthier</a></h2>--}}
{{--                            </div>--}}
{{--                            <p class="card-text"><small class="text-time"><em>3 mins ago</em></small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card"> <img class="img-fluid" src="http://grafreez.com/wp-content/temp_demos/river/img/food.jpg" alt="">--}}
{{--                        <div class="card-img-overlay"> <span class="badge badge-pill badge-danger">News</span> </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="news-title">--}}
{{--                                <h2 class=" title-small"><a href="#">‘S.N.L.’ to Lose Two Longtime Cast Members</a></h2>--}}
{{--                            </div>--}}
{{--                            <p class="card-text"><small class="text-time"><em>3 mins ago</em></small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="card"> <img class="img-fluid" src="http://grafreez.com/wp-content/temp_demos/river/img/business1.jpg" alt="">--}}
{{--                        <div class="card-img-overlay"> <span class="badge badge-pill badge-danger">Travel</span> </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="news-title">--}}
{{--                                <h2 class=" title-small"><a href="#">Obamacare Appears to Be Making People Healthier</a></h2>--}}
{{--                            </div>--}}
{{--                            <p class="card-text"><small class="text-time"><em>3 mins ago</em></small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card"> <img class="img-fluid" src="http://grafreez.com/wp-content/temp_demos/river/img/food.jpg" alt="">--}}
{{--                        <div class="card-img-overlay"> <span class="badge badge-pill badge-danger">News</span> </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="news-title">--}}
{{--                                <h2 class=" title-small"><a href="#">‘S.N.L.’ to Lose Two Longtime Cast Members</a></h2>--}}
{{--                            </div>--}}
{{--                            <p class="card-text"><small class="text-time"><em>3 mins ago</em></small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    {{-- <section class="pt-5 pb-5 mt-5">
        <div class="container-fluid" style="height: 650px; margin-top: 10px">
            <h2 class="text-center">Messages</h2>
            <hr class="midline">
            <div class="card col-md-12 mt-2">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="100000">
                    <div class="w-100 carousel-inner mb-5" role="listbox">
                        <div class="carousel-item active">
                            <div class="bg"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-sm-3 col-4 align-items-start">
                                                <img src="https://s17.postimg.org/mqjuw14bz/profile1.png" alt="" class="rounded-circle img-fluid">
                                            </div>
                                            <div class="col-sm-9 col-8">
                                                <h2>Dr. Mohan Krishna Shrestha - <span>Chairperson</span></h2>
                                                <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                                <small class="smallest mute">- willi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-sm-3 col-4 align-items-start">
                                                <img src="https://s17.postimg.org/5q0yndefz/profile2.png" alt="" class="rounded-circle img-fluid">
                                            </div>
                                            <div class="col-sm-9 col-8">
                                                <h2>Mr. Puspa Raj Khanal - <span>Registrar</span></h2>
                                                <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                                <small class="smallest mute">- willi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="bg"></div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-sm-3 col-4 align-items-start">
                                                <img src="https://s17.postimg.org/7ulbog0n3/profile3.png" alt="" class="rounded-circle img-fluid">
                                            </div>
                                            <div class="col-sm-9 col-8">
                                                <h2>John Doe - <span>Ceo Mobile company</span></h2>
                                                <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                                <small class="smallest mute">- willi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-sm-3 col-4 align-items-start">
                                                <img src="https://s17.postimg.org/u6j4hu7gv/profile4.png" alt="" class="rounded-circle img-fluid">
                                            </div>
                                            <div class="col-sm-9 col-8">
                                                <h2>Helena Doe - <span>Architect</span></h2>
                                                <small>Well incremented. Comes with recommended workout. I'm using it to help with bladder leakage issues that I've been experiencing since a recent vasectomy.</small>
                                                <small class="smallest mute">- willi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
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
