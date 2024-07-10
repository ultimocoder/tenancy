<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Tenant Information</title>
    @include('tenant_layouts.header')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                    <div class="container-fluid">
                    @if(session()->has('message'))    
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{route('tenant.tenant.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="page-card">
                                    <div class="title">
                                        <div class="d-flex align-items-center column-gap-3">
                                            <!-- <div class="form-check form-switch fs-13 mb-0"> -->
                                                <!-- <input class="form-check-input" type="checkbox" name="status" role="switch" id="flexSwitchCheckChecked" @if($tenant->status == true) checked @endif> -->
                                                <!-- <label class="form-check-label fs-14" for="flexSwitchCheckChecked">Status: @if($tenant->status == true) Active @else Inactive @endif</label> -->
                                            <!-- </div> -->
                                            {{--<a href="{{route('landlord.tenant-information')}}" class="btn-xs btn-4"><i class="fa-solid fa-floppy-disk"></i>Save</a>--}}
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{$tenant->id}}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Account number</label>
                                                    <span class="fw-bold">{{$tenant->unique_id}}</span>
                                                </div>
                                                <div class="data-row"><label for="">User name</label>
                                                <span class="fw-bold">{{$tenant->username}}</span>
                                                  
                                                </div>
                                                <div class="data-row"><label for="">First name</label>
                                                <span class="fw-bold">{{$tenant->first_name}}</span>
                                                  
                                                </div>
                                                <div class="data-row"><label for="">Last name</label>
                                                <span class="fw-bold">{{$tenant->last_name}}</span>
                                                    <!-- <input type="text" name="last_name" class="form-control form-control-sm" value="{{$tenant->last_name}}"> -->
                                                </div>
                                                <div class="data-row"><label for="">Address</label>
                                                <span class="fw-bold">{{$tenant->address}}</span>
                                                    <!-- <input type="text" name="address" class="form-control form-control-sm" value="{{$tenant->address}}"> -->
                                                </div>
                                                <div class="data-row"><label for="">Unit Number</label>
                                                <span class="fw-bold">{{$tenant->property_unit}}</span>
                                                    <!-- <input type="text" readonly name="unit_number" class="form-control form-control-sm" value="{{$tenant->property_unit}}"> -->
                                                </div>
                                                <div class="data-row"><label for="">City</label>
                                                <span class="fw-bold">{{$tenant->city}}</span>
                                                    <!-- <input type="text" name="city" class="form-control form-control-sm" value="{{$tenant->city}}"> -->
                                                </div>
                                                <div class="data-row"><label for="">State</label>
                                                <span class="fw-bold">{{$tenant->state}}</span>
                                                    <!-- <input type="text" name="state" class="form-control form-control-sm" value="{{$tenant->state}}"> -->
                                                </div>
                                                <div class="data-row"><label for="">Zip</label>
                                                <span class="fw-bold">{{$tenant->zipcode}}</span>
                                                    <!-- <input type="text" name="zipcode" class="form-control form-control-sm" value="{{$tenant->zipcode}}"> -->
                                                </div>
                                                <div class="data-row"><label for="">Phone</label>
                                                    <input type="text" name="phone" id="phoneInput" maxlength="10" min="10" class="form-control form-control-sm @error('phone') is-invalid @enderror" value="{{$tenant->phone}}">
                                                   
                                                </div>
                                                @error('phone')
                                                        <span style="color: red;font-weight: bolder">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                <span id="phone-error" style="color: red;font-weight: bolder"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Email</label>
                                                    <input type="text" name="email" class="form-control form-control-sm" value="{{$tenant->email}}">
                                                </div>
                                                <div class="data-row"><label for="">Created Date</label>
                                                    <!-- <input type="text" name="since" readonly class="form-control form-control-sm" value="{{date('d/m/Y',strtotime($tenant->created_at))}}"> -->
                                                <span class="fw-bold">{{date('m/d/Y',strtotime($tenant->created_at))}}</span>
                                                </div>
                                               <div class="data-row"><label for="">Lease Start Date</label>
                                               <span class="fw-bold">{{date('m/d/Y',strtotime($tenant->lease_start_date))}}</span>
                                                    <!-- <input type="text" name="lease_start_date" autocomplete="off" @if($tenant->rental_status == 'Expired') readonly class=" form-control form-control-sm" @else class="date form-control form-control-sm" @endif  value="@if($tenant->lease_start_date){{ date('m/d/Y', strtotime($tenant->lease_start_date))}}@endif"> -->
                                                </div>
                                                <div class="data-row"><label for="">Lease End</label>
                                                <span class="fw-bold">{{date('m/d/Y',strtotime($tenant->lease_end_date))}}</span>
                                                    <!-- <input type="text" name="lease_end_date" autocomplete="off" @if($tenant->rental_status == 'Expired') readonly  class="form-control form-control-sm" @else class="date form-control form-control-sm" @endif  value="@if($tenant->lease_end_date){{date('m/d/Y', strtotime($tenant->lease_end_date))}}@endif"> -->
                                                </div>
                                                <div class="data-row"><label for="">Rent Amount</label>
                                                <span class="fw-bold">${{number_format($tenant->rental_amount,2)}}</span>
                                                    <!-- <input type="text" name="rental_amount" id="price"  class="form-control form-control-sm" value="${{number_format($tenant->rental_amount,2)}}"> -->
                                                </div>
                                                <div class="data-row"><label for="">Account Status</label>
                                                    <!-- <input type="text" name="acc_status" class="form-control form-control-sm" readonly value="Current"> -->
                                                    <span class="fw-bold">Current</span>
                                                   
                                                </div>
                                                <div class="data-row"><label for="">Late Fee Owed</label>
                                                <span class="fw-bold">{{$tenant->late_fee}}</span>
                                                    <!-- <input type="text" name="late_fee" class="form-control form-control-sm" value="@if($tenant->late_fee){{$tenant->late_fee}}@else{{0.00}}@endif"> -->
                                                </div>
                                                <div class="data-row"><label for="">Rental Status</label>
                                                <span class="fw-bold">{{$tenant->rental_status}}</span>
                                                    <!-- <input type="text" name="rental_status" class="form-control form-control-sm" value="{{$tenant->rental_status}}"> -->
                                                    <!-- <select name="rental_status" id="rental_status" class="form-select form-select-sm @error('rental_status') is-invalid @enderror">
                                                        
                                                        <option value="Active" @if($tenant->rental_status == 'Active') selected @endif >Active</option> 
                                                        <option value="Expired" @if($tenant->rental_status == 'Expired') selected @endif >Expired</option> 
                                                    </select> -->
                                                </div>
                                                <div class="data-row"><label for="">Lease Type</label>
                                                <span class="fw-bold">{{$tenant->lease_type}}</span>
                                                    <!-- <input type="text" name="lease_type" class="form-control form-control-sm" value=""> -->
                                                    <!-- <select name="lease_type" id="lease_type" class="form-select form-select-sm @error('lease_type') is-invalid @enderror">
                                                        <option value="" @if($tenant->lease_type == '') selected @endif > -- Select lease type --</option>
                                                        <option value="Annual" @if($tenant->lease_type == 'Annual') selected @endif >Annual</option> 
                                                        <option value="Month-to-Month" @if($tenant->lease_type == 'Month-to-Month') selected @endif >Month-to-Month</option> 
                                                    </select> -->
                                                     
                                                </div>
                                                @error('lease_type')
                                                        <span style="color: red;font-weight: bolder">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-end">
                                            <div class="d-inline-flex flex-column text-center">
                                                @if($tenant->image)
                                                <img src="{{ asset('landlord/tenants/'.$tenant->image)}}" id="last_fetch_image" class="" alt="" height="200px" width="200px">
                                                @else
                                                <img src="{{ asset('tenants/img-1.jpg')}}" id="last_fetch_image" class="" alt="" height="200px" width="200px"  >
                                                @endif
                                                <img src="" id="profile-img-tag" class="" alt="" height="200px" width="200px">
                                                <!-- <div style="margin-left: 3px;">
                                                    <input type="file" name="file" class="d-none opacity-0 position-absolute" id="imgUpload" >
                                                    <label for="imgUpload" class="btn btn-sm btn-color-14 text-white"><i class="fa-solid fa-upload me-2"></i>Edit Photo</label>
                                                    @if($tenant->image)
                                                    <a href="{{route('tenant.tenant.remove.photo', $tenant->id)}}" onclick="return confirm('Are you sure you want to delete this photo ?')" class="btn btn-sm btn-danger text-white"><i class="fa-solid fa-trash me-2"></i>Remove Photo</a>
                                                    @endif
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    <a href="{{url()->previous()}}" class="btn btn-color-11 text-white rounded-2 px-4 me-2">Cancel</a>
                                        <button class="btn btn-sm btn-2 rounded-2">Save</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('tenant_layouts.footer')
        </div>
    </div>
    @include('tenant_layouts.script')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</body>

<script>
    $(function(){
        $( ".date" ).datepicker(
            {
                dateFormat: "mm/dd/yy",
            }
        );

        /* CFetching image instantly */
        $('#profile-img-tag').hide();
        function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                        $('#profile-img-tag').show();
                        $('#last_fetch_image').hide();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imgUpload").change(function(){
                readURL(this);
            });
        //phone number implementation
        $('#phoneInput').on('input', function(){
            // Get the current value of the input field
            var inputValue = $(this).val();
            
            // Remove non-numeric characters from the input
            var numericValue = inputValue.replace(/\D/g,'');
            
            // Format the phone number as (###) ###-####
            var formattedValue = numericValue.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            
            // Set the formatted value back to the input field
            $(this).val(formattedValue);
        });//phone number implementation end

        $('#phoneInput').on('input', function() {
            var phoneNumber = $(this).val();
            if (phoneNumber.charAt(0) === '0') {
                $('#phone-error').text('Phone number cannot start with 0.');
                return false;
            }if (phoneNumber.charAt(1) === '0') {
                $('#phone-error').text('Phone number cannot start with 0.');
                return false;
            } else {
                $('#phone-error').text('');
            }
        });

           // Function to format price
    function formatPrice(price) {
        // Add commas as thousand separators
        var parts = price.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        if (parts.length > 1) {
            // Limit decimal places to 2
            parts[1] = parts[1].slice(0, 2);
        }
        return "$" + parts.join(".");
    }

    // Function to update formatted price on page load
    // window.onload = function() {
    //     var priceInput = document.getElementById("price");
    //     var amount = priceInput.value;
    //     priceInput.value = formatPrice(amount);
    // };

    $("#price").on("keyup", function() {
        // Get the entered price
        var price = $(this).val();
        
        // Remove non-numeric characters and allow only one dot
        price = price.replace(/[^\d.]/g, '');
        var dotCount = price.split('.').length - 1;
        if(dotCount > 1) {
            price = price.substr(0, price.lastIndexOf('.'));
        }
        
        // Format the price
        var formattedPrice = formatPrice(price);
        
        // Display the formatted price
        $(this).val(formattedPrice);
    });
    
    })
</script>


</html>