<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Subscriptions</title>
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
                      <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <a href="#">Billing</a> / <span id="activepage"></span></div>
                      <h1><span id="title"></span></h1>
                  </div>
                  <a href="{{route('landlord.account.billing')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
              </div>
          </div>
            @if(session()->has('message'))    
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
          <div class="page-card mx-auto row-gap-20" style="width:500px;">

            <div class="form-group-1">
              <label for="">Account ID</label>
              <div class="dataValue">{{Auth::user()->unique_id}}</div>
            </div>

            <div class="heading-2">Manage the subscription tied to your account.</div>

            <div class="form-group-1">
              <label for="" class="mb-2">Active subscriptions</label>
              <div class="dataValue border-top mb-2">
                <a href="{{route('landlord.account.subscription.info', $subscription->subscription_id)}}" class="d-flex justify-content-between align-items-center w-100">
                  <div class="text-color-10">
                    <span>@if($package->package_id == 1) Single Unit @elseif($package->package_id == 2) Multi Unit @else Commercial @endif  subscription</span>
                    @if($subscription->current_status == 'active')
                    <div class="fs-12 fw-semibold text-black-50">Renews on {{$nextDueDate}} for ${{number_format($subscription->amount,2)}} {{$package->schedule_type}} plus applicable taxes.</div>
                    @else
                    <div class="fs-12 fw-semibold text-black-50">Subscription canceled</div>
                    @endif
                    
                  </div>
                  <i class="fa-solid fa-chevron-right text-dark"></i>
                </a>
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

</html>