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
                        <h3 class="card-title"><i class="fas fa-plus-circle"></i> Create New Property </h3>
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
                                                    <label for="title">Property  Title</label>
                                                    <input type="text" id="title" name="title" class="form-control"
                                                           value="{{old('title')}}"
                                                           placeholder="Enter ">
                                                    @error('title')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('title')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date_time">Date Time</label>
                                                    <input type="datetime-local" id="date_time" name="date_time" class="form-control"
                                                           value="{{old('date_time')}}"
                                                           placeholder="Enter ">
                                                    @error('date_time')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('date_time')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="type">Property  Type</label>
                                                    <select id="type" name="type" class="form-control"
                                                            data-placeholder="Select ">
                                                        <option value="sale">Sale</option>
                                                        <option value="rent">Rent</option>
                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('type')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="detail">Details</label>
                                                    <textarea class="form-control editor" name="detail">{{ old('detail') }}</textarea>
                                                    @error('detail')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('detail')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="place">City Name</label>
                                                    <input id="places_input" value="{{ old('name') }}"
                                                        class="form-control" name="place" />
                                                    @error('place')
                                                        <span class="text-sm text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Longitude</label>
                                                    <input class="form-control" id="place_lng" type="text"
                                                        name="longitude" placeholder="Longitude"
                                                        value="{{ old('longitude') }}" readonly />
                                                    @error('longitude')
                                                        <span class="text-sm text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-8">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Latitude</label>
                                                    <input class="form-control" id="place_lat" type="text"
                                                        name="latitude" placeholder="Latitude" value="{{ old('latitude') }}"
                                                        readonly />
                                                    @error('latitude')
                                                        <span class="text-sm text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
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
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                   <label for="image_input_field">Upload Cover Image</label><br>
                                                   <img
                                                      id="image_preview"
                                                      src="{{asset('admin/img/cover/placeholder.png')}}"
                                                      class="w-100 rounded"
                                                      alt="">
                                                      <br>
                                                   <input type="file" id="image_input_field" class="mt-2" name="cover_img"><br>
                                                   @error('')
                                                   <span class="text-danger text-sm pull-right">{{$errors->first('')}}</span>
                                                   @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="card p-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-fiels">
                                                        <label>Property  Images <span class="text-xs mx-2">(Choose multiple images with same dimensions)</span></label>
                                                        <div class="input-images w-100" style="border:1px solid black;"></div>
                                                        @error('images')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm float-right">
                                    <i class="fas fa-save"></i> Save Record
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
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 5,
                center: new google.maps.LatLng(50, 50),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var myMarker = new google.maps.Marker({
                position: new google.maps.LatLng(50, 50),
                draggable: true,
                title: ''
            });

            map.setCenter(myMarker.position);
            myMarker.setMap(map);

            var input = document.getElementById('places_input');
            var types = {
                types: ['(cities)'],
            };

            var autocomplete = new google.maps.places.Autocomplete(input, types);
            autocomplete.setFields(
                ['place_id', 'formatted_address', 'address_components', 'geometry', 'icon', 'name', 'vicinity']
            );

            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
                document.getElementById('places_input').value = place.name;
                document.getElementById('place_lat').value = place.geometry.location.lat();
                document.getElementById('place_lng').value = place.geometry.location.lng();
                myMarker.setPosition(place.geometry.location);
                map.setCenter(myMarker.position);
                for (var i = place.address_components.length - 1; i >= 0; i--) {
                    var addressType = place.address_components[i].types[0];
                    if (addressType == "country") {
                        document.getElementById('place_country').value = place.address_components[i].long_name;
                    } else if (addressType == 'locality') {
                        document.getElementById('place_city').value = place.address_components[i].long_name;
                        break;
                    }
                }
                console.log(place);
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