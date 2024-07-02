<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register New Tenant</title>
    @include('landlord_layouts.header')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                    <form action="{{route('landlord.tenant.save')}}" method="post">
                        @csrf
                    <div class="page-card mx-auto" style="width: 600px;">

                        <div class="heading-2">Primary tenant</div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">First name</label>
                                    <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control form-control-sm @error('first_name') is-invalid @enderror" placeholder="Enter first name">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Last name</label>
                                    <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control form-control-sm @error('last_name') is-invalid @enderror" placeholder="Enter last name">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Enter Email Address">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" id="phoneInput" value="{{old('phone')}}" name="phone" maxlength="10" minlength="10" class="form-control form-control-sm @error('phone') is-invalid @enderror" placeholder="Enter phone number">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span id="phone-error" style="color: red;font-weight: bolder"></span>
                                </div>
                            </div>
                        </div>

                        <div class="fs-16 fw-semibold text-color-6 mb-3 cursor-pointer singleCollapse1" data-bs-toggle="collapse" href="#collapseExample">Secondary Tenant</div>
                        <div class="collapse" id="collapseExample">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">First name</label>
                                        <input type="text" name="secondary_first_name"  class="form-control form-control-sm  @error('secondary_first_name') is-invalid @enderror" placeholder="Enter first name">
                                        @error('secondary_first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Last name</label>
                                        <input type="text" name="secondary_last_name" class="form-control form-control-sm @error('secondary_last_name') is-invalid @enderror" placeholder="Enter last name">
                                        @error('secondary_last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Registered property</label>
                                    <select name="property" id="property-dropdown" class="form-control form-control-sm form-control-sm @error('property') is-invalid @enderror">
                                        <option value="">-- Select registered property --</option>
                                        @if(count($property_list) > 0)
                                            @foreach($property_list as $list)
                                                <option value="{{$list->id}}" {{ old("property") == $list->id ? 'selected' : '' }} @if($property) @if($property->id == $list->id) selected @endif @endif>{{$list->property_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('property')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Registered unit</label>
                                    <select name="unit" id="unit-dropdown" class="form-control form-control-sm @error('unit') is-invalid @enderror">
                                        
                                        @if($unit)
                                        <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                        @elseif(old('property'))
                                            @foreach($property_units as $unit_prop)
                                                @if($unit_prop->property_id == old('property'))
                                                    <option value="{{ $unit_prop->id }}" {{ old('unit') == $unit_prop->id ? 'selected' : '' }}>
                                                        {{ $unit_prop->unit_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                        
                                        @else
                                        <option value="" >-- Select registered unit --</option> 
                                        @endif
                                    </select>
                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if($unit)
                                    <input type="hidden" name="view" value="1">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Street Address</label>
                            
                            @if($unit)
                            
                            <input name="address" id="address" class="form-control form-control-sm form-control-sm @error('address') is-invalid @enderror" placeholder="Enter Address" @if($property) value="{{$property->address}}" @endif>
                            @else
                            
                            <input name="address" id="address" value="{{old('address')}}" class="form-control form-control-sm form-control-sm @error('address') is-invalid @enderror" placeholder="Enter Address">
                            @endif
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Lease start date</label>
                                    <input type="text" name="lease_start_date" value="{{old('lease_start_date')}}" autocomplete="off" id="lease_start_date" class="form-control form-control-sm date @error('lease_start_date') is-invalid @enderror" placeholder="Enter start date">
                                    @error('lease_start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Lease end date</label>
                                    <input type="text" name="lease_end_date" value="{{old('lease_end_date')}}" autocomplete="off" class="form-control form-control-sm date @error('lease_end_date') is-invalid @enderror" placeholder="Enter end date">
                                    @error('lease_end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Rental amount</label>
                                    <input type="text" name="rental_amount" id="price" value="{{old('rental_amount')}}" maxlength="12"  class="form-control form-control-sm @error('rental_amount') is-invalid @enderror" placeholder="Enter amount (e.g., $10.00)" title="Please enter a valid price (e.g., $10.00)">
                                    <!-- <input type="text" name="rental_amount" id="price" class="form-control form-control-sm @error('rental_amount') is-invalid @enderror" placeholder="Enter amount (e.g., $10.00)" title="Please enter a valid price (e.g., $10.00)"> -->
                                    @error('rental_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Lease Type</label>
                                    <select name="lease_type" id="lease_type" class="form-select form-select-sm @error('lease_type') is-invalid @enderror">
                                        <option value=""> -- Select lease type --</option>
                                        <option value="Annual" {{ old('lease_type') == 'Annual' ? 'selected' : '' }}>Annual</option> 
                                        <option value="Month-to-Month" {{ old('lease_type') == 'Month-to-Month' ? 'selected' : '' }}>Month-to-Month</option> 
                                    </select>
                                    @error('lease_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                        <a href="{{url()->previous()}}" class="btn btn-color-11 text-white rounded-2 me-2">Cancel</a>
                            <button class="btn btn-color-8 rounded-2">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
       
    $(function(){
        $( ".date" ).datepicker(
            {
                dateFormat: "mm/dd/yy",
            }
        );

        $('#property-dropdown').on('change', function () {
                var idProp = this.value;
                $("#unit-dropdown").html('');
                $.ajax({
                    url: "{{route('landlord.fetch.property.unit')}}",
                    type: "POST",
                    data: {
                        prop_id: idProp,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#unit-dropdown').html('<option value="">-- Select registered unit --</option>');
                        $.each(result.props, function (key, value) {
                            $("#unit-dropdown").append('<option value="' + value
                                .id + '">' + value.unit_name + '</option>');
                        });
                        //console.log(result['property']['address']);
                       $('#address').val(result['property']['address']);
                    }
                });
            });


            // $('#price').on('keyup', function(){
            //     var value = $(this).val().replace(/[^0-9.]/g, '');
            //     if(value !== '' && !isNaN(value)){
            //         $(this).val('$' + value);
            //     }
            // });
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
        
    });
    </script>
</body>

</html>