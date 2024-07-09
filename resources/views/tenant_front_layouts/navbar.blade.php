<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light p-0" aria-label="Offcanvas navbar large">
      <div class="container">
        <a href="{{url('/')}}" class="logo text-black navbar-brand">
          <img src="{{asset('images/tenant_logo.svg')}}" alt="">
          
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
          aria-controls="offcanvasNavbar2">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
          aria-labelledby="offcanvasNavbar2Label">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbar2Label">
              <a href="index.html" class="logo text-black">
                <img src="{{asset('images/tenant_logo.svg')}}" alt="">
                Tenant
              </a>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body menu-body">

            <div class="menu-left">
              <a href="{{url('/')}}" class=" {{ (request()->is('/')) ? ' active' : '' }}">Home</a>            
            </div>

              <div class="menu-right">         
              <a href="{{url('tenant/login')}}" class="btn btn-color-1 text-white">Log in</a>
            </div>

          </div>
        </div>
      </div>
    </nav>
  </div>