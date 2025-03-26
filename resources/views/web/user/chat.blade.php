@extends('web.layout.app')
@push('styles')
    <style>
        input[type="file"] {
            display: none;
        }
    
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        .direct-chat-messages {
        max-height: 500px; /* Adjust as needed */
        overflow-y: auto;
        padding: 15px;
        background-color: #f5f5f5;
        border-radius: 8px;
    }
    
    /* General Message Box */
    .direct-chat-msg {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .direct-chat-msg.right {
        flex-direction: row-reverse;
    }
    
    /* Chat Image */
    .direct-chat-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }
    
    .direct-chat-msg.right .direct-chat-img {
        margin-left: 10px;
        margin-right: 0;
    }
    
    /* Chat Message Text */
    .direct-chat-text {
        max-width: 60%;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.4;
        position: relative;
        word-wrap: break-word;
    }
    
    /* Admin Message */
    .direct-chat-msg .direct-chat-text {
        background-color: #fff;
        color: #333;
        border: 1px solid #ddd;
    }
    
    /* User Message */
    .direct-chat-msg.right .direct-chat-text {
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
    }
    
    /* Timestamps & Names */
    .direct-chat-infos {
        font-size: 12px;
        color: #666;
    }
    
    .direct-chat-name {
        font-weight: bold;
    }
    
    .direct-chat-timestamp {
        font-size: 12px;
        opacity: 0.8;
    }
    
    /* Message Bubble Styling */
    .direct-chat-text {
        position: relative;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.4;
        max-width: 60%;
        word-wrap: break-word;
    }

    /* Left (Admin) Message Bubble Tail */
    .direct-chat-msg .direct-chat-text::before {
        content: "";
        position: absolute;
        top: 10px;
        left: -7px;
        width: 12px;
        height: 12px;
        background: inherit;
        transform: rotate(45deg);
        border-left: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }
    /* Right (User) Message Bubble Tail on Left Side */
    .direct-chat-msg.right .direct-chat-text::before {
        content: "";
        position: absolute;
        top: 10px;
        left: -7px;
        width: 12px;
        height: 12px;
        background: inherit;
        transform: rotate(45deg);
        border-left: 1px solid #007bff;
        border-bottom: 1px solid #007bff;
    }


    
    /* Attachment Image */
    .direct-chat-text img {
        max-width: 100%;
        border-radius: 5px;
        margin-top: 5px;
    }
    </style>
    
@endpush
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <livewire:web.chat />
        </section>
    </div>
@endsection

