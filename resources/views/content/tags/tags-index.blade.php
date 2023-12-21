@extends('layouts/contentNavbarLayout')

@section('title', 'Tags - List')

@section('page-script')
<script type="module" src="{{ mix('js/modules/tags.js') }}"></script>
@endsection


@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Tags</span>
</h4>
<div class="card" id="tags-list">
  <div class="card-datatable table-responsive text-nowrap">
    {{-- <div class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> --}}
    <table class="table" id="table-tags">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Color</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($tags as $tag)
          <tr>
            <td>{{ $tag->id }}</td>
            <td>{{ $tag->name }}</td>
            <td>
                <input class="form-control" type="color" value="{{ $tag->color }}" disabled /> 
            </td>
            <td>
              <form action="{{ route('tags.destroy', $tag->id) }}" method="post">
                @csrf
                @method('DELETE')

              <a  class="btn btn-sm btn-icon item-edit tags-edit" data-id={{$tag->id}}><i class="bx bxs-edit"></i></a>
              <a type="submit" class="btn btn-sm btn-icon item-delete delete-tags"><i class="bx bxs-trash"></i></a>
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
<div class="modal fade" id="tags-create-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" action="{{ route('tags.store') }}" method="post"  novalidate>
        @csrf
        
        <div class="modal-header">
          <h5 class="modal-title">Tags Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label for="name" class="form-label">Tag name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please fill out tag name</div>
              </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                  <label for="name" class="form-label">Color</label>
                  <input class="form-control" type="color" id="color" name="color" value="#000" /> 
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
<div class="modal fade" id="tags-edit-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="needs-validation" id="tags-edit-form" action="{{ route('tags.update', '') }}" method="post"  novalidate>
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Tag Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label for="name_edit" class="form-label">Tag name</label>
                <input type="text" id="name_edit" name="name" class="form-control" placeholder="Name" required>
                <div class="invalid-feedback">Please fill out tag name</div>
              </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                  <label for="name" class="form-label">Color</label>
                  <input class="form-control" type="color" id="color_edit" name="color" /> 
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