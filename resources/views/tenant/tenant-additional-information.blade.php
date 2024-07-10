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
          @if(session()->has('message'))    
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
              <div class="col-sm-12">
                <div class="page-card">
                  <div class="title">
                    <div></div>
                   
                  </div>
                  <div class="row">
                    <div class="col-sm-3" style="width: 33%;">
                      <div class="data-box">
                          <div class="data-row"><label for="">Account number</label>
                            <div class="value">{{$tenant_info->unique_id}}</div>
                          </div>
                          <div class="data-row"><label for="">late Fee Amount</label>
                              <div class="value">${{$tenant_info->late_fee}}</div>
                          </div>
                          <div class="data-row"><label for="">Grace Period Days</label>
                              <div class="value">{{$tenant_info->grace_period_days}}</div>
                          </div>  
                          <div class="data-row"><label for="">Notes</label>
                                <div class="value">{{$tenant_info->notes}}</div>
                          </div>  
                      </div>
                  </div>   
                 <div class="col-sm-3" style="width: 33%;">
                    <div class="data-box">
                        <div class="data-row"><label for="">Number of Security Deposit</label>
                           <div class="value">{{$tenant_info->number_of_security_deposit}}</div>
                        </div>
                        <div class="data-row"><label for="">Total Security Deposit</label>
                            <div class="value">${{$tenant_info->total_security_deposit}}</div>
                        </div>
                        <div class="data-row"><label for="">Rent Due Date</label>
                            <div class="value">{{$tenant_info->rent_due_date}}</div>
                        </div>
                     </div>
                   </div>    
                     <div class="col-sm-3">
                     <div class="data-box"> 
                        <div class="data-row"><label for="">Pets</label>
                            <div class="value">{{$tenant_info->pets}}</div>
                        </div>
                        <div class="data-row"><label for="">Storage</label>
                            <div class="value">{{$tenant_info->storage}}</div>
                        </div>
                        <div class="data-row"><label for="">Parking</label>
                            <div class="value">{{$tenant_info->parking}}</div>
                        </div>
                      </div>
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