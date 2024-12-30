@extends('web.layout.app')

@section('content')
    <div class="container-fluid px-4 bg-light">
        <div>
            <a href="#" class="text-decoration-none">
                <span class="me-3">
                    < </span> back to Account settings</a>
        </div>
        <div>
            <h2 class="fw-bold mt-3     ">Profile</h2>
        </div>
        <div class="row bg-white">
            <h4 class="fw-bold mt-3">Personal Info</h4>

            <div class="d-flex justify-content-between mt-3">
                <div>
                    <h6 class="fw-bold">Name</h6>
                    <p class="text-black-50">Your first and last given names. Updates are reflected across all
                        {{ env('APP_NAME') }} experiences.</p>
                </div>

                <div class="d-flex justify-content-between">
                    <div>John Doe</div>
                    <a href="#" class="fw-bold text-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
