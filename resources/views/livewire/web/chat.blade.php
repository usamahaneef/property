<div>
    <section class="content py-2" style="height:4px:">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-4">
                    <div class="card elevation-0 mt-3">
                        <div class="card-body">
                            <div class="card-info direct-chat direct-chat-primary" wire:poll.5000ms="fetchChats">
                                <div class="card-header">
                                    <h3 class="card-title">Chat Services</h3>
                                </div>
                                <div class="card-body">
                                    <div class="direct-chat-messages">
                                        @forelse ($chats as $chat)
                                            @if ($chat->admin_id != null)
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-right">{{ $chat->admin?->name }}</span> <br>
                                                    <span class="direct-chat-timestamp float-left">{{ $chat->created_at?->format('h:i A') ?? '' }}</span>
                                                </div>
                                                <img class="direct-chat-img" src="{{ $chat->admin?->avatar_url }}" alt="message user image">
                                                <div class="direct-chat-text">
                                                    {{ $chat->message ?? '' }}
                                                    <div>
                                                        @if($chat->attachment) 
                                                            <img src="{{ $chat->attachment_url }}" width="300" height="300">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            @else
                                                <div class="direct-chat-msg right">
                                                    <div class="direct-chat-infos clearfix">
                                                        <span class="direct-chat-name float-right">{{ $chat->member?->first_name }}</span> <br>
                                                        <span class="direct-chat-timestamp float-left">{{ $chat->created_at?->format('h:i A') ?? '' }}</span>
                                                    </div>
                                                    <img class="direct-chat-img" src="{{ $chat->member?->profile_url }}" alt="message user image">
                                                    <div class="direct-chat-text">
                                                        {{ $chat->message ?? '' }}
                                                        <div>
                                                            @if($chat->attachment) <img src="{{ $chat->attachment_url }}" width="300" height="300">@endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @empty
                                            <div>No record found</div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <form wire:submit.prevent="sendMessage" enctype="multipart/form-data">
                                        <div wire:loading wire:target='sendMessage'>Sending message . . .</div>
                                        <div wire:loading wire:target="file">Uploading file . . .</div>
                                        <div class="input-group">
                                            <input wire:model="message" type="text" name="message" @if(!$file) required @endif placeholder="Type Message ..." class="form-control" id="messageInput">
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
    </section>
</div>
