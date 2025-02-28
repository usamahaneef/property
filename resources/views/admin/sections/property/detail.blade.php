@extends('admin.layout.app')
@section('content')
@push('css')
<style>
    #map_canvas {
        height: 300px;
        width: 100%;
    }
</style>
@endpush
    <div class="content-wrapper">
        <section class="content py-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-eye"></i> View Property </h3>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card p-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Property Title</label>
                                                <p class="form-control-static">{{ $property->title }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date Time</label>
                                                <p class="form-control-static">{{ $property->date_time }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Property Type</label>
                                                <p class="form-control-static">{{ ucfirst($property->type) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Details</label>
                                                <p class="form-control-static">{!! $property->detail !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City Name</label>
                                                <p class="form-control-static">{{ $property->place }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Longitude</label>
                                                <p class="form-control-static">{{ $property->longitude }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Latitude</label>
                                                <p class="form-control-static">{{ $property->latitude }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="map_canvas"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{-- <div class="card p-3">
                                    <div class="form-group">
                                        <label>Property Images</label>
                                        <div class="w-100" style="border:1px solid black;">
                                            @foreach($property->images as $image)
                                                <img src="{{ asset('storage/'.$image) }}" class="img-fluid mb-2" />
                                            @endforeach
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 5,
                center: new google.maps.LatLng({{ $property->latitude }}, {{ $property->longitude }}),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var myMarker = new google.maps.Marker({
                position: new google.maps.LatLng({{ $property->latitude }}, {{ $property->longitude }}),
                title: '{{ $property->title }}'
            });

            map.setCenter(myMarker.position);
            myMarker.setMap(map);
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAse-TvvmvUxCiXhJ_SbFrDpjQekaYULdo&libraries=places&callback=initMap">
    </script>
@endsection
