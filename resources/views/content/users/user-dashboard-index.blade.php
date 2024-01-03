@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'User Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
@endsection

@section('content')

<div class="row w-100">
    <div class="d-flex justify-content-end column-gap-2 mb-3">
        <button type="button" class="btn rounded-pill btn-primary">
        <span class="tf-icons bx bx-table me-1"></span>Table
        </button>
        <a type="button" class="btn rounded-pill btn-primary" href="{{route('clock-in-out-view')}}">
        <span class="tf-icons bx bx-mobile me-1"></span>Clock IN/OUT
        </a>

        <button type="button" class="btn rounded-pill btn-primary">
        <span class="tf-icons bx bx-filter me-1"></span>Filter
        </button> 
    </div>
</div>

<!-- Layout Demo -->
<div class="layout-demo-wrapper">
    
    <div class="row">
        <div class="col-md-6 col-xl-3">
          <div class="card overflow-hidden mb-4"  style="height: 500px; background-color: #f8f8f8">
            <div class="d-flex justify-content-between align-items-center p-0">
                <div class="card-header p-3">Ciece</div>
                    <i class='bx bx-chevron-right fs-4 me-3' ></i>
            </div>
            <div class="card-body" id="vertical-example">
                <div class="row card p-2 mb-2">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-start column-gap-2">
                                    <button type="button" class="product-stop-btn-primary rounded-pill text-align-center">
                                        <i class="bx bx-stop fs-4"></i>STOP
                                    </button>
                                    <button type="button" class="product-stop-btn-secondary rounded-pill">
                                        3h 7m30s
                                    </button>
                                </div>
                                <small>125 of 125</small>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="d-flex justify-content-start align-items-end column-gap-2 mb-2">
                                <span class="header-product">AeroGlide Stream </span>
                                <small class="sub-header-product text-muted">starndardowe</small>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <i class='bx bx-extension'></i>
                                    <span class="product-specifics">07/07/2023-demo</span>
                                </div>
                                <div class="col-md-6">
                                    <i class='bx bxs-calendar me-2' ></i>
                                    <span class="product-specifics">2023-05-09</span>
                                </div>
                                <div class="col-md-6">
                                    <i class='bx bx-user-pin'></i>
                                    <span class="product-specifics">Michel holc</span>
                                </div>
                            </div>
                            <div class="row justify-content-center p-2">
                                <img src="{{ asset('assets/img/elements/path34.png') }}" style="max-height: 124px; max-width: 220px;" alt="productImg">
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row card p-2 mb-2">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-start column-gap-2">
                                    <button type="button" class="product-stop-btn-primary rounded-pill text-align-center">
                                        <i class="bx bx-stop fs-4"></i>STOP
                                    </button>
                                    <button type="button" class="product-stop-btn-secondary rounded-pill">
                                        3h 7m30s
                                    </button>
                                </div>
                                <small>125 of 125</small>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="d-flex justify-content-start align-items-end column-gap-2 mb-2">
                                <span class="header-product">AeroGlide Stream </span>
                                <small class="sub-header-product text-muted">starndardowe</small>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <i class='bx bx-extension'></i>
                                    <span class="product-specifics">07/07/2023-demo</span>
                                </div>
                                <div class="col-md-6">
                                    <i class='bx bxs-calendar me-2' ></i>
                                    <span class="product-specifics">2023-05-09</span>
                                </div>
                                <div class="col-md-6">
                                    <i class='bx bx-user-pin'></i>
                                    <span class="product-specifics">Michel holc</span>
                                </div>
                            </div>
                            <div class="row justify-content-center p-2">
                                <img src="{{ asset('assets/img/elements/path34.png') }}" style="max-height: 124px; max-width: 220px;" alt="productImg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    
        <div class="col-md-6 col-xl-3">
            <div class="card overflow-hidden mb-4"  style="height: 500px; background-color: #f8f8f8">
              <div class="d-flex justify-content-between align-items-center p-0">
                  <div class="card-header p-3">Ciece</div>
                      <i class='bx bx-chevron-right fs-4 me-3' ></i>
              </div>
              <div class="card-body" id="vertical-example">
                <div class="row card p-2 mb-2 product-dark">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-start column-gap-2">
                                    <button type="button" class="product-stop-btn-primary rounded-pill text-align-center">
                                        <i class="bx bx-stop fs-4"></i>STOP
                                    </button>
                                    <button type="button" class="product-stop-btn-secondary rounded-pill">
                                        3h 7m30s
                                    </button>
                                </div>
                                <small>125 of 125</small>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="d-flex justify-content-start align-items-end column-gap-2 mb-2">
                                <span class="header-product">AeroGlide Stream </span>
                                <small class="sub-header-product text-muted">starndardowe</small>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <i class='bx bx-extension'></i>
                                    <span class="product-specifics">07/07/2023-demo</span>
                                </div>
                                <div class="col-md-6">
                                    <i class='bx bxs-calendar me-2' ></i>
                                    <span class="product-specifics">2023-05-09</span>
                                </div>
                                <div class="col-md-6">
                                    <i class='bx bx-user-pin'></i>
                                    <span class="product-specifics">Michel holc</span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start mb-2">
                            <div class=" product-pending d-flex p-2 rounded align-items-end">
                                <i class='bx bx-time-five me-2' ></i>
                                <small> Waiting for:   (0/50)  Malowanie  3/11/2023-demo  </small>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="row card p-2 mb-2">
                      <div class="col">
                          <div class="row mb-2">
                              <div class="d-flex justify-content-between">
                                  <div class="d-flex justify-content-start column-gap-2">
                                      <button type="button" class="product-stop-btn-primary rounded-pill text-align-center">
                                          <i class="bx bx-stop fs-4"></i>STOP
                                      </button>
                                      <button type="button" class="product-stop-btn-secondary rounded-pill">
                                          3h 7m30s
                                      </button>
                                  </div>
                                  <small>125 of 125</small>
                              </div>
                          </div>
                          <div class="row mb-2">
                              <div class="d-flex justify-content-start align-items-end column-gap-2 mb-2">
                                  <span class="header-product">AeroGlide Stream </span>
                                  <small class="sub-header-product text-muted">starndardowe</small>
                              </div>
                              <div class="row mb-2">
                                  <div class="col-md-6">
                                      <i class='bx bx-extension'></i>
                                      <span class="product-specifics">07/07/2023-demo</span>
                                  </div>
                                  <div class="col-md-6">
                                      <i class='bx bxs-calendar me-2' ></i>
                                      <span class="product-specifics">2023-05-09</span>
                                  </div>
                                  <div class="col-md-6">
                                      <i class='bx bx-user-pin'></i>
                                      <span class="product-specifics">Michel holc</span>
                                  </div>
                              </div>
                              <div class="row justify-content-center p-2">
                                  <img src="{{ asset('assets/img/elements/path34.png') }}" style="max-height: 124px; max-width: 220px;" alt="productImg">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    
        <div class="col-md-6 col-xl-3">
            <div class="card overflow-hidden mb-4"  style="height: 500px; background-color: #f8f8f8">
              <div class="d-flex justify-content-between align-items-center p-0">
                  <div class="card-header p-3">Ciece</div>
                      <i class='bx bx-chevron-right fs-4 me-3' ></i>
              </div>
              <div class="card-body" id="vertical-example">
                  <div class="row card p-2 mb-2">
                      <div class="col">
                          <div class="row mb-2">
                              <div class="d-flex justify-content-between">
                                  <div class="d-flex justify-content-start column-gap-2">
                                      <button type="button" class="product-stop-btn-primary rounded-pill text-align-center">
                                          <i class="bx bx-stop fs-4"></i>STOP
                                      </button>
                                      <button type="button" class="product-stop-btn-secondary rounded-pill">
                                          3h 7m30s
                                      </button>
                                  </div>
                                  <small>125 of 125</small>
                              </div>
                          </div>
                          <div class="row mb-2">
                              <div class="d-flex justify-content-start align-items-end column-gap-2 mb-2">
                                  <span class="header-product">AeroGlide Stream </span>
                                  <small class="sub-header-product text-muted">starndardowe</small>
                              </div>
                              <div class="row mb-2">
                                  <div class="col-md-6">
                                      <i class='bx bx-extension'></i>
                                      <span class="product-specifics">07/07/2023-demo</span>
                                  </div>
                                  <div class="col-md-6">
                                      <i class='bx bxs-calendar me-2' ></i>
                                      <span class="product-specifics">2023-05-09</span>
                                  </div>
                                  <div class="col-md-6">
                                      <i class='bx bx-user-pin'></i>
                                      <span class="product-specifics">Michel holc</span>
                                  </div>
                              </div>
                              <div class="row justify-content-center p-2">
                                  <img src="{{ asset('assets/img/elements/path34.png') }}" style="max-height: 124px; max-width: 220px;" alt="productImg">
                              </div>
                          </div>
                      </div>
                  </div>
      
                  <div class="row card p-2 mb-2">
                      <div class="col">
                          <div class="row mb-2">
                              <div class="d-flex justify-content-between">
                                  <div class="d-flex justify-content-start column-gap-2">
                                      <button type="button" class="product-stop-btn-primary rounded-pill text-align-center">
                                          <i class="bx bx-stop fs-4"></i>STOP
                                      </button>
                                      <button type="button" class="product-stop-btn-secondary rounded-pill">
                                          3h 7m30s
                                      </button>
                                  </div>
                                  <small>125 of 125</small>
                              </div>
                          </div>
                          <div class="row mb-2">
                              <div class="d-flex justify-content-start align-items-end column-gap-2 mb-2">
                                  <span class="header-product">AeroGlide Stream </span>
                                  <small class="sub-header-product text-muted">starndardowe</small>
                              </div>
                              <div class="row mb-2">
                                  <div class="col-md-6">
                                      <i class='bx bx-extension'></i>
                                      <span class="product-specifics">07/07/2023-demo</span>
                                  </div>
                                  <div class="col-md-6">
                                      <i class='bx bxs-calendar me-2' ></i>
                                      <span class="product-specifics">2023-05-09</span>
                                  </div>
                                  <div class="col-md-6">
                                      <i class='bx bx-user-pin'></i>
                                      <span class="product-specifics">Michel holc</span>
                                  </div>
                              </div>
                              <div class="row justify-content-center p-2">
                                  <img src="{{ asset('assets/img/elements/path34.png') }}" style="max-height: 124px; max-width: 220px;" alt="productImg">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>  
        
        <div class="col-md-6 col-xl-3">
            <div class="card overflow-hidden mb-4"  style="height: 500px; background-color: #f8f8f8">
              <div class="d-flex justify-content-between align-items-center p-0">
                  <div class="card-header p-3">Ciece</div>
                      <i class='bx bx-chevron-right fs-4 me-3' ></i>
              </div>
              <div class="card-body" id="vertical-example">
                <div class="row card p-2 mb-2 product-dark">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-start column-gap-2">
                                    <button type="button" class="product-stop-btn-primary rounded-pill text-align-center">
                                        <i class="bx bx-stop fs-4"></i>STOP
                                    </button>
                                    <button type="button" class="product-stop-btn-secondary rounded-pill">
                                        3h 7m30s
                                    </button>
                                </div>
                                <small>125 of 125</small>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="d-flex justify-content-start align-items-end column-gap-2 mb-2">
                                <span class="header-product">AeroGlide Stream </span>
                                <small class="sub-header-product text-muted">starndardowe</small>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <i class='bx bx-extension'></i>
                                    <span class="product-specifics">07/07/2023-demo</span>
                                </div>
                                <div class="col-md-6">
                                    <i class='bx bxs-calendar me-2' ></i>
                                    <span class="product-specifics">2023-05-09</span>
                                </div>
                                <div class="col-md-6">
                                    <i class='bx bx-user-pin'></i>
                                    <span class="product-specifics">Michel holc</span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start mb-2">
                            <div class=" product-pending d-flex p-2 rounded align-items-end">
                                <i class='bx bx-time-five me-2' ></i>
                                <small> Waiting for:   (0/50)  Malowanie  3/11/2023-demo  </small>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="row card p-2 mb-2">
                      <div class="col">
                          <div class="row mb-2">
                              <div class="d-flex justify-content-between">
                                  <div class="d-flex justify-content-start column-gap-2">
                                      <button type="button" class="product-stop-btn-primary rounded-pill text-align-center">
                                          <i class="bx bx-stop fs-4"></i>STOP
                                      </button>
                                      <button type="button" class="product-stop-btn-secondary rounded-pill">
                                          3h 7m30s
                                      </button>
                                  </div>
                                  <small>125 of 125</small>
                              </div>
                          </div>
                          <div class="row mb-2">
                              <div class="d-flex justify-content-start align-items-end column-gap-2 mb-2">
                                  <span class="header-product">AeroGlide Stream </span>
                                  <small class="sub-header-product text-muted">starndardowe</small>
                              </div>
                              <div class="row mb-2">
                                  <div class="col-md-6">
                                      <i class='bx bx-extension'></i>
                                      <span class="product-specifics">07/07/2023-demo</span>
                                  </div>
                                  <div class="col-md-6">
                                      <i class='bx bxs-calendar me-2' ></i>
                                      <span class="product-specifics">2023-05-09</span>
                                  </div>
                                  <div class="col-md-6">
                                      <i class='bx bx-user-pin'></i>
                                      <span class="product-specifics">Michel holc</span>
                                  </div>
                              </div>
                              <div class="row justify-content-center p-2">
                                  <img src="{{ asset('assets/img/elements/path34.png') }}" style="max-height: 124px; max-width: 220px;" alt="productImg">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
<!--/ Layout Demo -->

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
