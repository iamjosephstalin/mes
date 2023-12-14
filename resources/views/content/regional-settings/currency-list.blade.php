@extends('layouts/contentNavbarLayout')

@section('title', 'Currency - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/currency.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Currency</span>
</h4>
<div class="card">
  <h5 class="card-header">Currency List</h5>
  <div class="table-responsive text-nowrap">
    <table class="table" id="table-currency">
      <thead>
        <tr>
          <th>Currency</th>
          <th>Default</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($currencies as $currency)
          <tr>
            <td>{{ $currency->currency_name }}</td>
            <td>
              <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" {{ $currency->is_default ? "checked" :""}}>
              </div>
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
