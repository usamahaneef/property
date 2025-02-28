


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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-info-circle"></i> Property Detail</h3>
                                <div class="card-tools">
                                    <button onclick="history.back()" class="btn btn-primary"> <i class="fas fas"></i> Back to List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card evaluation-0">
                            <div style="height:250px;" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($property->media as $image)
                                    <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                        <img style="height:250px; width:100%; object-fit:cover; " class="p-3"
                                         src="{{ $image->getFullUrl() }}" alt="First slide">
                                    </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="p-3 mx-3">
                                <div>
                                    <label for="">Property Title</label> <br>
                                    <p class="">{{ $property->title }}</p>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label for="">Date & Time</label>
                                        <p>{{ $property->date_time }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Type</label>
                                        <p>{{ ucfirst($property->type) }}</p>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label for="">Details</label>
                                        <span class="">{!! $property->detail !!}</span>
                                </div>
                            </div>
                            <div class="row p-3 mx-3">
                                <div class="col-md-4">
                                    <label for="">Place</label>
                                    <p>{{ $property->place }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label>Longitude</label>
                                    <input type="hidden" id="place_lng" value="{{ $property->longitude }}">
                                    <p class="form-control-static">{{ $property->longitude }}</p>
                                </div>
                                <div class=" col-md-4">
                                    <label>Latitude</label>
                                    <input type="hidden" id="place_lat" value="{{ $property->latitude }}">
                                    <p class="form-control-static">{{ $property->latitude }}</p>
                                </div>
                                <div class="col-md-12 ">
                                    <div id="map_canvas"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3">
                            <div class="col-md-12 pb-3">
                                <label for="">Property Cover Image</label>
                                <img src="{{ $property->cover_url}}"
                                class="w-100"
                                alt="Cover Image">
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function initMap() {
            var propertyLat = parseFloat("{{ $property->latitude }}");
            var propertyLng = parseFloat("{{ $property->longitude }}");
    
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(propertyLat, propertyLng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
    
            var myMarker = new google.maps.Marker({
                position: new google.maps.LatLng(propertyLat, propertyLng),
                draggable: true,
                title: 'Property Location'
            });
    
            map.setCenter(myMarker.position);
            myMarker.setMap(map);
    
            var input = document.getElementById('places_input');
            var autocomplete = new google.maps.places.Autocomplete(input, { types: ['(cities)'] });
    
            autocomplete.setFields(['place_id', 'formatted_address', 'geometry', 'name']);
    
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    alert("No details available for input: '" + place.name + "'");
                    return;
                }
                document.getElementById('places_input').value = place.name;
                document.getElementById('place_lat').value = place.geometry.location.lat();
                document.getElementById('place_lng').value = place.geometry.location.lng();
                myMarker.setPosition(place.geometry.location);
                map.setCenter(myMarker.position);
            });
    
            myMarker.addListener('dragend', function() {
                var position = myMarker.getPosition();
                document.getElementById('place_lat').value = position.lat();
                document.getElementById('place_lng').value = position.lng();
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAse-TvvmvUxCiXhJ_SbFrDpjQekaYULdo&libraries=places&types=cities&callback=initMap">
    </script>
@endsection

