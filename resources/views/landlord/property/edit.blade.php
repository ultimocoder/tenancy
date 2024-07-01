<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property</title>
    @include('landlord_layouts.header')
</head>

<style>
    .input-error {
    border: 2px solid #dc3545;
}

.error-message {
    color: #dc3545;
    /* font-size: 12px; */
}
</style>

<body>
    <div class="admin-container">
        @include('landlord_layouts.navbar')
        <div class="rightside">
            <div class="top">
            @include('landlord_layouts.topbar')
                <div class="page">
                    <div class="page-title">
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span></div>
                        <h1><span id="title"></span> - Edit</h1>
                    </div>
                    @if(session()->has('error'))    
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="container-fluid" id="cf">
                        <form action="{{route('landlord.property.update')}}" method="post">
                            @csrf
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="page-card">

                                    <div class="heading-underline">Property Details</div>

                                    <div class="form-group">
                                        <label for="">Property Name</label>
                                        <input type="text" name="property_nickname" class="form-control form-control-sm @error('property_nickname') is-invalid @enderror" value="{{$property->property_name}}" placeholder="Enter Property Name" value="Berben Street">
                                        @error('property_nickname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Street Address</label>
                                        <input name="address" id="" class="form-control form-control-sm" placeholder="Enter Address" value="{{$property->address}}">
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">City</label>
                                                <input type="text" name="city" class="form-control form-control-sm" value="{{$property->city}}" placeholder="Enter City">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">State</label>
                                                <input type="text"  name="state"class="form-control form-control-sm" value="{{$property->state}}" placeholder="Enter State" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Postal Code</label>
                                                <input type="number" name="postal_code" class="form-control form-control-sm" value="{{$property->postal_code}}" placeholder="Enter zip code">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Property Type</label>
                                                <select name="property_type" id="" class="form-select form-select-sm">
                                                    @if(count($property_types) > 0 )
                                                        @foreach($property_types as $pt)
                                                        <option value="{{$pt->id}}" @if($pt->id == $property->property_type_id) selected @endif>{{$pt->property_type}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex column-gap-3 align-items-center">
                                        <label for="" class="mb-0">Active Property</label>
                                        <div class="form-check form-switch mb-0 mh-auto">
                                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="flexSwitchCheckChecked" @if($property->active_property == true) checked @endif >
                                            <label class="form-check-label mb-0" for="flexSwitchCheckChecked">Yes</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{$property->id}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="page-card">
                                    <div class="heading-underline">Enter Units</div>
                                    <span id="msg" class="text-danger fw-bold"></span>
                                    <div class="units" id="unit-div">
                                        <input type="hidden" name="" id="unitCount" value="{{count($property_unit)}}">
                                        @if(count($property_unit) > 0)
                                            @foreach($property_unit as $unit)

                                            @if(in_array($unit->id, array_column($tenants->toArray(),'property_unit_id')))
                                            <input type="hidden" value="1" id="checkTenantInProperty" name="checkTenantInProperty">
                                            @endif
                                            <div class="Unit">
                                                @if(in_array($unit->id, array_column($tenants->toArray(),'property_unit_id')))
                                                <a class="remove btn btn-xs btn-3 " data-status="assignedUnit" data-id="{{$unit->id}}" >- remove unit </a>
                                                @else
                                                <a class="remove btn btn-xs btn-3 " data-status="unassignedUnit" data-id="{{$unit->id}}">- remove unit </a>
                                                @endif
                                                <div class="heading-2">Unit {{$loop->index+1}}</div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Unit Number</label>
                                                            <input type="text" name="unit[]" required class="unitNumber form-control form-control-sm" value="{{$unit->unit_name}}" placeholder="Enter Unit Name" value="A1">
                                                            <input type="hidden" name="unitid[]" value="{{$unit->id}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <div>
                                                                <label for=""># of Rooms</label>
                                                            </div>
                                                            <div class="no-unit">
                                                                <div onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</div>
                                                                <input type="number" readonly name="unit_number[]" min="1" value="{{$unit->room}}">
                                                                <div onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 kit-div">
                                                        <div class="form-group d-flex column-gap-3 align-items-center">
                                                            <label for="" class="mb-0">Kitchen?</label> 
                                                            <div class="form-check form-check-inline mb-0">
                                                                <input class="form-check-input" type="radio" name="kitchen_unit[{{$loop->index+1}}]" id="kitchen-unit-1-1" value="Yes" @if($unit->kitchen == 'Yes') checked @endif>
                                                                <label class="form-check-label mb-0" for="Kitchen-unit-1-1">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline mb-0">
                                                                <input class="form-check-input" type="radio" name="kitchen_unit[{{$loop->index+1}}]" id="Kitchen-unit-1-2" value="No" @if($unit->kitchen == 'No') checked @endif>
                                                                <label class="form-check-label mb-0" for="Kitchen-unit-1-2">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 bath-div">
                                                        <div class="form-group d-flex column-gap-3 align-items-center">
                                                            <label for="" class="mb-0">Bathroom?</label>
                                                            <div class="form-check form-check-inline mb-0">
                                                                <input class="form-check-input" type="radio" name="bathroom_unit[{{$loop->index+1}}]" id="bathroom-unit-1-1" value="Yes" @if($unit->bathroom == 'Yes')checked @endif>
                                                                <label class="form-check-label mb-0" for="bathtoom-unit-1-1">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline mb-0">
                                                                <input class="form-check-input" type="radio" name="bathroom_unit[{{$loop->index+1}}]" id="bathroom-unit-1-2" value="No" @if($unit->bathroom == 'No') checked @endif>
                                                                <label class="form-check-label mb-0" for="bathtoom-unit-1-2">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Sq Ft</label>
                                                            <input type="number" name="sqft[]" class="form-control form-control-sm" value="{{$unit->sqfeet}}" placeholder="1000" value="2000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    @if($package->package_name  == 'Multi Unit')
                                    <div class="text-center">
                                        <button id="AddUnit" class="btn btn-color-17 fw-medium rounded-2 w-50">Add Unit</button>
                                        <input type="text" name="currentValue" id="currentValue" value="{{$remainingUnits}}">
                                    </div>
                                    @elseif($package->package_name == 'Single Unit')
                                    <div class="text-center">
                                        <!-- <button id="AddUnit" class="btn btn-color-17 fw-medium rounded-2 w-50">Add Unit</button> -->
                                        <!-- <input type="text" name="currentValue" id="currentValue" value="{{$package->max_qty-1}}"> -->
                                    </div>
                                    @else
                                        <div class="text-center">
                                        <button id="AddUnit" class="btn btn-color-17 fw-medium rounded-2 w-50">Add Unit</button>
                                        <input type="text" name="currentValue" id="currentValue" value="{{$remainingUnits}}">
                                        </div>
                                    @endif
                                    <!-- <div class="text-center">
                                        <button id="AddUnit" class="btn btn-color-17 fw-medium rounded-2 w-50">Add Unit</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{url()->previous()}}" class="btn btn-color-11 text-white rounded-2 px-4 me-2">Cancel</a>
                            <button type="button" id="save-btn" class="btn btn-color-8 text-white rounded-2 px-4">Save Changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
    <script>
        // $(function(){
        //     var isTenant = $('#checkTenantInProperty').val();
            
        //     $("#flexSwitchCheckChecked").on('change', function() {
        //         if ($(this).is(':checked')) {
        //             //$(this).attr('value', 'true');
        //             //switchStatus = $(this).is(':checked');
        //             //alert(switchStatus+0);
        //             if(isTenant == 1){
        //             $(this).attr('value', 'true');
        //             //alert('You can not mark this property Inactive,the tenant is assigned to the unit');
        //             }else{
        //                 $(this).attr('value', 'false');
        //             }
        //         }
        //         else {
        //         //$(this).attr('value', 'false');
        //         switchStatus = $(this).is(':checked');
        //         // alert(switchStatus+1);
        //         if(isTenant == 1){
        //             $(this).attr('value', 'true');
        //             alert('You can not mark this property Inactive,the tenant is assigned to the unit');
        //             $('#flexSwitchCheckChecked').prop('checked');
        //         }else{
        //             $(this).attr('value', 'false');
        //         }
        //         }});
        // });
    </script>
    <script>
        $(document).ready(function() {
            // Remove existing error messages
            $('.error-message').remove();
            // Remove error class from all input fields
            $('.unitNumber').removeClass('input-error');

            var cnt = $('#unitCount').val();
            if(cnt >= 1 ){
                var CN = ++cnt; 
            }else{
                var CN = 1;
            }

            /* Hide and show */
            var currentValue = $('#currentValue').val();
            var start = $('#unitCount').val();
            var temp = currentValue -start;
           // $('#currentValue').val(temp);
            if(0 == currentValue){
                $('#AddUnit').hide();    
            }

            $('#save-btn').click(function(){

                $('.error-message').remove();
        
                // Remove error class from all input fields
                $('.unitNumber').removeClass('input-error');

                var allFieldsEmpty = false;
                $('.unitNumber').each(function() {
                    if ($(this).val().trim() == '') {
                        //alert('field required');
                        // At least one field is not empty
                        allFieldsEmpty = true;
                        return false; // Exit the loop early
                    }
                });
                //alert(allFieldsEmpty);
                if (allFieldsEmpty) {
                    //alert('Please fill in at least one field.');
                    //$('#msg').show();
                    //$('#msg').text('Unit number is a required field');
                    errorFunc();
                    event.preventDefault(); 
                    return false;// Prevent form submission
                }

                if (!checkUniqueness()) {
                    // $('#msg').show();
                    // $('#msg').text('Unit number must be a unique value');
                    //alert('Field values must be unique in each row!');
                    // Remove the row if the values are not unique
                    //newRow.remove();
                    return false;
                }else{
                    var confirmed = window.confirm('Are you sure you want to save the changes to your property?');
                    if (confirmed) {
                        $("form").submit();
                    }
                }
                //$("form").submit();
            })
            
            $("#AddUnit").click(function(e) {
                e.preventDefault();
                $('.error-message').remove();
                $('.unitNumber').removeClass('input-error');
                var allFieldsEmpty = false;
                $('.unitNumber').each(function() {
                    if ($(this).val().trim() == '') {
                        //alert('field required');
                        // At least one field is not empty
                        allFieldsEmpty = true;
                        return false; // Exit the loop early
                    }
                });
                //alert(allFieldsEmpty);
                if (allFieldsEmpty) {
                    //alert('Please fill in at least one field.');
                    //$('#msg').show();
                    //$('#msg').text('Unit number is a required field');
                    errorFunc();
                    event.preventDefault(); 
                    return false;// Prevent form submission
                }else{
                    $('#msg').hide();

                    $('.error-message').remove();
        
                    // Remove error class from all input fields
                    $('.unitNumber').removeClass('input-error');
                }

                if (!checkUniqueness()) {
                    //$('#msg').show();
                    //$('#msg').text('Unit number must be a unique value');
                    //alert('Field values must be unique in each row!');
                    // Remove the row if the values are not unique
                    //newRow.remove();
                    return false;
                }
                var currentValue = $('#currentValue').val();
                var start = $('#unitCount').val();

                var temp = currentValue-1;
                if(currentValue == 1){
                    //alert('hide');
                    $('#AddUnit').hide()
                }else{
                    //alert('show');
                    $('#AddUnit').show()
                }
               
                $('#currentValue').val(temp);
                /* Hide and show end*/

                $(".units").append(
                    '<div class="Unit" id="Unit-' + CN + '">' +
                    '<a class="remove btn btn-xs btn-3">- remove unit</a>' +
                    '<div class="heading-2">Unit ' + CN + '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-6">' +
                    '<div class="form-group">' +
                    '<label for="">Unit Number</label>' +
                    '<input type="text" name="unit[]" required class="unitNumber form-control form-control-sm" placeholder="Enter Unit Name">' +
                    '<input type="hidden" name="unitid[]" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-6">' +
                    '<div class="form-group">' +
                    '<div>' +
                    '<label for=""># of Rooms</label>' +
                    '</div>' +
                    '<div class="no-unit">' +
                    '<div onClick="this.parentNode.querySelector(\'input[type=number]\').stepDown()">-</div>' +
                    '<input type="number" readonly name="unit_number[]" value="1" min="1">' +
                    '<div onClick="this.parentNode.querySelector(\'input[type=number]\').stepUp()">+</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-6 kit-div">' +
                    '<div class="form-group d-flex column-gap-3 align-items-center">' +
                    '<label for="" class="mb-0">Kitchen?</label>' +
                    '<div class="form-check form-check-inline mb-0">' +
                    '<input class="form-check-input" type="radio" name="kitchen_unit[' + CN + ']" id="Kitchen-unit-' + CN + '-1" value="Yes" checked>' +
                    '<label class="form-check-label mb-0" for="Kitchen-unit-' + CN + '-1">Yes</label>' +
                    '</div>' +
                    '<div class="form-check form-check-inline mb-0">' +
                    '<input class="form-check-input" type="radio" name="kitchen_unit[' + CN + ']" id="Kitchen-unit-' + CN + '-2" value="No">' +
                    '<label class="form-check-label mb-0" for="Kitchen-unit-' + CN + '-2">No</label>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-6 bath-div">' +
                    '<div class="form-group d-flex column-gap-3 align-items-center">' +
                    '<label for="" class="mb-0">Bathtoom?</label>' +
                    '<div class="form-check form-check-inline mb-0">' +
                    '<input class="form-check-input" type="radio" name="bathroom_unit[' + CN + ']" id="bathtoom-unit-' + CN + '-1" value="Yes" checked>' +
                    '<label class="form-check-label mb-0" for="bathtoom-unit-' + CN + '-1">Yes</label>' +
                    '</div>' +
                    '<div class="form-check form-check-inline mb-0">' +
                    '<input class="form-check-input" type="radio" name="bathroom_unit[' + CN + ']" id="bathtoom-unit-' + CN + '-2" value="No">' +
                    '<label class="form-check-label mb-0" for="bathtoom-unit-' + CN + '-2">No</label>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-6">' +
                    '<div class="form-group">' +
                    '<label for="">Sq Ft</label>' +
                    '<input type="number" name="sqft[]" class="form-control form-control-sm" placeholder="1000">' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                CN++;
            });
            $('.units').on('click', 'a', (e) => {
                // CN = CN-1;
                // console.log(CN);
                $(e.target).parent().remove();

                CN--;
                $('#AddUnit').show();
                var currentValue = $('#currentValue').val();
                var temp = +currentValue + 1;
                $('#currentValue').val(temp);
                updateSerialNumbers();
            });

             //Function to update serial numbers
            function updateSerialNumbers() {
                $('.Unit').each(function(index) {
                    //alert(index);
                    //$(this).text("Unit "+ (index + 1));
                    var parent = $(this);
                    var heading = parent.find('.heading-2');
                    var kitchen = parent.find('.kit-div');
                    var kit_unit = kitchen.find('input[type="radio"]');

                    var bathroom = parent.find('.bath-div');
                    var bath_unit = bathroom.find('input[type="radio"]');
                    console.log(kit_unit);
                    //alert(parent);
                    kit_unit.attr('name', 'kitchen_unit[' + (index + 1)+ ']');
                    bath_unit.attr('name', 'bathroom_unit[' + (index + 1)+ ']');
                    $(heading).text("Unit "+ (index + 1));
                });
            }

            function errorFunc(){
                //alert('fdf');
                $('.Unit').each(function(index) {
                    
                    if($(this).find('.unitNumber').val().trim().toLowerCase() == ''){
                        $(this).find('.unitNumber').addClass('input-error');
                        $(this).find('.unitNumber').after('<div class="error-message">Unit number is a required field</div>');
                    }
                    
                });
            }
            // Function to check uniqueness of field values
            function checkUniqueness() {
                var values = {};
                var isUnique = true;
                $('.unitNumber').each(function() {
                    var value = $(this).val().trim().toLowerCase();
                    //alert(value);
                    if (values[value]) {
                        $(this).addClass('input-error');
                        $(this).after('<div class="error-message">Unit number must be a unique value</div>');
                        isUnique = false;
                        return false; // Break out of the loop
                    }
                    values[value] = true;
                });
                return isUnique;
            }

            //delete functionality
            $('.remove').on('click', function(){
               var unit_id = $(this).attr('data-id');
               var status = $(this).attr('data-status');

               if(status == 'assignedUnit'){
                alert('You must expire the tenant from that unit');
                    return false;
               }
            
            // alert(unit_id);
            // return false;
               $.ajax(
                {
                    url: "{{route('landlord.property.unit.delete')}}",
                    type: 'post',
                    data: {
                        "id": unit_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response){
                        console.log(response.redirect_url);
                        if(response.redirect_url){
                            window.location.href = response.redirect_url;
                        }
                        //$("#unit-div").load(location.href + " #unit-div");
                        //$("#cf").load(location.href + " #cf");

                    }
                });

             });
        });
    </script>
</body>

</html>