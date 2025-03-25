<div>
    <div class="container-fluid">
        <div class="map-sort-bar z-1 d-md-none rounded mb-3 d-flex shadow position-fixed bottom-0 start-50 translate-middle-x  px-3 py-2"
            style="background-color:#E0F2FF">
            <div id="toggle_map_button" class=" text-primary d-flex align-items-center d-none">
                <i class="fa-regular fa-map me-2"></i> Map
            </div>
            <div class="border-end mx-1"></div>
            <div id="toggle_sort_button" class=" d-flex align-items-center text-primary d-none" data-bs-toggle="offcanvas"
                data-bs-target="#sortOffcanvas" aria-controls="sortOffcanvas">
                <i class="fa-solid fa-arrow-up-short-wide me-2"></i> Sort
            </div>
    
            <div id="toggle_property_listing_button" class="z-1 d-flex align-items-center text-primary "><i
                    class="fa-solid fa-list-ul me-2"></i>List</div>
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
    <div class="container-md-fluid my-2"> 
        <div class="d-flex align-items-center justify-content-start">
            <div class="input-group  ms-1 d-md-flex d-none input-group-width">
                <input type="search" class="form-control" wire:model.live="search" placeholder="Address neighborhood, city, Zip"
                    aria-label="Address neighborhood, city, Zip" aria-describedby="button-addon2">

                <button class="btn btn-outline-secondary"
                    type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <!-- Dropdown 1 -->
            {{-- <div class="dropdown ms-lg-2 ms-1">
                <button class="btn btn-outline-light border-1 border text-black" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="selected-filter small">Type</span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-menu p-3">
                    <form>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option1"
                                value="For Sale" checked>
                            <label class="form-check-label" for="filter1Option1">Sale</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option2"
                                value="For Rent">
                            <label class="form-check-label" for="filter1Option2">Rent</label>
                        </div>
                        <div class="mt-3 apply-button d-grid gap-2">
                            <button type="button" class="btn btn-primary fw-bold apply-filter">Apply</button>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="dropdown ms-lg-2 ms-1">
                <button class="btn btn-outline-light border-1 border text-black" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="selected-filter small">{{ $type ? ucfirst($type) : 'Type' }}</span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-menu p-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option1"
                            value="sale" wire:click="filterByType('sale')">
                        <label class="form-check-label" for="filter1Option1">Sale</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option2"
                            value="rent" wire:click="filterByType('rent')">
                        <label class="form-check-label" for="filter1Option2">Rent</label>
                    </div>
                    <div class="mt-3 apply-button d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-bold apply-filter" wire:click="filterByType('')">Reset</button>
                    </div>
                </div>
            </div>
    
            <div class="dropdown ms-lg-2 ms-1 d-md-block d-none price-dropdown">
                <button class="btn btn-outline-light border-1 border text-black" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="selected-filter small">
                        Price: ${{ $minPrice }} - ${{ $maxPrice }}
                    </span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-menu p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <label class="form-check-label" for="minSelect">Minimum</label>
                            <select class="form-select w-auto" id="minSelect" wire:model.defer="minPrice">
                                <option value="0">$0</option>
                                <option value="10">$10</option>
                                <option value="100">$100</option>
                            </select>
                        </div>
                        <div class="mx-3 mt-3">-</div>
                        <div>
                            <label class="form-check-label" for="maxSelect">Maximum</label>
                            <select class="form-select w-auto" id="maxSelect" wire:model.defer="maxPrice">
                                <option value="10000">$10,000</option>
                                <option value="1000">$1,000</option>
                                <option value="100">$100</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 apply-button d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-bold apply-filter" wire:click="filterByPrice">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="dropdown ms-lg-2 ms-1 d-md-block d-none bedrooms-bathrooms-dropdown">
                <button class="btn btn-outline-light border-1 border text-black" type="button" data-bs-toggle="dropdown">
                    <span class="selected-filter small">Beds & Baths</span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-menu p-3">
                    <div class="h6">Bedrooms</div>
                    <div class="btn-group my-2">
                        <input type="radio" class="btn-check" name="bedroom" id="bed1" wire:model="bedrooms" value="">
                        <label class="btn btn-outline-light text-black" for="bed1">Any</label>
            
                        <input type="radio" class="btn-check" name="bedroom" id="bed2" wire:model="bedrooms" value="1">
                        <label class="btn btn-outline-light text-black" for="bed2">1+</label>
            
                        <input type="radio" class="btn-check" name="bedroom" id="bed3" wire:model="bedrooms" value="2">
                        <label class="btn btn-outline-light text-black" for="bed3">2+</label>
            
                        <input type="radio" class="btn-check" name="bedroom" id="bed4" wire:model="bedrooms" value="3">
                        <label class="btn btn-outline-light text-black" for="bed4">3+</label>
            
                        <input type="radio" class="btn-check" name="bedroom" id="bed5" wire:model="bedrooms" value="4">
                        <label class="btn btn-outline-light text-black" for="bed5">4+</label>
            
                        <input type="radio" class="btn-check" name="bedroom" id="bed6" wire:model="bedrooms" value="5">
                        <label class="btn btn-outline-light text-black" for="bed6">5+</label>
                    </div>
            
                    <div class="h6">Bathrooms</div>
                    <div class="btn-group my-2">
                        <input type="radio" class="btn-check" name="bathroom" id="bath1" wire:model="bathrooms" value="">
                        <label class="btn btn-outline-light text-black" for="bath1">Any</label>
            
                        <input type="radio" class="btn-check" name="bathroom" id="bath2" wire:model="bathrooms" value="1">
                        <label class="btn btn-outline-light text-black" for="bath2">1+</label>
            
                        <input type="radio" class="btn-check" name="bathroom" id="bath3" wire:model="bathrooms" value="2">
                        <label class="btn btn-outline-light text-black" for="bath3">2+</label>
            
                        <input type="radio" class="btn-check" name="bathroom" id="bath4" wire:model="bathrooms" value="3">
                        <label class="btn btn-outline-light text-black" for="bath4">3+</label>
            
                        <input type="radio" class="btn-check" name="bathroom" id="bath5" wire:model="bathrooms" value="4">
                        <label class="btn btn-outline-light text-black" for="bath5">4+</label>
            
                        <input type="radio" class="btn-check" name="bathroom" id="bath6" wire:model="bathrooms" value="5">
                        <label class="btn btn-outline-light text-black" for="bath6">5+</label>
                    </div>
            
                    <div class="mt-3 apply-button d-grid gap-2">
                        <button type="button" class="btn btn-primary fw-bold apply-filter" 
                            wire:click="filterByBedsBaths">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
            
            
    
            <div class="dropdown ms-lg-2 ms-1 d-md-block d-none home-type-dropdown">
                <button class="btn btn-outline-light border-1 border text-black " type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="selected-filter small">Home Type</span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-menu p-3">
                    <form>
    
                        <div class="h6">Home Type</div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault2" checked>
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
            <div class="dropdown ms-lg-2 ms-1 more-filters-dropdown">
                <button class="btn btn-outline-light border-1 border text-black " type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
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
            <div class="ms-lg-2 ms-1">
                <button class="btn btn-primary fw-bold">Save Search</button>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row">
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
                                    <a class="nav-link " href="#" id="navbarDarkDropdownMenuLink" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort: Search homes for you
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light"
                                        aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">Price (Low to High)</a></li>
                                        <li><a class="dropdown-item" href="#">Price (High to Low)</a></li>
                                        <li><a class="dropdown-item" href="#">Homes for you</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    {{-- <div class="col">
                        <div class="card" style="cursor: pointer" data-modal-id="saleModal">
                            <div class="card-img-top position-relative">
                                <!-- Badge -->
                                <div
                                    class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                    Showcase
                                </div>
    
                                <!-- Heart Icon -->
                                <div class="z-3 position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart fs-3"></i>
                                </div>
    
                                <div id="saleModalIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#saleModalIndicators" data-bs-slide-to="0"
                                            class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#saleModalIndicators" data-bs-slide-to="1"
                                            aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#saleModalIndicators" data-bs-slide-to="2"
                                            aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('web/img/h2.webp') }}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('web/img/h1.webp') }}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#saleModalIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#saleModalIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">$600</h5>
                                    <a href="#" onclick="event.stopPropagation();"><i
                                            class="fas fa-ellipsis-h"></i></a>
                                </div>
                                <p class="card-text small">
                                    4 bds | 3 ba | 2,652 sqft - House for sale 11310 Traverse Rd, Woodbury, MN 55129
                                    <small class="small">COLDWELL BANKER REALTY</small>
                                </p>
                            </div>
                        </div>
                    </div> --}}
                    @forelse ($properties as $property)
                        <div class="col">
                            <div class="card" style="cursor: pointer" data-modal-id="rentModal-{{$property->id}}">
                                <div class="card-img-top position-relative">
                                    <!-- Badge -->
                                    <div
                                        class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                        Showcase
                                    </div>
        
                                    <!-- Heart Icon -->
                                    <div class="z-3 position-absolute top-0 end-0 m-2">
                                        <i class="fa-regular fa-heart fs-3"></i>
                                    </div>
        
                                    <div id="rentModalIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#rentModalIndicators" data-bs-slide-to="0"
                                                class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#rentModalIndicators" data-bs-slide-to="1"
                                                aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#rentModalIndicators" data-bs-slide-to="2"
                                                aria-label="Slide 3"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            @foreach ($property->media as $index => $image)
                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                    <img src="{{ $image->getFullUrl() }}" class="d-block w-100 rounded" style="height:300px; object-fit:cover;" alt="...">
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#rentModalIndicators" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#rentModalIndicators" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">${{$property->amount}}</h5>
                                        <a href="#"><i class="fas fa-ellipsis-h"></i> </a>
                                    </div>
                                    <p class="card-text small">
                                        4 bds | 3 ba | 2,652 sqft - House for sale 11310 Traverse Rd, Woodbury, MN 55129
                                        <small class="small">COLDWELL BANKER REALTY</small>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade modal-xl " id="rentModal-{{$property->id}}" tabindex="-1" aria-labelledby="rentModalLabel"
                                aria-hidden="true">
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
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                    
                    
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row align-items-center h-auto">
                                                <div class="col-md-6 p-1">
                                                    <img src="{{ $property->cover_url }}" alt="" class="img-fluid">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @foreach ($property->media as $image)
                                                            <div class="col-md-6 p-1">
                                                                <img src="{{ $image->getFullUrl() }}"
                                                                    alt="" class="img-fluid rounded">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-8">    
                                                    <div class="">
                                                        <div>
                                                            <h2 class="fw-bold">{{$property->title}} <i
                                                                    class="fa-solid fa-circle-check text-success"></i></h2>
                                                            <p class="mt-0">{{$property->place ?? ''}} </p>
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
                                                                <span>{{$property->bedroom ?? ''}} beds</span>
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
                                                    {{-- <div class="row">
                                                        <h4 class="mb-3">What's available</h4>
                    
                                                        <!-- Tabs for filtering -->
                                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="btn btn-outline-light text-dark ms-1 active"
                                                                    id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all"
                                                                    type="button" role="tab" aria-controls="pills-all"
                                                                    aria-selected="true">All</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="btn btn-outline-light text-dark ms-1" id="pills-2bed-tab"
                                                                    data-bs-toggle="pill" data-bs-target="#pills-2bed" type="button"
                                                                    role="tab" aria-controls="pills-2bed" aria-selected="false">2
                                                                    bed</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="btn btn-outline-light text-dark ms-1" id="pills-3bed-tab"
                                                                    data-bs-toggle="pill" data-bs-target="#pills-3bed" type="button"
                                                                    role="tab" aria-controls="pills-3bed" aria-selected="false">3
                                                                    bed</button>
                                                            </li>
                                                        </ul>
                    
                                                        <!-- Cards Container -->
                                                        <div class="tab-content" id="pills-tabContent">
                                                            <!-- All Tab -->
                                                            <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                                                                aria-labelledby="pills-all-tab">
                                                                <div class="card mb-3">
                                                                    <div class="row g-0 align-items-center">
                                                                        <div class="col-md-2 text-center">
                                                                            <img src="{{ asset('web/img/h2.webp') }}"
                                                                                alt="placeholder image" class="img-fluid">
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
                                                                            <img src="{{ asset('web/img/h2.webp') }}"
                                                                                alt="placeholder image" class="img-fluid">
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
                                                            <div class="tab-pane fade" id="pills-2bed" role="tabpanel"
                                                                aria-labelledby="pills-2bed-tab">
                                                                <div class="card mb-3">
                                                                    <div class="row g-0 align-items-center">
                                                                        <div class="col-md-2 text-center">
                                                                            <img src="{{ asset('web/img/h2.webp') }}"
                                                                                alt="placeholder image" class="img-fluid">
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
                                                            <div class="tab-pane fade" id="pills-3bed" role="tabpanel"
                                                                aria-labelledby="pills-3bed-tab">
                                                                <div class="card mb-3">
                                                                    <div class="row g-0 align-items-center">
                                                                        <div class="col-md-2 text-center">
                                                                            <img src="{{ asset('web/img/h2.webp') }}"
                                                                                alt="placeholder image" class="img-fluid">
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
                                                    </div> --}}
                    
                                                    <hr>
                                                    <div>
                                                        <div class="details-section px-3">
                                                            <!-- Facts & Features -->
                                                            <h2>Facts, features & policies</h2>
                                                            <p>{!! $property->detail !!}</p>
                                                        </div>
                                                        <div class="row my-3">
                                                            <h4 class="fw-bold">What's special</h4>
                                                            {{-- <div>
                                                                <span class="badge bg-light text-dark p-2">CHEF-READY KITCHEN</span>
                                                            </div> --}}
                                                            <p>{!! $property->lease !!}</p>
                                                        </div>
                    
                                                        <hr>
                                                        <div class="row my-3">
                                                            {{-- <div class="col-md-6">
                                                                <div class="d-grid gap-2">
                                                                    <input type="radio" checked class="btn-check"
                                                                        id="btn-check-outlined" name="bed" autocomplete="off">
                                                                    <label class="btn btn-outline-light text-dark border"
                                                                        for="btn-check-outlined">2 bed</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="d-grid gap-2">
                                                                    <input type="radio" class="btn-check" id="btn-check-outlined2"
                                                                        name="bed" autocomplete="off">
                                                                    <label class="btn btn-outline-light text-dark border"
                                                                        for="btn-check-outlined2">3 bed</label>
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-md-4 ">
                                                                <div class="bg-light p-3 mt-3 rounded">
                    
                                                                    <p class="mb-0">Est. cost</p>
                                                                    <strong>${{$property->amount}}</strong>
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
                                                        {{-- <div class="row my-3 ">
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
                                                                    <div class="position-relative bg-light rounded"
                                                                        style="height: 230px;">
                                                                        <!-- Placeholder for Google Map -->
                                                                        <iframe class="w-100 h-100 border rounded"
                                                                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24176.231892173613!2d-73.98930819999999!3d40.748817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1689182866251!5m2!1sen!2sus"
                                                                            style="border:0;" allowfullscreen="" loading="lazy"
                                                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                                        <!-- Street View Overlay -->
                                                                        <div class="position-absolute bottom-0 end-0 p-2">
                                                                            <div class="bg-white border rounded shadow-sm">
                                                                                <img src="{{ asset('web/img/h1.webp') }}" width="100"
                                                                                    class="img-fluid rounded" alt="Street View">
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
                                                                        <button type="button"
                                                                            class="btn btn-outline-light text-dark rounded-pill">Highlights</button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-light text-dark rounded-pill">Active
                                                                            life</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-3 position-sticky"
                                                    style="height: 100vh;overflow-y: auto;top:16%;">
                    
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
                    @empty
                        <div class="col">
                            <p>No Record Found</p>
                        </div>
                     @endforelse
                </div>
            </div>
        </div>
    </div>
</div>