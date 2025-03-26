<div>
    <section class="content">
        <div class="container-fluid">
            <div class="card elevation-0">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-headset"></i> Chats users</h3>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-2">
                                <label class="text-sm mb-0">Per page</label>
                                <select wire:model.live="paginate" class="form-control" style="width: 4rem">
                                    <option value="10" {{ $paginate == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ $paginate == 20 ? 'selected' : '' }}>20</option>
                                    <option value="30" {{ $paginate == 30 ? 'selected' : '' }}>30</option>
                                </select>
                            </div>
                            @if (count($checkedData))
                                <div class="btn-group">
                                    <button class="btn btn-default" type="button">
                                        Bulk Actions ({{ count($checkedData) }})
                                    </button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-toggle="modal" href="#modal-delete-bulk">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="text-sm mb-0">Search</label>
                            <div class="">
                                <input type="text" class="form-control" wire:model.live="search" placeholder="search by username ,phone">
                            </div>                              
                            <div class="input-group d-flex">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-borderless">
                                <tr>
                                    @can('chat.bulk-view')
                                    <th></th>
                                    @endcan
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Username</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($chats as $key => $chat)
                                    <tr class="{{ in_array($chat->id , $checkedData) ? 'bg-light' : '' }}">
                                        @can('chat.bulk-view')
                                        <td>
                                            <input type="checkbox" value="{{ $chat->id }}" wire:model.live="checkedData" wire:key="checkbox-{{ $chat->id }}">
                                        </td>
                                        @endcan
                                        <td wire:key="{{ $chat->id }}">{{ $chat->id }}</td>
                                        <td>
                                            <img src="{{$chat->member?->profile_url}}" alt=""
                                                class="rounded"
                                                style="width:25px; height:25px; object-fit:cover;">
                                        </td>
                                        <td>{{$chat->member?->first_name}} {{$chat->member?->last_name}}</td>
                                        <td>{{$chat->message}}</td>
                                        <td>
                                            @if($chat->read_at == null)
                                                <span class="badge badge-danger">Unread</span>
                                            @else 
                                                <span class="badge badge-success">Read</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.member.chat.details', $chat)}}"
                                                class="btn btn-outline-success btn-xs"><i class="fas fa-info-circle"></i> View Conversation</a>

                                            {{-- <button type="button" data-target="#modal-{{ $chat->id }}"
                                                data-toggle="modal" class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button> --}}
                                            {{-- <div id="modal-{{ $chat->id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Record</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Do you really wish to delete this record?</p>
                                                            <p style="color: red">Please note that this will permanently
                                                                delete the record.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('admin.customer.service.delete' ,$chat)}}"
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
                                            </div> --}}
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
                    {!! $chats->links() !!}
                </div>
                <div id="modal-delete-bulk" class="modal">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete {{ count($checkedData) }} Product</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Do you really wish to delete selected chat?</p>
                                <p style="color: red">Please note that this will permanently delete the chat.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-default"
                                    data-dismiss="modal">No</button>
                                <button type="button" wire:click="bulkDelete"
                                    class="btn btn-sm btn-danger">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>