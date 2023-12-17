@extends('layouts/contentNavbarLayout')

@section('title', 'Vat Rate - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/vatRate.js') }}"></script>
@endsection


@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Vat Rate</span>
</h4>
<div class="card" id="vat-rate-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-vat-rate">
      <thead>
        <tr>
          <th>Vat Rate</th>
          <th>Default</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($vatRates as $vatRate)
          <tr>
            <td>{{ $vatRate->vat_rate }}</td>
            <td>
              <div class="form-check form-switch mb-2">
                <input class="form-check-input default-vat-rate" type="checkbox" {{ $vatRate->is_default ? "checked" :""}} data-id="{{$vatRate->id}}">
              </div>
            <td>
              <form action="{{ route('vat-rates.destroy', $vatRate->id) }}" method="post">
                @csrf
                @method('DELETE')

              <a  class="btn btn-sm btn-icon item-edit vat-rate-edit" data-id={{$vatRate->id}}><i class="bx bxs-edit"></i></a>
              <a type="submit" class="btn btn-sm btn-icon item-delete delete-vat-rate"><i class="bx bxs-trash"></i></a>
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
<div class="modal fade" id="vat-rate-create-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" action="{{ route('vat-rates.store') }}" method="post"  novalidate>
        @csrf
        
        <div class="modal-header">
          <h5 class="modal-title">Add Vat Rates</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label for="vat_rate" class="form-label">Vat Rate</label>
                <input type="text" id="vat_rate" name="vat_rate" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please fill out vat rate name</div>
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
<div class="modal fade" id="vat-rate-edit-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" id="vat-rate-edit-form" action="{{ route('vat-rates.update', '') }}" method="post"  novalidate>
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Vat Rate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label for="vat_rate_edit" class="form-label">Vat Rate</label>
                <input type="text" id="vat_rate_edit" name="vat_rate" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please fill out vat rate name</div>
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