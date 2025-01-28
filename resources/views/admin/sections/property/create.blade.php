@extends('admin.layout.app')
@section('content')
@push('css')
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
                                                    <label for="event_title">Property  Title</label>
                                                    <input type="text" id="event_title" name="event_title" class="form-control"
                                                           value="{{old('event_title')}}"
                                                           placeholder="Enter ">
                                                    @error('event_title')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('event_title')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <label for="ticket_price">Ticket Price</label>
                                                        <input type="hidden" name="is_free" value="0">
                                                        <input id="is-free" type="checkbox" name="is_free" data-on-text="Free" data-off-text="Paid" value="1" class="bt-switch float-right" style="height:32px;">
                                                    </div>
                                                    <input type="number" id="ticket-price" name="ticket_price" class="form-control"
                                                           value="{{old('ticket_price')}}"
                                                           placeholder="Enter ">
                                                    @error('ticket_price')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('ticket_price')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="event_type">Property  Type</label>
                                                    <select id="event_type" name="event_type" class="form-control"
                                                            data-placeholder="Select ">
                                                        <option value="indoor">Indoor</option>
                                                        <option value="outdoor">Outdoor</option>
                                                    </select>
                                                    @error('event_type')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('event_type')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="society_id">Location</label>
                                                    <input class="form-control" name="location" placeholder="Enter Location" value="{{ old('location') }}">
                                                    @error('location')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('location')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="contact_name">Contact name</label>
                                                    <input type="text" id="contact_name" name="contact_name" class="form-control"
                                                           value="{{old('contact_name')}}"
                                                           placeholder="Enter contact name">
                                                    @error('contact_name')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('contact_name')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="contact_email">Contact email</label>
                                                    <input type="text" id="contact_email" name="contact_email" class="form-control"
                                                           value="{{old('contact_email')}}"
                                                           placeholder="Enter contact email">
                                                    @error('contact_email')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('contact_email')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="contact_website">Contact website</label>
                                                    <input type="text" id="contact_website" name="contact_website" class="form-control"
                                                           value="{{old('contact_website')}}"
                                                           placeholder="Enter contact website">
                                                    @error('contact_website')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('contact_website')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="entry_requirements">Entry requirements</label>
                                                    <textarea class="form-control editor" name="entry_requirements">{{ old('entry_requirements') }}</textarea>
                                                    @error('entry_requirements')
                                                    <span class="text-danger text-sm pull-right">{{$errors->first('entry_requirements')}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="details">Details</label>
                                                    <textarea class="form-control" rows="5" id="details" name="details"
                                                              placeholder="Enter ">{{old('details')}}</textarea>
                                                    @error('details')
                                                    <span
                                                        class="text-danger text-sm pull-right">{{$errors->first('details')}}</span>
                                                    @enderror
                                                </div>
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
                                                        <label>Property  Images <span class="text-xs mx-2">(Choose multiple images with same dimensions)</span></label>
                                                        <div class="input-images w-100" style="border:1px solid black;"></div>
                                                        @error('images')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                   <label for="image_input_field">Upload Cover Image (optional)</label><br>
                                                   <img
                                                      id="image_preview"
                                                      src="{{asset('admin/img/cover/placeholder.png')}}"
                                                      class="w-100"
                                                      alt="">
                                                      <br>
                                                   <input type="file" id="image_input_field" class="mt-2" name="event_cover_img"><br>
                                                   @error('')
                                                   <span class="text-danger text-sm pull-right">{{$errors->first('')}}</span>
                                                   @enderror
                                                </div>
                                            </div>
                                            <div class="cold-md-5">
                                                <div class="form-group">
                                                  <label for="status"></label><br>
                                                  <input type="hidden" name="status" value="0">
                                                  <input type="checkbox" id="status" name="status"
                                                         class="bt-switch"
                                                         data-size="small" data-on-text="Active" data-off-text="Inactive"
                                                         value="1"
                                                         {{old('status')== 1?'checked="checked"':''}}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('admin/js') }}/image-uploader.min.js"></script>
<script>
    $(function(){
        $('#is-free').on('switchChange.bootstrapSwitch', function (event, state) {
            if(state)
            {
                $("#ticket-price").val("")
                $("#ticket-price").prop('readonly', true)
            }
            else{
                $("#ticket-price").prop('readonly', false)
            }
        });

        $('.input-images').imageUploader();
        $('.editor').summernote({
            height: 140
        });
    })
</script>
@endpush