<div class="topbar">
    <div class="left">
        <form class="search opacity-0">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" placeholder="Search...">
        </form>
        <nav class="navbar navbar-expand-lg p-0">
            <div class="container-fluid p-0">
                <a class="navbar-brand d-none" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{route('tenant.tenant-information')}}">Home</a></li>
                       
                     
                     
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                User Profile
                            </a>
                            <ul class="dropdown-menu">
                            
                                {{--<li><a class="dropdown-item" href="{{route('landlord.tenants')}}">Edit User</a></li>--}}
                                <li><a href="{{route('tenant.tenant-information')}}" class="dropdown-item" href="#">Profile</a></li>
                            </ul>
                        </li>
                    </ul>
                    <script>
                        $(".navbar-nav .nav-item .nav-link").filter(function() {
                            return this.href == location.href.replace(/#.*/, "");
                        }).addClass("active");
                    </script>
                </div>
            </div>
        </nav>
    </div>
    <div class="right">
        <div class="notifications-bar">
            <a href="#"><i class="fa-regular fa-circle-info"></i></a>
            <a href="#"><i class="fa-regular fa-calendar-days"></i></a>
            <a href="#"><i class="fa-regular fa-bell"></i></a>
        </div>
        <div class="profile-menu">
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                @if(Auth::user()->image)
                <img src="{{ asset('tenants/profile/'.Auth::user()->image)}}" id="previewImage" alt="Preview Image">
                @else
                <img src="{{ asset('tenants/profile/user-profile-pic.png')}}" id="previewImage" alt="Preview Image">
                @endif
                    Welcome <b class="ms-1 uc">{{ucfirst(auth::user()->first_name)." ".ucfirst(auth::user()->last_name)}}</b>
                </button>
                
                <ul class="dropdown-menu">
                    <!-- <li><a class="dropdown-item small" href="javascript:void(0);"><i class="fa-solid fa-gear me-2"></i><b>Account Profile</b></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item small" href="{{route('tenant.profile')}}">Profile</a></li>
                    <li><a class="dropdown-item small" href="#">Payment Account</a></li>
                    <li><a class="dropdown-item small" href="{{route('tenant.account.security')}}">Account and Security</a></li>
                    <li><a class="dropdown-item small" href="{{route('landlord.account.billing')}}">Billing</a></li> -->
                    <li><a class="dropdown-item small" href="{{route('tenantlogout')}}"> 
                            Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>