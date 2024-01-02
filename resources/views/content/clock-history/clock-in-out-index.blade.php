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
            <button type="button" class="btn btn-success py-4 fs-5" data-bs-toggle="offcanvas" data-bs-target="#clockInCanvas" ><i class='bx bx-play-circle fs-3 me-1'></i>CLOCK-IN</button>
            <button type="button" class="btn btn-warning py-4 fs-5" data-bs-toggle="offcanvas" data-bs-target="#pauseWorkCanvas" ><i class='bx bx-pause-circle fs-3 me-1' ></i>PAUSE WORK</button>
            <button type="button" class="btn btn-danger py-4 fs-5" data-bs-toggle="offcanvas" data-bs-target="#clockOutCanvas" ><i class='bx bx-stop-circle fs-3 me-1' ></i>CLOCK-OUT</button>
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
  <form class="needs-validation" novalidate>
  @csrf
      <div class="offcanvas-header">
          <h5 id="clockInCanvasLabel" class="offcanvas-title">Clock In</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body my-auto mx-0 flex-grow-0">
          <div class="row">
              <div class="col mb-3">
              <label for="name" class="form-label">Worker</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="Alex" disabled required>
              <div class="invalid-feedback">Please fill out the name</div>
              </div>
          </div>
          <div class="row">
              <div class="col mb-3">
              <label for="comment" class="form-label">Comment</label>
              <textarea type="text" id="comment" name="comment" class="form-control" placeholder="comment" rows="3"></textarea>
              </div>
          </div>
      </div>
      <div class="offcanvas-footer text-end mx-4">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="clockOutCanvas" aria-labelledby="clockOutCanvasLabel" data-bs-scroll="true" style="overflow-y: auto">
  <form class="needs-validation" novalidate>
  @csrf
      <div class="offcanvas-header">
          <h5 id="clockOutCanvasLabel" class="offcanvas-title">Clock Out</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body my-auto mx-0 flex-grow-0">
          <div class="row">
              <div class="col mb-3">
              <label for="name" class="form-label">Worker</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="Alex" disabled required>
              <div class="invalid-feedback">Please fill out the name</div>
              </div>
          </div>
          <div class="row">
              <div class="col mb-3">
              <label for="comment" class="form-label">Comment</label>
              <textarea type="text" id="comment" name="comment" class="form-control" placeholder="comment" rows="3"></textarea>
              </div>
          </div>
      </div>
      <div class="offcanvas-footer text-end mx-4">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="pauseWorkCanvas" aria-labelledby="pauseWorkCanvasLabel" data-bs-scroll="true" style="overflow-y: auto">
  <form class="needs-validation" novalidate>
  @csrf
      <div class="offcanvas-header">
          <h5 id="pauseWorkCanvasLabel" class="offcanvas-title">Pause Work</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body my-auto mx-0 flex-grow-0">
          <div class="row">
              <div class="col mb-3">
              <label for="name" class="form-label">Worker</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="Alex" disabled required>
              <div class="invalid-feedback">Please fill out the name</div>
              </div>
          </div>
          <div class="row mb-2">
            <div class="demo-inline-spacing d-flex justify-content-between">
              <button type="button" class="btn btn-icon btn-outline-secondary" style="padding: 35px">
                <span class="tf-icons bx bx-dish" style="font-size: 30px"></span>
              </button>
              <button type="button" class="btn btn-icon btn-outline-secondary" style="padding: 35px">
                <span class="tf-icons bx bx-wind"  style="font-size: 30px"></span>
              </button>
              <button type="button" class="btn btn-icon btn-outline-secondary" style="padding: 35px">
                <span class="tf-icons bx bx-coffee"  style="font-size: 30px"></span>
              </button>
              <button type="button" class="btn btn-icon btn-outline-secondary" style="padding: 35px">
                <span class="tf-icons bx bx-collection"  style="font-size: 30px"></span>
              </button>
            </div>
          </div>
          <div class="row">
              <div class="col mb-3">
              <label for="reason" class="form-label">Break For</label>
              <textarea type="text" id="reason" name="reason" class="form-control" placeholder="reason" rows="3"></textarea>
              </div>
          </div>
      </div>
      <div class="offcanvas-footer text-end mx-4">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>
</div>
@endsection