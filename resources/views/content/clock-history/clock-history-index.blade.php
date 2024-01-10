@extends('layouts/contentNavbarLayout')

@section('title', 'Clock-in/Clock-out History')

@section('page-script')
<script>
  var users = @json($users);
</script>
<script type="module" src="{{ mix('js/modules/clock-history.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Clock-in/Clock-out History</span>
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
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($histories as $history)
          <tr>
            <td>{{ $history->user->name }}</td>
            <td>{{ Carbon\Carbon::parse($history->clock_in)->tz('Asia/Kolkata') }}</td>
            <td>{{ Carbon\Carbon::parse($history->clock_out)->tz('Asia/Kolkata') }}</td>
            <td>{{ $history->working_time }}</td>
            <td>{{ $history->pause_time }}</td>
            <td>{{ $history->number_of_pauses }}</td>
            <td>{{ $history->clock_in_comment }}</td>
            <td>
              <form action="{{ route('clock-history.destroy', $history->id) }}" method="post">
                @csrf
                @method('DELETE')
                <a type="button" class="btn btn-sm btn-icon item-edit history-edit" data-id="{{ $history->id }}"><i class="bx bxs-edit"></i></a>
                <a type="submit" class="btn btn-sm btn-icon item-delete history-delete"><i class="bx bxs-trash"></i></a>
              </form>
            </td>
          </tr>
        @endforeach
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
      <form class="needs-validation" action="{{ route('clock-history.store') }}" method="post" novalidate>
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add Clock-in/Clock-out</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label" for="user_id">Worker</label>
              <select id="user_id" name="user_id" class="form-select" required>
                <option value="" selected>Select worker</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">Please select the worker</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="clock_in" class="form-label">Clock-in</label>
              <input type="datetime-local" step="1" id="clock_in" name="clock_in" class="form-control" placeholder="Clock-in" required>
              <div class="invalid-feedback">Please select the clock-in time</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="clock_out" class="form-label">Clock-out</label>
              <input type="datetime-local" step="1" id="clock_out" name="clock_out" class="form-control" placeholder="Clock-out" required>
              <div class="invalid-feedback">Please select the clock-out time</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="clock_in_comment" class="form-label">Comment</label>
              <textarea type="text" id="clock_in_comment" name="clock_in_comment" class="form-control" placeholder="Comment" rows="3"></textarea>
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

<!-- Edit Modal -->
<div class="modal fade" id="clock-history-edit-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" id="clock-history-edit-form" action="{{ route('clock-history.update', '') }}" method="post" novalidate>
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Clock-in/Clock-out</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label" for="edit_user_id">Worker</label>
              <select id="edit_user_id" name="user_id" class="form-select" required>
                <option value="" selected>Select worker</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">Please select the worker</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="edit_clock_in" class="form-label">Clock-in</label>
              <input type="datetime-local" step="1" id="edit_clock_in" name="clock_in" class="form-control" placeholder="Clock-in" required>
              <div class="invalid-feedback">Please select the clock-in time</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="edit_clock_out" class="form-label">Clock-out</label>
              <input type="datetime-local" step="1" id="edit_clock_out" name="clock_out" class="form-control" placeholder="Clock-out" required>
              <div class="invalid-feedback">Please select the clock-out time</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="edit_clock_in_comment" class="form-label">Comment</label>
              <textarea type="text" id="edit_clock_in_comment" name="clock_in_comment" class="form-control" placeholder="Comment" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <input type="hidden" id="id" name="id" value=""/>
      </form>
    </div>
  </div>
</div>

@endsection