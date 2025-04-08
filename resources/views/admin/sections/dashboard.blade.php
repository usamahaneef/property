@extends('admin.layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid pt-3">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                          <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-user-tag"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Members</span>
                            <span class="info-box-number">{{$members->count() ?? ''}}</span>
                          </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1">
                          <i class="fas fa-building"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Properties</span>
                          <span class="info-box-number">{{$properties->count() ?? ''}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1">
                          <i class="fas fa-question-circle"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Support</span>
                          <span class="info-box-number">{{$supports->count() ?? ''}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1">
                          <i class="fas fa-headset"></i>
                        </span>
                        <div class="info-box-content">
                          <span class="info-box-text">Chats</span>
                          <span class="info-box-number">{{$chats->count() ?? ''}}</span>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
