@extends('layouts/contentNavbarLayout')

@section('title', 'Roles - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/role.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Roles</span>
</h4>
<div class="card" id="role-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-role">
      <thead>
        <tr>
          <th>Role</th>
          <th>User type</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($roles as $role)
          <tr>
            <td>{{ $role->role }}</td>
            <td>{{ $role->userType->name }}</td>
            <td>
              <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                @csrf
                @method('DELETE')
                <a type="button" class="btn btn-sm btn-icon item-edit role-edit" data-id="{{ $role->id }}"><i class="bx bxs-edit"></i></a>
                <a type="submit" class="btn btn-sm btn-icon item-delete role-delete"><i class="bx bxs-trash"></i></a>
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

<!-- Add Modal -->
<div class="modal fade" id="role-add-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" action="{{ route('roles.store') }}" method="post" novalidate>
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="role" class="form-label">Role</label>
              <input type="text" id="role" name="role" class="form-control" placeholder="Role" required>
              <div class="invalid-feedback">Please enter the role</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="user_type_id" class="form-label">User type</label>
              <select id="user_type_id" name="user_type_id" class="form-select" required>
                <option value="" selected>Select user type</option>
                @foreach($userTypes as $userType)
                  <option value="{{ $userType->id }}">{{ $userType->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">Please select the user type</div>
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
<div class="modal fade" id="role-edit-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" id="role-edit-form" action="{{ route('roles.update', '') }}" method="post" novalidate>
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="edit_role" class="form-label">Role</label>
              <input type="text" id="edit_role" name="role" class="form-control" placeholder="Role" required>
              <div class="invalid-feedback">Please enter the role</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="edit_user_type_id" class="form-label">User type</label>
              <select id="edit_user_type_id" name="user_type_id" class="form-select" required>
                <option value="" selected>Select user type</option>
                @foreach($userTypes as $userType)
                  <option value="{{ $userType->id }}">{{ $userType->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">Please select the user type</div>
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
</div>
@endsection