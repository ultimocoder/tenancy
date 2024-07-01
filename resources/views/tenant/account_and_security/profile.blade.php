<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    @include('tenant_layouts.header')
</head>

<body>
    <div class="admin-container">
    @include('tenant_layouts.navbar')
        <div class="rightside">
            <div class="top">
            @include('tenant_layouts.topbar')
                <div class="page">
                    <div class="page-title">
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
                        <h1><span id="title"></span></h1>
                    </div>
                    @if(session()->has('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="page-card">
                                    @if(Auth::user()->image)
                                    <div class="profile-pic">
                                        <img src="{{ asset('landlord/profile/'.Auth::user()->image)}}" alt="">
                                    </div>
                                    @else
                                    <div class="profile-pic">
                                        <img src="{{ asset('landlord/images/user-profile-pic.png')}}" alt="">
                                    </div>
                                    @endif

                                    <div class="form-group-1">
                                        <label for="">User name</label>
                                        <div class="dataValue">
                                            <span>{{Auth::user()->username}}</span>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group-1">
                                        <label for="">Password</label>
                                        <div class="dataValue">
                                            <span>*****************</span>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="page-card">

                                    <div class="form-group-1">
                                        <label for="">Account ID</label>
                                        <div class="dataValue">{{Auth::user()->unique_id}}</div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div class="heading-2">Personal Information</div>
                                        <a href="{{route('tenant.profile.edit')}}" class="btn btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group-1">
                                                <label for="">First name</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->first_name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group-1">
                                                <label for="">Last name</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->last_name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group-1">
                                                <label for="">Phone</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->phone}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group-1">
                                                <label for="">Email</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="form-group-1">
                                                <label for="">Address</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->address}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group-1">
                                                <label for="">Zipcode</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->zipcode}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group-1">
                                                <label for="">City</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->city}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group-1">
                                                <label for="">State</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->state}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group-1">
                                                <label for="">Country</label>
                                                <div class="dataValue">
                                                    <span>{{Auth::user()->country}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @include('tenant_layouts.footer')
        </div>
    </div>
    @include('tenant_layouts.script')
</body>

</html>