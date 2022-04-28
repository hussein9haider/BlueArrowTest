<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center navb">
    <div class="navbar-wrapper">
      <div class="navbar-header" style="position: relative;">
        <ul class="nav navbar-nav flex-row">
         
          <li class="nav-item">
            <a class="navbar-brand" href="{{route('dashboard')}}">
               {{-- <i class="ft-bookmark brand-logo" ></i> --}}
              <img class="brand-logo" alt="modern admin logo" src="{{asset('/app-assets/logo.png')}}">
              <h3 class="brand-text"> ملاحظاتي </h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav  float-right">
            <li class="nav-item">
              <a class="nav-link nav-menu-main menu-toggle hidden-xs">
                مرحباً {{auth('admin')->user()->name}} 
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

