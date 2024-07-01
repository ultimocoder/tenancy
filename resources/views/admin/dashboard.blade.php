<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search</title>
  @include ('admin_layout.header');
</head>

<body>
  <div class="admin-container">
      @include('admin_layout.leftbar')
    <div class="rightside">
      <div class="top">
       @include ('admin_layout.navbar')      
        <div class="page">
          <div class="page-title">
            <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span></div>
            <h1><span id="title"></span></h1>
          </div>
          <!--@if (session('success'))-->
          <!--              <div class="alert alert-success" role="alert">-->
          <!--                  {{ session('success') }}-->
          <!--              </div>-->
          <!--          @endif-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4 mx-auto">
                <div class="page-card">
                  <div class="title">
                    Search Tenant
                    <a href="#" class="btn btn-1">New Tanant</a>
                  </div>
                  <div class="form-group">
                    <label for="">First name</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Enter first name">
                  </div>
                  <div class="form-group">
                    <label for="">Last name</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Enter last name">
                  </div>
                  <div class="form-group">
                    <label for="">Street address</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Enter street address">
                  </div>
                  <div class="d-grid">
                    <button class="btn btn-1 btn-lg">Search</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include ('admin_layout.footer')
    </div>
  </div>
@include ('admin_layout.script');
</body>
</html>