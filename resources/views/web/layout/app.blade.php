<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>property</title>
    <link rel="stylesheet" href="{{ asset('web/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <!-- Centered logo -->
            <a class="navbar-brand position-absolute top-50 start-50 translate-middle" href="#">
                <img src="{{ asset('web/img/logo.jpg') }}" alt="Logo" class="img-brand" height="50">
            </a>
    
            <!-- Hamburger Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Collapsible Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <div class="navbar-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-black" aria-current="page" href="#">Rent</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="#">Sell</a>
                            </li>
                        </ul>
                    </div>
                </div>
    
                <!-- Right Section -->
                <div class="navbar-nav ms-auto">
                    <a class="nav-link text-black" href="#">Help</a>
                    <a class="nav-link text-black" href="#">Sign In</a>
                    <li class="nav-item dropdown dropdown-mega position-static ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside"><i class="fa fa-globe"></i></a>
                        <div class="dropdown-menu shadow dropdown-menu-end w-100">
                            <div class="mega-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <!-- First Column (11 languages) -->
                                        <div class="col-12 col-sm-4 col-md-3 py-4">
                                            <div class="list-group">
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/eng_uk.png') }}" alt=""> English
                                                    (UK)</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/fr@3x.png') }}" alt="">
                                                    Français</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/catalonia@3x.png') }}"
                                                        alt=""> Català</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/no@3x.png') }}" alt="">
                                                    Norsk</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/Cz@3x.png') }}" alt="">
                                                    Čeština</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/cn@3x.png') }}" alt="">
                                                    简体中文</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/ru@3x.png') }}" alt="">
                                                    Русский</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/kr@3x.png') }}"
                                                        alt=""> 한국어</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/in@3x.png') }}"
                                                        alt=""> हिन्दी</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/es@3x.png') }}"
                                                        alt=""> Eesti</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/rs@3x.png') }}"
                                                        alt=""> Srpski</a>
                                            </div>
                                        </div>

                                        <!-- Second Column (10 languages) -->
                                        <div class="col-12 col-sm-4 col-md-3 py-4">
                                            <div class="list-group">
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/is@3x.png') }}"
                                                        alt=""> Íslenska</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/us@3x.png') }}"
                                                        alt=""> English (US)</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/es@3x.png') }}"
                                                        alt=""> Español (MX)</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/it@3x.png') }}"
                                                        alt=""> Italiano</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/fi@3x.png') }}"
                                                        alt=""> Suomi</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/hu@3x.png') }}"
                                                        alt=""> Magyar</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/tw@3x.png') }}"
                                                        alt=""> 繁體中文</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/tr@3x.png') }}"
                                                        alt=""> Türkçe</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/il@3x.png') }}"
                                                        alt=""> עברית</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/id@3x.png') }}"
                                                        alt=""> Bahasa Indonesia</a>
                                            </div>
                                        </div>

                                        <!-- Third Column (10 languages) -->
                                        <div class="col-12 col-sm-4 col-md-3 py-4">
                                            <div class="list-group">
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/pt@3x.png') }}"
                                                        alt=""> Português (BR)</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/ro@3x.png') }}"
                                                        alt=""> Română</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/gr@3x.png') }}"
                                                        alt=""> Ελληνικά</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/sa@3x.png') }}"
                                                        alt=""> العربية</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/ua@3x.png') }}"
                                                        alt=""> Українська</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/nl@3x.png') }}"
                                                        alt=""> Nederlands</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/th@3x.png') }}"
                                                        alt=""> ภาษาไทย</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/vn@3x.png') }}"
                                                        alt=""> Tiếng Việt</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/dk@3x.png') }}"
                                                        alt=""> Dansk</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/jp@3x.png') }}"
                                                        alt=""> 日本語</a>
                                            </div>
                                        </div>

                                        <!-- Fourth Column (10 languages) -->
                                        <div class="col-12 col-sm-12 col-md-3 py-4">
                                            <div class="list-group">
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/se@3x.png') }}"
                                                        alt=""> Svenska</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/lt@3x.png') }}"
                                                        alt=""> Lietuvių</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/my@3x.png') }}"
                                                        alt=""> Bahasa Malaysia</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/ph@3x.png') }}"
                                                        alt=""> Filipino</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/pl@3x.png') }}"
                                                        alt=""> Polski</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/hr@3x.png') }}"
                                                        alt=""> Hrvatski</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/sk@3x.png') }}"
                                                        alt=""> Slovenščina</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/bg@3x.png') }}"
                                                        alt=""> Български</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/lv@3x.png') }}"
                                                        alt=""> Latviski</a>
                                                <a class="list-group-item" href="#"><img
                                                        class="rounded-circle border" width="20"
                                                        src="{{ asset('web/img/languages/sk@3x.png') }}"
                                                        alt=""> Slovenský</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')



    <script src="{{ asset('web/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
