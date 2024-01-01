@extends('layouts/contentNavbarLayout')

@section('title', ' Machines/Operations - Create')

@section('page-script')
<script type="module" src="{{ mix('js/modules/machines-operations.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Create/</span> Machines/Operations</h4>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Basic Options</h5> <small class="text-muted float-end"></small>
      </div>
      <div class="card-body">
        <form class="needs-validation" action="{{ route('machines-operations.store') }}" method="post"  novalidate>
            @csrf
            <div class="row mb-3">
            <div class="col-md-5">
                <div class="row">
                    <label class="col-sm-12 col-form-label" for="name">Name</label>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required/>
                        <div class="invalid-feedback">Please fill out the name</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <label class="col-sm-12 col-form-label" for="active">Active</label>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="active" name="active" class="form-select" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <div class="invalid-feedback">Please select active status</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <label class="col-sm-12 col-form-label" for="end_machine">End Machine</label>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="end_machine" name="end_machine" class="form-select" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <div class="invalid-feedback">Please select end machine status</div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="row">
                        <label class="col-sm-12 col-form-label" for="notes">Notes</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                                <textarea id="notes" class="form-control" name="notes" placeholder="This text will be shown on the production schedule to all workers" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start column-gap-2 mb-3 mt-4">
                <h5 class="mb-2">Advanced Options</h5>
                <button type="button" class="btn btn-primary btn-icon square-pill dropdown-toggle hide-arrow" id="advanceOptionBtn" style="width: 25px;height:25px" data-bs-toggle="collapse" data-bs-target="#advanceOption" aria-expanded="false" aria-controls="advanceOption">
                    <i class='bx bx-chevron-down' ></i>
                </button>
            </div>
            <hr>
            <div class="collapse" id="advanceOption">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="row">
                            <label class="col-sm-12 col-form-label" for="work_hour_price">Work hour price</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="work_hour_price" name="work_hour_price" />
                                </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <label class="col-sm-12 col-form-label" for="currency_id">Currency</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <select id="currency_id" name="currency_id" class="form-select">
                                    <option value="">Please select</option>
                                    @foreach ($currencies as $currency)
                                    <option value={{ $currency->id}}>{{ $currency->currency_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <label class="col-sm-12 col-form-label" for="end_machine">Number of shifts</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <select id="no_of_shifts" name="no_of_shifts" class="form-select" required>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                     @endfor
                                </select>
                                <div class="invalid-feedback">Please select number of shifts</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <label class="col-sm-12 col-form-label" for="hours_per_day">Hours per day</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <select id="hours_per_day" name="hours_per_day" class="form-select" required>
                                    @for ($i = 1; $i <= 24; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                     @endfor
                                </select>
                                <div class="invalid-feedback">Please select hours per day</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end my-2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </div>
        </form>
      </div>
    </div>
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

@endsection
