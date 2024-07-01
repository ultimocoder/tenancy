<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search</title>
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
            <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span></div>
            <h1><span id="title"></span></h1>
          </div>
          @if(session()->has('message'))    
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session()->get('message') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          <div class="mx-auto" style="width:500px;">
          <form action="{{route('landlord.tenant.dashboard.search')}}" method="post">
            <div class="page-card">
              <div class="title">
                Search Tenant
                <a href="{{route('landlord.new.tenant')}}" class="btn btn-1">New Tenant</a>
              </div>
              
              @csrf
              <div class="form-group">
                <label for="">First name</label>
                <input type="text" name="first_name" class="form-control form-control-lg" placeholder="Enter first name">
              </div>
              <div class="form-group">
                <label for="">Last name</label>
                <input type="text" name="last_name" class="form-control form-control-lg" placeholder="Enter last name">
              </div>
              <div class="form-group">
                <label for="">Street address</label>
                <input type="text" name="address" class="form-control form-control-lg" placeholder="Enter street address">
              </div>
              <div class="d-grid">
                <button class="btn btn-1 btn-lg">Search</button>
              </div>
              
            </div>
            </form>
          </div>
            
        </div>
      </div>
      @include('landlord_layouts.footer')
    </div>
  </div>
  @include('landlord_layouts.script')
</body>
</html>