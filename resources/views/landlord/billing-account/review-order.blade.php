<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review Order</title>
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
                <div class="withButton">
                        <div>
                            <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
                            <h1><span id="title"></span></h1>
                        </div>
                        <a href="{{route('billing.cycle' , [$unit,$pid])}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                    </div>
                </div>
                    <form class="page-card mx-auto" action="{{route('landlord.account.subscription.update')}}" method="post">
                        @csrf
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-sm-8">
                                <div class="page-card">
                                    <div class="fw-semibold">Your subscription changes will take effect immediately</div>
                                    <div class="box-style-1">
                                        <div class="heading-2">Your Cart</div>
                                        <input type="hidden" name="unit" id="unit" value="{{$unit}}">
                                        <input type="hidden" name="pid" id="pid" value="{{$pid}}">
                                        <input type="hidden" name="cycle" id="cycle" value="{{$cycle}}">
                                        <?php
                                        // Get the current month and year
                                        $currentMonth = date('n'); // Numeric representation of a month, without leading zeros (1 through 12)
                                        $currentYear = date('Y');  // A full numeric representation of a year, 4 digits (e.g., 2024)

                                        // Calculate the number of days in the current month
                                        $daysInCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

                                        // echo "Current Month: $currentMonth<br>";
                                        // echo "Number of days in current month: $daysInCurrentMonth<br>";
                                        //$remaining_days;
                                        ?>
                                        <?php  
                                            if($unit >2 ) 
                                                $discount = ((25 * $unit) * 20)/100;
                                            else
                                                $discount = 0;

                                                $current_amount = (((number_format(((25 * $unit) - $discount), 2) - $subscription->amount)/$daysInCurrentMonth) * $remaining_days)   
                                        ?>
                                        
                                        <br>
                                       
                                        <div>
                                            <div class="fw-semibold">@if($pid == 1) Single Unit @elseif($pid == 2) Multi Unit @else Commercial @endif plan</div>
                                            <div class="fs-14 fw-semibold text-black-50">Pay <?php if($cycle == ' yearly' || $cycle == 'yearly'){echo "$".number_format(((25 * $unit) - $discount) * 12, 2) ;}else{ echo "$".number_format(((25 * $unit) - $discount), 2) ;} ?> {{$cycle}} + application taxes</div>
                                            {{--<div class="fs-14 fw-semibold text-black-50">Pay @if($cycle == 'monthly' || $cycle == ' monthly')  ${{$finalCost}}  @else ${{$finalCost}}  @endif {{$cycle}} + application taxes</div>--}}
                                        </div>
                                    </div>
                                    <div class="box-style-1">
                                        <div class="heading-2">Billing address</div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fw-semibold">{{Auth::user()->address}}, {{Auth::user()->city}}, {{Auth::user()->state}} {{Auth::user()->zipcode}}, {{Auth::user()->country}}</div>
                                            <!-- <a href="#" class="btn btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i>Edit</a> -->
                                        </div>
                                    </div>
                                    <div class="box-style-1">
                                        <div class="heading-2">Payment</div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center column-gap-4">
                                                <img src="images/visa.png" alt="">
                                                <div class="fw-semibold">**** **** **** <?php $json =  (json_decode(Auth::user()->card_detail,true)); echo $json['last4'] ?></div>
                                            </div>
                                            <!-- <a href="#" class="btn btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i>Edit</a> -->
                                        </div>
                                    </div>
                                    <!-- <div class="box-style-1">
                                        <div class="heading-2">Promo Code</div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input type="text" name="" id="" class="border-0 fs-16 w-75" placeholder="Add Code">
                                            <a href="" class="btn btn-xs btn-2"><i class="fa-regular fa-square-check"></i>Apply</a>
                                        </div>
                                    </div> -->
                                    <div class="text-black-50">
                                        <b>By clicking, confirm, you agree:</b><br>
                                        To ensure uninterrupted service, your subscription will be set to continuous auto-renewal payments of <?php if($cycle == ' yearly' || $cycle == 'yearly'){echo "$".number_format(((25 * $unit) - $discount) * 12, 0) ;}else{ echo "$".number_format(((25 * $unit) - $discount), 0) ;} ?> per <?php if($cycle == ' yearly' || $cycle == 'yearly'){echo 'year';}else{ echo "month";} ?> (plus applicable taxes),
                                        with your next payment due on {{$nextDueDateByFormat}}. This means you authorize us to take this amount from your account each <?php if($cycle == ' yearly' || $cycle == 'yearly'){echo 'year';}else{ echo "month";} ?>.
                                        You can cancel your subscription or disable auto-renewal at any time from your billing panel, or by contacting <a href="#" class="text-dark text-decoration-underline">Customer Service</a>.
                                        You also agreed to our <a href="#" class="text-dark text-decoration-underline">Terms of Service</a> and confirm that you have read and understood
                                        our <a href="#" class="text-dark text-decoration-underline">Privacy Policy</a>.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="page-card">
                                    <div class="fs-20 fw-semibold">Order Summary</div>
                                    <table class="table fs-16">
                                        <tr><td>@if($pid == 1) Single Unit @elseif($pid == 2) Multi Unit @else Commercial @endif plan</td><td class="text-end">@if($cycle == 'monthly' || $cycle == ' monthly')  ${{$finalCost}}  @else ${{$finalCost}}  @endif</td></tr>
                                        <tr><td>Subtotal</td><td class="text-end">@if($cycle == 'monthly' || $cycle == ' monthly')  ${{$finalCost}}  @else ${{$finalCost}}  @endif</td></tr>
                                        <tr><td>Sales Tax</td><td class="text-end">$0.00</td></tr>
                                        <tr><td class="fs-20 fw-semibold">Due Today</td><td class="text-end fs-20 fw-semibold">@if($cycle == 'monthly')  ${{$finalCost}}  @else ${{$finalCost}}  @endif</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-2">Confirm Payment</button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>

</html>