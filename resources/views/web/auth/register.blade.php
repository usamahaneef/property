@extends('web.layout.app')
@push('styles')
<style>
    body {
        background: url("web/img/login_bg.webp") no-repeat center center fixed;
        background-size: cover;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
        border-radius: 8px;
    }
    .form-label {
        font-weight: bold;
    }
    .btn-primary {
        background-color: #0074e4;
        border-color: #0074e4;
    }
</style>

@endpush
@section('content')
<div class="container small d-flex align-items-center justify-content-center min-vh-100">
    <div class="row">

        <div class="card p-4 shadow-sm  col-md-6 m-auto" >
            <h2 class="text-center mb-4 fw-bold">Create a Free Profile</h2>
            <form action="{{route('user.registor.store')}}" method="POST" >
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" name="password" id="password" placeholder="Create password"   autocomplete="new-password"  required>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" id="first-name" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="" name="zip" placeholder="Zip/Postal Code" required>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" id="" placeholder="555">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" placeholder="555">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" placeholder="5555">
                    </div>
                    <div class="col align-items-center pt-2">
                        Ext.
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="" placeholder="5555">
                    </div>
                </div>
               
                <div class="row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    </div>
                    <div class="col">
                        I accept {{ env("APP_NAME") }}'s <a href="#" class="text-decoration-none">Terms of use</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection