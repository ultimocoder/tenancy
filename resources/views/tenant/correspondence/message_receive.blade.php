<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Message Receive</title>
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
            <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span></div>
            <h1><span id="title"></span> - Receive</h1>
          </div>

          <div class="page-card">
            <div class="title">
              New Message
              <div class="d-flex column-gap-3">
                <a href="{{route('tenant.tenant-Correspondence')}}" class="btn btn-xs btn-1"><i class="fa-solid fa-arrow-left-long"></i>Back</a>
                <a href="{{route('tenant.tenant-Correspondence-message-send')}}" class="btn btn-xs btn-2"><i class="fa-solid fa-reply"></i>Reply</a>
                <a href="#" class="btn btn-xs btn-3"><i class="fa-solid fa-trash-can"></i>Delete</a>
              </div>
            </div>
            <hr class="my-0">
            <div class="d-flex justify-content-between">
              <div>
                <div><b>To:</b> Management</div>
                <div><b>Form:</b> Amy Smith</div>
              </div>
              <div class="d-flex column-gap-3 text-center">
                <div>
                  <div><b>Status</b></div> <span class="badge text-bg-success">Closed</span>
                </div>
                <div>
                  <div><b>Matter</b></div><span class="badge text-bg-success">Closed</span>
                </div>
                <div>
                  <div><b>Priority!</b></div> <span class="badge text-bg-success">Low</span>
                </div>
              </div>
            </div>
            <hr class="my-0">
            <div class="d-flex justify-content-between">
              <div>
                <div><b>Subject:</b> Refrigerator water filter</div>
              </div>
              <div class="d-flex column-gap-3 text-center">
                <div>Tue, 16 Jan, 01:33</div>
              </div>
            </div>
            <div class="p-3 border bg-light rounded-3">
              <p>Hi Joe,</p>

              <p>The water filter in my Refrigerator needs replacing. The water is dispensing but it taste really bad. I think a new filter may resolves the problem.</p>

              Thank you,<br>
              Amy
            </div>
          </div>
        </div>
      </div>
      @include('tenant_layouts.footer')
    </div>
  </div>
  @include('tenant_layouts.script')
</body>

</html>