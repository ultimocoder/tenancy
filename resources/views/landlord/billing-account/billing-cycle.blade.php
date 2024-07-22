<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Billing Cycle</title>
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
                        <a href="{{route('landlord.account.subscription.change.plan')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                    </div>
                </div>
                    
                    <form class="page-card mx-auto"  style="width:500px;">
                    
                        <div>
                            <div class="fs-16 fw-semibold">Select a billing cycle</div>
                            <div class="text-black-50 fs-14 fw-semibold">Select a new billing cycle or keep your current one.</div>
                        </div>

                        <hr class="my-0 opacity-10">

                        <div class="heading-2">Billing Cycle</div>

                        <div class="cus-radio-1">
                            <?php  
                            if($unit >2 ) 
                                $discount = ((25 * $unit) * 20)/100;
                            else
                                $discount = 0;

                            ?>
                            <input type="hidden" name="unit" id="unit" value="{{$unit}}">
                            <input type="hidden" name="pid" id="pid" value="{{$id}}">

                        @if($schedule->schedule_type == 'yearly')
                            <input type="radio" name="cycle" id="annually" @if($schedule->schedule_type == 'yearly') checked @endif>
                            <label for="annually" class="cycle" data-card="yearly">
                                <div>
                                    <div class="fs-16 fw-semibold">Pay annually @if($schedule->schedule_type == 'yearly') <span class="text-color-6">(current)</span>@endif </div>
                                   
                                    

                                    <div class="text-black-50 fs-14 fw-semibold mb-2">billed ${{number_format(((25 * $unit) - $discount) * 12, 2)}} annually + applicable taxes</div>
                                    <div class="fs-16 fw-semibold">You save $20 by paying annually</div>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </label>
                        @else    
                            <input type="radio" name="cycle" id="monthly" @if($schedule->schedule_type == 'monthly') checked @endif>
                            <label for="monthly" class="cycle" data-card="monthly">
                                <div>
                                
                                    <div class="fs-16 fw-semibold">Pay monthly @if($schedule->schedule_type == 'monthly') <span class="text-color-6">(current)</span>@endif </div> 
                                    <div class="text-black-50 fs-14 fw-semibold mb-2">billed ${{number_format(((25 * $unit) - $discount), 2)}} monthly + applicable taxes</div>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </label>
                        @endif    
                        </div>
                        <input type="hidden" id="billing-cycle" name="billing-cycle" value="@if($schedule->schedule_type == 'monthly') monthly @else yearly @endif">
                        <div class="text-center">
                            <a href="javascript:void(0);" id="next" class="btn btn-2">Next</a>
                        </div>

                    </form>

                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>


<script>
    $(function(){
        $('.cycle').on('click', function(){
            var status = $(this).data('card');

            $('#billing-cycle').val(status);
        });
        $('#next').on('click', function(){
            var unit = $('#unit').val();
            var pid = $('#pid').val();
            var cycle = $('#billing-cycle').val();
            //var url = '/user-sign-up/'+unit+'/'+pid;
            var url = '/landlord/account/subscription/review-order/'+unit+'/'+pid+'/'+cycle;
            location.href = url;
        });
    });
</script>

</html>
<!-- 
stripe.Subscription.modify(
    "sub_abc123",
    proration_behavior='always_invoice',
    items = [{
        "price": 'price_abc123'
    }],
    billing_cycle_anchor= 'now',
) -->