<div>
    <div class="container-fluid">
        <div class="card elevation-0 mt-3">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="nav-icon fas fa-headset"></i> Customer Service
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-info direct-chat direct-chat-info">
                            <div class="card-header">
                                <h3 class="card-title">Direct Chat</h3>
                            </div>
                            <div class="card-body">
                                <div class="direct-chat-messages" wire:poll.5000ms="fetchChats">
                                    @forelse ($chats as $chat)
                                        @if ($chat->admin_id != null)
                                            <div class="direct-chat-msg left">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-left">{{ $chat->admin?->name }}</span>
                                                    <span class="direct-chat-timestamp float-right">{{ $chat->created_at->format('H:i') }}</span>
                                                </div>
                                                <img class="direct-chat-img" src="{{ asset('admin/img/avatar.png') }}" alt="message user image">
                                                <div class="direct-chat-text">
                                                    {{ $chat->message ?? '' }}
                                                    @if($chat->attachment_url)
                                                        <div>
                                                            <img src="{{ $chat->attachment_url }}" width="300" height="300" alt="attachment">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="direct-chat-msg right">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-right">{{ $chat->member?->first_name }}</span>
                                                    <span class="direct-chat-timestamp float-left">{{ $chat->created_at->format('H:i') }}</span>
                                                </div>
                                                <img class="direct-chat-img" src="{{ $chat->member?->profile_url }}" alt="message user image">
                                                <div class="direct-chat-text">
                                                    {{ $chat->message ?? '' }}
                                                    @if($chat->attachment_url)
                                                        <div>
                                                            <img src="{{ $chat->attachment_url }}" width="300" height="300" alt="attachment">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <div class="">
                                            No records found
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="card-footer">
                                <form wire:submit.prevent="SendMessage" enctype="multipart/form-data">
                                    <div wire:loading wire:target="SendMessage">
                                        Sending message . . . 
                                    </div>
                                    <div wire:loading wire:target="file">
                                        Uploading file . . .
                                    </div>
                                    <div class="input-group">
                                        <input wire:model="message" type="text" name="message" placeholder="Type Message ..." class="form-control" id="messageInput">
                                        {{-- @if(empty($file))
                                            <label for="file-upload" class="custom-file-upload mb-0">
                                                    <span class="btn add-file border"><i class="fas fa-paperclip"></i></span>
                                            </label>
                                            <input id="file-upload" type="file" wire:model="file" hidden name="attachment" />
                                        @endif --}}
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary" id="submitButton"><i class="fas fa-paper-plane"></i></button>
                                        </span>
                                    </div>
                                    @if($file)
                                        <div class="mt-1 float-right">
                                            <button type="button" wire:click="resetFile" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove {{ $file->getClientOriginalName() }}</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
