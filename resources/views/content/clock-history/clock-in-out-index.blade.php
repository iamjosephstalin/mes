@extends('layouts/contentNavbarLayout')

@section('title', 'Clock-IN/OUT')

@section('page-script')
<script type="module" src="{{ mix('js/modules/clock-in-out.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Clock-IN/OUT</span>
</h4>
<div class="card">
  <div class="row">
    <div class="col-md-6 ">
      <div class="d-grid gap-3 mx-3 my-5">
        <button type="button" class="btn btn-success py-4 fs-5"><i class='bx bx-play-circle fs-3 me-1'></i>CLOCK-IN</button>
        <button type="button" class="btn btn-secondary py-4 fs-5"><i class='bx bx-pause-circle fs-3 me-1'></i>PAUSE WORK</button>
        <button type="button" class="btn btn-danger py-4 fs-5"><i class='bx bx-stop-circle fs-3 me-1'></i>CLOCK-OUT</button>
      </div>
    </div>
    <div class="col-md-6" style="box-shadow:-6px 0 10px -4px #999; ">
      <div class="row">
        <div class="d-flex justify-content-start align-items-baseline"><h1 class="card-header"><i class='bx bx-time-five fs-4 me-1'></i><span id="current-time"></span></h1><h6 class="text-muted p-0"><span id="current-date"></span></h6></div>
      </div>
      <hr class="m-0">
        <h6 class="card-header">Recent Operations</h6>
      <hr class="m-0">
    </div>
  </div>
</div>

@if ($errors->any() || session('success'))
  <div class="bs-toast toast toast-placement-ex m-2 fade top-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="bx bx-bell me-2 {{ $errors->any() ? 'text-danger':''}}"></i>
      <div class="me-auto fw-medium {{ $errors->any() ? 'text-danger':'' }}">{{ $errors->any() ? "Error" : "Alert" }}</div>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <span class="text-danger">{{ $error }}</span>
        @endforeach 
      @else
        {{ session('success') }}
      @endif
    </div>
  </div>
@endif
@endsection