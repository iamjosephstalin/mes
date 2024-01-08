@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
$closeViewBtn = ($closeViewBtn ?? false);
$clockHistoryBtn = ($clockHistoryBtn ?? false);
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
          <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex justify-content-between align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..." aria-label="Search...">
          </div>
        </div>
        <div class="d-flex column-gap-2 align-items-center">
          @if(isset($closeViewBtn) && $closeViewBtn)
          <a type="button" class="btn rounded-pill btn-primary" style="height: 40px" href="{{route('user-dashboard.index')}}">
            <span class="tf-icons bx bx-low-vision me-1"></span>Close view
          </a>
          @endif
          @if(isset($clockHistoryBtn) && $clockHistoryBtn)
          <a type="button" class="btn rounded-pill btn-primary" style="height: 40px" href="{{route('clock-history.index')}}">
            <span class="tf-icons bx bxs-time-five me-1"></span>Clock-in/Clock-out History
          </a>
          @endif
          <!-- /Search -->
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-target="#profile-menu">
                <div class="avatar avatar-online">
                  <img src="{{ isset(auth()->user()->image_path) ? asset("storage/" . auth()->user()->image_path) : asset('assets/img/avatars/profile.jpg') }}" alt class="w-px-40 h-auto rounded-circle">
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" id="profile-menu">
                <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="{{ isset(auth()->user()->image_path) ? asset("storage/" . auth()->user()->image_path) : asset('assets/img/avatars/profile.jpg') }}" alt class="w-px-40 h-auto rounded-circle">
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-medium d-block">{{auth()->user()->name}}</span>
                        <small class="text-muted">{{auth()->user()->role->role}}</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                {{-- <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <i class="bx bx-user me-2"></i>
                    <span class="align-middle">My Profile</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <i class='bx bx-cog me-2'></i>
                    <span class="align-middle">Settings</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <span class="d-flex align-items-center align-middle">
                      <i class="flex-shrink-0 bx bx-credit-card me-2 pe-1"></i>
                      <span class="flex-grow-1 align-middle">Billing</span>
                      <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                    </span>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li> --}}
                @auth
                <li>
                  <form method="POST" action={{route('logout')}} >
                    @csrf

                  <button class="dropdown-item" type="submit">
                    <i class='bx bx-power-off me-2'></i>
                    <span class="align-middle">Log Out</span>
                  </button>
                </form>
                </li>
                @endauth
              </ul>
            </li>
            <!--/ User -->
          </ul>
      </div>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->

