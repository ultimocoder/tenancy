<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subscription Billing</title>
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
                        <a href="{{route('landlord.account.subscription')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                    </div>
                </div>
                <div class="alert alert-danger " id="msg" style="display:none;"></div>
                    <div class="page-card mx-auto" style="width:600px;">

                        <div class="form-group-1">
                            <label for="">Account ID</label>
                            <div class="dataValue">{{Auth::user()->unique_id}}</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group-1">
                                    <label for="">Registered Units</label>
                                    <div class="dataValue mb-2">
                                        <span>{{$sub->quantity}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group-1">
                                    <label for="">Member since</label>
                                    <div class="dataValue mb-2">
                                        <span>
                                       
                                        {{  date_format($subscription->created_at, "M d, Y")}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="heading-2">Payment</div>

                        <div class="form-group-1">
                            <label for="">Card Number</label>
                            <div class="dataValue mb-2">
                                <span>**** **** **** {{$data['card']['last4']}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group-1">
                                    <label for="">Next Payment</label>
                                    <div class="dataValue mb-2">
                                    @if($subscription->current_status == 'active')
                                        <span>${{number_format($subscription->amount,2)}}</span>
                                    @else
                                    <span>-</span>
                                    
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group-1">
                                    <label for="">Payment Due</label>
                                    @if($subscription->current_status == 'active')
                                    <div class="dataValue mb-2">
                                        <span>{{$nextDueDate}}</span>
                                    </div>
                                    @else
                                    <div class="dataValue mb-2">
                                        <span>-</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="heading-2">Plan</div>

                        <div class="form-group-1">
                            <label for="">Current Plan</label>
                            <div class="dataValue mb-2">
                                <span>@if($package->package_id == 1) Single Unit @elseif($package->package_id == 2) Multi Unit @else Commercial @endif Plan
                                    <div class="fs-13 fw-semibold text-black-50">Paid {{$package->schedule_type}}</div>
                                </span>
                                @if($subscription->current_status == 'active')
                                <a href="{{route('landlord.account.subscription.change.plan')}}" class="btn btn-xs btn-2">Change</a>
                                @else
                                <a href="{{route('landlord.account.subscription.renew.plan')}}" class="btn btn-xs btn-2">Renew</a>
                                @endif
                            </div>
                        </div>

                        
                        @if($subscription->current_status != 'canceled')
                        <div class="form-check form-switch mb-0 mh-auto">
                            <input class="form-check-input toggle-class" type="checkbox" role="switch" id="flexSwitchCheckChecked" data-status="{{ $subscription->invoice_status }}" @if($subscription->invoice_status == 'active') checked @endif>
                            <label class="form-check-label mb-0" for="flexSwitchCheckChecked">Renew Automatically</label>
                        </div>
                        <div><a href="{{route('landlord.account.subscription.cancelation')}}" class="btn btn-sm btn-danger">Cancel Subscription</a></div>

                        @else
                        <div><span class="text-danger fw-bold"><h4>Subscription Canceled</h4></span></div>

                        @endif
                        
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')

    <script>
        $(function(){
            $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var invoice_status = $(this).data('status'); 
            // alert(status);
            // alert(invoice_status);
            
            $.ajax({
                type: "post",
                dataType: "json",
                url: '{{route("landlord.account.subscription.changeStatus")}}',
                data: {'status': status, 'invoice_status': invoice_status, '_token': "{{csrf_token()}}" },
                success: function(data){
                console.log(data.message)
                    if(status)
                    {
                        $("#msg").html(data.message);
                    }else{
                        $("#msg").html(data.message);
                    }
                    $("#msg").show();
                    $("#msg").fadeOut(3000);
                    // setTimeout(function() {
                    //     location.reload();
                    //         }, 3000);
                        }
            });
        });

        })
    </script>

</body>

</html>