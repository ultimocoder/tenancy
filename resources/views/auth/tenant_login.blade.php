@extends('tenant_front_layouts.master')

    @section('title' , 'Tenant')

@section('main-content')

<body class="underpage bg-main">

@include('tenant_front_layouts.navbar')

    <div class="section pb-3">
        <div class="container">
            <form action="{{route('telantlogin')}}" method="post">
                @csrf
            <div class="row">
                <div class="col-sm-10 mx-auto">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ asset('images/login-img.png')}}" class="img-fluid mb-4 mb-sm-0" alt="">
                        </div>
                        <div class="col-sm-6">
                            <div class="new-form">
                                <a href="{{url('/')}}" class="logo text-black mb-3">
                                    <img src="{{asset('images/tenant_logo.svg')}}" alt="">
                                    Login 
                                </a>
                                <h2 class="heading-1 mb-2">Welcome Back!</h2>
                                <h3 class="heading-2 mb-4">Sign in to continue with Tenancy</h3>
                                <div class="box">
                                    <div>
                                        <label for="username Id">User name</label>
                                        <div class="icon-control">
                                            <i class="fa-regular fa-circle-user"></i>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Enter User name" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="User name">Password</label>
                                        <div class="icon-control">
                                            <i class="fa-regular fa-key"></i>
                                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center mb-2">
                                        <button class="btn-gradient w-100">Log In</button>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-6 text-sm-start"><a href="#" class="text-black-50"><i
                                                    class="fa-regular fa-lock me-2"></i>Forgot user name?</a></div>
                                        <div class="col-sm-6 text-sm-end"><a href="#" class="text-black-50"><i
                                                    class="fa-regular fa-lock me-2"></i>Forgot user password?</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

@include('tenant_front_layouts.footer')

@endsection