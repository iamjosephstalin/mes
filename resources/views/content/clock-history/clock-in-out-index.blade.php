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
      <div class="d-grid gap-3  mx-3 my-5">
        <button type="button" class="btn btn-success py-4 fs-5" id="clockInCanvasBtn"><i class='bx bx-play-circle fs-3 me-1'></i>CLOCK-IN</button>
        <button type="button" class="btn btn-secondary py-4 fs-5" id="pauseWorkCanvasBtn"><i class='bx bx-pause-circle fs-3 me-1'></i>PAUSE WORK</button>
        <button type="button" class="btn btn-danger py-4 fs-5" id="clockOutCanvasBtn"><i class='bx bx-stop-circle fs-3 me-1'></i>CLOCK-OUT</button>
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

<div class="offcanvas offcanvas-end" tabindex="-1" id="clockInCanvas" aria-labelledby="clockInCanvasLabel" data-bs-scroll="true" style="overflow-y: auto">
  <form action="{{ route('clock-history.store') }}" method="post">
    @csrf
    <div class="offcanvas-header">
      <h5 id="clockInCanvasLabel" class="offcanvas-title">Clock in</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <div class="row">
        <div class="col mb-3">
          <label for="in_name" class="form-label">Worker</label>
          <input type="text" id="in_name" class="form-control" value="{{auth()->user()->name}}" disabled>
          <input type="hidden" id="in_user_id" name="user_id" value="{{auth()->user()->id}}"/>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label for="clock_in_comment" class="form-label">Comment</label>
          <textarea type="text" id="clock_in_comment" name="clock_in_comment" class="form-control" placeholder="Comment" rows="3"></textarea>
        </div>
      </div>
    </div>
    <div class="offcanvas-footer text-end mx-4 mb-3">
      <button type="submit" class="btn btn-success">CLOCK IN</button>
    </div>
  </form>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="clockOutCanvas" aria-labelledby="clockOutCanvasLabel" data-bs-scroll="true" style="overflow-y: auto">
  <form id="clock-out-edit-form" action="{{ route('clock-history.update', '') }}" method="post">
    @csrf
    @method('PUT')
    <div class="offcanvas-header">
      <h5 id="clockOutCanvasLabel" class="offcanvas-title">Clock out</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <div class="row">
        <div class="col mb-3">
          <label for="out_name" class="form-label">Worker</label>
          <input type="text" id="out_name" class="form-control" value="{{auth()->user()->name}}" disabled>
          <input type="hidden" id="out_user_id" name="user_id" value="{{auth()->user()->id}}"/>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label for="clock_out_comment" class="form-label">Comment</label>
          <textarea type="text" id="clock_out_comment" name="clock_out_comment" class="form-control" placeholder="Comment" rows="3"></textarea>
        </div>
      </div>
    </div>
    <div class="offcanvas-footer text-end mx-4 mb-3">
      <button type="submit" class="btn btn-danger">CLOCK OUT</button>
    </div>
    <input type="hidden" id="id" name="id" value=""/>
  </form>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="pauseWorkStartCanvas" aria-labelledby="pauseWorkStartCanvasLabel" data-bs-scroll="true" style="overflow-y: auto">
  <form class="needs-validation" action="{{ route('start-pause') }}" method="post" novalidate>
    @csrf
    <div class="offcanvas-header">
      <h5 id="pauseWorkCanvasLabel" class="offcanvas-title">Pause work</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <div class="row">
        <div class="col mb-3">
          <label for="pause_start_name" class="form-label">Worker</label>
          <input type="text" id="pause_start_name" class="form-control" value="{{auth()->user()->name}}" disabled>
          <input type="hidden" id="pause_start_user_id" name="user_id" value="{{auth()->user()->id}}"/>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label class="form-label">Reason for break</label>
          <div class="demo-inline-spacing d-flex justify-content-between">
            <input type="radio" id="meal" name="reason_option" class="btn-check" value="Meal">
            <label class="btn btn-icon btn-outline-secondary" for="meal" style="padding: 35px">
              <span class="tf-icons bx bx-dish" style="font-size: 30px"></span>
            </label>
            <input type="radio" id="cleaning" name="reason_option" class="btn-check" value="Cleaning">
            <label class="btn btn-icon btn-outline-secondary" for="cleaning" style="padding: 35px">
              <span class="tf-icons bx bx-coffee" style="font-size: 30px"></span>
            </label>
            <input type="radio" id="smoking" name="reason_option" class="btn-check" value="Smoking">
            <label class="btn btn-icon btn-outline-secondary" for="smoking" style="padding: 35px">
              <span class="tf-icons bx bx-wind" style="font-size: 30px"></span>
            </label>
            <input type="radio" id="inventory" name="reason_option" class="btn-check" value="Inventory">
            <label class="btn btn-icon btn-outline-secondary" for="inventory" style="padding: 35px">
              <span class="tf-icons bx bx-collection" style="font-size: 30px"></span>
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <textarea type="text" id="reason" name="reason" class="form-control" placeholder="Reason for break" rows="3" required></textarea>
          <div class="invalid-feedback">Please choose/write the pause reason</div>
        </div>
      </div>
    </div>
    <div class="offcanvas-footer text-end mx-4 mb-3">
      <button type="submit" class="btn btn-success">START PAUSE</button>
    </div>
    <input type="hidden" id="start_clock_history_id" name="clock_history_id" value=""/>
  </form>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="pauseWorkEndCanvas" aria-labelledby="pauseWorkEndCanvasLabel" data-bs-scroll="true">
  <form action="{{ route('end-pause') }}" method="post">
    @csrf
    <div class="offcanvas-header">
      <h5 id="pauseWorkCanvasLabel" class="offcanvas-title">Pause work</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <div class="row">
        <div class="col mb-3">
          <label for="pause_end_name" class="form-label">Worker</label>
          <input type="text" id="pause_end_name" class="form-control" value="{{auth()->user()->name}}" disabled>
          <input type="hidden" id="pause_end_user_id" name="user_id" value="{{auth()->user()->id}}"/>
        </div>
      </div>
    </div>
    <div class="offcanvas-footer text-end mx-4 mb-3">
      <button type="submit" class="btn btn-success">END PAUSE</button>
    </div>
    <input type="hidden" id="end_clock_history_id" name="clock_history_id" value=""/>
    <input type="hidden" id="clock_pause_history_id" name="clock_pause_history_id" value=""/>
  </form>
</div>

@endsection