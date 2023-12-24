@extends('layouts/contentNavbarLayout')

@section('title', 'Client - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/clients.js') }}"></script>
@endsection


@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Clients</span>
</h4>
<div class="card" id="clients-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-clients">
      <thead>
        <tr>
          <th>Name</th>
          <th>Active</th>
          <th>Address</th>
          <th>Tax identification number</th>
          <th>City</th>
          <th>Email</th>
          <th>Phone number</th>
          <th>Postal code</th>
          <th>Web page</th>
          <th>Comments</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($clients as $client)
          <tr>
            <td>{{ $client->name }}</td>
            <td>{{ $client->active ? "Yes" : "No"}}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->tax_id_number }}</td>
            <td>{{ $client->city }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->postal_code }}</td>
            <td>{{ $client->web_page }}</td>
            <td>{{ $client->comment }}</td>
            <td>
              <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                @csrf
                @method('DELETE')

              <a  class="btn btn-sm btn-icon item-edit clients-edit" data-id={{$client->id}}><i class="bx bxs-edit"></i></a>
              <a type="submit" class="btn btn-sm btn-icon item-delete delete-clients"><i class="bx bxs-trash"></i></a>
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

<div class="offcanvas offcanvas-end" tabindex="-1" id="addClientCanvas" aria-labelledby="addClientLabel" data-bs-scroll="true" style="overflow-y: auto">
    <form class="needs-validation" action="{{ route('clients.store') }}" method="post"  novalidate>
    @csrf
        <div class="offcanvas-header">
            <h5 id="addClientLabel" class="offcanvas-title">Add Client</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
            <div class="row">
                <div class="col mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please fill out the name</div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <div class="row">
                    <label class="col-sm-12 col-form-label" for="active">Active</label>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="active" name="active" class="form-select" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <div class="invalid-feedback">Please select the active status</div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="tax_id_number" class="form-label">Tax identification number</label>
                <input type="text" id="tax_id_number" name="tax_id_number" class="form-control" placeholder="Tax identification number">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" id="city" name="city" class="form-control" placeholder="City">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone number">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="postal_code" class="form-label">Postal code</label>
                <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder="Postal code">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="web_page" class="form-label">Web page</label>
                <input type="text" id="web_page" name="web_page" class="form-control" placeholder="Web page">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea type="text" id="comment" name="comment" class="form-control" placeholder="comment" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer text-end mx-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="editClientCanvas" aria-labelledby="editClientLabel" data-bs-scroll="true" style="overflow-y: auto">
    <form class="needs-validation" id="clients-edit-form" action="{{ route('clients.update', '') }}" method="post"  novalidate>
     @csrf
     @method('PUT')
        <div class="offcanvas-header">
            <h5 id="editClientLabel" class="offcanvas-title">Update Client</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
            <div class="row">
                <div class="col mb-3">
                <label for="name_edit" class="form-label">Name</label>
                <input type="text" id="name_edit" name="name" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please fill out the name</div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <div class="row">
                    <label class="col-sm-12 col-form-label" for="active_edit">Active</label>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="active_edit" name="active" class="form-select" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <div class="invalid-feedback">Please select the active status</div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="address_edit" class="form-label">Address</label>
                <input type="text" id="address_edit" name="address" class="form-control" placeholder="Address">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="tax_id_number_edit" class="form-label">Tax identification number</label>
                <input type="text" id="tax_id_number_edit" name="tax_id_number" class="form-control" placeholder="Tax identification number">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="city_edit" class="form-label">City</label>
                <input type="text" id="city_edit" name="city" class="form-control" placeholder="City">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="email_edit" class="form-label">Email</label>
                <input type="text" id="email_edit" name="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="phone_edit" class="form-label">Phone</label>
                <input type="text" id="phone_edit" name="phone" class="form-control" placeholder="Phone number">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="postal_code_edit" class="form-label">Postal code</label>
                <input type="text" id="postal_code_edit" name="postal_code" class="form-control" placeholder="Postal code">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="web_page_edit" class="form-label">Web page</label>
                <input type="text" id="web_page_edit" name="web_page" class="form-control" placeholder="Web page">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="comment_edit" class="form-label">Comment</label>
                <textarea type="text" id="comment_edit" name="comment" class="form-control" placeholder="comment" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="offcanvas-fotter text-end mx-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

@endsection