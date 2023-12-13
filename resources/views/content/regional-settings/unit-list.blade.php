@extends('layouts/contentNavbarLayout')

@section('title', 'Units - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/unit.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Units</span>
</h4>
<div class="card">
  <h5 class="card-header">Unit List</h5>
  <div class="table-responsive text-nowrap">
    <table class="table" id="table-unit">
      <thead>
        <tr>
          <th>Unit</th>
          <th>Default</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($units as $unit)
          <tr>
            <td>{{ $unit->unit }}</td>
            <td>
              <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" {{ $unit->is_default ? "checked" :""}}>
              </div>
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
