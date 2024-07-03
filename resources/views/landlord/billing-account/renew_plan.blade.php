<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Plan</title>
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
                        <a href="{{route('landlord.account.subscription.info', $subscription->subscription_id)}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                    </div>
                </div>
                @if(session()->has('error'))    
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif 

                    <div class="d-flex">
                        <label for="" class="fw-semibold text-black-50 me-2">Account ID :</label>
                        <div class="dataValue fw-semibold">{{Auth::user()->unique_id}}</div>
                    </div>

                    <hr class="opacity-10">

                    <div>
                        <div class="heading-2">Current plan (Canceled)</div>
                        <div class="fw-semibold">@if($package->package_id == 1) Single Unit @elseif($package->package_id == 2) Multi Unit @else Commercial @endif - {{$subscription->quantity}} registered unit ${{number_format($subscription->amount,2)}} ({{$package->schedule_type}}) </div>
                    </div>

                    <hr class="opacity-10">

                    <div class="container mx-0 account-plans">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <div class="starter">
                                    <div class="top">
                                        <div class="fs-24 fw-bold">Base Price</div>
                                        <div class="fw-bold">$25 per added unit</div>
                                        <div class="fw-bold">20% discount with 3 units or more</div>
                                    </div>

                                    <ul class="list-unstyled mb-0">
                                        <li class="px-3 border-bottom fw-semibold">Tenant Management</li>
                                        <li class="px-3 border-bottom fw-semibold">Lease notifications</li>
                                        <li class="px-3 border-bottom fw-semibold">Massaging platform</li>
                                        <li class="px-3 border-bottom fw-semibold">Reporting</li>
                                        <li class="px-3 border-bottom fw-semibold">Document Management</li>
                                        <li class="px-3 border-bottom fw-semibold">Property Management</li>
                                        <li class="px-3 border-bottom fw-semibold">Expense Tracking</li>
                                        <li class="px-3 border-bottom fw-semibold">24/7 Customer Support</li>
                                    </ul>
                                </div>
                            </div>
                            @if(count($packageLists) > 0)
                            @foreach($packageLists as $item)
                            <div class="col-sm-3">
                                <div class="account-plan">
                                    <input type="radio" name="plan" class="package" id="plan{{$item->id}}" data-id="{{$item->id}}" data-uid="{{$item->min_qty}}" @if($item->id == 1) checked @endif>
                                    <label for="plan{{$item->id}}">
                                        <div>

                                            <div class="current fw-bold fs-18">Selected plan</div>
                                        
                                            <div class="name fw-bold fs-18">{{$item->package_name}}</div>
                                            <div class="price">${{$item->package_price}}</div>
                                            <input type="hidden" name="amount" id="amount" value="{{$item->package_price}}">
                                            <div class="fw-bold fs-18">per month</div>
                                        </div>
                                        @if($item->id == $package->package_id)
                                        <div class="button">Keep</div>
                                        @else
                                        <div class="button">Select</div>
                                        @endif
                                        <ul class="list-unstyled border mb-0">
                                            <li class="px-3 border-bottom fw-semibold fs-22"><i class="fa-solid fa-check text-color-9"></i></li>
                                            <li class="px-3 border-bottom fw-semibold fs-22"><i class="fa-solid fa-check text-color-9"></i></li>
                                            <li class="px-3 border-bottom fw-semibold fs-22"><i class="fa-solid fa-check text-color-9"></i></li>
                                            <li class="px-3 border-bottom fw-semibold fs-22"><i class="fa-solid fa-check text-color-9"></i></li>
                                            <li class="px-3 border-bottom fw-semibold fs-22"><i class="fa-solid fa-check text-color-9"></i></li>
                                            <li class="px-3 border-bottom fw-semibold fs-22"><i class="fa-solid fa-check text-color-9"></i></li>
                                            <li class="px-3 border-bottom fw-semibold fs-22"><i class="fa-solid fa-check text-color-9"></i></li>
                                            <li class="px-3 fw-semibold fs-22"><i class="fa-solid fa-check text-color-9"></i></li>
                                        </ul>
                                        <div class="select-unit">
                                        <div class="unit-text fw-bold"># of Units</div>
                                        <div class="no-unit">
                                            <div onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus">-</div>
                                            <input type="number" class="currentUnit" value="{{$item->min_qty}}" min="{{$item->min_qty}}" max="{{$item->max_qty}}">
                                            <div onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus">+</div>
                                        </div>
                                    </div>
                                    </label>
    
                                    
                                    
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <input type="hidden" name="unit" id="unit" value="{{$subscription->quantity}}">
                        <input type="hidden" name="package_id" id="package_id" value="{{$package->package_id}}">
                        <input type="hidden" name="finalAmount" id="finalAmount" value="{{$subscription->amount}}">
                        <input type="hidden" name="temp" id="temp" value="no">
                        <div class="mb-3">
                            Select plans start at the lowest number of units form the plan selected. You can add more units to your selected plan by using the toggle above.<br>
                            Receive a 20% discount on your monthly plan when adding 3 units or more.
                        </div>
                        <div class="text-center">
                            <div class="d-inline-flex column-gap-3">
                                <a href="{{route('landlord.account.subscription.info', $subscription->subscription_id)}}" class="btn btn-danger">Cancel</a>
                                <a href="javascript:void(0);" id="next" class="btn btn-success">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>

<script>
    $(function(){
        $('.package').on('change', function(){
            var packid = $(this).data('id');
            var unitnum = $(this).data('uid');
            var unit = $('#unit').val();
            var temp = $('#temp').val();

            $('#package_id').val(packid);
            if(temp == 'yes'){
                $('#unit').val(unit);
            }else{
                $('#unit').val(unitnum);

            }
            


        });

        $('#next').on('click', function(){
            var pid = $('#package_id').val();
            var unit = $('#unit').val();

            //var url = '/user-sign-up/'+unit+'/'+pid;
            var url = '/tenancy/public/landlord/account/subscription/subscription-renew-billing-cycle/'+unit+'/'+pid;
            location.href = url;
        });

        var discount;
        var totalPrice;
        //alert(amount);
        $('.plus').click(function(){
            var current_unit = $(this).closest('div.no-unit').find('.currentUnit').val();
            if(current_unit >= 2 || current_unit <= 4 ){
                var totalPrice = current_unit * 25;
                //alert(totalPrice);
                if(current_unit > 1){
                    var discount  = (totalPrice * 20 ) / 100 ;
                    totalPrice -= discount;
                }
                var discount  = 0 ;
                totalPrice -= discount;
                $(this).closest('div.account-plan').find('.price').text('$'+totalPrice);
                $(this).closest('div.account-plan').find('#amount').val(totalPrice);
                $('#finalAmount').val(totalPrice);
                $('#unit').val(current_unit);
                $("#temp").val('yes');

            }      
        });

        $('.minus').click(function(){
            var current_unit = $(this).closest('div.no-unit').find('.currentUnit').val();
            //alert(current_unit);
            if(current_unit == 2){
                var totalPrice = current_unit * 25;
                $(this).closest('div.account-plan').find('.price').text('$'+totalPrice);
                $(this).closest('div.account-plan').find('#amount').val(totalPrice);
                $('#finalAmount').val(totalPrice);
                $('#unit').val(current_unit);
            }else if(current_unit >= 2){
                var totalPrice = current_unit * 25;
                //alert(totalPrice);
                var discount  = (totalPrice * 20 ) / 100 ;
                totalPrice -= discount;
                $(this).closest('div.account-plan').find('.price').text('$'+totalPrice);
                $(this).closest('div.account-plan').find('#amount').val(totalPrice);
                $('#finalAmount').val(totalPrice);
                $('#unit').val(current_unit);
            }else{
                var totalPrice = current_unit * 25;
                $(this).closest('div.account-plan').find('.price').text('$'+totalPrice);
                $('#finalAmount').val(totalPrice);
                $('#unit').val(current_unit);
            }
           
        });

    })
</script>
</html>