@extends('front_layouts.master')

    @section('title' , 'Tenancy')

@section('main-content')

<body class="underpage bg-main">

@include('front_layouts.navbar')

    <div class="section">
        <div class="container">
            <h1 class="bg-white p-5 text-center rounded-4 mb-4"><i class="fa-solid fa-circle-check text-success"></i> Payment Successful!</h1>
            <div class="bg-white p-5 rounded-4 text-center lh-lg">

                <div class="mb-4"><img src="images/payment-successful.png" width="200" alt=""></div>

                <!-- <h1 class="display-3 fw-bold text-success">$100.00</h1> -->

                 <h4 class="lh-lg">Thank you!<br>
                Your payment has been processed successfully!<br>
                Click to login below</h4>
                <!-- <p class="fw-semibold">Payment ID: 12345678, 28 Feb, 2024-11:50 AM</p> -->

                

                <!-- <div class="text-black-50 mb-5">Please contact us at (XXX) XXX-XXXX or email to care@tenants.bc.ca for ant query.</div> -->

                <a href="{{url('/login')}}" class="btn btn-rounded-outline">Login</a>
            </div>
        </div>
    </div>

    @include('front_layouts.footer')

  @endsection