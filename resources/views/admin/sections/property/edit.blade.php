@extends('admin.layout.app')
@section('content')
@push('css')
<style>
    #map_canvas {
        height: 300px;
        width: 100%;
    }
</style>
 <link type="text/css" rel="stylesheet" href="{{ asset('admin/css') }}/image-uploader.min.css">
@endpush
    <div class="content-wrapper">
        <section class="content py-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Edit Property </h3>
                    </div>
                    <div class="">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card p-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Property Title</label>
                                                    <input type="text" id="title" name="title" class="form-control"
                                                           value="{{ old('title', $property->title) }}"
                                                           placeholder="Enter ">
                                                    @error('title')
                                                    <span class="text-danger text-sm pull-right">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date_time">Date Time</label>
                                                    <input type="datetime-local" id="date_time" name="date_time" class="form-control"
                                                           value="{{ old('date_time', $property->date_time) }}">
                                                    @error('date_time')
                                                    <span class="text-danger text-sm pull-right">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="type">Property Type</label>
                                                    <select id="type" name="type" class="form-control">
                                                        <option value="sale" {{ old('type', $property->type) == 'sale' ? 'selected' : '' }}>Sale</option>
                                                        <option value="rent" {{ old('type', $property->type) == 'rent' ? 'selected' : '' }}>Rent</option>
                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger text-sm pull-right">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="detail">Details</label>
                                                    <textarea class="form-control editor" name="detail">{{ old('detail', $property->detail) }}</textarea>
                                                    @error('detail')
                                                    <span class="text-danger text-sm pull-right">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="place">City Name</label>
                                                    <input id="places_input" value="{{ old('place', $property->place) }}" class="form-control" name="place" />
                                                    @error('place')
                                                        <span class="text-sm text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Longitude</label>
                                                    <input class="form-control" id="place_lng" type="text" name="longitude" value="{{ old('longitude', $property->longitude) }}" readonly />
                                                    @error('longitude')
                                                        <span class="text-sm text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Latitude</label>
                                                    <input class="form-control" id="place_lat" type="text" name="latitude" value="{{ old('latitude', $property->latitude) }}" readonly />
                                                    @error('latitude')
                                                        <span class="text-sm text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="map_canvas"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-fiels">
                                                        <label>Property Images <span class="text-xs mx-2">(Choose multiple images with same dimensions)</span></label>
                                                        <div class="input-images w-100" style="border:1px solid black;"></div>
                                                        @error('images')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="input-fiels">
                                                        {{-- <label>Your Venue Gallery Images</label> --}}
                                                    </div>
                                                    <div class="row">
                                                        @forelse ($property->media as $image)
                                                            <div class="col-sm-4" style="position:relative;">
                                                                <a href="{{route('admin.property.gallery' ,[$property , $image])}}" class="btn btn-danger btn-xs m-2" style="right:8px; top:8px; position: absolute;"><i class="fas fa-times"></i></a>
                                                                <img src="{{ $image->getFullUrl() }}"
                                                                    class="w-100 m-1 rounded"
                                                                    style="border: 1px solid lightgrey;height:160px; object-fit:cover;"
                                                                    alt=""
                                                                    id="image_preview">
                                                            </div>
                                                        @empty
                                                            <h6 class="text-danger">No property images</h6>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                       <label for="image_input_field">Update Cover Image (optional)</label><br>
                                                       <img
                                                          id="image_preview"
                                                          src="{{ $property->cover_url}}"
                                                          class="w-100"
                                                          alt="">
                                                          <br>
                                                       <input type="file" id="image_input_field" class="mt-2" name="cover_img"><br>
                                                       @error('cover_img')
                                                       <span class="text-danger text-sm pull-right">{{$errors->first('cover_img')}}</span>
                                                       @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm float-right">
                                    <i class="fas fa-save"></i> Update Record
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function initMap() {
            // Get existing property coordinates from Laravel variables
            var propertyLat = parseFloat("{{ old('latitude', $property->latitude) }}") || 50;
            var propertyLng = parseFloat("{{ old('longitude', $property->longitude) }}") || 50;
    
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(propertyLat, propertyLng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
    
            var myMarker = new google.maps.Marker({
                position: new google.maps.LatLng(propertyLat, propertyLng),
                draggable: true,
                title: 'Drag to Adjust Location'
            });
    
            myMarker.setMap(map);
            map.setCenter(myMarker.position);
    
            // Autocomplete for city selection
            var input = document.getElementById('places_input');
            var autocomplete = new google.maps.places.Autocomplete(input, { types: ['(cities)'] });
    
            autocomplete.setFields(['place_id', 'formatted_address', 'address_components', 'geometry', 'name']);
    
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
    
                // Extract City and Country
                place.address_components.forEach(component => {
                    if (component.types.includes("locality")) {
                        document.getElementById('place_city').value = component.long_name;
                    }
                    if (component.types.includes("country")) {
                        document.getElementById('place_country').value = component.long_name;
                    }
                });
            });
    
            // Update lat/lng on marker drag
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
@push('script')
<script type="text/javascript" src="{{ asset('admin/js') }}/image-uploader.min.js"></script>
<script>
    $(function(){
        $('.input-images').imageUploader();
        $('.editor').summernote({
            height: 140
        });
    })
</script>
@endpush
