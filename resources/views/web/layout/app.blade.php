<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('admin/img/favicon.png') }}">
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
                <img src="{{ asset('web/img/logo.png') }}" alt="Logo" class="img-brand" height="50">
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
                                <a class="nav-link text-black px-md-3" aria-current="page" href="#">Rent</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black px-md-3" href="#">Sell</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="navbar-nav ms-auto">
                    <a class="nav-link text-black px-md-3" href="#">Help</a>
                    <a class="nav-link text-black px-md-3" href="{{ route('user.login') }}">Sign In</a>
                    <a class="nav-link text-black px-md-3" href="#" data-bs-toggle="modal"
                        data-bs-target="#languagePopup"> <i class="fa fa-globe"></i></a>
                </div>
            </div>
        </div>
    </nav>


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
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/gb@3x.png') }}" alt=""> English (UK)</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/fr@3x.png') }}" alt=""> Français
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/catalonia@3x.png') }}" alt="">
                                        Català</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/no@3x.png') }}" alt=""> Norsk
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/Cz@3x.png') }}" alt=""> Čeština
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/cn@3x.png') }}" alt=""> 简体中文
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/ru@3x.png') }}" alt=""> Русский
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/kr@3x.png') }}" alt=""> 한국어</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/in@3x.png') }}" alt=""> हिन्दी
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/es@3x.png') }}" alt=""> Eesti
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/rs@3x.png') }}" alt=""> Srpski
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/se@3x.png') }}" alt=""> Svenska
                                    </li>
                                </ul>
                            </div>

                            <!-- Second Column (11 flags) -->
                            <div class="col-6 col-sm-4 col-md-3">
                                <ul class="list-unstyled">
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/us@3x.png') }}" alt=""> English
                                        (US)</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/is@3x.png') }}" alt=""> Íslenska
                                    </li>

                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/it@3x.png') }}" alt=""> Italiano
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/fi@3x.png') }}" alt=""> Suomi
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/hu@3x.png') }}" alt=""> Magyar
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/z4@3x.png') }}" alt=""> 繁體中文
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/tr@3x.png') }}" alt=""> Türkçe
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/il@3x.png') }}" alt=""> עברית
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/id@3x.png') }}" alt=""> Bahasa
                                        Indonesia</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/pt@3x.png') }}" alt="">
                                        Português (BR)</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/ro@3x.png') }}" alt=""> Română
                                    </li>
                                </ul>
                            </div>

                            <!-- Third Column (11 flags) -->
                            <div class="col-6 col-sm-4 col-md-3">
                                <ul class="list-unstyled">
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/gr@3x.png') }}" alt=""> Ελληνικά
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/sa@3x.png') }}" alt=""> العربية
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/ua@3x.png') }}" alt="">
                                        Українська</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/nl@3x.png') }}" alt="">
                                        Nederlands</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/th@3x.png') }}" alt=""> ภาษาไทย
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/vn@3x.png') }}" alt=""> Tiếng
                                        Việt</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/dk@3x.png') }}" alt=""> Dansk
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/jp@3x.png') }}" alt=""> 日本語</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/se@3x.png') }}" alt=""> Svenska
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/lt@3x.png') }}" alt=""> Lietuvių
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/my@3x.png') }}" alt=""> Bahasa
                                        Malaysia</li>
                                </ul>
                            </div>

                            <!-- Fourth Column (11 flags) -->
                            <div class="col-6 col-sm-12 col-md-3">
                                <ul class="list-unstyled">
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/ph@3x.png') }}" alt=""> Filipino
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/pl@3x.png') }}" alt=""> Polski
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/hr@3x.png') }}" alt=""> Hrvatski
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/sk@3x.png') }}" alt="">
                                        Slovenščina</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/bg@3x.png') }}" alt="">
                                        Български</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/lv@3x.png') }}" alt=""> Latviski
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/sk@3x.png') }}" alt="">
                                        Slovenský</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/lt@3x.png') }}" alt=""> Lietuvių
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/ph@3x.png') }}" alt=""> Filipino
                                    </li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/jp@3x.png') }}" alt=""> 日本語</li>
                                    <li class="my-5 "><img class="rounded-circle border" width="20"
                                            src="{{ asset('web/img/languages/th@3x.png') }}" alt=""> ภาษาไทย
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
