<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register New Property</title>
    @include('landlord_layouts.header')
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
                    @if(session()->has('error'))    
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif 
                    <form action="{{route('landlord.property.save')}}" method="post">
                        @csrf
                    <div class="page-card mx-auto" style="width: 600px;" id="PropertyDetails">

                        <div class="heading-underline">Property Details</div>
                        <span id="Error" class="error-message text-danger text-bold fw-bold"></span>

                        <div class="form-group">
                            <label for="">Property Nickname</label>
                            <input type="text" id="name" class="form-control form-control-sm @error('property_nickname') is-invalid @enderror" name="property_nickname" placeholder="Enter Property Nickname">
                            @error('property_nickname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span id="nameError" class="error-message text-danger fw-bold"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Street Address</label>
                            <input name="address" id="address" class="form-control form-control-sm" placeholder="Enter Address"></textarea>
                            <span id="addressError" class="error-message text-danger fw-bold"></span>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" name="city" id="city" class="form-control form-control-sm" placeholder="Enter City">
                                    <span id="cityError" class="error-message text-danger fw-bold"></span>
                                </div>
                                
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" name="state" id="state" class="form-control form-control-sm" placeholder="Enter State">
                                    <span id="stateError" class="error-message text-danger fw-bold"></span>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Postal Code</label>
                                    <input type="number" name="postal_code" id="postal_code" class="form-control form-control-sm" placeholder="Enter zip code">
                                </div>
                                <span id="postalError" class="error-message text-danger fw-bold"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Property Type</label>
                                    <!-- form-select-sm -->
                                    <select name="property_type" id="" readonly class="form-select form-select-sm">
                                        @if(count($property_types) > 0 )
                                            @foreach($property_types as $type)
                                            <option value="{{$type->id}}">{{$type->property_type}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group d-flex column-gap-3 align-items-center">
                            <label for="" class="mb-0">Active Property</label>
                            <div class="form-check form-switch mb-0 mh-auto">
                                <input class="form-check-input" name="status" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label mb-0" for="flexSwitchCheckChecked">Yes</label>
                            </div>
                        </div> -->
                        
                        <div class="text-center">
                            <a href="{{URL::previous()}}" class="btn btn-color-11 text-white rounded-2 px-4 me-4">Cancel</a>
                            <a href="javscript:void(0)" class="btn btn-color-8 px-4" id="next">Next</a>
                        </div>
                    </div>
                    <div class="page-card mx-auto d-none" style="width: 600px;" id="EnterUnits">

                        <div class="heading-underline">Enter Units</div>

                        <div class="units">
                            <span id="msg" class="text-danger fw-bold"></span>
                            <div class="Unit">
                                <div class="heading-2">Unit 1</div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Unit Number</label>
                                            <input type="text" name="unit[]" required="" class="unitNumber form-control form-control-sm" placeholder="Enter Unit Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div>
                                                <label for=""># of Rooms</label>
                                            </div>
                                            <div class="no-unit">
                                                <div onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</div>
                                                <input type="number" readonly name="unit_number[]" value="1" min="1">
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
                                                <input class="form-check-input" type="radio" name="kitchen_unit_1" id="Kitchen-unit-1-1" value="Yes" checked>
                                                <label class="form-check-label mb-0" for="kitchen-unit-2-1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-0">
                                                <input class="form-check-input" type="radio" name="kitchen_unit_1" id="Kitchen-unit-1-2" value="No">
                                                <label class="form-check-label mb-0" for="kitchen-unit-2-2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 bath-div">
                                        <div class="form-group d-flex column-gap-3 align-items-center">
                                            <label for="" class="mb-0">Bathroom?</label>
                                            <div class="form-check form-check-inline mb-0">
                                                <input class="form-check-input" type="radio" name="bathroom_unit_1" id="Bathtoom-unit-1-1" value="Yes" checked>
                                                <label class="form-check-label mb-0" for="Bathtoom-unit-2-1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-0">
                                                <input class="form-check-input" type="radio" name="bathroom_unit_1" id="Bathtoom-unit-1-2" value="No">
                                                <label class="form-check-label mb-0" for="bathtoom-unit-2-2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Sq Ft</label>
                                            <input type="number" name="sqft[]" class="form-control form-control-sm" placeholder="1000">
                                        </div>
                                    </div>
                                </div>
                            </div>

                          
                        </div>
                            
                       
                        @if($package->package_name  == 'Multi Unit')
                        <div class="text-center">
                            <button id="AddUnit" class="btn btn-color-17 fw-medium rounded-2 w-50">Add Unit</button>
                            <input type="hidden" name="currentValue" id="currentValue" value="{{$subscription->quantity-1}}">
                        </div>
                        @elseif($package->package_name == 'Single Unit')
                        <div class="text-center">
                            <!-- <button id="AddUnit" class="btn btn-color-17 fw-medium rounded-2 w-50">Add Unit</button> -->
                            <!-- <input type="text" name="currentValue" id="currentValue" value="{{$package->max_qty-1}}"> -->
                        </div>
                        @else
                            <div class="text-center">
                            <button id="AddUnit" class="btn btn-color-17 fw-medium rounded-2 w-50">Add Unit</button>
                            <input type="hidden" name="currentValue" id="currentValue" value="{{$subscription->quantity-1}}">
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-4"><a id="previous" class="btn btn-color-5 fw-medium rounded-2">Previous</a></div>
                            <div class="col-sm-8 text-sm-end">
                                <a href="{{route('landlord.view.property')}}" class="btn btn-color-11 text-white rounded-2 me-2">Cancel</a>
                                <button class="btn btn-color-8 text-white rounded-2" id="save-btn">Save</button>
                            </div>
                        </div>
                        <!-- <div class="row text-center">
                            <div class="col-sm-6"><a id="previous" class="btn btn-color-16 fw-medium rounded-2 w-50">Previous</a></div>
                            <div class="col-sm-6"><button class="btn btn-color-8 text-white rounded-2 w-50">Save</button></div>
                        </div> -->
                    </div>
                    </form>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')

    <script>
        $(document).ready(function() {
            //var inc= 2;
            
            
            $('#save-btn').click(function(){

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
                    $('#msg').show();
                    $('#msg').text('Unit number is a required field');
                    event.preventDefault(); 
                    return false;// Prevent form submission
                }

                if (!checkUniqueness()) {
                    $('#msg').show();
                    $('#msg').text('Unit number must be a unique value');
                    //alert('Field values must be unique in each row!');
                    // Remove the row if the values are not unique
                    //newRow.remove();
                    return false;
                }else{
                    //var confirmed = window.confirm('Are you sure you want to save the changes to your property');
                    //if (confirmed) {
                        $("form").submit();
                    //}
                }
                //$("form").submit();
                });
                
            $('#AddUnit').on('click', function(){
            //     var currentValue = $('#currentValue').val();
                   
            //     var temp = currentValue-1;
            //     if(currentValue == 1){
            //         //alert('hide');
            //         $('#AddUnit').hide()
            //     }else{
            //         //alert('show');
            //         $('#AddUnit').show()
            //     }
               
            //    $('#currentValue').val(temp);

            })

            var CN = 2;
            $("#AddUnit").click(function(e) {
                e.preventDefault();
                /* check the required field */
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
                    $('#msg').show();
                    $('#msg').text('Please fill the unit number field');
                    event.preventDefault(); 
                    return false;// Prevent form submission
                }else{
                    $('#msg').hide();
                }
                /* check the required field */

                if (!checkUniqueness()) {
                    $('#msg').show();
                    $('#msg').text('Unit number must be a unique value');
                    //alert('Field values must be unique in each row!');
                    // Remove the row if the values are not unique
                    //newRow.remove();
                    return false;
                }

                /* Hide and show */
                var currentValue = $('#currentValue').val();
                   
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
                    '<a class="remove btn btn-xs btn-2">- remove unit</a>' +
                    '<div class="heading-2">Unit ' + CN + '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-6">' +
                    '<div class="form-group">' +
                    '<label for="">Unit Number</label>' +
                    '<input type="text" name="unit[]" required class="unitNumber form-control form-control-sm" placeholder="Enter Unit Name">' +
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
                    '<input class="form-check-input" type="radio" name="kitchen_unit_' + CN + '" id="Kitchen-unit-' + CN + '-1" value="Yes" checked>' +
                    '<label class="form-check-label mb-0" for="kitchen-unit-' + CN + '-1">Yes</label>' +
                    '</div>' +
                    '<div class="form-check form-check-inline mb-0">' +
                    '<input class="form-check-input" type="radio" name="kitchen_unit_' + CN + '" id="Kitchen-unit-' + CN + '-2" value="No">' +
                    '<label class="form-check-label mb-0" for="kitchen-unit-' + CN + '-2">No</label>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-6 bath-div">' +
                    '<div class="form-group d-flex column-gap-3 align-items-center">' +
                    '<label for="" class="mb-0">Bathtoom?</label>' +
                    '<div class="form-check form-check-inline mb-0">' +
                    '<input class="form-check-input" type="radio" name="bathroom_unit_' + CN + '" id="Bathtoom-unit-' + CN + '-1" value="Yes" checked>' +
                    '<label class="form-check-label mb-0" for="bathtoom-unit-' + CN + '-1">Yes</label>' +
                    '</div>' +
                    '<div class="form-check form-check-inline mb-0">' +
                    '<input class="form-check-input" type="radio" name="bathroom_unit_' + CN + '" id="Bathtoom-unit-' + CN + '-2" value="No">' +
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
                //alert(CN);
               // updateRemoveButtons();
            });

            // Function to check uniqueness of field values
            function checkUniqueness() {
                var values = {};
                var isUnique = true;
                $('.unitNumber').each(function() {
                    var value = $(this).val().trim().toLowerCase();
                    //alert(value);
                    if (values[value]) {
                        isUnique = false;
                        return false; // Break out of the loop
                    }
                    values[value] = true;
                });
                return isUnique;
            }

            function updateRemoveButtons() {
                    $('.remove').prop('disabled', true); // Disable all remove buttons
                    $('.units .Unit:last .remove').prop('disabled', false); // Enable remove button of last row
                    //newRow.find('.units','.remove').prop('disabled', false);
                }
            $('.units').on('click', 'a', (e) => {
                $(e.target).parent().remove();
                //alert(CN--);
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
                    kit_unit.attr('name', 'kitchen_unit_' + (index + 1));
                    bath_unit.attr('name', 'bathroom_unit_' + (index + 1));
                    $(heading).text("Unit "+ (index + 1));
                });
            }
            $("#next").click(function() {
                $('.error-message').text('');
                var property = $('#name').val();
                var address = $('#address').val();
                var city = $('#city').val();
                var state = $('#state').val();
                var postal_code = $('#postal_code').val();

                if(property === ''){
                   
                    $('#nameError').text('Property Nickname is required');
                    //return;
                }
                
                if(address === ''){
                    $('#addressError').text('Address is required');
                    //return;
                }
                
                if(city === ''){
                    $('#cityError').text('City is required');
                    //return;
                }
                if(state === ''){
                    $('#stateError').text('State is required');
                    //return;
                }
                if(postal_code == ''){
                    $('#postalError').text('Postal Code is required');
                   // return;
                }

                if(property === '' || address === '' || city === '' || state =='' || postal_code ==''){
                    //alert('All fields are required');
                    
                    //$('#Error').text('All fields are required');
                    return
                }

                $("#PropertyDetails").addClass("d-none");
                $("#EnterUnits").removeClass("d-none");
            });
            $("#previous").click(function() {
                $("#PropertyDetails").removeClass("d-none");
                $("#EnterUnits").addClass("d-none");
            });
        });
    </script>

    <script>
        // $(function(){
        //     $('#next').on('click', function(){
        //         alert('hello');
        //     })
        // })
    </script>

</body>

</html>