<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tenant Information</title>
  @include('tenant_layouts.header')
</head>
<style>
  .tag-red {
    background-color: red!important;
    color: #ffffff;
}
  </style>
<body>
  <div class="admin-container">
  @include('tenant_layouts.navbar')
  <div class="rightside">
      <div class="top">
      @include('tenant_layouts.topbar')
      
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
            <a href="{{route('landlord.tenant-information', $tenant->tenant_id)}}">{{$tenant->unique_id}}</a>
          </div>
          @endforeach
        @endif
        @endif
      </div>
      
      {{--<div class="tab-buttons">
          @if(isset($popups))  
          @if(count($popups) > 0)
              @foreach($popups as $tenant)

              <div class="btn-tab-button @if(session('tenant_id') == $tenant->tenant_id) active @endif">
                
                <i class="fa-solid fa-xmark remove cursor-pointer" data-id="{{$tenant->tenant_id}}"></i>
                
                <a href="{{route('landlord.tenant-information', $tenant->tenant_id)}}">{{$tenant->unique_id}}</a>
              </div>
              @endforeach
            @endif
            @endif
          </div>--}}
          
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
                    <div class="d-flex column-gap-3">
                      @if($tenant_info->status == true)
                      <a href="#" class="tag tag-green">Status: Active</a>
                      @else
                      <a href="#" class="tag tag-red text-red">Status: Inactive</a>

                      @endif
                      <a href="{{route('tenant.tenant.edit', $tenant_info->user_id)}}" class="btn-xs btn-1"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="data-box">
                        <div class="data-row"><label for="">Account number</label>
                          <div class="value fw-bold">{{$user->unique_id}}</div>
                        </div>
                        <div class="data-row"><label for="">First name</label>
                          <div class="value">{{$tenant_info->first_name}}</div>
                        </div>
                        <div class="data-row"><label for="">Last name</label>
                          <div class="value">{{$tenant_info->last_name}}</div>
                        </div>
                        <div class="data-row"><label for="">Address</label>
                          <div class="value">{{$tenant_info->address}}</div>
                        </div>
                        <div class="data-row"><label for="">Unit Number</label>
                          <div class="value">{{$tenant_info->property_unit}}</div>
                        </div>
                        <div class="data-row"><label for="">City</label>
                          <div class="value">{{$user->city}}</div>
                        </div>
                        <div class="data-row"><label for="">State</label>
                          <div class="value">{{$user->state}}</div>
                        </div>
                        <div class="data-row"><label for="">Zip</label>
                          <div class="value">{{$user->zipcode}}</div>
                        </div>
                        <div class="data-row"><label for="">Phone</label>
                          <div class="value">{{$tenant_info->phone}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="data-box">
                        <div class="data-row"><label for="">Email</label>
                          <div mailto:class="value">{{$tenant_info->email}}</div>
                        </div>
                        <div class="data-row"><label for="">Created Date</label>
                          <div class="value">{{date_format($tenant_info->created_at,"m/d/Y")}}</div>
                        </div>
                         <div class="data-row"><label for="">Lease Start Date</label>
                          <div class="value">@if($tenant_info->lease_start_date){{ date('m/d/Y', strtotime($tenant_info->lease_start_date))}} @endif</div>
                        </div>
                        <div class="data-row"><label for="">Lease End Date</label>
                          <div class="value">@if($tenant_info->lease_end_date){{date('m/d/Y', strtotime($tenant_info->lease_end_date))}} @endif</div>
                        </div>
                        <div class="data-row"><label for="">Next Payment Due Date</label>
                          <div class="value">@if($tenant_info->first_payment_due_date){{date('m/d/Y', strtotime($tenant_info->first_payment_due_date))}} @endif</div>
                        </div>
                        <div class="data-row"><label for="">Rent Amount</label>
                        <div class="value">${{number_format($tenant_info->rental_amount, 2)}}</div>
                        </div>
                        <div class="data-row"><label for="">Account Status</label>
                          <div class="value">{{$tenant_info->account_status}}</div>
                        </div>
                        <div class="data-row"><label for="">Late Fee Owed</label>
                          <div class="value">@if($tenant_info->late_fee) {{$tenant_info->late_fee}} @else 0.00 @endif</div>
                        </div>
                        <div class="data-row"><label for="">Rental Status</label>
                          <div class="value">{{$tenant_info->rental_status}}</div>
                        </div>
                        <div class="data-row"><label for="">Lease Type</label>
                          <div class="value">{{$tenant_info->lease_type}}</div>
                        </div>
                      </div>
                    </div>
                    @if($tenant_info->image)
                    <div class="col-sm-2 text-center">
                      <img src="{{asset('landlord/tenants/'.$tenant_info->image)}}" class="" alt="" height="200px" width="200px">
                    </div>
                    @else
                    <div class="col-sm-2 text-center">
                      <img src="{{asset('user.png')}}" class="img-fluid" alt="">
                    </div>
                    @endif
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