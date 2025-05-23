@extends('web.layout.app')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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
                                        </ul>
                    </div>

                    <hr>
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
    </div>
</div>

</div>
</div>
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

</div>
</div>
<div class="col-md-4 mt-3 position-sticky" style="height: 100vh;overflow-y: auto;top:16%;">

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
            <div id="map" class="google_map"></div>
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

    // Property data
    const properties = [
        {
            coords: { lat: 25.7617, lng: -80.1918 }, // Miami
            title: "Luxury Apartment",
            price: "$500,000",
            beds: 3,
            baths: 2,
            sqft: "2,000 sqft",
            address: "123 Miami St, Miami, FL",
            realtor: "Coldwell Banker Realty",
            images: [
                "{{ asset('web/img/h1.webp') }}",
                "{{ asset('web/img/h2.webp') }}",
                "{{ asset('web/img/h1.webp') }}"
            ]
        },
        {
            coords: { lat: 28.5383, lng: -81.3792 }, // Orlando
            title: "Cozy Condo",
            price: "$400,000",
            beds: 2,
            baths: 1,
            sqft: "1,500 sqft",
            address: "456 Orlando Ave, Orlando, FL",
            realtor: "Coldwell Banker Realty",
            images: [
                "{{ asset('web/img/h1.webp') }}",
                "{{ asset('web/img/h2.webp') }}",
                "{{ asset('web/img/h1.webp') }}"
            ]
        },
    ];

    function initMap() {
        // Initialize the map
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 27.9944, lng: -81.7603 }, // Florida
            zoom: 6,
            mapTypeId: "roadmap",
            fullscreenControl: false,
            zoomControl: window.innerWidth > 768
        });

        // Add markers and InfoWindows
        addPropertyMarkers();

        // Add drawing tools
        initDrawingTools();

        // Add custom map controls
        addMapOptionsButton();
        addDrawToggleButton();
    }

    function addPropertyMarkers() {
        properties.forEach((property, index) => {
            const marker = new google.maps.Marker({
                position: property.coords,
                icon: createCustomMarkerIcon(property.price),
                map: map,
                title: 'Click to see details'
            });

            const popupContent = createPopupContent(property, index);

            const infoWindow = new google.maps.InfoWindow({
                content: popupContent,
                disableAutoPan: true
            });

            // Customize the InfoWindow styles
            google.maps.event.addListener(infoWindow, "domready", () => {
                customizeInfoWindow();
            });

            // Close the InfoWindow when clicking outside
            google.maps.event.addListener(map, "click", () => {
                infoWindow.close();
            });

            // Open custom popup on marker click
            marker.addListener("click", () => {
                // Custom popup positioning
                const popupDiv = document.createElement('div');
                popupDiv.innerHTML = popupContent;

                // Add custom styles to position at the bottom-center
                popupDiv.classList.add('custom-popup');
                popupDiv.style.position = 'absolute';
                popupDiv.style.bottom = '5%';
                popupDiv.style.left = '40%';
                popupDiv.style.transform = 'translateX(-50%)';
                popupDiv.style.zIndex = '1';
                popupDiv.style.height = 'auto';

                const mapDiv = map.getDiv();
                mapDiv.appendChild(popupDiv);

                // Close the popup if clicked outside
                google.maps.event.addListener(map, 'click', () => {
                    popupDiv.remove();
                });
            });
        });
    }

    function createCustomMarkerIcon(price) {
        return {
            url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
            scaledSize: new google.maps.Size(40, 40)
        };
    }

    function createPopupContent(property, index) {
        return `
            <div class="card property-popup">
                <div class="card-img-top position-relative">
                    <div class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">Showcase</div>
                    <div class="z-3 position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart fs-3"></i></div>
                    <div id="carousel-${index}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            ${property.images.map((_, i) => `
                                <button type="button" data-bs-target="#carousel-${index}" data-bs-slide-to="${i}" class="${i === 0 ? 'active' : ''}" aria-label="Slide ${i + 1}"></button>
                            `).join('')}
                        </div>
                        <div class="carousel-inner">
                            ${property.images.map((img, i) => `
                                <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                    <img src="${img}" class="d-block w-100" alt="${property.title}">
                                </div>
                            `).join('')}
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-${index}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-${index}" data-bs-slide="next">
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
                        ${property.beds} bds | ${property.baths} ba | ${property.sqft}<br>${property.address}
                    </p>
                </div>
            </div>
        `;
    }

    function customizeInfoWindow() {
        const closeButton = document.querySelector(".gm-ui-hover-effect");
        if (closeButton) closeButton.style.display = "none";
        const iwOuter = document.querySelector(".gm-style-iw");
        if (iwOuter) {
            iwOuter.style.overflow = "visible";
            iwOuter.style.width = "auto";
            iwOuter.style.maxWidth = "none";
        }
    }

    function initDrawingTools() {
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: null,
            drawingControl: false
        });
        drawingManager.setMap(map);
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
