<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('web/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('web/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
    <link rel="stylesheet" href="{{ asset("web/style.css") }}">
</head>

<body>
    <nav class="navbar navbar-expand-md bg-light">
        <div class="container-fluid">
            <!-- Centered Logo (Visible on Desktop) -->
            <a class="navbar-brand position-absolute top-50 start-50 translate-middle d-md-block d-none" href="/">
                <img src="{{ asset('web/img/z-logo.png') }}" alt="Logo" class="img-brand" height="30">
            </a>

            {{--
            <!-- Centered Search Bar (Visible on Mobile) -->
            <div class="input-group d-md-none position-absolute top-50 start-50 translate-middle w-100">
                <input type="search" class="form-control flex-grow-1" placeholder="Address neighborhood, city, Zip"
                    aria-label="Address neighborhood, city, Zip" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>


            <!-- User Icon (Visible on Mobile) -->
            <div class="position-absolute top-50 end-0 translate-middle fs-1">
                <a class="nav-link text-black px-md-3 pe-1 d-lg-none" href="#">
                    <i class="fa-regular fa-user"></i>
                </a>
            </div>

            <!-- Hamburger Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            --}}

            <div class="d-md-none d-flex justify-content-between align-items-center w-100">
                <!-- Hamburger Icon -->
                <button class="navbar-toggler  fs-6" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                </button>

                <!-- Centered Search Bar -->
                <div class="input-group mx-2 fs-6">
                    <input type="search" class="form-control" placeholder="Address neighborhood, city, Zip" aria-label="Address neighborhood, city, Zip" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>

                <!-- Profile Icon -->
                <button class="nav-link text-black fs-2" href="#">
                    <i class="fa-regular fa-user"></i>
                </button>
            </div>


            <!-- Off-Canvas -->
            <div class="offcanvas offcanvas-start w-100" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header position-relative">
                    <!-- Close Button on the Left -->
                    <button type="button" class="btn-close position-absolute start-0 ms-2 text-primary" data-bs-dismiss="offcanvas" aria-label="Close"></button>

                    <!-- Centered Logo -->
                    <a class="offcanvas-title mx-auto" href="/">
                        <img src="{{ asset('web/img/z-logo.png') }}" alt="Logo" class="img-brand" height="30">
                    </a>
                </div>


                <div class="offcanvas-body">
                    <!-- Off-Canvas Content -->
                    <div class="d-flex align-items-center">
                        <div class="navbar-nav w-100">
                            <ul class="navbar-nav w-100">
                                <!-- Rent Section -->
                                <li class="nav-item dropdown dropdown-mega position-static border-bottom-md">
                                    <a class="nav-link text-black px-md-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Rent</a>
                                    <div class="dropdown-menu shadow w-100   pb-md-0 pb-5 mb-md-0 mb-5" id="mega-content">
                                        <!-- Rent Mega Menu Content -->
                                        <div class="mega-content">
                                            <div class="container-fluid">
                                                <div class="row my-md-3">
                                                    <div class="col-md-2 border-end">
                                                        <h6 class="fw-bold">Saint Augustine rentals</h6>
                                                        <ul class="navbar-nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Apartments
                                                                        for Rent</small></a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Houses
                                                                        for
                                                                        Rent</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>All
                                                                        Rental
                                                                        Listings</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>All
                                                                        Rental
                                                                        buildings</small></a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-2 border-end">
                                                        <h6 class="fw-bold">Your Search</h6>
                                                        <ul class="navbar-nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Saved
                                                                        Searches</small></a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Messages</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Contacted
                                                                        Rentals</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Applications</small></a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-2 border-end">
                                                        <h6 class="fw-bold">Your Rental</h6>
                                                        <ul class="navbar-nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Overview</small></a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Make
                                                                        Payment</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Your
                                                                        lease</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Applications</small></a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-2 border-end">
                                                        <h6 class="fw-bold">Resources</h6>
                                                        <ul class="navbar-nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Rent
                                                                        with
                                                                        {{ env('APP_NAME') }}</small></a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Build
                                                                        Your
                                                                        Credits</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Renters
                                                                        insurance</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Affordability
                                                                        calculator</small></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Rent
                                                                        Guide</small></a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Sell Section -->
                                <li class="nav-item dropdown dropdown-mega position-static border-bottom-md">
                                    <a class="nav-link text-black px-md-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Sell</a>
                                    <div class="dropdown-menu shadow w-100">
                                        <!-- Sell Mega Menu Content -->
                                        <div class="mega-content">
                                            <div class="container-fluid">
                                                <div class="row my-md-3">
                                                    <div class="col-md-2 border-end">
                                                        <h6 class="fw-bold">Resources</h6>
                                                        <ul class="navbar-nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>
                                                                        Explore
                                                                        your options</small></a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>See
                                                                        your
                                                                        home's Zestimate</small></a>


                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Home
                                                                        values</small></a>

                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Sellers
                                                                        guide</small></a>

                                                            </li> --}}

                                                        </ul>
                                                    </div>
                                                    <div class="col-md-2 border-end">
                                                        <h6 class="fw-bold">Selling options</h6>
                                                        <ul class="navbar-nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>
                                                                        Find a seller's agent</small></a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                <a class="nav-link  text-primary" href="#"><small>Post
                                                                        For Sale by Owner</small></a>


                                                            </li> --}}

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <!-- Right Section -->
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link text-black px-md-3 border-bottom-md" href="#">Help</a>
                        <a class="nav-link text-black px-md-3 border-bottom-md" href="{{ route('user.chat') }}">Messages</a>
                        @if(auth()->guard('member')->check())
                            <a class="nav-link text-black px-md-3 border-bottom-md" href="#" data-bs-toggle="modal" data-bs-target="#memberPopup">
                                <i class="fa fa-user"></i>
                            </a>
                        @else
                            <a class="nav-link text-black px-md-3 border-bottom-md" href="{{ route('user.login') }}">Sign In</a>
                        @endif
                    
                        <a class="nav-link text-black px-md-3 border-bottom-md" href="#" data-bs-toggle="modal" data-bs-target="#languagePopup">
                            <i class="fa fa-globe"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="memberPopup" tabindex="-1" aria-labelledby="memberPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="languagePopupLabel">User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="{{route('user.logout')}}" class="">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="languagePopup" tabindex="-1" aria-labelledby="languagePopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="languagePopupLabel">Select Your Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- First Column (12 flags) -->
                            <div class="col-6 col-sm-4 col-md-3">
                                <ul class="list-unstyled">
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Gb@3x.png') }}" alt=""> English
                                        (UK)</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Fr@3x.png') }}" alt=""> Français
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Catalonia@3x.png') }}" alt="">
                                        Català</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/No@3x.png') }}" alt=""> Norsk
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Cz@3x.png') }}" alt=""> Čeština
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Cn@3x.png') }}" alt=""> 简体中文
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Ru@3x.png') }}" alt=""> Русский
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Kr@3x.png') }}" alt=""> 한국어</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/In@3x.png') }}" alt=""> हिन्दी
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Es@3x.png') }}" alt=""> Eesti
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Rs@3x.png') }}" alt=""> Srpski
                                    </li>
                                    <li class=" d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Se@3x.png') }}" alt=""> Svenska
                                    </li>
                                </ul>
                            </div>

                            <!-- Second Column (11 flags) -->
                            <div class="col-6 col-sm-4 col-md-3">
                                <ul class="list-unstyled">
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Us@3x.png') }}" alt=""> English
                                        (US)</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Is@3x.png') }}" alt=""> Íslenska
                                    </li>   

                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/It@3x.png') }}" alt=""> Italiano
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Fi@3x.png') }}" alt=""> Suomi
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Hu@3x.png') }}" alt=""> Magyar
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Z4@3x.png') }}" alt=""> 繁體中文
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Tr@3x.png') }}" alt=""> Türkçe
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Il@3x.png') }}" alt=""> עברית
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Id@3x.png') }}" alt=""> Bahasa
                                        Indonesia</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Pt@3x.png') }}" alt="">
                                        Português (BR)</li>
                                    <li class=" d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Ro@3x.png') }}" alt=""> Română
                                    </li>
                                </ul>
                            </div>

                            <!-- Third Column (11 flags) -->
                            <div class="col-6 col-sm-4 col-md-3">
                                <ul class="list-unstyled">
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Gr@3x.png') }}" alt=""> Ελληνικά
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Sa@3x.png') }}" alt=""> العربية
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Ua@3x.png') }}" alt="">
                                        Українська</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Nl@3x.png') }}" alt="">
                                        Nederlands</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Th@3x.png') }}" alt=""> ภาษาไทย
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Vn@3x.png') }}" alt=""> Tiếng
                                        Việt</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Dk@3x.png') }}" alt=""> Dansk
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Jp@3x.png') }}" alt=""> 日本語</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Se@3x.png') }}" alt=""> Svenska
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Lt@3x.png') }}" alt=""> Lietuvių
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/My@3x.png') }}" alt=""> Bahasa
                                        Malaysia</li>
                                </ul>
                            </div>

                            <!-- Fourth Column (11 flags) -->
                            <div class="col-6 col-sm-12 col-md-3">
                                <ul class="list-unstyled">
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Ph@3x.png') }}" alt=""> Filipino
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Pl@3x.png') }}" alt=""> Polski
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Hr@3x.png') }}" alt=""> Hrvatski
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Sk@3x.png') }}" alt="">
                                        Slovenščina</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Bg@3x.png') }}" alt="">
                                        Български</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Lv@3x.png') }}" alt=""> Latviski
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Sk@3x.png') }}" alt="">
                                        Slovenský</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Lt@3x.png') }}" alt=""> Lietuvių
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Ph@3x.png') }}" alt=""> Filipino
                                    </li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Jp@3x.png') }}" alt=""> 日本語</li>
                                    <li class="my-5 d-flex flex-wrap"><img class="rounded-circle border" width="20" src="{{ asset('web/img/languages/Th@3x.png') }}" alt=""> ภาษาไทย
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')



    <script src="{{ asset('web/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @stack('scripts')

    <script>
        document.addEventListener('click', function(e) {
            // Hamburger menu
            if (e.target.classList.contains('hamburger-toggle')) {
                e.target.children[0].classList.toggle('active');
            }
        })

    </script>
</body>

</html>
