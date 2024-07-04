<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  @include('tenant_layouts.header')
</head>

<body>
  <div class="admin-container">
  @include('tenant_layouts.navbar')
    <div class="rightside">
      <div class="top">
        
      @include('tenant_layouts.topbar')        
        <div class="page">
          <div class="page-title">
         
            <h1><span id="title"></span>  -{{ucfirst(auth::user()->username)}}:{{auth::user()->unique_id}} </h1>
          </div>
          
          <div class="mx-auto" style="width:500px;">
          </div>
            
        </div>
      </div>
      @include('tenant_layouts.footer')
    </div>
  </div>
  @include('tenant_layouts.script')
</body>
</html>