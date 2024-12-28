@extends('web.layout.app')
@push('styles')
    <style>
        .google_map{
            position: fixed;
            left: 0;
            bottom: 0;
            top: 25%;
            width: 40rem;
            height: 28rem;
        }

        @media only screen and (max-width: 768px) {
            .google_map{
            position: relative;
            width: 100%;
            height: 100%;
        }
}
    </style>
@endpush
@section('content')
    <div class="container-fluid my-2">
        <div class="row">
            <div class="col-md-5">
                <div class="input-group mb-3">
                    <input type="search" class="form-control" placeholder="Address neighborhood, city, Zip"
                        aria-label="Address neighborhood, city, Zip" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>

            </div>
            <div class="col-md-7">

                <div class="d-flex justify-content-between flex-wrap">
                    <!-- Dropdown 1 -->
                    <div class="dropdown mb-3">
                        <button class="btn btn-outline-light border-1 border-primary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="selected-filter text-black  small">For Sale</span>
                        </button>
                        <div class="dropdown-menu p-3">
                            <form>
                                <!-- Radio Buttons -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option1"
                                        value="Option 1" checked>
                                    <label class="form-check-label" for="filter1Option1">Option 1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option2"
                                        value="Option 2">
                                    <label class="form-check-label" for="filter1Option2">Option 2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filterOptions1" id="filter1Option3"
                                        value="Option 3">
                                    <label class="form-check-label" for="filter1Option3">Option 3</label>
                                </div>
                                <!-- Apply Button -->
                                <div class="mt-3 apply-button d-grid gap-2">
                                    <button type="button" class="btn btn-primary fw-bold apply-filter">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Dropdown 2 -->
                    <div class="dropdown mb-3">
                        <button class="btn btn-outline-light border-1 border-primary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="selected-filter text-black  small">Price</span>
                        </button>
                        <div class="dropdown-menu p-3">
                            <form>
                                <!-- Minimum and Maximum Dropdowns -->
                                <div class="d-flex justify-content-evenly align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label" for="minSelect">Minimum</label>
                                        <select class="form-select" id="minSelect">
                                            <option value="0">$0</option>
                                            <option value="10">$10</option>
                                            <option value="100">$100</option>
                                        </select>
                                    </div>
                                    <div class="form-check mt-3">-</div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="maxSelect">Maximum</label>
                                        <select class="form-select" id="maxSelect">
                                            <option value="0">$0</option>
                                            <option value="10">$10</option>
                                            <option value="100">$100</option>
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

                    <div class="dropdown mb-3">
                        <button class="btn btn-outline-light border-1 border-primary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="selected-filter text-black  small">Beds &amp; Baths</span>
                        </button>
                        <div class="dropdown-menu">
                            <form class="p-3">
                                <div class="h6">Bedrooms</div>


                                <div class="btn-group my-2" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1"
                                        autocomplete="off" checked>
                                    <label class="btn btn-outline-light text-black" for="btnradio1">Any</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="btnradio2">1+</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="btnradio3">2+</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="btnradio4">3+</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="btnradio5">4+</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="btnradio6">5+</label>
                                </div>
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Use exact match
                                    </label>
                                </div>

                                <div class="h6">Bathrooms</div>


                                <div class="btn-group my-2" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="bathroom" id="bathroom1"
                                        autocomplete="off" checked>
                                    <label class="btn btn-outline-light text-black" for="bathroom1">Any</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bathroom2"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="bathroom2">1+</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bathroom3"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="bathroom3">1.5+</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bathroom4"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="bathroom4">2+</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bathroom5"
                                        autocomplete="off">
                                    <label class="btn btn-outline-light text-black" for="bathroom5">3+</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bathroom6"
                                        autocomplete="off">
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

                    <div class="dropdown mb-3">
                        <button class="btn btn-outline-light border-1 border-primary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="selected-filter text-black  small">Home Type</span>
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
                    <div class="dropdown mb-3">
                        <button class="btn btn-outline-light border-1 border-primary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="selected-filter text-black  small">More</span>
                        </button>
                        <div class="dropdown-menu p-3 w-100">
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
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="garage">
                                    <label class="form-check-label" for="garage">
                                        must have garange
                                    </label>
                                </div>


                                <label for="" class="mt-2">Square Feet</label>
                                <div class="d-flex ">
                                        <select class="form-select me-2" id="">
                                            <option value="" selected>No Min</option>
                                            <option value="500">500</option>
                                            <option value="750">750</option>
                                        </select>
                                        <select class="form-select" id="">
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
        </div>
    </div>

    <div class="container-fluid ">
        <div class="row ">
            <div class="col-md-6 ">
                <iframe class="google_map" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317716.6065035931!2d-0.43124885956926756!3d51.52860700576551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2s!4v1735031784268!5m2!1sen!2s"
                     style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <div class="row mb-2">
                    <h6>Recently Sold Homes</h6>
                    <div class="d-flex justify-content-between">
                        <div>
                            21 results
                        </div>
                        <div>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort: Search homes for you
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
                    <div class="col">
                        <div class="card">
                            <div class="card-img-top position-relative">
                                <!-- Badge -->
                                <div
                                    class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                    Showcase
                                </div>

                                <!-- Heart Icon -->
                                <div class="z-3 position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart "></i>
                                </div>

                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
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
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
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
                                <div
                                    class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                    Showcase
                                </div>

                                <!-- Heart Icon -->
                                <div class="z-3 position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart "></i>
                                </div>

                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
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
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
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
                                <div
                                    class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">
                                    Showcase
                                </div>

                                <!-- Heart Icon -->
                                <div class="z-3 position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart "></i>
                                </div>

                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
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
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
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
                          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                      </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
@endpush


@push('scripts')
    <script>
        $('.dropdown').each(function() {
            const dropdown = $(this);
            const applyButton = dropdown.find('.apply-filter');
            const dropdownMenu = dropdown.find('.dropdown-menu');
            const selectedFilter = dropdown.find('.selected-filter');

            // Prevent dropdown from closing when clicking inside
            dropdownMenu.on('click', function(e) {
                e.stopPropagation();
            });

            // Handle Apply button click
            applyButton.on('click', function() {
                let displayValue = '';

                // Check for radio buttons
                const selectedRadio = dropdownMenu.find('input[name^="filterOptions"]:checked');
                if (selectedRadio.length > 0) {
                    displayValue = selectedRadio.val();
                }

                // Check for range selectors (minimum and maximum dropdowns)
                const rangeSelectors = dropdownMenu.find('select');
                if (rangeSelectors.length === 2) {
                    const minValue = rangeSelectors.eq(0).val();
                    const maxValue = rangeSelectors.eq(1).val();

                    // Validation: Ensure Maximum is greater than or equal to Minimum
                    if (parseInt(maxValue) < parseInt(minValue)) {
                        alert('Maximum value must be greater than or equal to Minimum value.');
                        return;
                    }

                    displayValue = `$${minValue} - $${maxValue}`;
                }

                // Update display
                if (selectedFilter.length > 0) {
                    selectedFilter.text(displayValue.trim());
                }

                // Close the dropdown
                const bsDropdown = bootstrap.Dropdown.getInstance(dropdown.find(
                    '[data-bs-toggle="dropdown"]')[0]);
                if (bsDropdown) {
                    bsDropdown.hide();
                }

                // Log the applied filter for debugging
                console.log("Filter applied:", displayValue);
            });
        });
    </script>
@endpush
