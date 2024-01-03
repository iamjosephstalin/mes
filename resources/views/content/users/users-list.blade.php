@extends('layouts/contentNavbarLayout')

@section('title', 'Users - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/user.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Users</span>
</h4>
<div class="card" id="user-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-user">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Role</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Default Language</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($users as $user)
          <tr>
            <td>
              <div class="avatar-wrapper">
                <div class="avatar me-2">
                  <img src="{{isset($user->image_path) ? asset("storage/{$user->image_path}") : asset('assets/img/avatars/profile.jpg') }}" alt="Avatar" class="rounded-circle">
                </div>
              </div>
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->role->role }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{!! $user->language ? $user->language->name : '' !!}</td>
            <td>{!! $user->status ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>' !!}</td>
            <td>
              <form action="{{ route('users.destroy', $user->id) }}" method="post">
                @csrf
                @method('DELETE')
                <a type="button" class="btn btn-sm btn-icon item-edit user-edit" data-id="{{ $user->id }}"><i class="bx bxs-edit"></i></a>
                <a type="submit" class="btn btn-sm btn-icon item-delete user-delete"><i class="bx bxs-trash"></i></a>
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
<div class="modal fade" id="user-add-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"  novalidate>
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row me-1">
            <div class="col-md-3 mb-2">
              <div class="avatar-wrapper">
                <div class="avatar me-2" style="width:150px;height:150px">
                  <img src="{{ asset('assets/img/avatars/profile.jpg') }}" alt="Avatar" id="profile_preview"class="rounded-circle">
                </div>
              </div>
            </div>
            <div class="col mb-3">
              <div class="row mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please enter the name</div>
              </div>
              <div class="row">
                <input class="form-control" type="file" id="profile" name="profile">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="role_id" class="form-label">Role</label>
              <select id="role_id" name="role_id" class="form-select" required>
                <option value="" selected>Select role</option>
                @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->role }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">Please select the role</div>
            </div>
            <div class="col mb-2">
              <label for="status" class="form-label">Status</label>
              <select id="status" name="status" class="form-select">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
              <div class="invalid-feedback">Please enter the valid email</div>
            </div>
            <div class="col mb-3">
              <label for="mobile" class="form-label">Mobile</label>
              <input type="tel" pattern="[0-9]+" id="mobile" name="mobile" class="form-control" placeholder="Mobile" required>
              <div class="invalid-feedback">Please enter the valid mobile number</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="text" id="password" name="password" class="form-control" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required>
              <div class="invalid-feedback">Please enter a valid password. It should have at least 8 characters, including one uppercase letter, one lowercase letter, one digit, and one special character.</div>
            </div>
            <div class="col mb-3">
              <label for="default_language_id" class="form-label">Default Language</label>
              <select id="default_language_id" name="default_language_id" class="form-select">
                <option value="" selected>Select default language</option>
                @foreach($languages as $language)
                  <option value="{{ $language->id }}">{{ $language->name }}</option>
                @endforeach
              </select>
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
<div class="modal fade" id="user-edit-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" id="user-edit-form" action="{{ route('users.update', '') }}" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row me-1">
            <div class="col-md-3 mb-1">
              <div class="avatar-wrapper">
                <div class="avatar me-2" style="width:150px;height:150px">
                  <img src="{{ asset('assets/img/avatars/profile.jpg') }}" alt="Avatar" id="profile_preview_edit" class="rounded-circle">
                </div>
              </div>
            </div>
            <div class="col mb-3">
              <div class="row mb-3">
                <label for="edit_name" class="form-label">Name</label>
                <input type="text" id="edit_name" name="name" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please enter the name</div>
              </div>
              <div class="row">
                <input class="form-control" type="file" id="profile_edit" name="profile">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="edit_role_id" class="form-label">Role</label>
              <select id="edit_role_id" name="role_id" class="form-select" required>
                <option value="" selected>Select role</option>
                @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->role }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">Please select the role</div>
            </div>
            <div class="col mb-2">
              <label for="edit_status" class="form-label">Status</label>
              <select id="edit_status" name="status" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="edit_email" class="form-label">Email</label>
              <input type="email" id="edit_email" name="email" class="form-control" placeholder="Email" required>
              <div class="invalid-feedback">Please enter the valid email</div>
            </div>
            <div class="col mb-3">
              <label for="edit_mobile" class="form-label">Mobile</label>
              <input type="tel" pattern="[0-9]+" id="edit_mobile" name="mobile" class="form-control" placeholder="Mobile" required>
              <div class="invalid-feedback">Please enter the valid mobile number</div>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col mb-3">
              <label for="edit_password" class="form-label">Password</label>
              <input type="text" id="edit_password" name="password" class="form-control" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required>
              <div class="invalid-feedback">Please enter a valid password. It should have at least 8 characters, including one uppercase letter, one lowercase letter, one digit, and one special character.</div>
            </div> -->
            <div class="col-md-6 mb-3">
              <label for="edit_default_language_id" class="form-label">Default Language</label>
              <select id="edit_default_language_id" name="default_language_id" class="form-select">
                <option value="" selected>Select default language</option>
                @foreach($languages as $language)
                  <option value="{{ $language->id }}">{{ $language->name }}</option>
                @endforeach
              </select>
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