<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Account and Security</title>
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
            @if(session()->has('message'))    
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

          <div class="page-card mx-auto" style="width:500px;">

            <div class="form-group-1">
              <label for="">Account ID</label>
              <!-- <div class="dataValue">4785456465248654684</div> -->
              <div class="dataValue">{{Auth::user()->unique_id}}</div>
            </div>

            <div class="heading-2">Login Info</div>

            <div class="form-group-1">
              <label for="">User name</label>
              <div class="dataValue">
                <span>{{Auth::user()->username}}</span>
                <a href="{{route('landlord.account.username.change')}}" class="btn btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
              </div>
            </div>

            <div class="form-group-1">
              <label for="">Password</label>
              <div class="dataValue">
                <span>*****************</span>
                <a href="{{route('landlord.account.password.change')}}" class="btn btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
              </div>
            </div>

            <div class="form-group-1">
              <label for="">Email</label>
              <div class="dataValue">
                <span>{{Auth::user()->email}}</span>
                <a href="#" class="btn btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
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