@php
  $isMenu = auth()->user()->role->user_type_id == 1 ? true : false;
  $navbarHideToggle = false;
  $container = 'container-fluid p-0';
  $containerNav = 'container-fluid';
  $isContainerPad = false;
  $overflow = "style=overflow:hidden";
  $navbarFull = true;
  $closeViewBtn = true;
  $date = date('d F Y');
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Clock-IN/OUT')

@section('page-script')
  <script type="module" src="{{ mix('js/modules/clock-in-out.js') }}"></script>
@endsection

@section('content')
<div>
  {{-- <div class="row w-100 m-0 p-2 border-bottom border-secondary">
    <div class="d-flex justify-content-end ">
      <a type="button" class="btn rounded-pill btn-primary" href="{{route('user-dashboard.index')}}">
        <span class="tf-icons bx bx-low-vision me-1"></span>Close view
      </a>
    </div>
  </div> --}}
  <div class="row w-100" style="height: 100vh">
    <div class="col-md-6" style="padding-top: 5%;">
      <div class="d-grid gap-4 p-5">
        <button type="button" class="btn btn-success py-4 fs-5" style="background-color:#168d42" id="clockInCanvasBtn"><i class='bx bx-arrow-to-right fs-3 me-1'></i>CLOCK-IN</button>
        @if($lastHistory && $lastHistory->in_pause && $lastHistory->pause && $lastHistory->pause->first())
         <form action="{{ route('end-pause') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-secondary py-4 fs-5 form-control"><i class='bx bx-pause-circle fs-3 me-1'></i>END PAUSE</button>
            <input type="hidden" id="end_clock_history_id" name="clock_history_id" value="{{ $lastHistory->id }}"/>
            <input type="hidden" id="clock_pause_history_id" name="clock_pause_history_id" value="{{ optional($lastHistory->pause->first())->id }}"/>
          </form>
        @else
          <button type="button" class="btn btn-secondary py-4 fs-5" id="pauseWorkCanvasBtn"><i class='bx bx-pause-circle fs-3 me-1'></i>PAUSE WORK</button>
        @endif
        <button type="button" class="btn btn-danger py-4 fs-5" style="background-color:#cb361c" id="clockOutCanvasBtn"><i class='bx bx-arrow-to-left fs-3 me-1'></i>CLOCK-OUT</button>
      </div>
    </div>
    <div class="col-md-6" style="box-shadow:-6px 0 10px -4px #999">
      <div class="row">
        <div class="d-flex justify-content-start align-items-baseline pt-3 px-3 pb-2">
          <h1 class="me-2">
            <i class='bx bx-time-five fs-4 me-1 text-muted'></i>
            <span id="current-time"></span>
          </h1>
          <h6 class="text-muted p-0">
            <span id="current-date"></span>
          </h6>
        </div>
      </div>
      <dt style="font-size: 12px;font-weight:bold">RECENT OPERATIONS</dt>
      <hr>
      <section class="py-3 px-3" style="overflow-y:scroll; max-height: 420px;">
        <ul class="timeline-with-icons">
          <div class="d-flex justify-content-center mb-5">
            <small class="text-muted mb-2 fw-bold">Today</small>
          </div>
          @foreach($histories as $history)
            @if($history->clock_out && $history->working_time)
              @if($date != date('d F Y', strtotime($history->clock_out)))
                <?php $date = date('d F Y', strtotime($history->clock_out)); ?>
                <div class="d-flex justify-content-center mb-5">
                  <small class="text-muted mb-2 fw-bold">{{ $date }}</small>
                </div>
              @endif
              <li class="timeline-item mb-5">
                <span class="timeline-icon">
                  <i class='bx bx-arrow-to-left text-danger'></i>
                </span>
                <div class="shadow-sm p-2">
                  <div class="d-grid gap-1">
                    <small class="fw-bold">{{ Carbon\Carbon::parse($history->clock_out)->tz('Asia/Kolkata')->format('H:i:s Y-m-d') }}</small>
                    <small class="fw-bold">
                      <i class='bx bx-user me-1'></i>{{ $history->user->name}}
                      @if($history->clock_out_comment)
                        <i class='bx bx-comment ms-1' data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $history->clock_out_comment }}"></i>
                      @endif
                    </small>
                     <?php
                     list($hours, $minutes, $seconds) = explode(':', $history->working_time);
                     $wt = sprintf('%dh %02dm %02ds', $hours, $minutes, $seconds);
                     ?>
                    <small>Working time (WT): <span class="fw-bold">{{ $wt}}</span></small>
                  </div>
                </div>
              </li>
            @endif
            @foreach($history->pause as $pause)
              @if($pause->pause_stop && $pause->pause_time)
                @if($date != date('d F Y', strtotime($pause->pause_stop)))
                  <?php $date = date('d F Y', strtotime($pause->pause_stop)); ?>
                  <div class="d-flex justify-content-center mb-5">
                    <small class="text-muted mb-2 fw-bold">{{ $date }}</small>
                  </div>
                @endif
                <li class="timeline-item mb-5">
                  <span class="timeline-icon">
                    <i class='bx bx-pause-circle text-warning'></i>
                  </span>
                  <div class="shadow-sm p-2">
                    <div class="d-grid gap-1">
                      <small class="fw-bold">{{ Carbon\Carbon::parse($pause->pause_stop)->tz('Asia/Kolkata')->format('H:i:s Y-m-d') }}</small>
                      <small class="fw-bold"><i class='bx bx-user me-1'></i>{{ $history->user->name }}</small>
                      <small class="fw-bold">
                        <span class="text-danger">Pause :</span> {{ $pause->reason }}
                      </small>
                      <?php
                      list($hours, $minutes, $seconds) = explode(':', $pause->pause_time);
                      $pt = sprintf('%dh %02dm %02ds', $hours, $minutes, $seconds);
                      ?>
                      <small>Pause time: <span class="fw-bold">{{ $pt }}</span></small>
                    </div>
                  </div>
                </li>
              @endif
              @if($pause->pause_start)
               @if($date != date('d F Y', strtotime($pause->pause_start)))
                  <?php $date = date('d F Y', strtotime($pause->pause_start)); ?>
                  <div class="d-flex justify-content-center mb-5">
                    <small class="text-muted mb-2 fw-bold">{{ $date }}</small>
                  </div>
                @endif
                <li class="timeline-item mb-5">
                  <span class="timeline-icon">
                    <i class='bx bx-pause-circle text-secondary'></i>
                  </span>
                  <div class="shadow-sm p-2">
                    <div class="d-grid gap-1">
                      <small class="fw-bold">{{ Carbon\Carbon::parse($pause->pause_start)->tz('Asia/Kolkata')->format('H:i:s Y-m-d') }}</small>
                      <small class="fw-bold"><i class='bx bx-user me-1'></i>{{ $history->user->name }}</small>
                      <small class="fw-bold">
                        <span class="text-success">Pause :</span> {{ $pause->reason }}
                      </small>
                    </div>
                  </div>
                </li>
              @endif
            @endforeach
            @if($history->clock_in)
              @if($date != date('d F Y', strtotime($history->clock_in)))
                <?php $date = date('d F Y', strtotime($history->clock_in)); ?>
                <div class="d-flex justify-content-center mb-5">
                  <small class="text-muted mb-2 fw-bold">{{ $date }}</small>
                </div>
              @endif
              <li class="timeline-item mb-5">
                <span class="timeline-icon">
                  <i class='bx bx-arrow-to-right' style="color:#168d42"></i>
                </span>
                <div class="shadow-sm p-2">
                  <div class="d-grid gap-1">
                    <small class="fw-bold">{{ Carbon\Carbon::parse($history->clock_in)->tz('Asia/Kolkata')->format('H:i:s Y-m-d') }}</small>
                    <small class="fw-bold"><i class='bx bx-user me-1'></i>{{ $history->user->name }}
                    @if($history->clock_in_comment)
                      <i class='bx bx-comment ms-1' data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $history->clock_in_comment }}"></i>
                    @endif
                  </small>
                  </div>
                </div>
              </li>
            @endif
          @endforeach
        </ul>
      </section>
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

@endsection