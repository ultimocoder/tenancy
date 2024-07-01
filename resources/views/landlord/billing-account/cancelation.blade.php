<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm your cancelation</title>
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
                            <a href="{{route('landlord.account.subscription.info',$subscription->subscription_id)}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                        </div>
                    </div>
                    
                    @if(session()->has('message'))    
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="page-card mx-auto" style="width:500px;" method="post" action="{{route('landlord.account.subscription.cancelation.post')}}">
                        @csrf
                        <div>
                            <div class="text-black-50 fs-14 fw-semibold mb-4">If you cancel your tenancy subscription, it will be taken offline immediately.</div>
                            <div class="fs-16 fw-semibold fs-14">All data will be permanently lost.</div>
                        </div>

                        <hr class="my-0 opacity-10">

                        <div class="box-style-1">
                            <div class="heading-2">summary</div>
                            <div class="mb-2">
                                <div class="fs-16 fw-semibold">@if($package->package_id == 1) Single Unit @elseif($package->package_id == 2) Multi Unit @else Commercial @endif plan</div>
                                <div class="text-black-50 fs-14 fw-semibold">Renews on {{$nextDueDate}} for ${{number_format($subscription->amount,2)}} {{$package->schedule_type}} plus applicable taxes </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-bottom border-top py-2">
                                <div class="fs-16 fw-semibold">Total Refund</div>
                                <div class="fs-16 fw-semibold">$0.00</div>
                            </div>
                        </div>



                        <div class="text-center">
                            @if($subscription->current_status != 'canceled')
                            <button class="btn btn-2">Confirm Cancelation</button>
                            @else
                            <span class="text-danger fw-bold">Subscription Already Canceled</span>
                            @endif
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