@extends('layouts/contentNavbarLayout')

@section('title', 'Machines/Operations - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/machines-operations.js') }}"></script>
@endsection


@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Machines/Operations</span>
</h4>
<div class="card" id="machines-operations-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-machines-operations">
      <thead>
        <tr>
          <th>Name</th>
          <th>Active</th>
          <th>End Machine</th>
          <th>Work hour price</th>
          <th>Currency</th>
          <th>Action</th>
        </tr>
      </thead>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($machinesOperations as $machinesOperation)
          <tr>
            <td>{{ $machinesOperation->name }}</td>
            <td class="text-center fs-5">{!! $machinesOperation->active ? '<i class="bx bx-check text-success"></i>':'<i class="bx bx-x text-danger"></i>' !!}</td>
            <td class="text-center fs-5">{!! $machinesOperation->end_machine ? '<i class="bx bx-check text-success"></i>':'<i class="bx bx-x text-danger"></i>' !!}</td>
            <td>{{ $machinesOperation->work_hour_price }}</td>
            <td>{{ $machinesOperation->currency->currency_name }}</td>
            <td>
              <form action="{{ route('machines-operations.destroy', $machinesOperation->id) }}" method="post">
                @csrf
                @method('DELETE')

              <a  class="btn btn-sm btn-icon item-edit machines-operations-edit" data-id={{$machinesOperation->id}}><i class="bx bxs-edit"></i></a>
              <a type="submit" class="btn btn-sm btn-icon item-delete delete-machines-operations"><i class="bx bxs-trash"></i></a>
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

@endsection