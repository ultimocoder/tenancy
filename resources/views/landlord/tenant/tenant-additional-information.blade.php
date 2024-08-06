<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Additional Information</title>
  @include('landlord_layouts.header')
</head>

<body>
  <div class="admin-container">
    @include('landlord_layouts.navbar')
    <div class="rightside">
      <div class="top">
        @include('landlord_layouts.topbar')

      <div class="tab-buttons">
        
        @if(isset($popups))  
          @if(count($popups) > 0)
            @foreach($popups as $tenant)

            <div class="btn-tab-button @if(session('tenant_id') == $tenant->tenant_id) active @endif">
              
              @if(session('tenant_id') != $tenant->tenant_id)
              <i class="fa-solid fa-xmark remove cursor-pointer" data-tid="no" data-id="{{$tenant->tenant_id}}"></i>
              @endif
              @if(count($popups) == 1)
                <i class="fa-solid fa-xmark remove cursor-pointer" data-tid="yes" data-id="{{$tenant->tenant_id}}"></i>
              @endif
              <a href="{{route('landlord.tenant-additional-information', $tenant->tenant_id)}}">{{$tenant->unique_id}}</a>
            </div>
            @endforeach
          @endif
        @endif
      </div>

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
                    @if($tenant_info->rental_status != 'Expired')
                    <div class="d-flex column-gap-3">
                      <a href="{{route('landlord.tenant.additional.edit', $tenant_info->user_id)}}" class="btn-xs btn-1"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                    </div>
                    @endif
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="data-box">
                        <div class="data-row"><label for="">Account number</label>
                          <div class="value fw-bold">{{$tenant_info->unique_id}}</div>
                        </div>
                        <div class="data-row"><label for="">Late Fee Amount</label>
                          <div class="value">${{$tenant_info->late_fee}}</div>
                        </div>
                        <div class="data-row"><label for="">Grace Period Days</label>
                          <div class="value">{{$tenant_info->grace_period_days}}</div>
                        </div>
                        <div class="data-row"><label for="">Number of Security Deposit</label>
                          <div class="value">{{$tenant_info->number_of_security_deposit}}</div>
                        </div>
                        <div class="data-row"><label for="">Total Security Deposit</label>
                          <div class="value">${{$tenant_info->total_security_deposit}}</div>
                        </div>
                        <div class="data-row"><label for="">Rent Due Date</label>
                          <div class="value">@if($tenant_info->rent_due_date){{date('m/d/Y',strtotime($tenant_info->rent_due_date))}} @endif</div>
                        </div>
                        <div class="data-row"><label for="">Secondary Tenant First Name</label>
                          <div class="value">{{$tenant_info->secondary_first_name}}</div>
                        </div>
                         <div class="data-row"><label for="">Secondary Tenant Last Name</label>
                          <div class="value">{{$tenant_info->secondary_last_name}}</div>
                        </div>
                        <div class="data-row"><label for="">Pets</label>
                          <div class="value">{{$tenant_info->pets}}</div>
                        </div>
                        <div class="data-row"><label for="">Storage</label>
                          <div class="value">{{$tenant_info->storage}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="data-box">
                        <div class="data-row"><label for="">Parking</label>
                          <div class="value">{{$tenant_info->parking}}</div>
                        </div>
                        <div class="data-row">
                          <div class="data-row"><label for="">Notes </label>
                            <div class="value">{{$tenant_info->notes}}</div>
                          </div>
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
      @include('landlord_layouts.footer')
    </div>
  </div>
  @include('landlord_layouts.script')
</body>

<script>
   jQuery(".tab-buttons").on('click', '.btn-tab-button', function() {
      jQuery(this).addClass("active").siblings().removeClass("active");
    });

$(function(){
  $('body').on('click','.remove', function(){
    
    var tenant_id = $(this).attr('data-id');
    tid = $(this).attr('data-tid');
      $.ajax({
              url: "{{route('landlord.tenant.session.delete')}}",
              type: 'DELETE',
              data: {
                  "id": tenant_id,
                  "_token": "{{ csrf_token() }}",
              },
              success: function (){
                //alert('done');
                if(tid == 'yes'){
                  window.location.href = "{{route('landlord.tenant.advanced.search')}}";
                }else{
                  $(".tab-buttons").load(location.href + " .tab-buttons");
                }
                  
                  
              }
          });
  });
});
</script>

</html>