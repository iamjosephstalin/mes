@extends('layouts/contentNavbarLayout')

@section('title', 'API Keys - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/api-key.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">API Keys</span>
</h4>
<div class="card" id="api-key-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-api-key">
      <thead>
        <tr>
          <th>API Key</th>
          <th>Products</th>
          <th>Orders</th>
          <th>Files</th>
          <th>Clients</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($apiKeys as $apiKey)
          <tr>
            <td>{{ $apiKey->api_key }}</td>
            <td>{!! $apiKey->products ? '<i class="bx bx-check text-success fs-5" data-value="Active"></i>' : '<i class="bx bx-x text-danger fs-5" data-value="Inactive"></i>' !!}</td>
            <td>{!! $apiKey->orders ? '<i class="bx bx-check text-success fs-5" data-value="Active"></i>' : '<i class="bx bx-x text-danger fs-5" data-value="Inactive"></i>' !!}</td>
            <td>{!! $apiKey->files ? '<i class="bx bx-check text-success fs-5" data-value="Active"></i>' : '<i class="bx bx-x text-danger fs-5" data-value="Inactive"></i>' !!}</td>
            <td>{!! $apiKey->clients ? '<i class="bx bx-check text-success fs-5" data-value="Active"></i>' : '<i class="bx bx-x text-danger fs-5" data-value="Inactive"></i>' !!}</td>
            <td>{!! $apiKey->status ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>' !!}</td>
            <td>
              <form action="{{ route('api-keys.destroy', $apiKey->id) }}" method="post">
                @csrf
                @method('DELETE')
                <a type="button" class="btn btn-sm btn-icon item-edit api-key-edit" href="{{ route('api-keys.edit', $apiKey->id) }}"><i class="bx bxs-edit"></i></a>
                <a type="submit" class="btn btn-sm btn-icon item-delete api-key-delete"><i class="bx bxs-trash"></i></a>
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
@endsection