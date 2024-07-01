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
                        <h1><span id="title"></span> - Edit</h1>
                    </div>
                    @if(session()->has('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{route('landlord.account.payment.info.save')}}" method="post">
                        @csrf
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex">
                            <label for="" class="fw-semibold text-black-50 me-2">Account ID :</label>
                            <div class="dataValue fw-semibold">{{Auth::user()->unique_id}}</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center column-gap-3">
                            {{--<a href="{{route('landlord.account.payment.info')}}" class="btn btn-xs btn-3"><i class="fa-regular fa-delete-left"></i>Cancel</a>--}}
                            <a href="{{route('landlord.account.payment.info')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i>Back</a>

                            <button class="btn btn-xs btn-4"><i class="fa-solid fa-floppy-disk"></i>Confirm</button>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="page-card">
                                <div class="heading-2">Credit Card</div>
                                <!-- <div class="heading-2">Credit Card</div><a href="{{route('add.card')}}">Add Card</a> -->

                                <div class="form-group">
                                    <label for="">Cardholder Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Card Number</label>
                                    <input type="text" name="card_number" class="form-control" value="**** **** **** {{ $data['card']['last4'] }}">
                                </div>

                                <div class="row">
                                    <?php
                                        // $dateString = $data['card']['exp_month']."/".$data['card']['exp_year'];

                                        // // Split the month and year
                                        // list($month, $year) = explode('/', $dateString);

                                        // // Create a Carbon instance with the provided month and year
                                        // $date = \Carbon\Carbon::createFromDate($year, $month, 1);

                                        // // Format the date as "mm/yy"
                                        // $formattedDate = $date->format('m/y');
                                    ?>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="">Expiration Month</label>
                                            <input type="number" name="month" class="form-control" value="{{$data['card']['exp_month']}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Expiration Date</label>
                                            <input type="number" name="date" class="form-control" value="{{$data['card']['exp_year']}}" maxlength="4">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="">CVC</label>
                                            <input type="text" class="form-control" name="cvc" value="***" maxlength="3">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="page-card">

                                <div class="heading-2">Billing Address</div>

                                <div class="form-group">
                                    <label for="">Street Address</label>
                                    
                                    <input type="text" name="address" class="form-control" value="@if($data['billing_details']['address']['line1'] == '' || $data['billing_details']['address']['line1'] == null){{Auth::user()->address}}@else{{$data['billing_details']['address']['line1']}}@endif">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" name="city" class="form-control" value="@if($data['billing_details']['address']['city'] == '' || $data['billing_details']['address']['city'] == null){{Auth::user()->city}}@else{{$data['billing_details']['address']['city']}}@endif">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <input type="text" name="state" class="form-control" value="@if($data['billing_details']['address']['state'] == '' || $data['billing_details']['address']['state'] == null){{Auth::user()->state}}@else{{$data['billing_details']['address']['state']}}@endif">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <select name="country" class="form-control" id="">
                                                @foreach($countries as $c)
                                                <option value="{{$c->iso}}" @if($c->nicename == Auth::user()->country) selected @endif>{{$c->nicename}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Postal Code</label>
                                            <input type="text" name="postal_code" class="form-control" value="@if($data['billing_details']['address']['postal_code'] == '' || $data['billing_details']['address']['postal_code'] == null){{Auth::user()->zipcode}}@else{{$data['billing_details']['address']['postal_code']}}@endif">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    </form>

                    <!-- <div class="text-end">
                        <div class="d-inline-flex align-items-center column-gap-3">
                            <button type="submit" class="btn btn-success">Send</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </div> -->
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>

</html>