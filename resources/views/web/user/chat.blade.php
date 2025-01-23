@extends('web.layout.app')
@push('styles')
<style>
    body {
        height: 90vh;
        margin: 0;
    }

    .chat-container {
        overflow: hidden;
        background-color: #f8f9fa;
        /* Light background */
        color: #495057;
        /* Darker text */
        font-family: Arial, sans-serif;
    }

    .sidebar {
        background-color: #ffffff;
        /* White background */
        border-right: 1px solid #dee2e6;
        /* Light border */
        overflow-y: auto;
    }

    .sidebar-header {

        padding: 15px;
        background-color: #e9ecef;
        /* Light gray */
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #dee2e6;
        /* Light border */
    }

    .sidebar-header img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .list-group-item img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .list-group-item {
        background-color: transparent;
        color: #495057;
        /* Darker text */
        border: none;
        padding: 15px;
        transition: background-color 0.3s;
    }

    .list-group-item:hover {
        background-color: #e9ecef;
        /* Light hover effect */
        cursor: pointer;
    }

    .chat-area {
        background-color: #ffffff;
        /* White background */
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .chat-header {
        padding: 15px;
        background-color: #e9ecef;
        /* Light gray */
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #dee2e6;
        /* Light border */
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .chat-header img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .chat-messages {
        flex-grow: 1;
        padding: 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        scroll-behavior: smooth;
    }

    .message {
        margin-bottom: 15px;
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 10px;
        word-wrap: break-word;
    }

    .sent {
        background-color: #0d6efd;
        /* Bootstrap Primary Blue */
        color: #ffffff;
        /* White text */
        align-self: flex-end;
    }

    .received {
        background-color: #e9ecef;
        /* Light gray */
        color: #495057;
        /* Darker text */
        align-self: flex-start;
    }

    .chat-footer {
        padding: 10px;
        background-color: #e9ecef;
        /* Light gray */
        display: flex;
        align-items: center;
        border-top: 1px solid #dee2e6;
        /* Light border */
    }

    .chat-footer input {
        background-color: #ffffff;
        /* White background */
        border: 1px solid #ced4da;
        /* Light border */
        color: #495057;
        /* Darker text */
        border-radius: 20px;
        padding: 10px 15px;
        flex-grow: 1;
        outline: none;
    }

    .chat-footer input::placeholder {
        color: #adb5bd;
        /* Placeholder text */
    }

    .chat-footer button {
        background-color: #0d6efd;
        /* Bootstrap Primary Blue */
        border: none;
        color: #ffffff;
        /* White text */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-left: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chat-footer button:hover {
        background-color: #0b5ed7;
        /* Slightly darker blue */
    }

    .scrollbar-hidden {
        scrollbar-width: none;
        /* For Firefox */
        -ms-overflow-style: none;
        /* For Internet Explorer and Edge */
    }

    .scrollbar-hidden::-webkit-scrollbar {
        display: none;
        /* For Chrome, Safari, and Opera */
    }

    .chat-footer.keyboard-active {
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 10;
    }

    @media (max-width: 768px) {
        body {
            height: 85vh;
        }

        .sidebar {
            display: none;
        }

        .chat-area {
            flex: 1;
        }

        .chat-header .back-button {
            display: inline-block;
            margin-right: 10px;
        }

        .chat-header img {
            margin-left: 0;
        }
    }

    @media (min-width: 769px) {
        .back-button {
            display: none;
        }
    }

</style>
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
