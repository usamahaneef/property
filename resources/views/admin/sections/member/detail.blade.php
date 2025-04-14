
@extends('admin.layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid pt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3">
                            <div class="">
                                <div class="text-center">
                                    <img src="{{$member->profile_url}}" class="img-circle"
                                    width="150" height="150">
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <label class="pr-2">Member Name:</label>
                                    <span class="">{{$member->first_name ?? ''}} {{$member->last_name ?? ''}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label class="pr-2">Email:</label>
                                    <span>{{$member->email ?? ''}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label class="pr-2">Phone:</label>
                                    <span>{{$member->phone ?? ''}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label class="pr-2">Bio:</label>
                                    <span>{{$member->bio ?? ''}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label class="pr-2">Status:</label>
                                    <span>{!! $member->status_badge !!}</span>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title"><i class="fas fa-info-circle"></i> Properties Details</h2>
                                <div class="card-tools">
                                    <a href="" class="btn btn-sm btn-info">Rent</a>
                                    <a href="" class="btn btn-sm btn-success">Sale</a>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="table-borderless">
                                            <tr>
                                                <th>Sr</th>
                                                <th>Date Time</th>
                                                <th>Type</th>
                                                <th>Title</th>  
                                                <th>Place</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($properties as $key => $property)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td><span class="badge badge-info">{{ $property->date_time}}</span></td>
                                                    <td>{{ ucfirst($property->type)}}</td>
                                                    <td>{{ $property->title}}</td>
                                                    <td>{{ $property->place}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No records found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection