<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <!-- <li class="menu-header">Dashboard</li> -->
          <li class="@if(Request::segment(1) == 'dashboard') active @endif">
            <a class="nav-link" href="/dashboard"><i class="far fa-square"></i> <span>Dashboard</span></a></li>
          <li class="menu-header">Stisla</li>
          <li class="dropdown @if (Request::segment(1) == 'post_list' or Request::segment(1) == 'post_add') active @endif">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i> <span>Post</span></a>
            <ul class="dropdown-menu">
              <li class="@if (Request::segment(1) == 'post_list' or Request::segment(1) == 'post_add') active @endif"><a class="nav-link" href="{{ url('post_list') }}">Post List</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google Maps</span></a>
            <ul class="dropdown-menu">
              <li><a href="gmaps-advanced-route.html">Advanced Route</a></li>
              <li><a href="gmaps-draggable-marker.html">Draggable Marker</a></li>
              <li><a href="gmaps-geocoding.html">Geocoding</a></li>
              <li><a href="gmaps-geolocation.html">Geolocation</a></li>
              <li><a href="gmaps-marker.html">Marker</a></li>
              <li><a href="gmaps-multiple-marker.html">Multiple Marker</a></li>
              <li><a href="gmaps-route.html">Route</a></li>
              <li><a href="gmaps-simple.html">Simple</a></li>
            </ul>
          </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div>
    </aside>
  </div>