<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>property</title>
    <link rel="stylesheet" href="{{ asset('web/bootstrap/css/bootstrap.min.css') }}">
    <style>
        .form-floating-custom {
            position: relative;
        }

        .form-floating-custom .form-control {
            padding: 12px 10px;
            border-radius: 5px;
        }

        .form-floating-custom .form-control:focus {
            border: 2px solid #0041d9 !important;
            /* Change border color to a neutral one */
            box-shadow: none !important;
            /* Remove blue focus shadow */
        }

        .form-floating-custom label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #aaa;
            pointer-events: none;
            background: white;
            padding: 0 5px;
            transition: 0.3s ease all;
        }

        .form-floating-custom .form-control:focus+label,
        .form-floating-custom .form-control:not(:placeholder-shown)+label {
            top: -6px;
            left: 10px;
            font-size: 12px;
            color: #007bff;
            padding: 0 5px;
            z-index: 1;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mt-md-5 px-md-5 ">
                <div class="">
                    <img src="{{ asset('web/img/z-logo.svg') }}" class="img-fluid" alt="">
                    <div class="mt-4">
                        <h5 class="fw-bold">Sign in</h5>
                    </div>

                    <form class="mt-4">
                        <div class="form-floating-custom mb-3">
                            <input type="email" class="form-control form-control-lg rounded-3" id="email"
                                placeholder=" " required>
                            <label for="email">Email address*</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-lg" type="submit">Continue</button>
                        </div>
                    </form>

                    <div class="mt-3">New to Zillow? <a href="#" class="fw-bold text-decoration-none">Sign
                            up</a></div>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center mx-3 mb-0 text-muted">OR</p>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-light py-2 text-normal text-black small border text-start" type="submit"><img class="pe-3" src="{{ asset('web/img/google.png') }}" height="30" alt="">Continue with Google</button>
                        <button class="btn btn-outline-light py-2 text-normal text-black small border text-start" type="submit"><img class="pe-3" src="{{ asset('web/img/apple.png') }}" height="30" alt="">Continue with Apple</button>
                        <button class="btn btn-outline-light py-2 text-normal text-black small border text-start" type="submit"><img class="pe-3" src="{{ asset('web/img/fb.png') }}" height="30" alt="">Continue with Facebook</button>
                    </div>
                    <div>
                        <small  class="fw-small">By submitting, I accept Zillow's <a href="#" class="fw-bold text-decoration-none">terms of use</a></small>
                    </div>
                    

                </div>
            </div>
            <div class="col-md-8 d-md-block d-none">
                <img src="{{ asset('web/img/login_bg.webp') }}" class="img-fluid" style="" alt="">
            </div>
        </div>
    </div>
</body>

</html>
