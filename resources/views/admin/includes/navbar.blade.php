<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
          {{ __('mycustom.main_page') }}
        </a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('userProfile.index') }}" class="nav-link">
          {{ __('mycustom.profile') }}
        </a>
      </li>


      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.logout') }}" class="nav-link">
          {{ __('mycustom.logout') }}
        </a>
      </li>

    </ul>

   
  
  </nav>