@php
  $clockHistoryBtn = true;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Clock Pause History')

@section('page-script')
<script>
  var users = @json($users);
</script>
<script type="module" src="{{ mix('js/modules/clock-pause-history.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Clock Pause History</span>
</h4>
<div class="card" id="clock-pause-history-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-clock-pause-history">
      <thead>
        <tr>
          <th>Worker</th>
          <th>Pause start</th>
          <th>Pause stop</th>
          <th>Pause time [h:m:s]</th>
          <th>Reason</th>
          <th>Comments</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($pauses as $pause)
          <tr>
            <td>{{ $pause->clockHistory->user->name }}</td>
            <td>{{ $pause->pause_start }}</td>
            <td>{{ $pause->pause_stop }}</td>
            <td>{{ $pause->pause_time }}</td>
            <td>{{ $pause->reason }}</td>
            <td>{{ $pause->comment }}</td>
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

@endsection