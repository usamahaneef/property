<div>
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-12 col-sm-6 col-md-3 mt-2">
                <a href="">
                    <div class="info-box">
                        <span class="info-box-icon bg-gradient-success elevation-1">
                            <i class="fas fa-file-invoice"></i>
                        </span>
                        <div class="info-box-content text-dark">
                            <span class="info-box-text">Total Diagnoses Amount</span>
                            <span class="info-box-number">{{$total_diagnoses_sales ?? ''}}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}

        <div class="card elevation-0">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-building"></i> Properties</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.property.create')}}" class="btn btn-sm btn-info"><i class="fas fa-plus-circle"></i> Create Property</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input wire:model="start_date" type="date" id="start_date" name="start_date" class="form-control" placeholder="Enter ">
                                @error('start_date')
                                    <span class="text-danger text-sm pull-right">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group px-2">
                                <label for="end_date">End Date</label>
                                <input wire:model="end_date" type="date" id="end_date" name="end_date" class="form-control" placeholder="Enter ">
                                @error('end_date')
                                    <span class="text-danger text-sm pull-right">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="">Search</label> <br>
                                <button wire:click="applyDateFilter" class="btn btn-outline-info"> <i class="fas fa-search"></i></button>
                            </div>
                        </div>                               
                    </div>
                    <div class="col-md-4 offset-md-2 float-right">
                        <div class="form-group">
                            <label for="search">Search</label>
                            <input type="text" class="form-control" wire:model.live="search" placeholder="search by type , title , place">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button wire:click="clearFilters()" class="btn btn-xs btn-primary float-right">Clear Filter</button>
                </div>
            </div>
            {{-- <div class="card-header">
                <div class="col-md-4 float-right">
                    <div class="form-group">
                        <label for="search">Search</label>
                        <input type="text" class="form-control" wire:model.live="search" placeholder="search by name , marfat name ,contact ">
                    </div>
                </div>
            </div> --}}
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-borderless">
                            <tr>
                                <th>Sr</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Title</th>  
                                <th>Place</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($properties as $key => $property)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><span class="badge badge-info">{{ $property->date_time}}</span></td>
                                    <td>{{ $property->type}}</td>
                                    <td>{{ $property->title}}</td>
                                    <td>{{ $property->place}}</td>
                                    <td>
                                        @can('properties.detail')
                                        <a href="{{ route('admin.property.details', $property) }}" class="btn btn-outline-info btn-xs">
                                            <i class="fas fa-receipt"></i> Details
                                        </a>
                                        @endcan

                                        @can('properties.edit')
                                        <a href="{{ route('admin.property.edit', $property) }}" class="btn btn-primary btn-xs">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        @endcan
                                        
                                        @can('properties.delete')
                                        <button type="button" data-target="#modal-del{{ $property->id }}"
                                            data-toggle="modal" class="btn btn-xs btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endcan
                                        
                                        <div id="modal-del{{ $property->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Property</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Do you really wish to delete this Property? This will delete permanently !</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{route('admin.property.delete' , $property)}}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-sm btn-default"
                                                                data-dismiss="modal">No</button>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Yes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <a href="{{ route('admin.property.detail', $property) }}" class="btn btn-info btn-xs">
                                            <i class="fas fa-info-circle"></i> Details
                                        </a> --}}
                                    </td>
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
            <div class="card-footer">
                {!! $properties->links() !!}
            </div>
        </div>
    </div>
</div>
