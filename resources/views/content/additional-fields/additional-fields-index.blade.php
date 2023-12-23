@extends('layouts/contentNavbarLayout')

@section('title', 'Additional fields - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/additional-fields.js') }}"></script>
@endsection


@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Additional Fields</span>
</h4>
<div class="card" id="additional-fields-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-additional-fields">
      <thead>
        <tr>
          <th>Assigned to</th>
          <th>Group</th>
          <th>Field</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($additionalFields as $additionalField)
          <tr>
            <td>{{ $additionalField->assigned_to }}</td>
            <td>{{ $additionalField->group }}</td>
            <td>{{ $additionalField->field }}</td>
            <td>
              <form action="{{ route('additional-fields.destroy', $additionalField->id) }}" method="post">
                @csrf
                @method('DELETE')

              <a  class="btn btn-sm btn-icon item-edit additional-fields-edit" data-id={{$additionalField->id}}><i class="bx bxs-edit"></i></a>
              <a type="submit" class="btn btn-sm btn-icon item-delete delete-additional-fields"><i class="bx bxs-trash"></i></a>
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
<div class="modal fade" id="additional-fields-create-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" action="{{ route('additional-fields.store') }}" method="post"  novalidate>
        @csrf
        
        <div class="modal-header">
          <h5 class="modal-title">Add additional fields</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <div class="row">
                    <label class="col-sm-12 col-form-label" for="assigned_to">Assigned to</label>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="assigned_to" name="assigned_to" class="form-select" required>
                            <option value="">Please select</option>
                            <option value="Products">Products</option>
                            <option value="Orders">Orders</option>
                        </select>
                        <div class="invalid-feedback">Please select additional field</div>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                  <div class="row">
                      <label class="col-sm-12 col-form-label" for="group">Group</label>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <select id="group" name="group" class="form-select" required>
                              <option value="">Please select</option>
                              <option value="Default Group">Default Group</option>
                          </select>
                          <div class="invalid-feedback">Please select group field</div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                  <label for="field" class="form-label">Field</label>
                  <input type="text" id="field" name="field" class="form-control" placeholder="Field" required>
                  <div class="invalid-feedback">Please fill out field</div>
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
<div class="modal fade" id="additional-fields-edit-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" id="additional-fields-edit-form" action="{{ route('additional-fields.update', '') }}" method="post"  novalidate>
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit additional fields</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                  <div class="row">
                      <label class="col-sm-12 col-form-label" for="assigned_to_edit">Assigned to</label>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <select id="assigned_to_edit" name="assigned_to" class="form-select" required>
                            option value="">Please select</option>
                            <option value="Products">Products</option>
                            <option value="Orders">Orders</option>
                          </select>
                          <div class="invalid-feedback">Please select additional field</div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col mb-3">
                    <div class="row">
                        <label class="col-sm-12 col-form-label" for="group_edit">Group</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <select id="group_edit" name="group" class="form-select" required>
                                <option value="">Please select</option>
                                <option value="Default Group">Default Group</option>
                            </select>
                            <div class="invalid-feedback">Please select group field</div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col mb-3">
                    <label for="field_edit" class="form-label">Field</label>
                    <input type="text" id="field_edit" name="field" class="form-control" placeholder="Field" required>
                    <div class="invalid-feedback">Please fill out field</div>
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