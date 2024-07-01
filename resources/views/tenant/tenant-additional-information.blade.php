<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Additional Information</title>
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
            <h1><span id="title"></span></h1>
          </div>
          @if (!empty($tenant_info))
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="page-card">
                  <div class="title">
                    <div></div>
                    <!-- <div class="d-flex column-gap-3">
                      <a href="{{route('landlord.tenant.additional.edit', $tenant_info->user_id)}}" class="btn-xs btn-1"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="data-box">
                        <div class="data-row"><label for="">Account number</label>
                          <div class="value">{{$tenant_info->unique_id}}</div>
                        </div>
                        <div class="data-row"><label for="">late Fee Amount</label>
                          <!-- <div class="value">$25.00</div> -->
                        </div>
                        <div class="data-row"><label for="">Grace Period Days</label>
                          <!-- <div class="value">10</div> -->
                        </div>
                        <div class="data-row"><label for="">Number of Security Deposit</label>
                          <!-- <div class="value">2</div> -->
                        </div>
                        <div class="data-row"><label for="">Total Security Deposit</label>
                          <!-- <div class="value">$3700.00</div> -->
                        </div>
                        <div class="data-row"><label for="">Rent Due Date</label>
                          <!-- <div class="value">1st</div> -->
                        </div>
                        <div class="data-row"><label for="">Pets</label>
                          <!-- <div class="value">No</div> -->
                        </div>
                        <div class="data-row"><label for="">Storage</label>
                          <!-- <div class="value">Yes</div> -->
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="data-box">
                        <div class="data-row"><label for="">Parking</label>
                          <!-- <div class="value">Yes</div> -->
                        </div>
                        <div class="data-row">
                          <!-- <b class="pe-1">Notes: </b> Other residents of this lease agreement are John Doe, Jane Doe -->
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4 text-end">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
      @include('tenant_layouts.footer')
    </div>
  </div>
  @include('tenant_layouts.script')
</body>

</html>