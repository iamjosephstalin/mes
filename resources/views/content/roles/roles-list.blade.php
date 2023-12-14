@extends('layouts/contentNavbarLayout')

@section('title', 'Roles - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/roles.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Roles</span>
</h4>
<div class="card">
  <div class="card-datatable table-responsive text-nowrap">
    <table class="table" id="table-roles">
      <thead>
        <tr>
          <th>Role</th>
          <th>User Type</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($roles as $role)
          <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->userType->name }}</td>
            <td>{{ $role->created_at->format('Y-m-d') }}</td>
            <td>{{ $role->updated_at->format('Y-m-d') }}</td>
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
