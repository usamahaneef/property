@extends('admin.layout.app')
@push('style')
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
    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <livewire:admin.message :chat="$chat"/>
        </section>
    </div>
@endsection