@extends('web.layout.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('web/css/chat.css') }}">
@endpush
@section('content')
<div class="container-fluid h-100 chat-container">
    <div class="row h-100">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            {{-- <div class="sidebar-header">
                <img src="{{ asset('web/img/user.png') }}" alt="Profile">
            <button class="btn btn-sm text-white"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        </div> --}}
        <div class="list-group scrollbar-hidden">
            <a href="#" class="list-group-item border-bottom">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('web/img/user.png') }}" alt="Contact" class="me-3">
                    <div>
                        <h6 class="mb-0">Contact 1</h6>
                        <small>Last message...</small>
                    </div>
                </div>
            </a>
            <a href="#" class="list-group-item border-bottom">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('web/img/user.png') }}" alt="Contact" class="me-3">
                    <div>
                        <h6 class="mb-0">Contact 2</h6>
                        <small>Last message...</small>
                    </div>
                </div>
            </a>
            <a href="#" class="list-group-item border-bottom">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('web/img/user.png') }}" alt="Contact" class="me-3">
                    <div>
                        <h6 class="mb-0">Contact 3</h6>
                        <small>Last message...</small>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Chat Area -->
    <div class="col-md-9 chat-area d-flex flex-column">
        <!-- Chat Header -->
        <div class="chat-header">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm  back-button"><i class="fas fa-arrow-left"></i></button>
                <img src="{{ asset('web/img/user.png') }}" alt="Contact">
                <h6 class="mb-0">Contact Name</h6>
            </div>
            {{-- <button class="btn btn-sm text-white"><i class="fa-solid fa-ellipsis-vertical"></i></button> --}}
        </div>

        <!-- Chat Messages -->
        <div class="chat-messages d-flex flex-column scrollbar-hidden">
            <div class="message received">Hi! How are you?</div>
            <div class="message sent">I'm good, thanks!</div>
            <div class="message received">What are you up to?</div>
        </div>

        <!-- Chat Footer -->
        <div class="chat-footer">
            <input type="text" autocomplete="off" id="messageInput" placeholder="Type a message">
            <button id="sendMessage">➤</button>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        const chatMessages = $('.chat-messages');
        const chatFooter = $('.chat-footer');

        function scrollToBottom() {
            chatMessages.scrollTop(chatMessages[0].scrollHeight);
        }

        $('#sendMessage').click(function(event) {
            event.preventDefault();
            const messageInput = $('#messageInput');
            const message = messageInput.val().trim();

            if (message) {
                chatMessages.append(`<div class="message sent">${message}</div>`);
                messageInput.val(''); // Clear input

                // Refocus input to prevent keyboard from closing
                setTimeout(() => messageInput.focus(), 0);

                scrollToBottom();
            }
        });


        $('#messageInput').keypress(function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#sendMessage').click();
            }
        });



        // Sidebar toggle for mobile
        $('.back-button, .list-group-item').click(function() {
            if (window.innerWidth < 768) {
                $('.sidebar').toggle();
                $('.chat-area').toggleClass('d-none');
                scrollToBottom();
            }
        });

        // Initial scroll to bottom
        scrollToBottom();
    });

</script>

@endpush
