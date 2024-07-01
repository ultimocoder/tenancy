<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Billing</title>
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
            <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
            <h1><span id="title"></span></h1>
          </div>

          <div class="page-card mx-auto" style="width:500px;">

            <div class="form-group-1">
              <label for="">Account ID</label>
              <div class="dataValue">{{Auth::user()->unique_id}}</div>
            </div>

            <div class="form-group-1">
              <div class="dataValue">
                <span>Payment information</span>
                <a href="{{route('landlord.account.payment.info')}}" class="btn btn-xs btn-1"><i class="fa-regular fa-eye"></i> View</a>
              </div>
            </div>

            <div class="form-group-1">
              <div class="dataValue">
                <span>Subscription</span>
                <a href="{{route('landlord.account.subscription')}}" class="btn btn-xs btn-1"><i class="fa-regular fa-eye"></i> View</a>
              </div>
            </div>

            <div class="form-group-1">
              <div class="dataValue">
                <span>Invoice</span>
                <a href="{{route('landlord.account.invoice.list')}}" class="btn btn-xs btn-1"><i class="fa-regular fa-eye"></i> View</a>
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