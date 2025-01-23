@extends('web.layout.app')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .gm-style-iw-chr {
        display: none;
    }

    .gm-style .gm-style-iw-c {
        padding: 0;
    }

    .gm-style-iw-d {
        overflow: hidden !important;
    }

    .property-popup {
        width: 13rem;
        height: 14rem;
    }

    #saleModalSpy {
        .nav-link.active {
            color: #000;
        }
    }

    #map {
        position: relative;
        width: 100%;
        /* this height must be same as in scrollable/map class or give body overflow:hidden */
        height: calc(100vh - 130px);
        transition: all 0.3s ease-in-out;
    }

    .zoom-message {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
        z-index: 1000;
    }

    #map-options {
        position: absolute;
        top: 10px;
        right: 10px;
        background: white;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        z-index: 1000;
        width: 250px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #map-options h5 {
        margin-bottom: 10px;
        font-weight: bold;
    }

    #map-options label {
        display: block;
        margin-bottom: 8px;
        cursor: pointer;
    }



    .carousel-indicators button {
        width: 5px !important;

        height: 5px !important;
        border-radius: 50% !important;
    }

    /* Make the section scrollable */
    .scrollable {
        /* this height must be same as in scrollable/map class or give body overflow:hidden */
        height: calc(100vh - 130px);
        overflow: auto;
        transition: all 0.3s ease-in-out;
    }


    .featureContainer {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 768px) {
        .featureContainer {
            width: 750px;
        }
    }

    @media (min-width: 992px) {
        .featureContainer {
            width: 970px;
        }
    }

    @media (min-width: 1200px) {
        .featureContainer {
            width: 1170px;
        }
    }


    @media (max-width: 767px) {
        .property-popup {
            width: 9rem;
            height: 10rem;
        }

        #map {
            /* this height must be same as in scrollable/map class or give body overflow:hidden */
            height: calc(100vh - 150px);
        }

        .scrollable {
            display: none;
        }

        .featureContainer .carousel-inner .carousel-item>div {
            display: none;
        }

        .featureContainer .carousel-inner .carousel-item>div:first-child {
            display: block;
        }
    }

    .featureContainer .carousel-inner .carousel-item.active,
    .featureContainer .carousel-inner .carousel-item-next,
    .featureContainer .carousel-inner .carousel-item-prev {
        display: flex;
    }

    @media (min-width: 768px) {

        .featureContainer .carousel-inner .carousel-item-end.active,
        .featureContainer .carousel-inner .carousel-item-next {
            transform: translateX(25%);
        }

        .featureContainer .carousel-inner .carousel-item-start.active,
        .featureContainer .carousel-inner .carousel-item-prev {
            transform: translateX(-25%);
        }

        .featureContainer .carousel-item {
            justify-content: space-between;
        }
    }

    .featureContainer .carousel-inner .carousel-item-end,
    .featureContainer .carousel-inner .carousel-item-start {
        transform: translateX(0);
    }

    .featureContainer .card {
        border: 0;
    }

    .featureContainer .card {
        position: relative;
    }

    .featureContainer .card .card-img-overlays {
        position: absolute;
        bottom: 15%;
        left: 10%;
    }

    .featureContainer a {
        text-decoration: none;
    }

    .featureContainer .indicator {
        border: 1px solid rgb(202, 202, 202);
        padding: 3px 6px 3px 6px;
    }

    .featureContainer .indicator:hover {
        background-color: blue;
        border: 1px solid blue;
        transition: 200ms;
    }

    .featureContainer .indicator:hover {
        color: white;
        transition: 200ms;
    }

    .featureContainer .indicator {
        color: lightgray;
    }

    .featureContainer .float-end {
        padding-top: 10px;
    }

    .score-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #4CAF50;
        /* Green color */
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2rem;
        color: white;
        margin-right: 20px;
    }

</style>

<style>
    .info-card {
        display: flex;
        align-items: center;
        justify-content: start;
        padding: 15px;
        border: 1px solid #eaeaea;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .info-card i {
        font-size: 15px;
        margin-right: 10px;
    }

</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="map-sort-bar z-1 d-md-none rounded mb-3 d-flex shadow position-fixed bottom-0 start-50 translate-middle-x  px-3 py-2" style="background-color:#E0F2FF">
        <div id="toggle_map_button" class=" text-primary d-flex align-items-center d-none">
            <i class="fa-regular fa-map me-2"></i> Map
        </div>
        <div class="border-end mx-1"></div>
        <div id="toggle_sort_button" class=" d-flex align-items-center text-primary d-none" data-bs-toggle="offcanvas" data-bs-target="#sortOffcanvas" aria-controls="sortOffcanvas">
            <i class="fa-solid fa-arrow-up-short-wide me-2"></i> Sort
        </div>

        <div id="toggle_property_listing_button" class="z-1 d-flex align-items-center text-primary "><i class="fa-solid fa-list-ul me-2"></i>List</div>
    </div>
    <!-- Off-Canvas -->
    <div class="offcanvas offcanvas-start w-100" tabindex="-1" id="sortOffcanvas" aria-labelledby="sortOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="sortOffcanvasLabel">Sort results by</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item text-center">Homes for You</li>
                <li class="list-group-item text-center">Price (High to Low)</li>
                <li class="list-group-item text-center">Price (Low to High)</li>
                <li class="list-group-item text-center">Newest</li>
                <li class="list-group-item text-center">Bedrooms</li>
                <li class="list-group-item text-center">Bathrooms</li>
                <li class="list-group-item text-center">Square Feet</li>
                <li class="list-group-item text-center">Lot Size</li>
            </ul>
        </div>
    </div>


</div>
<div class="container-fluid">


    <!-- Modal for sale-->
    <div class="modal fade modal-xl " id="saleModal" tabindex="-1" aria-labelledby="saleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">


                <div class="modal-header sticky-top bg-light bg-gradient">
                    <div class="">
                        <p class="d-md-block d-none"><b>$729,000 4</b> bds <b>2</b> ba <b>19,998</b> sqft</p>
                        <i class="fa-solid fa-chevron-left d-md-none d-block"></i>
                    </div>
                    <div class="ms-auto d-flex align-items-center">
                        <nav id="saleModalSpy" class="navbar navbar-light bg-light px-3">

                            <ul class="nav nav-pills d-md-flex d-none">
                                <li class="nav-item">
                                    <a class="nav-link" href="#Highlights">Highlights</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Details">Details</a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                    <div class="ms-auto d-flex align-items-center">
                        <a class="btn me-2 d-flex align-items-center"><span class="d-md-flex d-none me-1"> Save </span>
                            <i class="fa-regular fa-heart"></i></a>
                        <a class="btn me-2 d-flex align-items-center"><span class="d-md-flex d-none me-1">Share </span>
                            <i class="fa-solid fa-share-alt"></i></a>
                        {{-- <a class="btn me-2 d-flex align-items-center"><span class="d-md-flex d-none me-1"> Hide </span>
                            <i class="fa-solid fa-ban"></i></a> --}}
                        {{-- <a class="btn me-2"><i class="fa-solid fa-ellipsis"></i></a> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>


                <div class="modal-body p-0" data-bs-spy="scroll" data-bs-target="#saleModalSpy" data-bs-offset="0" class="scrollspy-example" tabindex="0">

                    <div class="" id="Highlights">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('web/img/h2.webp') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            {{-- <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button> --}}
                        </div>
                    </div>
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div>
                                    <div class="accordion bg-white" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header justify-content-center align-items-center" id="headingOne">
                                                <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <span class="me-md-3">Mark Reling</span> | <img class="ms-3" src="{{ asset('web/img/logo.png') }}" width="30" alt="">
                                                    MVPS Realtors
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="d-flex">
                                                        <div>
                                                            <img width="100" class="rounded-circle border border-light " src="{{ asset('web/img/user.png') }}" alt="">
                                                        </div>

                                                        <div class="ms-md-3">
                                                            <h5 class="m-0">Mark Reling</h5>
                                                            <h6 class="m-0">MVPS Realtors</h6>
                                                            <h6 class="m-0"><a href="" class="text-decoration-none">586-634-4545</a></h6>
                                                        </div>

                                                    </div>

                                                    <p>
                                                        I became a full time Realtor in 1987 and have over 37 years
                                                        experience in the Metro Detroit area. I am Broker-Owner of MVPS
                                                        Realtors and we are loctaed in Sterling Heights. I take pride in
                                                        the
                                                        fact that most of my business comes from past clients and
                                                        referrals.
                                                        If you are looking to buy or sell, I would love to talk to you!!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="">
                                        <div class="badge bg-secondary">
                                            <span class=" bg-danger rounded-circle"></span> Foreclosure
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h2 class="fw-bold">$259,900</h2>
                                                <p class="mt-0">14574 Rutland St, Detroit, MI 48227 </p>
                                            </div>
                                            <div>
                                                <h2 class="fw-bold">9</h2>
                                                <p>baths</p>

                                            </div>
                                            <div>
                                                <h2 class="fw-bold">9</h2>
                                                <p>beds</p>

                                            </div>
                                            <div>
                                                <h2 class="fw-bold">9889</h2>
                                                <p>sqft</p>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- First Info Card -->
                                        <div class="col-md-6">
                                            <div class="info-card">
                                                <i class="fa-solid fa-house"></i>
                                                <span>Single family residence</span>
                                            </div>
                                        </div>
                                        <!-- Second Info Card -->
                                        <div class="col-md-6">
                                            <div class="info-card">
                                                <i class="fa-solid fa-hammer"></i>
                                                <span>Built in 1938</span>
                                            </div>
                                        </div>
                                        <!-- Third Info Card -->
                                        <div class="col-md-6">
                                            <div class="info-card">
                                                <i class="fa-solid fa-landmark"></i>
                                                <span>0.59 Acres</span>
                                            </div>
                                        </div>
                                        <!-- Fourth Info Card -->
                                        <div class="col-md-6">
                                            <div class="info-card">
                                                <i class="fa-solid fa-square-parking"></i>
                                                <span>3 Garage spaces</span>
                                            </div>
                                        </div>
                                        <!-- Fifth Info Card -->
                                        <div class="col-md-6">
                                            <div class="info-card">
                                                <i class="fa-solid fa-dollar-sign"></i>
                                                <span>$38 price/sqft</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <h4 class="fw-bold">What's special</h4>
                                        <p>WoW!!! Unbelievable oppurtunity!! Stately mansion in one of Detroits finest
                                            Neighborhoods! Awesome curb appeal. Beautiful woodwork throughout, and a
                                            grand
                                            staircase. Huge lot. Oversized garage. Your chance to truly own one of the
                                            gems
                                            of Detroit. Close to major freeways.</p>

                                        <div class="d-flex">
                                            <span class="fw-bold ps-3"> 8 days </span> <span class="ps-2"> on
                                                {{ env('APP_NAME') }} | </span>

                                            <span class="fw-bold ps-3"> 37,209</span><span class="ps-2">views | </span>

                                            <span class="fw-bold ps-3"> 2,106 </span>
                                            <span class="ps-2"> saves </span>
                                        </div>
                                        <div class="text-black-50">
                                            Source: Realcomp II,MLS#: 20240093392 <img src="{{ asset('web/img/logo.png') }}" width="40" alt="">
                                        </div>
                                    </div>

                                    {{-- <div class="row g-3 my-3">
                                        <!-- All Photos -->
                                        <div class="col-md-4">
                                            <div class="position-relative rounded overflow-hidden">
                                                <img src="{{ asset('web/img/h1.webp') }}" class="img-fluid"
                                    alt="All Photos">
                                    <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 text-white text-center py-2">
                                        All photos
                                    </div>
                                </div>
                            </div>
                            <!-- Floor Plans -->
                            <div class="col-md-4">
                                <div class="position-relative rounded overflow-hidden">
                                    <img src="{{ asset('web/img/h2.webp') }}" class="img-fluid" alt="Floor Plans">
                                    <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 text-white text-center py-2">
                                        Floor plans
                                    </div>
                                </div>
                            </div>
                            <!-- 3D Home -->
                            <div class="col-md-4">
                                <div class="position-relative rounded overflow-hidden">
                                    <img src="{{ asset('web/img/h1.webp') }}" class="img-fluid" alt="3D Home">
                                    <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 text-white text-center py-2">
                                        3D home
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="position-relative bg-light rounded" style="height: 500px;">
                                    <!-- Placeholder for Google Map -->
                                    <iframe class="w-100 h-100 border rounded" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24176.231892173613!2d-73.98930819999999!3d40.748817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1689182866251!5m2!1sen!2sus" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    <!-- Street View Overlay -->
                                    <div class="position-absolute top-0 start-0 p-2">
                                        <div class="bg-white border rounded shadow-sm">
                                            <img src="{{ asset('web/img/h2.webp') }}" width="100" class="img-fluid rounded" alt="Street View">
                                            <div class="text-center">Street View</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Legend Section -->
                        <div class="row my-3">
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <i class="bi bi-zoom-out"></i>
                                    </div>
                                    <span>Zoom out</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="rounded bg-success" style="width: 20px; height: 20px; margin-right: 8px;"></div>
                                    <span>Kitchen</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="rounded bg-danger" style="width: 20px; height: 20px; margin-right: 8px;"></div>
                                    <span>Living Room</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="rounded bg-primary" style="width: 20px; height: 20px; margin-right: 8px;"></div>
                                    <span>Dining Room</span>
                                </div>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text bg-white" id="addon-wrapping"><i class="fa-solid fa-car-side text-primary"></i></span>
                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="addon-wrapping">
                            </div>
                        </div>

                        {{-- <div class="row my-3">

                                        <ul class="nav nav-pills mb-3 justify-content-between align-items-center"
                                            id="pills-tab" role="tablist">
                                            <li class="nav-item h6 fw-bold">Kitchen</li>
                                            <li class="nav-item " role="presentation" aria-label="Basic example">
                                                <div class="btn-group" role="group">

                                                    <button class="nav-link rounded-pill active p-2"
                                                        id="pills-photoes-kitchen-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-photoes-kitchen" type="button" role="tab"
                                                        aria-controls="pills-photoes-kitchen"
                                                        aria-selected="true">Photoes</button>
                                                    <button class="nav-link rounded-pill" id="pills-3d-kitchen-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-3d-kitchen"
                                                        type="button" role="tab" aria-controls="pills-3d-kitchen"
                                                        aria-selected="false">3D
                                                        Tour</button>
                                                </div>
                                            </li>
                                            <li class="nav-item"><img src="{{ asset('web/img/floor1.png') }}"
                        width="100" alt=""></li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-photoes-kitchen" role="tabpanel" aria-labelledby="pills-photoes-kitchen-tab">
                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <img class="img-fluid" src="{{ asset('web/img/h1.webp') }}" alt="">
                                    </div>
                                    <div class="col-md-6 pe-0">
                                        <img class="img-fluid" src="{{ asset('web/img/h2.webp') }}" alt="">
                                    </div>
                                    <div class="col-md-6 ps-2">
                                        <img class="img-fluid" src="{{ asset('web/img/h1.webp') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-3d-kitchen" role="tabpanel" aria-labelledby="pills-3d-kitchen-tab">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('web/img/h1.webp') }}" class="img-fluid" alt="3D Image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">

                        <ul class="nav nav-pills mb-3 justify-content-between align-items-center" id="pills-tab" role="tablist">
                            <li class="nav-item h6 fw-bold">Living Room</li>
                            <li class="nav-item " role="presentation" aria-label="Basic example">
                                <div class="btn-group" role="group">

                                    <button class="nav-link rounded-pill active p-2" id="pills-photoes-living-room-tab" data-bs-toggle="pill" data-bs-target="#pills-photoes-living-room" type="button" role="tab" aria-controls="pills-photoes-living-room" aria-selected="true">Photoes</button>
                                    <button class="nav-link rounded-pill" id="pills-3d-living-room-tab" data-bs-toggle="pill" data-bs-target="#pills-3d-living-room" type="button" role="tab" aria-controls="pills-3d-living-room" aria-selected="false">3D
                                        Tour</button>
                                </div>
                            </li>
                            <li class="nav-item"><img src="{{ asset('web/img/floor1.png') }}" width="100" alt=""></li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-photoes-living-room" role="tabpanel" aria-labelledby="pills-photoes-living-room-tab">
                                <div class="row">

                                    <div class="col-md-6 pe-0">
                                        <img class="img-fluid" src="{{ asset('web/img/h2.webp') }}" alt="">
                                    </div>
                                    <div class="col-md-6 ps-2">
                                        <img class="img-fluid" src="{{ asset('web/img/h1.webp') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-3d-living-room" role="tabpanel" aria-labelledby="pills-3d-living-room-tab">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('web/img/h2.webp') }}" class="img-fluid" alt="3D Image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">

                        <ul class="nav nav-pills mb-3 justify-content-between align-items-center" id="pills-tab" role="tablist">
                            <li class="nav-item h6 fw-bold">Primary Bedroom</li>
                            <li class="nav-item " role="presentation" aria-label="Basic example">
                                <div class="btn-group" role="group">

                                    <button class="nav-link rounded-pill active p-2" id="pills-photoes-bedroom-tab" data-bs-toggle="pill" data-bs-target="#pills-photoes-bedroom" type="button" role="tab" aria-controls="pills-photoes-bedroom" aria-selected="true">Photoes</button>
                                    <button class="nav-link rounded-pill" id="pills-3d-bedroom-tab" data-bs-toggle="pill" data-bs-target="#pills-3d-bedroom" type="button" role="tab" aria-controls="pills-3d-bedroom" aria-selected="false">3D
                                        Tour</button>
                                </div>
                            </li>
                            <li class="nav-item"><img src="{{ asset('web/img/floor1.png') }}" width="100" alt=""></li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-photoes-bedroom" role="tabpanel" aria-labelledby="pills-photoes-bedroom-tab">
                                <div class="row">

                                    <div class="col-md-6 pe-0">
                                        <img class="img-fluid" src="{{ asset('web/img/h2.webp') }}" alt="">
                                    </div>
                                    <div class="col-md-6 ps-2">
                                        <img class="img-fluid" src="{{ asset('web/img/h1.webp') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-3d-bedroom" role="tabpanel" aria-labelledby="pills-3d-bedroom-tab">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('web/img/h2.webp') }}" class="img-fluid" alt="3D Image">
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="row">
                                        <div class="col-12 ms-md-3 align-items-center">
                                            <button
                                                class="btn btn-outline-light text-primary fw-bold border border-primary align-items-center btn-block">See
                                                all media <i class="fa fa-arrow-right"></i> </button>
                                        </div>
                                    </div> --}}
                    <hr>
                    <div class="row my-3">
                        <p class="small fw-light my-1">
                            Listed by: Dj Della Sala 904-643-6199, DJ & Lindsey Real Estate, Gage King
                            386-546-6557, DJ & Lindsey Real Estate</p>
                        <p class="small fw-light my-1">Source: St Augustine St Johns County BOR,
                            MLS#:
                            245880</p>
                        <p class="small fw-light my-1">
                            {{ env('APP_NAME') }} last checked: 15 hours ago</p>
                        <p class="small fw-light my-1">
                            Listing updated: December 13, 2024 at 07:35am</p>
                    </div>
                </div>
                <hr>
                <div id="Details">
                    <div class="details-section px-3">
                        <!-- Facts & Features -->
                        <h2>Facts & Features</h2>
                        <h5 class="mb-4 col-12 bg-light">Interior</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Bedrooms & Bathrooms</h6>
                                <ul>
                                    <li>Bedrooms: 4</li>
                                    <li>Bathrooms: 3</li>
                                    <li>Full Bathrooms: 2</li>
                                    <li>1/2 Bathrooms: 1</li>
                                </ul>
                                <h6>Primary Bedroom</h6>
                                <p>Level: Second</p>
                                <h6>Heating</h6>
                                <p>Central, Electric</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Cooling</h6>
                                <p>Central Air, Electric</p>
                                <h6>Features</h6>
                                <p>Flooring: Carpet, Laminate</p>
                                <h6>Interior Area</h6>
                                <ul>
                                    <li>Total Structure Area: 3,286 sqft</li>
                                    <li>Total Interior Livable Area: 3,286 sqft</li>
                                </ul>
                                {{-- <h6>Virtual Tour</h6>
                                                <a href="#" class="text-primary">View Virtual Tour</a> --}}
                            </div>
                        </div>

                        <!-- Property Details -->
                        <h5 class="mb-4 col-12 bg-light">Property</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Parking</h6>
                                <ul>
                                    <li>Total Spaces: 2</li>
                                    <li>Parking Features: 2 Car Garage</li>
                                    <li>Garage Spaces: 2</li>
                                </ul>
                                <h6>Features</h6>
                                <ul>
                                    <li>Stories: 2</li>
                                    <li>Entry Location: Ground Level</li>
                                    <li>Fencing: Partial</li>
                                    <li>Waterfront Features: Waterfront</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>Lot</h6>
                                <ul>
                                    <li>Size: 7,840 sqft</li>
                                    <li>Features: Less than 1/4 Acre</li>
                                </ul>
                                <h6>Details</h6>
                                <ul>
                                    <li>Parcel Number: 1823240940</li>
                                    <li>Zoning: PUD</li>
                                </ul>
                            </div>
                        </div>

                        {{--
                                        <!-- Construction -->
                                        <h5 class="mb-4 col-12 bg-light">Construction</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Type & Style</h6>
                                                <ul>
                                                    <li>Home Type: SingleFamily</li>
                                                </ul>
                                                <h6>Materials</h6>
                                                <ul>
                                                    <li>Stucco</li>
                                                    <li>Roof: Shingle</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Condition</h6>
                                                <ul>
                                                    <li>New Construction: No</li>
                                                    <li>Year Built: 2006</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Utilities -->
                                        <h5 class="mb-4 col-12 bg-light">Utilities & Green Energy</h5>
                                        <ul>
                                            <li>Sewer: Public Sewer</li>
                                            <li>Water: County</li>
                                        </ul>

                                        <!-- Community & HOA -->
                                        <h5 class="mb-4 col-12 bg-light">Community & HOA</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6>Community</h6>
                                                <ul>
                                                    <li>Features: HOA</li>
                                                    <li>Subdivision: Grand Cay</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <h6>HOA</h6>
                                                <ul>
                                                    <li>Has HOA: Yes</li>
                                                    <li>HOA Fee: $240 semi-annual</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <h6>Location</h6>
                                                <ul>
                                                    <li>Region: Saint Augustine</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Financial Details -->
                                        <h5 class="mb-4 col-12 bg-light">Financial & Listing Details</h5>
                                        <ul>
                                            <li>Price Per Square Foot: $145/sqft</li>
                                            <li>Tax Assessed Value: $443,464</li>
                                            <li>Annual Tax Amount: $5,532</li>
                                            <li>Price Range: $475K - $475K</li>
                                            <li>Date on Market: 12/13/2024</li>
                                            <li>Listing Terms: Cash, Conventional, FHA, VA</li>
                                        </ul> --}}
                    </div>

                    <hr>
                    {{-- <div class="row my-3 price-history">
                                        <h2 class="mb-3">Price history</h2>
                                        <table class="table  align-middle">
                                            <thead>
                                                <tr class="text-secondary">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Event</th>
                                                    <th scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>12/13/2024
                                                        <div class="text-muted small">
                                                            <small>🏘️ St Augustine St Johns County BOR #245880</small>
                                                            <a href="#" class="text-primary">Report</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Listed for sale

                                                    </td>
                                                    <td>
                                                        $475,000 <span class="text-danger">-5%</span><br>
                                                        <span class="text-muted">$145/sqft</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>10/12/2023
                                                        <div class="text-muted small">
                                                            <small>🏠 realMLS #1231826</small> <a href="#"
                                                                class="text-primary">Report</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Sold

                                                    </td>
                                                    <td>
                                                        $500,000 <span class="text-success">+0.2%</span><br>
                                                        <span class="text-muted">$152/sqft</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>10/3/2023
                                                        <div class="text-muted small">
                                                            <small>🏠 realMLS #1231826</small> <a href="#"
                                                                class="text-primary">Report</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Pending sale

                                                    </td>
                                                    <td>
                                                        $499,000<br>
                                                        <span class="text-muted">$152/sqft</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="row my-3 public-text-history">
                                        <h2 class="mb-3">Public tax history</h2>
                                        <table class="table  align-middle">
                                            <thead>
                                                <tr class="text-secondary">
                                                    <th scope="col">Year</th>
                                                    <th scope="col">Property taxes</th>
                                                    <th scope="col">Tax assessment</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2024 </td>
                                                    <td>$5,243 <span class="text-success">+10.5%</span></td>
                                                    <td>$443,464 <span class="text-success">+13.4%</span></td>

                                                </tr>
                                                <tr>
                                                    <td>2023 </td>
                                                    <td>$5,243 <span class="text-success">+10.5%</span></td>
                                                    <td>$443,464 <span class="text-success">+13.4%</span></td>

                                                </tr>
                                                <tr>
                                                    <td>2022 </td>
                                                    <td>$5,243 <span class="text-success">+10.5%</span></td>
                                                    <td>$443,464 <span class="text-success">+13.4%</span></td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="text-secondary">Monthly cost calculator</h5>
                                            <p class="h4">Estimated monthly payment</p>
                                            <p class="h2">$2,888</p>
                                        </div>
                                    </div> --}}

                    <!-- Accordion Section -->
                    {{-- <div class="accordion" id="monthlyCostAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Principal & interest
                                                    <span class="ms-auto">$2,449</span>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#monthlyCostAccordion">
                                                <div class="accordion-body">
                                                    <label class="form-label fw-bold mb-3" for="">Home
                                                        Price</label>
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text bg-white"
                                                            id="addon-wrapping">$</span>
                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="" aria-describedby="addon-wrapping">
                                                    </div>

                                                    <label class="form-label fw-bold" for="">Down Payment</label>

                                                    <div class="input-group mb-3">

                                                        <span class="input-group-text bg-white"
                                                            id="addon-wrapping">$</span>
                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="" aria-describedby="addon-wrapping">
                                                        <input type="text" class="form-control"
                                                            aria-label="Dollar amount (with dot and two decimal places)">
                                                        <span class="input-group-text bg-white">%</span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <label class="form-label fw-bold" for="">Loan
                                                                Program</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example">
                                                                <option selected>30-year fixed</option>
                                                                <option value="1">15-year fixed</option>
                                                                <option value="1">15-year ARM</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label class="form-label fw-bold" for="">Interest
                                                                Rate</label>

                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" placeholder=""
                                                                    aria-label="" aria-describedby="basic-addon2">
                                                                <span class="input-group-text bg-white"
                                                                    id="basic-addon2">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Mortgage insurance
                                                    <span class="ms-auto">$0</span>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#monthlyCostAccordion">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckChecked" checked>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            Include mortgage insurance
                                                        </label>
                                                        <div>
                                                            <small class="form-text">Mortgage insurance is usually
                                                                required
                                                                for
                                                                down payments below 20%.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Property taxes
                                                    <span class="ms-auto">$273</span>
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#monthlyCostAccordion">
                                                <div class="accordion-body">
                                                    <div class="form-text">
                                                        This estimate is based on the home value, property type, and an
                                                        estimated local tax rate. Actual rate or taxes assessed may
                                                        vary.
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="" class="form-label fw-bold">Home
                                                                Price</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" readonly
                                                                    class="form-control plaintext border-0"
                                                                    placeholder="" value="4000"
                                                                    aria-label="Recipient's username"
                                                                    aria-describedby="basic-addon2">
                                                                <span class="input-group-text bg-white border-0"
                                                                    id="basic-addon2">X</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label for="" class="form-label fw-bold">Tax
                                                                Rate</label>

                                                            <div class="input-group mb-3">
                                                                <input type="number" class="form-control" placeholder=""
                                                                    aria-label="" aria-describedby="basic-addon2">
                                                                <span class="input-group-text"
                                                                    id="basic-addon2">%</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 align-items-center">
                                                            <label for="" class="form-label fw-bold"></label>
                                                            <input type="text" readonly
                                                                class="form-control-plaintext border-0" name=""
                                                                value="= $4000 /year" id="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                    aria-expanded="false" aria-controls="collapseFour">
                                                    Home insurance
                                                    <span class="ms-auto">$166</span>
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse"
                                                aria-labelledby="headingFour" data-bs-parent="#monthlyCostAccordion">
                                                <div class="accordion-body">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-white">$</span>
                                                        <input type="number" class="form-control" value="300">
                                                        <span class="input-group-text bg-white">/year</span>
                                                    </div>
                                                    <div class="form-text">Most lenders require homeowners insurance,
                                                        which protects your home and property.</div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFive">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                    aria-expanded="false" aria-controls="collapseFive">
                                                    HOA fees
                                                    <span class="ms-auto">N/A</span>
                                                </button>
                                            </h2>
                                            <div id="collapseFive" class="accordion-collapse collapse"
                                                aria-labelledby="headingFive" data-bs-parent="#monthlyCostAccordion">
                                                <div class="accordion-body">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-white">$</span>
                                                        <input type="number" class="form-control" value="0">
                                                        <span class="input-group-text bg-white">/month</span>
                                                    </div>
                                                    <div class="form-text">Some properties require monthly HOA dues to
                                                        cover common amenities or services.</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSix">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                    aria-expanded="false" aria-controls="collapseSix">
                                                    Utilities
                                                    <span class="ms-auto">Not included</span>
                                                </button>
                                            </h2>
                                            <div id="collapseSix" class="accordion-collapse collapse"
                                                aria-labelledby="headingSix" data-bs-parent="#monthlyCostAccordion">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Include utilities in payment
                                                        </label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="" class="fw-bold">Water/Sewer</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text bg-white">$</span>
                                                                <input type="number" class="form-control" value="0">
                                                                <span class="input-group-text bg-white">/month</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="" class="fw-bold">Gas</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text bg-white">$</span>
                                                                <input type="number" class="form-control" value="0">
                                                                <span class="input-group-text bg-white">/month</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="" class="fw-bold">Internet</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text bg-white">$</span>
                                                                <input type="number" class="form-control" value="0">
                                                                <span class="input-group-text bg-white">/month</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="" class="fw-bold">Electric</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text bg-white">$</span>
                                                                <input type="number" class="form-control" value="0">
                                                                <span class="input-group-text bg-white">/month</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Disclaimer Section -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <p class="text-muted small">
                                                All calculations are estimates and provided by {{ env('APP_NAME') }},
                    Inc.
                    for
                    informational purposes only. Actual amounts may vary.
                    </p>
                    <p class="text-muted small">
                        Mortgage interest rates are dependent on a number of factors, including
                        credit score, down payment, and repayment length. Interest rate data
                        provided by {{ env('APP_NAME') }} Group Marketplace, Inc. as of 1/1/2025
                        from various
                        mortgage lenders with which we have lead or other similar arrangements;
                        the
                        Estimated Payment is an average of those rates.
                    </p>
                </div>
            </div>
            <div class="row my-3">
                <p>See how much you could borrow to make a competitive offer.</p>
                <div>
                    <button class="btn btn-outline-light  mb-3 text-primary border fw-bold"><span class="badge bg-primary rounded-cirlce">$</span>
                        Get
                        Pre-Qualified</button>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="score-circle">
                            <i class="fa-solid fa-person-walking fs-2"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Walk Score®</h4>
                            <p class="mb-1">18 / 100</p>
                            <p class="text-muted">Car-Dependent</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="score-circle">
                            <i class="fa-solid fa-bicycle fs-2"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Bike Score®</h4>
                            <p class="mb-1">37 / 100</p>
                            <p class="text-muted">Somewhat Bikeable</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <h4 class="fw-bold">Nearby Schools</h4>
                <div class="col-md-6">
                    <h6>Schools provided by</h6>
                    <p class="mb-0">Elementary: <strong> Otis A. Mason Elementary</strong></p>
                    <p class="mb-0">Middle: <strong> Gamble Rogers Middle</strong></p>
                    <p class="mb-0">High: <strong> Pedro Menendez High School</strong></p>
                </div>
                <div class="col-md-6">
                    <h6>GreatSchools rating</h6>
                    <div class="d-flex">
                        <div>
                            <div class="bg-primary rounded-circle p-2 m-auto text-white me-md-2">
                                <strong class="fs-3">8</strong>/10

                            </div>
                        </div>
                        <div>

                            <a href=""><strong>Otis A. Mason Elementary School</strong></a>
                            <div>
                                Grades <b>PK-5</b> Distance <b>4.3 mi</b>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 my-2">
                    <p>This data may not be complete. We recommend contacting the local school
                        district to confirm school assignments for this home.</p>
                </div>
                <div class="col-md-6 my-2">
                    <div class="d-flex">
                        <div>
                            <div class="bg-primary rounded-circle p-2 m-auto text-white me-md-2">
                                <strong class="fs-3">5</strong>/10

                            </div>
                        </div>
                        <div>

                            <a href=""><strong>Gamble Rogers Middle School</strong></a>
                            <div>
                                Grades <b>6-8</b> Distance <b>1.1 mi</b>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 my-2">
                    <p>Source: St Augustine St Johns County BOR</p>
                </div>
                <div class="col-md-6 my-2">
                    <div class="d-flex">
                        <div>
                            <div class="bg-primary rounded-circle p-2 m-auto text-white me-md-2">
                                <strong class="fs-3">5</strong>/10

                            </div>
                        </div>
                        <div>

                            <a href=""><strong>Gamble Rogers Middle School</strong></a>
                            <div>
                                Grades <b>9-12</b> Distance <b>2.3 mi</b>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 my-2">
                    <h6 class="my-2">About GreatSchools</h6>
                    <p>The GreatSchools Summary Rating is based on several metrics.</p>
                    <p>
                        <b>About the ratings:</b> GreatSchools Ratings are designed to be a
                        starting
                        point
                        to help parents compare schools, and should not be the only factor used
                        in
                        selecting the right school for your family. {{ env('APP_NAME') }} and
                        GreatSchools
                        recommend that parents tour multiple schools in-person to inform that
                        choice. As of October 2020, the GreatSchools Ratings methodology
                        continues
                        to move beyond proficiency and standardized test scores. The latest
                        methodology prioritizes student growth through measures of equity and
                        school
                        quality. <a href="#">Learn more</a>


                    </p>
                    <p><b>Disclaimer:</b> School attendance zone boundaries are provided by a
                        third
                        party
                        and are subject to change. They are not guaranteed to be accurate, up to
                        date, or complete. Check with the applicable school district prior to
                        making
                        a decision based on these boundaries.</p>
                </div>

            </div>
            <div class="row my-3">
                <div>
                    <img src="{{ asset('web/img/logo.png') }}" width="100" alt="">
                </div>
                <p>

                    IDX information is provided exclusively for personal, non-commercial use,
                    and
                    may not be used for any purpose other than to identify prospective
                    properties
                    consumers may be interested in purchasing. Information is deemed reliable
                    but
                    not guaranteed. © 2024 St Augustine & St. Johns County Board of REALTORS®.
                    All
                    rights reserved.
                </p>
            </div>
            <div>
                <div class="nearby-section">
                    <h5 class="fw-bold my-3">Nearby cities</h5>
                    <div class="row nearby-links">
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">Elkton
                                Real
                                estate</a>
                            <a href="#" class="d-block text-decoration-none text-primary">Hastings
                                Real
                                estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">Ponte
                                Vedra Real
                                estate</a>
                            <a href="#" class="d-block text-decoration-none text-primary">Ponte
                                Vedra Beach
                                Real estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">Saint
                                Augustine
                                Real estate</a>
                            <a href="#" class="d-block text-decoration-none text-primary">Saint
                                Augustine
                                Beach Real estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">Saint
                                Johns Real
                                estate</a>
                        </div>
                    </div>
                </div>

                <!-- Nearby Neighborhoods -->
                <div class="nearby-section">
                    <h5 class="fw-bold my-3">Nearby neighborhoods</h5>
                    <div class="row nearby-links">
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">Butler
                                Beach Real
                                estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">Crescent
                                Beach
                                Real estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">Marineland
                                Real
                                estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">Villano
                                Beach
                                Real estate</a>
                        </div>
                    </div>
                </div>

                <!-- Nearby Zip Codes -->
                <div class="nearby-section">
                    <h5 class="fw-bold my-3">Nearby zip codes</h5>
                    <div class="row nearby-links">
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">32080
                                Real
                                estate</a>
                            <a href="#" class="d-block text-decoration-none text-primary">32084
                                Real
                                estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">32085
                                Real
                                estate</a>
                            <a href="#" class="d-block text-decoration-none text-primary">32086
                                Real
                                estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">32092
                                Real
                                estate</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="d-block text-decoration-none text-primary">32095
                                Real
                                estate</a>
                        </div>
                    </div>
                </div>

                <div class="topics-section my-3">
                    <h5 class="fw-bold my-3">Other Saint Augustine Topics</h5>
                    <div class="row topics-links">
                        <div class="col-md-2 col-sm-4">
                            <a href="#" class="d-block text-decoration-none text-primary">Apartments
                                for
                                Rent in 32086</a>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <a href="#" class="d-block text-decoration-none text-primary">32086
                                Real
                                Estate</a>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <a href="#" class="d-block text-decoration-none text-primary">Newest
                                Listings
                                in Saint Augustine</a>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <a href="#" class="d-block text-decoration-none text-primary">Saint
                                Augustine</a>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <a href="#" class="d-block text-decoration-none text-primary">Saint
                                Augustine</a>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <a href="#" class="d-block text-decoration-none text-primary">Refinance</a>
                        </div>
                    </div>
                </div>

            </div> --}}
        </div>
    </div>
    <div class="col-md-4 mt-3 position-sticky" style="height: 100vh;overflow-y: auto;top:16%;">
        <div class="card mb-3">
            <p class="small-text ps-3">Listed by</p>
            <div class="text-center">
                <img class="rounded-circle" width="100" src="{{ asset('web/img/user.png') }}" alt="Realtor">
                <h5 class="mb-1">Mark Reling</h5>
                <p class="mb-3 text-muted">MVPS Realtors</p>
                <div class="d-grid gap-2 px-3">
                    <a href="{{ route('user.chat') }}" class="btn btn-outline-light btn-block mb-3 text-primary border">Contact
                        Mark</a>
                </div>
            </div>
        </div>

        <!-- Request Tour Card -->
        {{-- <div class="card">
                                    <button class="btn btn-primary btn-block">
                                        <span class="fw-bold">Request a tour</span><br>
                                        <small class="small-text">as early as today at 11:00 am</small>
                                    </button>
                                </div> --}}
    </div>
</div>

</div>
</div>
{{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
</div>
</div>
</div>


<!-- Modal for rent-->
<div class="modal fade modal-xl " id="rentModal" tabindex="-1" aria-labelledby="rentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header sticky-top bg-light bg-gradient">
                <div class="d-md-block d-none">
                    <a href="#" class="text-decoration-none align-items-center"> Back to Search</a>
                    {{-- <p class="small text-muted mb-0">123 Main Street, New York, NY</p> --}}
                </div>
                <div class="ms-auto d-flex align-items-center">
                    <a class="btn me-2">Save <i class="fa-regular fa-heart"></i></a>
                    <a class="btn me-2">Share <i class="fa-solid fa-share-alt"></i></a>
                    {{-- <a class="btn me-2">Hide <i class="fa-solid fa-ban"></i></a> --}}
                    {{-- <a class="btn me-2"><i class="fa-solid fa-ellipsis"></i></a> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>


            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row align-items-center h-auto">
                        <div class="col-md-6 p-1">
                            <img src="{{ asset('web/img/h1.webp') }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 p-1"><img src="{{ asset('web/img/h2.webp') }}" alt="" class="img-fluid"></div>
                                <div class="col-md-6 p-1"><img src="{{ asset('web/img/h1.webp') }}" alt="" class="img-fluid"></div>
                                <div class="col-md-6 p-1"><img src="{{ asset('web/img/h1.webp') }}" alt="" class="img-fluid"></div>
                                <div class="col-md-6 p-1"><img src="{{ asset('web/img/h2.webp') }}" alt="" class="img-fluid"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">


                            <div class="">

                                <div>
                                    <h2 class="fw-bold">DLP Portofino <i class="fa-solid fa-circle-check text-success"></i></h2>
                                    <p class="mt-0">213 Cantabria Way St, Augustine, FL 32086 </p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <!-- First Info Card -->
                                <div class="col-md-4 d-flex">
                                    <div class="info-card d-flex align-items-center p-3 w-100">
                                        <i class="fa-regular fa-building pe-2"></i>
                                        <span>Apartment building</span>
                                    </div>
                                </div>
                                <!-- Second Info Card -->
                                <div class="col-md-4 d-flex">
                                    <div class="info-card d-flex align-items-center p-3 w-100">
                                        <i class="fa-solid fa-bed pe-2"></i>
                                        <span>2-3 beds</span>
                                    </div>
                                </div>
                                <!-- Third Info Card -->
                                <div class="col-md-4 d-flex">
                                    <div class="info-card d-flex align-items-center p-3 w-100">
                                        <i class="fa-solid fa-paw pe-2"></i>
                                        <span>Pets Friendly</span>
                                    </div>
                                </div>
                                <!-- Fourth Info Card -->
                                <div class="col-md-4 d-flex">
                                    <div class="info-card d-flex align-items-center p-3 w-100">
                                        <i class="fa-solid fa-square-parking pe-2"></i>
                                        <span>Parking Lot</span>
                                    </div>
                                </div>
                                <!-- Fifth Info Card -->
                                <div class="col-md-4 d-flex">
                                    <div class="info-card d-flex align-items-center p-3 w-100">
                                        <i class="fa-solid fa-fan pe-2"></i>
                                        <span>Air conditioning (central)</span>
                                    </div>
                                </div>
                                <!-- Sixth Info Card -->
                                <div class="col-md-4 d-flex">
                                    <div class="info-card d-flex align-items-center p-3 w-100">
                                        <i class="fa-solid fa-shirt pe-2"></i>
                                        <span>In-unit dryer + 1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="mb-3">What's available</h4>

                                <!-- Tabs for filtering -->
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="btn btn-outline-light text-dark ms-1 active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="btn btn-outline-light text-dark ms-1" id="pills-2bed-tab" data-bs-toggle="pill" data-bs-target="#pills-2bed" type="button" role="tab" aria-controls="pills-2bed" aria-selected="false">2
                                            bed</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="btn btn-outline-light text-dark ms-1" id="pills-3bed-tab" data-bs-toggle="pill" data-bs-target="#pills-3bed" type="button" role="tab" aria-controls="pills-3bed" aria-selected="false">3
                                            bed</button>
                                    </li>
                                </ul>

                                <!-- Cards Container -->
                                <div class="tab-content" id="pills-tabContent">
                                    <!-- All Tab -->
                                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                                        <div class="card mb-3">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-md-2 text-center">
                                                    <img src="{{ asset('web/img/h2.webp') }}" alt="placeholder image" class="img-fluid">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <p class="card-text">2 bd, 2 ba</p>
                                                        <h5 class="card-title">$2,050+</h5>
                                                        <p class="card-text">1,411 sqft</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end pe-3">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-3">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-md-2 text-center">
                                                    <img src="{{ asset('web/img/h2.webp') }}" alt="placeholder image" class="img-fluid">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <p class="card-text">3 bd, 2 ba</p>
                                                        <h5 class="card-title">$2,350+</h5>
                                                        <p class="card-text">1,721 sqft</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end pe-3">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Other Tabs  -->
                                    <div class="tab-pane fade" id="pills-2bed" role="tabpanel" aria-labelledby="pills-2bed-tab">
                                        <div class="card mb-3">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-md-2 text-center">
                                                    <img src="{{ asset('web/img/h2.webp') }}" alt="placeholder image" class="img-fluid">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <p class="card-text">2 bd, 2 ba</p>
                                                        <h5 class="card-title">$2,050+</h5>
                                                        <p class="card-text">1,411 sqft</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end pe-3">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-3bed" role="tabpanel" aria-labelledby="pills-3bed-tab">
                                        <div class="card mb-3">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-md-2 text-center">
                                                    <img src="{{ asset('web/img/h2.webp') }}" alt="placeholder image" class="img-fluid">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <p class="card-text">3 bd, 2 ba</p>
                                                        <h5 class="card-title">$2,350+</h5>
                                                        <p class="card-text">1,721 sqft</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end pe-3">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-3">
                                <h4 class="fw-bold">What's special</h4>
                                <div>
                                    <span class="badge bg-light text-dark p-2">CHEF-READY KITCHEN</span>
                                </div>
                                <p>WoW!!! Unbelievable oppurtunity!! Stately mansion in one of Detroits finest
                                    Neighborhoods! Awesome curb appeal. Beautiful woodwork throughout, and a grand
                                    staircase. Huge lot. Oversized garage. Your chance to truly own one of the gems
                                    of Detroit. Close to major freeways.</p>


                            </div>


                            {{-- <div class="row my-3">
                                    <div class=" p-4">
                                        <h5 class="mb-4">Office hours</h5>
                                        <table class="table table-borderless table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Open Hours</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Mon - Fri</td>
                                                    <td>By appointment only</td>
                                                </tr>
                                                <tr>
                                                    <td>Sat</td>
                                                    <td>By appointment only</td>
                                                </tr>
                                                <tr>
                                                    <td>Sun</td>
                                                    <td>By appointment only</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <h5 class="mt-4">Listed by management company</h5>
                                        <div class="d-flex align-items-center mt-3">
                                            <div class="management-logo">
                                                <img src="{{ asset('web/img/dreamLiveProsper.jpg') }}" width="70"
                            alt="Logo">
                        </div>
                        <div class="ms-3">
                            <p class="mb-0 fw-bold">Leasing Agent</p>
                            <span class="verified-source">✔ Verified Source</span>
                            <p class="mb-0">(213) 401-9986</p>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary mt-4">Ask a question</button>
                    </div>
                </div>
            </div> --}}
            <hr>
            <div>
                <div class="details-section px-3">
                    <!-- Facts & Features -->
                    <h2>Facts, features & policies</h2>
                    <h5 class="mb-4 col-12 bg-light">Building amenities</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Services & facilities</h6>
                            <ul>
                                <li>24 hour maintenance</li>
                                <li>Online rent payment</li>
                                <li>Onsite management</li>
                            </ul>
                        </div>

                    </div>

                    <!-- Property Details -->
                    <h5 class="mb-4 col-12 bg-light">Policies</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Lease terms</h6>
                            <ul>
                                <li>Flexible</li>
                            </ul>
                            <h6>Small dogs</h6>
                            <ul>
                                <li>Allowed</li>
                            </ul>

                        </div>
                        <div class="col-md-6">
                            <h6>Parking</h6>
                            <ul>
                                <li>Parking lot</li>
                            </ul>
                            <h6>Cats</h6>
                            <ul>
                                <li>Allowed</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Unit features -->
                    <h5 class="mb-4 col-12 bg-light">Unit features</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Appliances</h6>
                            <ul>
                                <li>Dishwasher</li>
                                <li>Dryer</li>
                                <li>Freezer</li>
                                <li>Microwave oven</li>
                                <li>Oven</li>
                                <li>Range</li>
                                <li>Refrigerator</li>
                                <li>Washer</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Cooling</h6>
                            <ul>
                                <li>Air conditioning: Central</li>
                            </ul>
                            <h6>Flooring</h6>
                            <ul>
                                <li>Carpet</li>
                                <li>Vinyl</li>
                            </ul>
                            <h6>Internet/Satellite</h6>
                            <ul>
                                <li>Cable</li>
                                <li>High-speed internet</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="d-grid gap-2">
                            <input type="radio" checked class="btn-check" id="btn-check-outlined" name="bed" autocomplete="off">
                            <label class="btn btn-outline-light text-dark border" for="btn-check-outlined">2 bed</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-grid gap-2">
                            <input type="radio" class="btn-check" id="btn-check-outlined2" name="bed" autocomplete="off">
                            <label class="btn btn-outline-light text-dark border" for="btn-check-outlined2">3 bed</label>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="bg-light p-3 mt-3 rounded">

                            <p class="mb-0">Est. monthly cost</p>
                            <strong>$2,050</strong>
                        </div>

                    </div>
                    <div class="col-md-4 ">
                        <div class="bg-light p-3 mt-3 rounded">

                            <p class="mb-0">Est. one-time cost</p>
                            <strong>$0</strong>
                        </div>

                    </div>
                    <div class="col-md-4 ">
                        <div class="bg-light p-3 mt-3 rounded">

                            <p class="mb-0">Est. move-in cost</p>
                            <strong>$2,050</strong>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row my-3 ">
                    <h5 class="mb-3">Monthly costs</h5>
                    <table class="table border">
                        <tbody>
                            <tr>
                                <td>Base rent</td>
                                <td class="text-end">$2,050/mo</td>
                            </tr>
                            <tr>
                                <td>Parking fee</td>
                                <td class="text-end">Contact for details</td>
                            </tr>
                            <tr>
                                <td>Pet fee</td>
                                <td class="text-end">Contact for details</td>
                            </tr>
                            <tr class="highlight">
                                <td>Est. monthly cost</td>
                                <td class="text-end">$2,050/mo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- <div class="row my-3">
                                        <h5 class="mb-3">One-time costs</h5>
                                        <table class="table border">
                                            <caption style="font-size: 10px">Pricing is subject to change. All
                                                calculations
                                                are estimates and provided for informational purposes only. Actual
                                                amounts
                                                may include additional mandatory or optional fees. Please consult the
                                                community manager for a complete breakdown of all rental costs.
                                            </caption>
                                            <tbody>
                                                <tr>
                                                    <td>Security deposit</td>
                                                    <td class="text-end">Contact for details</td>
                                                </tr>
                                                <tr>
                                                    <td>Application fee</td>
                                                    <td class="text-end">Contact for details</td>
                                                </tr>
                                                <tr>
                                                    <td>Administration fee</td>
                                                    <td class="text-end">Contact for details</td>
                                                </tr>
                                                <tr>
                                                    <td>Pet deposit</td>
                                                    <td class="text-end">$0</td>
                                                </tr>
                                                <tr class="highlight">
                                                    <th scope="col">Est. one-time cost</th>
                                                    <th class="text-end" scope="col">$0</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> --}}

                <div class="row">
                    <!-- Neighborhood Section -->
                    <div class="row">
                        <div class="col-12">
                            <h4>Neighborhood: 32086</h4>
                            <p class="text-muted">Areas of interest</p>
                            <p>Use our interactive map to explore the neighborhood and see how it
                                matches your interests.</p>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative bg-light rounded" style="height: 230px;">
                                <!-- Placeholder for Google Map -->
                                <iframe class="w-100 h-100 border rounded" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24176.231892173613!2d-73.98930819999999!3d40.748817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1689182866251!5m2!1sen!2sus" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <!-- Street View Overlay -->
                                <div class="position-absolute bottom-0 end-0 p-2">
                                    <div class="bg-white border rounded shadow-sm">
                                        <img src="{{ asset('web/img/h1.webp') }}" width="100" class="img-fluid rounded" alt="Street View">
                                        <div class="text-center">Street View</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- Buttons Section -->
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-start">
                            <div class="ms-2">
                                <button type="button" class="btn btn-outline-light text-dark rounded-pill">Highlights</button>
                                <button type="button" class="btn btn-outline-light text-dark rounded-pill">Active
                                    life</button>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- <div class="row my-3">
                                        <h4>Travel times</h4>

                                        <div class="input-group flex-nowrap mt-3">
                                            <span class="input-group-text bg-white " id="addon-wrapping"><i
                                                    class="fa-solid fa-car-side text-primary"></i></span>
                                            <input type="text" class="form-control" placeholder="" aria-label=""
                                                aria-describedby="addon-wrapping">
                                        </div>
                                    </div> --}}

                {{--
                                    <hr>
                                    <div class="row mb-3">
                                        <h3>Walk, Transit & Bike Scores</h3>

                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div class="score-circle">
                                                    <i class="fa-solid fa-person-walking fs-2"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-0">Walk Score®</h4>
                                                    <p class="mb-1">18 / 100</p>
                                                    <p class="text-muted">Car-Dependent</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div class="score-circle">
                                                    <i class="fa-solid fa-bicycle fs-2"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-0">Bike Score®</h4>
                                                    <p class="mb-1">37 / 100</p>
                                                    <p class="text-muted">Somewhat Bikeable</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                {{--
                                    <hr>
                                    <div class="row">
                                        <h4 class="fw-bold">Nearby Schools</h4>

                                        <div class="col-md-12">
                                            <h6>GreatSchools rating</h6>
                                            <div class="d-flex">
                                                <div>
                                                    <div
                                                        class="bg-primary rounded-circle p-2 m-auto text-white me-md-2">
                                                        <strong class="fs-3">8</strong>/10

                                                    </div>
                                                </div>
                                                <div>

                                                    <a href=""><strong>Otis A. Mason Elementary School</strong></a>
                                                    <div>
                                                        Grades <b>PK-5</b> Distance <b>4.3 mi</b>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-12 my-2">
                                            <div class="d-flex">
                                                <div>
                                                    <div
                                                        class="bg-primary rounded-circle p-2 m-auto text-white me-md-2">
                                                        <strong class="fs-3">5</strong>/10

                                                    </div>
                                                </div>
                                                <div>

                                                    <a href=""><strong>Gamble Rogers Middle School</strong></a>
                                                    <div>
                                                        Grades <b>6-8</b> Distance <b>1.1 mi</b>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-12 my-2">
                                            <div class="d-flex">
                                                <div>
                                                    <div
                                                        class="bg-primary rounded-circle p-2 m-auto text-white me-md-2">
                                                        <strong class="fs-3">5</strong>/10

                                                    </div>
                                                </div>
                                                <div>

                                                    <a href=""><strong>Gamble Rogers Middle School</strong></a>
                                                    <div>
                                                        Grades <b>9-12</b> Distance <b>2.3 mi</b>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 my-2">
                                            <h6 class="my-2">About GreatSchools</h6>
                                            <p>The GreatSchools Summary Rating is based on several metrics.</p>
                                            <p>
                                                <b>About the ratings:</b> GreatSchools Ratings are designed to be a
                                                starting
                                                point
                                                to help parents compare schools, and should not be the only factor used
                                                in
                                                selecting the right school for your family. {{ env('APP_NAME') }} and
                GreatSchools
                recommend that parents tour multiple schools in-person to inform that
                choice. As of October 2020, the GreatSchools Ratings methodology
                continues
                to move beyond proficiency and standardized test scores. The latest
                methodology prioritizes student growth through measures of equity and
                school
                quality. <a href="#">Learn more</a>


                </p>
                <p><b>Disclaimer:</b> School attendance zone boundaries are provided by a
                    third
                    party
                    and are subject to change. They are not guaranteed to be accurate, up to
                    date, or complete. Check with the applicable school district prior to
                    making
                    a decision based on these boundaries.</p>
            </div>

        </div> --}}
        {{-- <div class="row my-3 form-container">
                                        <h4 class="mb-3">Request a tour</h4>
                                        <form>
                                            <!-- Name Field -->
                                            <div class="mb-3">
                                                <label for="name" class="form-label">First & last name</label>
                                                <input type="text" class="form-control" id="name" value="Mahr Zohaib"
                                                    placeholder="Enter your name">
                                            </div>

                                            <!-- Phone Field -->
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control " id="phone" placeholder="Phone">

                                            </div>

                                            <!-- Email Field -->
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Signed in email</label>
                                                <input type="email" class="form-control" id="email"
                                                    value="abc@gmail.com" readonly>
                                            </div>

                                            <!-- Message Field -->
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Message</label>
                                                <textarea class="form-control" id="message"
                                                    rows="3">I would like to schedule a tour </textarea>
                                            </div>

                                            <!-- Submit Button -->
                                            <div>
                                                <button type="submit" class="btn btn-primary w-100">Send tour
                                                    request</button>
                                            </div>
                                        </form>
                                    </div> --}}
        {{-- <div class="row">
                                        <!-- Header Section -->
                                        <h6 class="mb-3">Will be sent to</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="rounded-circle bg-light d-flex justify-content-center align-items-center me-3"
                                                style="width: 60px; height: 60px;">
                                                <i class="bi bi-person text-muted fs-3"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-0">Leasing Agent</h5>
                                                <p class="mb-1 text-muted">Leasing consultant</p>
                                                <span class="text-success ">Verified <i
                                                        class="fa-solid fa-circle-info"></i></span>
                                                <i class="bi bi-info-circle text-muted" title="Verified agent"> </i>
                                            </div>
                                        </div>
                                        <p class="mb-0">
                                            <a href="tel:(213)401-9986"
                                                class="text-decoration-none text-primary fw-bold">(213) 401-9986</a>
                                        </p>

                                        <!-- Divider -->
                                        <hr class="my-4">

                                        <!-- Actions Section -->
                                        <h6 class="mb-3">Other things you can do:</h6>
                                        <div class=" row">
                                            <div class="col-6">

                                                <button
                                                    class="btn btn-outline-light text-primary border fw-bold w-100 ">Ask
                                                    a question</button>
                                            </div>
                                            <div class="col-6">
                                                <button
                                                    class="btn btn-outline-light text-primary border fw-bold w-100 ">Request
                                                    to apply</button>

                                            </div>
                                        </div>

                                        <!-- Disclaimer -->
                                        <p class="mt-4 text-muted small">
                                            By contacting this property, you agree to our
                                            <a href="#" class="text-primary text-decoration-none">Terms of
                                                Use</a>. Visit
                                            our
                                            <a href="#" class="text-primary text-decoration-none">Privacy
                                                Portal</a> for
                                            more information.
                                            When you click Send request, we’ll send your inquiry to the property manager
                                            so
                                            they can reach out and answer your questions.
                                        </p>

                                    </div> --}}
        {{-- <div class="row my-3">
                                        <div class="container featureContainer my-3 mt-5">
                                            <div class="row mx-auto my-auto justify-content-center">
                                                <div id="featureCarousel" class="carousel slide"
                                                    data-bs-ride="carousel">
                                                    <!-- Carousel Controls. OPTIONAL -->
                                                    <div class="float-start">
                                                        <h4> Nearby apartments for rent</h4>
                                                    </div>
                                                    <div class="float-end mb-2">
                                                        <a class="indicator" href="#featureCarousel" role="button"
                                                            data-bs-slide="prev">
                                                            <i class="fa-solid fa-less-than"></i>
                                                        </a> &nbsp;&nbsp;
                                                        <a class="w-aut indicator" href="#featureCarousel" role="button"
                                                            data-bs-slide="next">
                                                            <i class="fa-solid fa-greater-than"></i>
                                                        </a>
                                                    </div>
                                                    <!-- Add Slides To The Carousel -->
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <div class="col-md-3 mx-1 border">
                                                                <div class="card">
                                                                    <img src="{{ asset('web/img/h1.webp') }}"
        class="img-fluid" class="card-img-top"
        alt="...">
        <div class="card-body p-1">
            <h5 class="card-title">$500 - $700</h5>
            <p class="card-text small">
                <b>4</b> bds | <b>3</b> ba | <b>1.6</b> sqft
                <br>
                Devon Circle Apartments
                <br>
                For Rent

            </p>
        </div>
    </div>
</div>
</div>
<div class="carousel-item">
    <div class="col-md-3 mx-1 border">
        <div class="card">
            <img src="{{ asset('web/img/h1.webp') }}" class="img-fluid" class="card-img-top" alt="...">
            <div class="card-body p-1">
                <h5 class="card-title">$500 - $700</h5>
                <p class="card-text small">
                    <b>4</b> bds | <b>3</b> ba | <b>1.6</b> sqft
                    <br>
                    Devon Circle Apartments
                    <br>
                    For Rent

                </p>
            </div>
        </div>
    </div>
</div>
<div class="carousel-item">
    <div class="col-md-3 mx-1 border">
        <div class="card">
            <img src="{{ asset('web/img/h1.webp') }}" class="img-fluid" class="card-img-top" alt="...">
            <div class="card-body p-1">
                <h5 class="card-title">$500 - $700</h5>
                <p class="card-text small">
                    <b>4</b> bds | <b>3</b> ba | <b>1.6</b> sqft
                    <br>
                    Devon Circle Apartments
                    <br>
                    For Rent

                </p>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
{{-- <div class="row my-3">
                                        <h2 class="mb-3">Local legal protections</h2>
                                        <p class="text-muted">
                                            Current <a href="#" class="text-decoration-underline">legal
                                                protections</a> at
                                            the city level in Saint Augustine
                                        </p>

                                        <div class="row">
                                            <!-- Housing Column -->
                                            <div class="col-md-4">
                                                <h6 class="">Housing</h6>
                                                <small class="text-muted mb-2">
                                                    Including protection from being unfairly evicted, denied housing, or
                                                    refused the ability to rent or buy housing.
                                                </small>
                                                <div class="d-flex flex-column gap-2">
                                                    <div
                                                        class="border p-2 d-flex align-items-center justify-content-between rounded">
                                                        <span><i class="fa-regular fa-circle-xmark"></i> Gender
                                                            identity</span>
                                                    </div>
                                                    <div
                                                        class="border p-2 d-flex align-items-center justify-content-between rounded">
                                                        <span><i class="fa-regular fa-circle-check"></i> Sexual
                                                            orientation</span>
                                                    </div>
                                                    <div
                                                        class="border p-2 d-flex align-items-center justify-content-between rounded">
                                                        <span><i class="fa-regular fa-circle-xmark"></i> Housing choice
                                                            voucher (Section 8)</span>
                                                    </div>
                                                    <div
                                                        class="border p-2 d-flex align-items-center justify-content-between rounded">
                                                        <span><i class="fa-regular fa-circle-xmark"></i> Source of
                                                            income</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Employment Column -->
                                            <div class="col-md-4">
                                                <h6 class="">Employment</h6>
                                                <small class="text-muted mb-2">
                                                    Including protection from being fired, denied employment, or
                                                    otherwise
                                                    discriminated against by an employer.
                                                </small>
                                                <div class="d-flex flex-column gap-2">
                                                    <div
                                                        class="border p-2 d-flex align-items-center justify-content-between rounded">
                                                        <span><i class="fa-regular fa-circle-xmark"></i> Gender
                                                            identity</span>
                                                    </div>
                                                    <div
                                                        class="border p-2 d-flex align-items-center justify-content-between rounded">
                                                        <span><i class="fa-regular fa-circle-xmark"></i> Sexual
                                                            orientation</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Public Accommodations Column -->
                                            <div class="col-md-4">
                                                <h6 class="">Public accommodations</h6>
                                                <small class="text-muted mb-2">
                                                    Including protection from being unfairly refused services or entry
                                                    to
                                                    places accessible to the public (stores, restaurants, parks, etc.).
                                                </small>
                                                <div class="d-flex flex-column gap-2">
                                                    <div
                                                        class="border p-2 d-flex align-items-center justify-content-between rounded">
                                                        <span><i class="fa-regular fa-circle-xmark"></i> Gender
                                                            identity</span>
                                                    </div>
                                                    <div
                                                        class="border p-2 d-flex align-items-center justify-content-between rounded">
                                                        <span><i class="fa-regular fa-circle-xmark"></i> Sexual
                                                            orientation</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="text-muted mt-4">
                                            Data Source: <a href="#" class="text-decoration-underline">Movement
                                                Advancement
                                                Project (MAP)</a>
                                        </p>
                                    </div> --}}
{{-- <div class="row my-3">
                                        <div class="container featureContainer my-3 mt-5">
                                            <div class="row mx-auto my-auto justify-content-center">
                                                <div id="featureCarousel2" class="carousel slide "
                                                    data-bs-ride="carousel">
                                                    <!-- Carousel Controls. OPTIONAL -->
                                                    <div class="float-start">
                                                        <h4> Similar apartments for rent</h4>
                                                    </div>
                                                    <div class="float-end mb-2">
                                                        <a class="indicator" href="#featureCarousel2" role="button"
                                                            data-bs-slide="prev">
                                                            <i class="fa-solid fa-less-than"></i>
                                                        </a> &nbsp;&nbsp;
                                                        <a class="w-aut indicator" href="#featureCarousel2"
                                                            role="button" data-bs-slide="next">
                                                            <i class="fa-solid fa-greater-than"></i>
                                                        </a>
                                                    </div>
                                                    <!-- Add Slides To The Carousel -->
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <div class="col-md-3 mx-1 border">
                                                                <div class="card">
                                                                    <img src="{{ asset('web/img/h1.webp') }}"
class="img-fluid" class="card-img-top"
alt="...">
<div class="card-body p-1">
    <h5 class="card-title">$500 - $700</h5>
    <p class="card-text small">
        <b>4</b> bds | <b>3</b> ba | <b>1.6</b> sqft
        <br>
        Devon Circle Apartments
        <br>
        For Rent

    </p>
</div>
</div>
</div>
</div>
<div class="carousel-item">
    <div class="col-md-3 mx-1 border">
        <div class="card">
            <img src="{{ asset('web/img/h1.webp') }}" class="img-fluid" class="card-img-top" alt="...">
            <div class="card-body p-1">
                <h5 class="card-title">$500 - $700</h5>
                <p class="card-text small">
                    <b>4</b> bds | <b>3</b> ba | <b>1.6</b> sqft
                    <br>
                    Devon Circle Apartments
                    <br>
                    For Rent

                </p>
            </div>
        </div>
    </div>
</div>
<div class="carousel-item">
    <div class="col-md-3 mx-1 border">
        <div class="card">
            <img src="{{ asset('web/img/h1.webp') }}" class="img-fluid" class="card-img-top" alt="...">
            <div class="card-body p-1">
                <h5 class="card-title">$500 - $700</h5>
                <p class="card-text small">
                    <b>4</b> bds | <b>3</b> ba | <b>1.6</b> sqft
                    <br>
                    Devon Circle Apartments
                    <br>
                    For Rent

                </p>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
{{-- <div class="row my-3">
                                        <h2 class="mb-4">Frequently asked questions</h2>
                                        <div class="mb-4">
                                            <h5>What is the walk score of DLP Portofino?</h5>
                                            <p class="text-muted">DLP Portofino has a walk score of 21, it's
                                                car-dependent.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h5>What schools are assigned to DLP Portofino?</h5>
                                            <p class="text-muted">
                                                The schools assigned to DLP Portofino include W. Douglas Hartley
                                                Elementary
                                                School, Gamble Rogers Middle School, and Pedro Menendez High School.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h5>Does DLP Portofino have in-unit laundry?</h5>
                                            <p class="text-muted">Yes, DLP Portofino has in-unit laundry for some or all
                                                of
                                                the units.</p>
                                        </div>
                                        <div>
                                            <h5>What neighborhood is DLP Portofino in?</h5>
                                            <p class="text-muted">DLP Portofino is in the 32086 neighborhood in
                                                Augustine,
                                                FL.</p>
                                        </div>
                                    </div> --}}
{{-- <div>
                                        <div class="nearby-section">
                                            <h5 class="fw-bold my-3">Nearby cities</h5>
                                            <div class="row nearby-links">
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">Elkton
                                                        Real
                                                        estate</a>
                                                    <a href="#"
                                                        class="d-block text-decoration-none text-primary">Hastings
                                                        Real
                                                        estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">Ponte
                                                        Vedra Real
                                                        estate</a>
                                                    <a href="#" class="d-block text-decoration-none text-primary">Ponte
                                                        Vedra
                                                        Beach
                                                        Real estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">Saint
                                                        Augustine
                                                        Real estate</a>
                                                    <a href="#" class="d-block text-decoration-none text-primary">Saint
                                                        Augustine
                                                        Beach Real estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">Saint
                                                        Johns Real
                                                        estate</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nearby Neighborhoods -->
                                        <div class="nearby-section">
                                            <h5 class="fw-bold my-3">Nearby neighborhoods</h5>
                                            <div class="row nearby-links">
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">Butler
                                                        Beach
                                                        Real
                                                        estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#"
                                                        class="d-block text-decoration-none text-primary">Crescent
                                                        Beach
                                                        Real estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#"
                                                        class="d-block text-decoration-none text-primary">Marineland
                                                        Real
                                                        estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#"
                                                        class="d-block text-decoration-none text-primary">Villano
                                                        Beach
                                                        Real estate</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nearby Zip Codes -->
                                        <div class="nearby-section">
                                            <h5 class="fw-bold my-3">Nearby zip codes</h5>
                                            <div class="row nearby-links">
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">32080
                                                        Real
                                                        estate</a>
                                                    <a href="#" class="d-block text-decoration-none text-primary">32084
                                                        Real
                                                        estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">32085
                                                        Real
                                                        estate</a>
                                                    <a href="#" class="d-block text-decoration-none text-primary">32086
                                                        Real
                                                        estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">32092
                                                        Real
                                                        estate</a>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <a href="#" class="d-block text-decoration-none text-primary">32095
                                                        Real
                                                        estate</a>
                                                </div>
                                            </div>
                                        </div>



                                    </div> --}}
</div>
</div>
<div class="col-md-4 mt-3 position-sticky" style="height: 100vh;overflow-y: auto;top:16%;">


    <!-- Request Tour Card -->
    {{-- <div class="card">

                                    <div class="d-grid gap-2 p-3">
                                        <button class="btn btn-primary btn-lg  mb-3  border bold">Request a
                                            tour</button>
                                        <button class="btn btn-outline-light btn-lg  text-primary border bold">Request
                                            to Apply</button>

                                    </div>
                                </div> --}}
    <div class="card card-body">
        <a href="{{ route('user.chat') }}" class="btn btn-primary btn-block">
            <span class="fw-bold">Request a tour</span><br>
            <small class="small-text">as early as today at 11:00 am</small>
        </a>
    </div>
</div>
</div>

</div>
</div>
{{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
</div>
</div>
</div>
</div>
<div class="container-md-fluid my-2">
    <div class="d-flex align-items-center justify-content-start w-100">
        <div class="input-group w-25 ms-1 d-md-flex d-none ">
            <input type="search" class="form-control" placeholder="Address neighborhood, city, Zip" aria-label="Address neighborhood, city, Zip" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <!-- Dropdown 1 -->
        <div class="dropdown ms-1">
            <button class="btn btn-outline-light border-1 border text-black" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="selected-filter   small">For Sale</span>
                <i class="fa fa-angle-down"></i>
            </button>
            <div class="dropdown-menu p-3">
                <form>
                    <!-- Radio Buttons -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option1" value="For Sale" checked>
                        <label class="form-check-label" for="filter1Option1">For Sale</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option2" value="For Rent">
                        <label class="form-check-label" for="filter1Option2">For Rent</label>
                    </div>
                    <!-- Apply Button -->
                    <div class="mt-3 apply-button d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-bold apply-filter">Apply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Dropdown 2 -->
        <div class="dropdown ms-1 d-md-block d-none price-dropdown">
            <button class="btn btn-outline-light border-1 border text-black " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="selected-filter   small">Price</span>
                <i class="fa fa-angle-down"></i>
            </button>
            <div class="dropdown-menu p-3">
                <form>
                    <!-- Minimum and Maximum Dropdowns -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <label class="form-check-label" for="minSelect">Minimum</label>
                            <select class="form-select w-auto" id="minSelect">
                                <option value="0">$0</option>
                                <option value="10">$10</option>
                                <option value="100">$100</option>
                            </select>
                        </div>
                        <div class="mx-3 mt-3">-</div>
                        <div class="">
                            <label class="form-check-label" for="maxSelect">Maximum</label>
                            <select class="form-select w-auto" id="maxSelect">
                                <option value="0">$0</option>
                                <option value="10">$10</option>
                                <option value="100">$100</option>
                                <option value="10000">$10000</option>
                            </select>
                        </div>
                    </div>
                    <!-- Apply Button -->
                    <div class="mt-3 apply-button d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-bold apply-filter">Apply</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- Dropdown 3 -->

        <div class="dropdown ms-1 d-md-block d-none bedrooms-bathrooms-dropdown">
            <button class="btn btn-outline-light border-1 border text-black " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="selected-filter  small">Beds &amp; Baths</span>
                <i class="fa fa-angle-down"></i>
            </button>
            <div class="dropdown-menu">
                <form class="p-3">
                    <div class="h6">Bedrooms</div>


                    <div class="btn-group my-2" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                        <label class="btn btn-outline-light text-black" for="btnradio1">Any</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="btnradio2">1+</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="btnradio3">2+</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="btnradio4">3+</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="btnradio5">4+</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="btnradio6">5+</label>
                    </div>
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Use exact match
                        </label>
                    </div>

                    <div class="h6">Bathrooms</div>


                    <div class="btn-group my-2" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="bathroom" id="bathroom1" autocomplete="off" checked>
                        <label class="btn btn-outline-light text-black" for="bathroom1">Any</label>

                        <input type="radio" class="btn-check" name="bathroom" id="bathroom2" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="bathroom2">1+</label>

                        <input type="radio" class="btn-check" name="bathroom" id="bathroom3" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="bathroom3">1.5+</label>

                        <input type="radio" class="btn-check" name="bathroom" id="bathroom4" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="bathroom4">2+</label>

                        <input type="radio" class="btn-check" name="bathroom" id="bathroom5" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="bathroom5">3+</label>

                        <input type="radio" class="btn-check" name="bathroom" id="bathroom6" autocomplete="off">
                        <label class="btn btn-outline-light text-black" for="bathroom6">4+</label>
                    </div>

                    <!-- Apply Button -->
                    <div class="mt-3 apply-button d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-bold apply-filter">Apply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Dropdown 4 -->

        <div class="dropdown ms-1 d-md-block d-none home-type-dropdown">
            <button class="btn btn-outline-light border-1 border text-black " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="selected-filter small">Home Type</span>
                <i class="fa fa-angle-down"></i>
            </button>
            <div class="dropdown-menu p-3">
                <form>

                    <div class="h6">Home Type</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Deselect All
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="housetype1" checked>
                        <label class="form-check-label" for="housetype1">
                            Houses
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="housetype2" checked>
                        <label class="form-check-label" for="housetype2">
                            Townhomes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="housetype3" checked>
                        <label class="form-check-label" for="housetype3">
                            Multi-family
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="housetype4" checked>
                        <label class="form-check-label" for="housetype4">
                            Condos/Co-ops
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="housetype5" checked>
                        <label class="form-check-label" for="housetype5">
                            Lots/Lands
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="housetype6" checked>
                        <label class="form-check-label" for="housetype6">
                            Apartment
                        </label>
                    </div>
                    <!-- Apply Button -->
                    <div class="mt-3 apply-button d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-bold apply-filter">Apply</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Dropdown 5 -->
        <div class="dropdown mx-1 more-filters-dropdown">
            <button class="btn btn-outline-light border-1 border text-black " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="selected-filter  small">More</span>
                <i class="fa fa-angle-down"></i>
            </button>
            <div class="dropdown-menu p-3">
                <form>
                    <label for="">Max HOA</label>
                    <select class="form-select" aria-label="Max HOA">
                        <option selected>Any</option>
                        <option value="no HOA">No HOA fee</option>
                        <option value="50">$50/month</option>
                        <option value="2">$100/month</option>
                    </select>
                    <label for="" class="mt-2">Parking Spots</label>
                    <select class="form-select" aria-label="Max HOA">
                        <option selected>Any</option>
                        <option value="1">1+</option>
                        <option value="2">2+</option>
                        <option value="3">3+/month</option>
                    </select>

                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" value="" id="garage">
                        <label class="form-check-label" for="garage">
                            must have garage
                        </label>
                    </div>


                    <label for="" class="mt-2">Square Feet</label>
                    <div class="d-flex ">
                        <select class="form-select me-2 w-auto" id="">
                            <option value="" selected>No Min</option>
                            <option value="500">500</option>
                            <option value="750">750</option>
                        </select>
                        <select class="form-select w-auto" id="">
                            <option value="" selected>No max</option>
                            <option value="">3500</option>
                            <option value="">4000</option>
                            <option value="">7000</option>
                        </select>
                    </div>

                    <!-- Apply Button -->
                    <div class="mt-3 apply-button d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-bold apply-filter">Apply</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="">

            <button class="btn btn-primary fw-bold">Save Search</button>
        </div>
    </div>
</div>

<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-5 ">

            {{-- <div class="zoom-message">Zoom in to see homes.</div> --}}
            <div id="map" class="google_map"></div>

            {{-- <iframe class="google_map"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317716.6065035931!2d-0.43124885956926756!3d51.52860700576551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2s!4v1735031784268!5m2!1sen!2s"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
        </div>
        <div class="col-md-7 scrollable">

            <div class="row mb-2">
                <h6>Recently Sold Homes</h6>
                <div class="d-flex justify-content-between">
                    <div>
                        21 results
                    </div>
                    <div>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort: Search homes for you
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li><a class="dropdown-item" href="#">Price (Low to High)</a></li>
                                    <li><a class="dropdown-item" href="#">Price (High to Low)</a></li>
                                    <li><a class="dropdown-item" href="#">Homes for you</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4 ">
                <div class="col">
                    <div class="card" style="cursor: pointer" data-modal-id="saleModal">
                        <div class="card-img-top position-relative">
                            <!-- Badge -->
                            <div class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                Showcase
                            </div>

                            <!-- Heart Icon -->
                            <div class="z-3 position-absolute top-0 end-0 m-2">
                                <i class="fa-regular fa-heart fs-3"></i>
                            </div>

                            <div id="saleModalIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#saleModalIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#saleModalIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#saleModalIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('web/img/h2.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#saleModalIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#saleModalIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">$500</h5>
                                <a href="#" onclick="event.stopPropagation();"><i class="fas fa-ellipsis-h"></i></a>
                            </div>
                            <p class="card-text small">
                                4 bds | 3 ba | 2,652 sqft - House for sale 11310 Traverse Rd, Woodbury, MN 55129
                                <small class="small">COLDWELL BANKER REALTY</small>
                            </p>
                        </div>
                    </div>



                </div>
                <div class="col">
                    <div class="card" style="cursor: pointer" data-modal-id="rentModal">
                        <div class="card-img-top position-relative">
                            <!-- Badge -->
                            <div class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                Showcase
                            </div>

                            <!-- Heart Icon -->
                            <div class="z-3 position-absolute top-0 end-0 m-2">
                                <i class="fa-regular fa-heart fs-3"></i>
                            </div>

                            <div id="rentModalIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#rentModalIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#rentModalIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#rentModalIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('web/img/h2.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#rentModalIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#rentModalIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">$500</h5>
                                <a href="#"><i class="fas fa-ellipsis-h"></i> </a>
                            </div>
                            <p class="card-text small">
                                4 bds | 3 ba | 2,652 sqft - House for sale 11310 Traverse Rd, Woodbury, MN 55129
                                <small class="small">COLDWELL BANKER REALTY</small>
                            </p>
                        </div>
                    </div>


                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-img-top position-relative">
                            <!-- Badge -->
                            <div class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                Showcase
                            </div>

                            <!-- Heart Icon -->
                            <div class="z-3 position-absolute top-0 end-0 m-2">
                                <i class="fa-regular fa-heart fs-3"></i>
                            </div>

                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('web/img/h2.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">$500</h5>
                                <a href="#"><i class="fas fa-ellipsis-h"></i> </a>
                            </div>
                            <p class="card-text small">
                                4 bds | 3 ba | 2,652 sqft - House for sale 11310 Traverse Rd, Woodbury, MN 55129
                                <small class="small">COLDWELL BANKER REALTY</small>
                            </p>
                        </div>
                    </div>


                </div>
                {{-- <div class="col">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in
                                to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7ks8X2YnLcxTuEC3qydL2adzA0NYbl6c&libraries=geometry,drawing">
</script>
<script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script>
    let map, drawingManager;
    const properties = [{
            coords: {
                lat: 25.7617
                , lng: -80.1918
            }, // Miami
            title: "Luxury Apartment"
            , price: "$500,000"
            , beds: 3
            , baths: 2
            , sqft: "2,000 sqft"
            , address: "123 Miami St, Miami, FL"
            , realtor: "Coldwell Banker Realty"
            , images: [
                "{{ asset('web/img/h1.webp') }}"
                , "{{ asset('web/img/h2.webp') }}"
                , "{{ asset('web/img/h1.webp') }}"
            ]
        }
        , {
            coords: {
                lat: 28.5383
                , lng: -81.3792
            }, // Orlando
            title: "Cozy Condo"
            , price: "$400,000"
            , beds: 2
            , baths: 1
            , sqft: "1,500 sqft"
            , address: "456 Orlando Ave, Orlando, FL"
            , realtor: "Coldwell Banker Realty"
            , images: [
                "{{ asset('web/img/h1.webp') }}"
                , "{{ asset('web/img/h2.webp') }}"
                , "{{ asset('web/img/h1.webp') }}"
            ]
        },
        // Add more properties as needed
    ];

    function initMap() {
        // Initialize the map
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 27.9944
                , lng: -81.7603
            }, // Florida
            zoom: 6
            , mapTypeId: "roadmap"
            , fullscreenControl: false
            , zoomControl: window.innerWidth > 768,

        });

        // Add markers and popups
        properties.forEach((property, index) => {
            const marker = new google.maps.Marker({
                position: property.coords
                , icon: createCustomMarker(property.price)
                , map: map
            });


            const popupContent = `
                     <div class="card property-popup" >
                        <div class="card-img-top position-relative">
                            <!-- Badge -->
                            <div class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                Showcase
                            </div>

                            <!-- Heart Icon -->
                            <div class="z-3 position-absolute top-0 end-0 m-2">
                                <i class="fa-regular fa-heart fs-3"></i>
                            </div>

                            <div id="${index}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                   ${property.images.map((_, i) => `
                                                        <button type="button" data-bs-target="#${index}" data-bs-slide-to="${i}" class="${i === 0 ? 'active' : ''}" aria-label="Slide ${i + 1}"></button>
                                                `).join('')}
                                </div>
                            <div class="carousel-inner">
                                  ${property.images.map((img, i) => `
                                                        <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                                            <img src="${img}" class="d-block w-100" alt="${property.title}">
                                                        </div>
                                                    `).join('')}
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#${index}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#${index}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div class="d-flex justify-content-between mb-0">
                                 <h5 class="card-title">${property.price}</h5>
                                 <a href="#" onclick="event.stopPropagation();"><i class="fas fa-ellipsis-h"></i></a>
                             </div>
                             <p class="card-text small">
                                 ${property.beds} bds | ${property.baths} ba | ${property.sqft} - ${property.title}
                                 ${property.address}
                             </p>
                        </div>
                    </div>
                `;
            const infoWindow = new google.maps.InfoWindow({
                content: popupContent
                , disableAutoPan: true, // Prevent auto-panning when the popup opens
                
            });

            // Apply custom styles to the InfoWindow
            google.maps.event.addListener(infoWindow, "domready", () => {
                // Remove default close button
                const closeButton = document.querySelector(".gm-ui-hover-effect");
                if (closeButton) {
                    closeButton.style.display = "none";
                }

                // Ensure no overflow issues with the content
                const iwOuter = document.querySelector(".gm-style-iw");
                if (iwOuter) {
                    iwOuter.style.overflow = "visible";
                    iwOuter.style.width = "auto";
                    iwOuter.style.maxWidth = "none";
                }
            });



            // Close the InfoWindow when clicking outside
            google.maps.event.addListener(map, 'click', () => {
                infoWindow.close();
            });


            marker.addListener("click", () => {
                infoWindow.open(map, marker);
            });
        });

        // Add drawing tools
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: null
            , drawingControl: false
        });
        drawingManager.setMap(map);

        // Add custom controls
        addMapOptionsButton();
        addDrawToggleButton();
    }

    function createCustomMarker(price) {
        return {
            url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png"
            , scaledSize: new google.maps.Size(40, 40)
        , };
    }

    function addMapOptionsButton() {
        // Create the button
        if (window.innerWidth > 768) {
            var r = "15%";
        } else {
            var r = "5%";
        }
        const mapOptionsButton = document.createElement("button");
        mapOptionsButton.innerHTML = `Map <i class="fa fa-angle-down"></i>`;
        mapOptionsButton.classList.add("btn", "btn-light", "px-3", "map-options-button");
        mapOptionsButton.style.position = "absolute";
        mapOptionsButton.style.bottom = "5%";
        mapOptionsButton.style.right = r;
        mapOptionsButton.style.zIndex = "1";

        // Create the menu
        const mapOptionsMenu = document.createElement("div");
        mapOptionsMenu.classList.add("map-options-menu", "d-none", "bg-white", "p-2", "rounded");
        mapOptionsMenu.style.position = "absolute";
        mapOptionsMenu.style.bottom = "calc(5% + 50px)"; // Position menu above the button
        mapOptionsMenu.style.right = r;
        mapOptionsMenu.style.zIndex = "1000";
        mapOptionsMenu.style.width = "300px"; // Adjust width as needed
        mapOptionsMenu.innerHTML = `
        <div class="card border-0 w-100">
            <div class="card-body">
                <h5 class="card-title">Map Options</h5>
                <form>
                    <!-- Map Options -->
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="mapType" value="automatic" checked>
                            <span class="form-check-label">Automatic</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="mapType" value="satellite">
                            <span class="form-check-label">Satellite</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="mapType" value="streetview">
                            <span class="form-check-label">Street view</span>
                        </label>
                    </div>
                    <!-- Climate Risks -->
                    <h6 class="mt-4">Climate Risks</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="none" checked>
                                <span class="form-check-label">None selected</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="flood">
                                <span class="form-check-label">Flood</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="fire">
                                <span class="form-check-label">Fire</span>
                            </label>
                        </div>
                        <div class="col-6">
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="wind">
                                <span class="form-check-label">Wind</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="air">
                                <span class="form-check-label">Air</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="heat">
                                <span class="form-check-label">Heat</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>`;

        // Toggle menu visibility on button click
        mapOptionsButton.addEventListener("click", (event) => {
            event.stopPropagation(); // Prevent event from bubbling to the document
            mapOptionsMenu.classList.toggle("d-none");
        });

        // Update map type on menu change
        mapOptionsMenu.addEventListener("change", (event) => {
            if (event.target.name === "mapType") {
                map.setMapTypeId(event.target.value);
            }
        });

        // Hide the menu when clicking outside
        document.addEventListener("click", (event) => {
            const isClickInsideMenu = mapOptionsMenu.contains(event.target);
            const isClickOnButton = mapOptionsButton.contains(event.target);

            if (!isClickInsideMenu && !isClickOnButton) {
                mapOptionsMenu.classList.add("d-none");
            }
        });

        // Append button and menu directly to the map container
        const mapContainer = map.getDiv();
        mapContainer.appendChild(mapOptionsButton);
        mapContainer.appendChild(mapOptionsMenu);
    }


    function addDrawToggleButton() {
        // Create the button
        const drawToggleButton = document.createElement("button");
        drawToggleButton.textContent = "Draw";
        drawToggleButton.classList.add("btn", "btn-primary", "draw-toggle-button");

        // Toggle drawing mode on click
        drawToggleButton.addEventListener("click", () => {
            const currentMode = drawingManager.getDrawingMode();
            drawingManager.setDrawingMode(currentMode ? null : "polygon");
        });

        // Create a container for the button
        const controlDiv = document.createElement("div");
        controlDiv.style.position = "absolute";
        controlDiv.style.top = "5%";
        controlDiv.style.right = "5%";
        controlDiv.style.zIndex = "1"; // Ensure the button is above the map
        controlDiv.appendChild(drawToggleButton);

        // Append the controlDiv directly to the map's container
        const mapContainer = map.getDiv();
        mapContainer.appendChild(controlDiv);
    }


    window.onload = initMap;

</script>







<script>
    //    dropwdow filters start
    $(document).ready(function() {
        // Main Initialization
        $('.dropdown').each(function() {
            const dropdown = $(this);

            if (dropdown.hasClass('price-dropdown')) {
                handlePriceDropdown(dropdown);
            } else if (dropdown.hasClass('more-filters-dropdown')) {
                handleMoreFiltersDropdown(dropdown);
            } else if (dropdown.hasClass('home-type-dropdown')) {
                handleHomeTypeDropdown(dropdown);
            } else if (dropdown.hasClass('bedrooms-bathrooms-dropdown')) {
                handleBedroomsBathroomsDropdown(dropdown);
            } else {
                handleGenericDropdown(dropdown);
            }
        });
    });

    // Generic Dropdown Handler
    function handleGenericDropdown(dropdown) {
        const applyButton = dropdown.find('.apply-filter');
        const dropdownMenu = dropdown.find('.dropdown-menu');
        const selectedFilter = dropdown.find('.selected-filter');

        dropdownMenu.on('click', function(e) {
            e.stopPropagation();
        });

        applyButton.on('click', function() {
            let displayValue = '';
            const selectedRadio = dropdownMenu.find('input[type="radio"]:checked');
            if (selectedRadio.length > 0) {
                displayValue = selectedRadio.next('label').text();
            }
            selectedFilter.text(displayValue.trim() || 'No filter selected');
            closeDropdown(dropdown);
        });
    }

    // Bedrooms & Bathrooms Dropdown Handler
    function handleBedroomsBathroomsDropdown(dropdown) {
        const applyButton = dropdown.find('.apply-filter');
        const dropdownMenu = dropdown.find('.dropdown-menu');
        const selectedFilter = dropdown.find('.selected-filter');

        dropdownMenu.on('click', function(e) {
            e.stopPropagation();
        });

        applyButton.on('click', function() {
            let bedroomsLabel = '';
            let bathroomsLabel = '';

            // Get selected bedrooms
            const selectedBedroom = dropdownMenu.find('input[name="btnradio"]:checked').next('label').text();
            if (selectedBedroom && selectedBedroom !== 'Any') {
                bedroomsLabel = `${selectedBedroom} bd`;
            }

            // Get selected bathrooms
            const selectedBathroom = dropdownMenu.find('input[name="bathroom"]:checked').next('label').text();
            if (selectedBathroom && selectedBathroom !== 'Any') {
                bathroomsLabel = `${selectedBathroom} ba`;
            }

            // Combine and update the display label
            const displayValue = [bedroomsLabel, bathroomsLabel].filter(Boolean).join(', ') || 'No filter selected';
            selectedFilter.text(displayValue.trim());
            closeDropdown(dropdown);
        });
    }

    // Price Dropdown Handler
    function handlePriceDropdown(dropdown) {
        const applyButton = dropdown.find('.apply-filter');
        const dropdownMenu = dropdown.find('.dropdown-menu');
        const selectedFilter = dropdown.find('.selected-filter');

        applyButton.on('click', function() {
            const rangeSelectors = dropdownMenu.find('select');
            let minValue = rangeSelectors.eq(0).val();
            let maxValue = rangeSelectors.eq(1).val();
            let displayValue = '';

            if (minValue && maxValue && parseInt(maxValue) < parseInt(minValue)) {
                alert('Maximum value must be greater than or equal to Minimum value.');
                return;
            }

            displayValue = `$${minValue || '0'} - $${maxValue || 'No Limit'}`;
            selectedFilter.text(displayValue.trim());
            closeDropdown(dropdown);
        });
    }

    // Home Type Dropdown Handler
    function handleHomeTypeDropdown(dropdown) {
        const applyButton = dropdown.find('.apply-filter');
        const dropdownMenu = dropdown.find('.dropdown-menu');
        const selectedFilter = dropdown.find('.selected-filter');

        applyButton.on('click', function() {
            const selectedCheckboxes = dropdownMenu.find('input[type="checkbox"]:checked');
            const totalFilters = selectedCheckboxes.length;
            const displayValue = totalFilters > 0 ? `Home Type (${totalFilters})` : 'Home Type';
            selectedFilter.text(displayValue);
            closeDropdown(dropdown);
        });
    }

    // More Filters Dropdown Handler
    function handleMoreFiltersDropdown(dropdown) {
        const applyButton = dropdown.find('.apply-filter');
        const dropdownMenu = dropdown.find('.dropdown-menu');
        const selectedFilter = dropdown.find('.selected-filter');

        applyButton.on('click', function() {
            const totalFilters = dropdownMenu.find('input[type="checkbox"]:checked, select').length;
            const displayValue = totalFilters > 0 ? `More (${totalFilters})` : 'More';
            selectedFilter.text(displayValue);
            closeDropdown(dropdown);
        });
    }

    // Utility to Close Dropdown
    function closeDropdown(dropdown) {
        const bsDropdown = bootstrap.Dropdown.getInstance(dropdown.find('[data-bs-toggle="dropdown"]')[0]);
        if (bsDropdown) {
            bsDropdown.hide();
        }
    }

    //    dropwdow filters end







    let myCarousel = document.querySelectorAll('.featureContainer .carousel .carousel-item');
    myCarousel.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i = 1; i < minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = myCarousel[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    });

    $(document).on('click', '.card', function(event) {
        // Exclude certain elements from triggering the popup
        if (!$(event.target).is(
                'a, button, i, .indicator, .carousel-control-prev-icon, .carousel-control-next-icon')) {
            var modalId = $(this).data('modal-id');

            // Show the modal using the fetched modal ID
            $('#' + modalId).modal('show');
        }
    });



    $("#toggle_map_button,#toggle_property_listing_button").click(function(e) {
        e.preventDefault(); // Prevent default action
        $(".google_map").toggle(); // Toggle visibility of the map
        $(".scrollable").toggle(); // Toggle visibility of the listing
        $("#toggle_map_button,#toggle_property_listing_button,#toggle_sort_button").toggleClass('d-none');
    });

</script>

@endpush
