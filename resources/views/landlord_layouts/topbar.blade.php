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
                        <li class="nav-item"><a class="nav-link" href="{{route('landlord.tenant.advanced.search')}}">Search</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('landlord.new.tenant')}}">New Tenant</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Properties</a>
                            <ul class="dropdown-menu">
                                <!-- <li><a class="dropdown-item" href="{{route('landlord.property')}}">Properties</a></li> -->
                                <li><a class="dropdown-item" href="{{route('landlord.view.property')}}">View Properties</a></li>
                                <li><a class="dropdown-item" href="{{route('landlord.edit.property')}}">Edit Properties</a></li>
                               <li><a class="dropdown-item" href="{{route('landlord.property.create')}}">Register New Property</a></li>
                                
                                <li><a class="dropdown-item" href="{{route('landlord.new.tenant')}}">Register New Tenant</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Payment Manager </a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                User Profile
                            </a>
                            <ul class="dropdown-menu">
                            
                                {{--<li><a class="dropdown-item" href="{{route('landlord.tenants')}}">Edit User</a></li>--}}
                                <li><a class="dropdown-item" href="#">Manage Payment</a></li>
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
                    <img src="{{ asset('landlord/images/user-profile-pic.png')}}" alt="">
                    Welcome <b class="ms-1 uc">{{ucfirst(auth::user()->username)}}</b>
                </button>
                
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item small" href="javascript:void(0);"><i class="fa-solid fa-gear me-2"></i><b>Account Profile</b></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item small" href="{{route('landlord.profile')}}">Profile</a></li>
                    <li><a class="dropdown-item small" href="#">Payment Account</a></li>
                    <li><a class="dropdown-item small" href="{{route('landlord.account.security')}}">Account and Security</a></li>
                    <li><a class="dropdown-item small" href="{{route('landlord.account.billing')}}">Billing</a></li>
                    <li><a class="dropdown-item small" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                            Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>