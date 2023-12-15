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
          <th>User type</th>
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
                  <a class="dropdown-item" id="edit-role" data-roleId="{{$role->id}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" id="delete-role" data-roleId="{{$role->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="modal fade" id="add-role-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Add Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="addRole" class="form-label">Role</label>
            <input type="text" id="addRole" class="form-control" placeholder="Enter role">
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="addUserType" class="form-label">User type</label>
            <select id="addUserType" class="form-select">
              <option value="" selected>Select user type</option>
              @foreach($userTypes as $userType)
                <option value="{{ $userType->id }}">{{ $userType->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="save-role" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit-role-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Edit Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="editRole" class="form-label">Role</label>
            <input type="text" id="editRole" class="form-control" placeholder="Enter role">
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="editUserType" class="form-label">User type</label>
            <select id="editUserType" class="form-select">
              <option value="">Select user type</option>
              @foreach($userTypes as $userType)
                <option value="{{ $userType->id }}">{{ $userType->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="update-role" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
@endsection
