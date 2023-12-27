<ul class="menu-sub">
  @if (isset($menu))
    @foreach ($menu as $submenu)

    {{-- active menu method --}}
    @php
      require_once app_path('Http/Helpers/helpers.php');

      $activeClass = null;
      $active = 'active open';
      $currentRouteName = Route::currentRouteName();

      if ($currentRouteName === $submenu->slug) {
          $activeClass = 'active';
      }
      elseif (isset($submenu->submenu) && is_array($submenu->submenu)) {
       $slugsArr = getAllSlugs($submenu);
       if(in_array($currentRouteName, $slugsArr)){
          $activeClass = 'active open';
       }
      }
    @endphp

      <li class="menu-item {{$activeClass}}">
        <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}" class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
          @if (isset($submenu->icon))
          <i class="{{ $submenu->icon }}"></i>
          @endif
          <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
          @isset($submenu->badge)
            <div class="badge bg-{{ $submenu->badge[0] }} rounded-pill ms-auto">{{ $submenu->badge[1] }}</div>
          @endisset
        </a>

        {{-- submenu --}}
        @if (isset($submenu->submenu))
          @include('layouts.sections.menu.submenu',['menu' => $submenu->submenu])
        @endif
      </li>
    @endforeach
  @endif
</ul>
