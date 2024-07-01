<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Information</title>
    @include('landlord_layouts.header')
</head>

<body>
    <div class="admin-container">
        @include('landlord_layouts.navbar')
        <div class="rightside">
            <div class="top">
                @include('landlord_layouts.topbar')
                <div class="page">
                    <div class="page-title">
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <a href="#">Billing</a> / <span id="activepage"></span></div>
                        <h1><span id="title"></span></h1>
                    </div>
                    @if(session()->has('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{route('landlord.account.payment.info.save')}}" method="post">@csrf
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex">
                            <label for="" class="fw-semibold text-black-50 me-2">Account ID :</label>
                            <div class="dataValue fw-semibold">{{Auth::user()->unique_id}}</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center column-gap-3">
                            <a href="{{route('landlord.account.billing')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i>Back</a>
                            {{--<a href="{{route('landlord.account.payment.edit')}}" class="btn btn-xs btn-5"><i class="fa-solid fa-pen-to-square"></i>Edit</a>--}}
                            <button class="btn btn-xs btn-5"><i class="fa-solid fa-floppy-disk"></i>Edit</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="page-card">

                                <div class="heading-2">Credit Card</div>

                                <div class="form-group-1">
                                    <label for="">Cardholder Name</label>
                                    <div class="dataValue">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</div>
                                </div>

                                <div class="form-group-1">
                                    <label for="">Card Number</label>
                                    <div class="dataValue">**** **** **** {{ $data['card']['last4'] }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group-1">
                                            <label for="">Expiration Month</label>
                                            <?php
                                                $dateString = $data['card']['exp_month']."/".$data['card']['exp_year'];

                                                // Split the month and year
                                                list($month, $year) = explode('/', $dateString);

                                                // Create a Carbon instance with the provided month and year
                                                $date = \Carbon\Carbon::createFromDate($year, $month, 1);

                                                // Format the date as "mm/yy"
                                                $formattedDate = $date->format('m/y');
                                            ?>
                                            <div class="dataValue">{{$data['card']['exp_month']}}</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3"><div class="form-group-1">
                                    <label for="">Expiration Year</label>
                                    <div class="dataValue">{{$data['card']['exp_year']}}</div>
                                    </div></div>
                                    <div class="col-sm-4">
                                        <div class="form-group-1">
                                            <label for="">CVC</label>
                                            <div class="dataValue">***</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="page-card">

                                <div class="heading-2">Billing Address</div>

                                <div class="form-group-1">
                                    <label for="">Street Address</label>
                                    <div class="dataValue">{{Auth::user()->address}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group-1">
                                            <label for="">City</label>
                                            <div class="dataValue">{{Auth::user()->city}}</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group-1">
                                            <label for="">State</label>
                                            <div class="dataValue">{{Auth::user()->state}}</div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group-1">
                                            <label for="">Country</label>
                                            <div class="dataValue">{{Auth::user()->country}}</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group-1">
                                            <label for="">Postal Code</label>
                                            <div class="dataValue">{{Auth::user()->zipcode}}</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="name" class="form-control" value="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}">

                    <input type="hidden" name="address" class="form-control" value="@if($data['billing_details']['address']['line1'] == '' || $data['billing_details']['address']['line1'] == null){{Auth::user()->address}}@else{{$data['billing_details']['address']['line1']}}@endif">
                    <input type="hidden" name="city" class="form-control" value="@if($data['billing_details']['address']['city'] == '' || $data['billing_details']['address']['city'] == null){{Auth::user()->city}}@else{{$data['billing_details']['address']['city']}}@endif">

                    <input type="hidden" name="state" class="form-control" value="@if($data['billing_details']['address']['state'] == '' || $data['billing_details']['address']['state'] == null){{Auth::user()->state}}@else{{$data['billing_details']['address']['state']}}@endif">
                    <input type="hidden" name="country" class="form-control" value="{{Auth::user()->country}}">
                    
                    <input type="hidden" name="postal_code" class="form-control" value="@if($data['billing_details']['address']['postal_code'] == '' || $data['billing_details']['address']['postal_code'] == null){{Auth::user()->zipcode}}@else{{$data['billing_details']['address']['postal_code']}}@endif">


                    </form>


                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>

</html>