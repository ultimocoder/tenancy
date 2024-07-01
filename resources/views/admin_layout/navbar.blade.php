<div class="topbar">
    <div class="left">
      
       
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
                    <img src="{{asset('images/user-profile-pic.png')}}" alt="">
                    Welcome <b class="ms-1">Admin</b>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="admin-profile">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Payment Account</a></li>
                    <li><a class="dropdown-item" href="#">Account and Security Billing</a></li>
                    <li><a class="dropdown-item" href="{{url('logout')}}"> Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
