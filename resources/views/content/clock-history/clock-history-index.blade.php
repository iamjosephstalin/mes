@extends('layouts/contentNavbarLayout')

@section('title', 'Clock-in/Clock-out history')

@section('page-script')
<script type="module" src="{{ mix('js/modules/clock-history.js') }}"></script>
@endsection


@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Clock-in/Clock-out history</span>
</h4>
<div class="card" id="clock-history-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-clock-history">
      <thead>
        <tr>
          <th>Worker</th>
          <th>Clock-in</th>
          <th>Clock-out</th>
          <th>Working time [h:m:s]</th>
          <th>Pause time [h:m:s]</th>
          <th>Number of pauses</th>
          <th>Comment</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
          <tr>
            <td>Asia Kasprzyk</td>
            <td>2023-12-27 04:25:22</td>
            <td>2023-12-28 16:35:44</td>
            <td>36:10:22</td>
            <td>36:09:49</td>
            <td>3</td>
            <td>No comments yet</td>
          </tr>
      </tbody>
    </table>
  </div>
</div>

@if ($errors->any() || session('success'))
<div class="bs-toast toast toast-placement-ex m-2 fade top-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <i class='bx bx-bell me-2 {{$errors->any() ? "text-danger":""}}'></i>
    <div class="me-auto fw-medium {{$errors->any() ? "text-danger":""}}">{{$errors->any() ?"Error":"Alert" }}</div>
    {{-- <small>11 mins ago</small> --}}
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
      <span class="text-danger">{{ $error }}</span>
      @endforeach 
    @else
     {{ session('success')  }}
    @endif
  </div>
</div>
@endif

<!-- Add Modal -->
<div class="modal fade" id="clock-history-create-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" action="{{ route('currencies.store') }}" method="post"  novalidate>
        @csrf
        
        <div class="modal-header">
          <h5 class="modal-title">Add Clock-IN/OUT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                <div class="row">
                    <label class="col-sm-12 col-form-label" for="worker">Worker</label>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="worker" name="worker" class="form-select" required>
                            <option value="0">Guru</option>
                            <option value="1">Shaju</option>
                        </select>
                        <div class="invalid-feedback">Please select the worker name</div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="clock_in" class="form-label">Clock-in</label>
                <input type="datetime-local" id="clock_in" name="clock_in" class="form-control" placeholder="Clock-in">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="clock_out" class="form-label">Clock-out</label>
                <input type="datetime-local" id="clock_out" name="clock_out" class="form-control" placeholder="Clock-out">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea type="text" id="comment" name="comment" class="form-control" placeholder="comment" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="clock-history-edit-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" id="clock-history-edit-form" action="{{ route('currencies.update', '') }}" method="post"  novalidate>
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Clock-IN/OUT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                <div class="row">
                    <label class="col-sm-12 col-form-label" for="worker_edit">Worker</label>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="worker_edit" name="worker" class="form-select" required>
                            <option value="0">Guru</option>
                            <option value="1">Shaju</option>
                        </select>
                        <div class="invalid-feedback">Please select the worker name</div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="clock_in_edit" class="form-label">Clock-in</label>
                <input type="datetime-local" id="clock_in_edit" name="clock_in" class="form-control" placeholder="Clock-in">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="clock_out_edit" class="form-label">Clock-out</label>
                <input type="datetime-local" id="clock_out_edit" name="clock_out" class="form-control" placeholder="Clock-out">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="comment_edit" class="form-label">Comment</label>
                <textarea type="text" id="comment_edit" name="comment" class="form-control" placeholder="comment" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        <input type="hidden" id="id" name="id" value=""/>
      </form>
      </div>
    </div>
  </div>
</div>

@endsection