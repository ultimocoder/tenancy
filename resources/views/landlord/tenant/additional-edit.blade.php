<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenant Additional Information</title>
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
                    <div class="container-fluid">
                        <form action="{{route('landlord.tenant.additional.update')}}" method="post">
                            @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card">
                                    <div class="title">
                                        <!-- <div class="d-flex column-gap-3">
                                            <a href="tenant-information-2.php" class="btn-xs btn-4"><i class="fa-regular fa-pen-to-square"></i>Save</a>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Account number</label><span class="fw-bold">{{$tenant->unique_id}}</span><input type="hidden" name="unique_id" readonly class="form-control form-control-sm" value="{{$tenant->unique_id}}"></div>
                                                
                                                <div class="data-row"><label for="">late Fee Amount</label><input type="text" name="late_fee_amount" id="late_fee_amount" value="{{$tenant->late_fee}}" class="form-control form-control-sm" placeholder="$25.00"></div>
                                                
                                                <div class="data-row"><label for="">Grace Period Days</label><input type="text" name="grace_period_days" value="{{$tenant->grace_period_days}}" class="form-control form-control-sm" placeholder="10"></div>
                                                
                                                <div class="data-row"><label for="">Number of Security Deposit</label><input type="text" value="{{$tenant->number_of_security_deposit}}" name="number_of_security_deposit" class="form-control form-control-sm" placeholder="2"></div>
                                                
                                                <div class="data-row"><label for="">Total Security Deposit</label><input type="text" id="security_deposit" value="{{$tenant->total_security_deposit}}" name="total_security_deposit" class="form-control form-control-sm" placeholder="$3700.00"></div>
                                                <?php $day = date('d',strtotime($tenant->first_payment_due_date)) ?>
                                                <div class="data-row"><label for="">Rent Due Date</label>
                                                    <select name="rent_due_date" id="rent_due_date" class="form-select form-select-sm @error('rental_status') is-invalid @enderror">
                                                        
                                                        <option value="1" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 1) selected @endif  @else @if($day == 1) selected @endif @endif>1st of the month</option> 
                                                        <option value="2" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 2) selected @endif  @else @if($day == 2) selected @endif @endif>2nd of the month</option>
                                                        <option value="3" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 3) selected @endif  @else @if($day == 3) selected @endif @endif>3rd of the month</option> 
                                                        <option value="4" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 4) selected @endif  @else @if($day == 4) selected @endif @endif>4th of the month</option> 
                                                        <option value="5" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 5) selected @endif  @else @if($day == 5) selected @endif @endif>5th of the month</option> 
                                                        <option value="6" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 6) selected @endif  @else @if($day == 6) selected @endif @endif> 6th of the month</option> 
                                                        <option value="7" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 7) selected @endif  @else @if($day == 7) selected @endif @endif>7th of the month</option> 
                                                        <option value="8" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 8) selected @endif  @else @if($day == 8) selected @endif @endif>8th of the month</option> 
                                                        <option value="9" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 9) selected @endif  @else @if($day == 9) selected @endif @endif>9th of the month</option> 
                                                        <option value="10" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 10) selected @endif  @else @if($day == 10) selected @endif @endif>10th of the month</option> 
                                                        <option value="11" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 11) selected @endif  @else @if($day == 11) selected @endif @endif>11th of the month</option> 
                                                        <option value="12" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 12) selected @endif  @else @if($day == 12) selected @endif @endif>12th of the month</option> 
                                                        <option value="13" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 13) selected @endif  @else @if($day == 13) selected @endif @endif>13th of the month</option> 
                                                        <option value="14" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 14) selected @endif  @else @if($day == 14) selected @endif @endif>14th of the month</option> 
                                                        <option value="15" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 15) selected @endif  @else @if($day == 15) selected @endif @endif>15th of the month</option> 
                                                        <option value="16" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 16) selected @endif  @else @if($day == 16) selected @endif @endif>16th of the month</option> 
                                                        <option value="17" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 17) selected @endif  @else @if($day == 17) selected @endif @endif>17th of the month</option> 
                                                        <option value="18" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 18) selected @endif  @else @if($day == 18) selected @endif @endif>18th of the month</option> 
                                                        <option value="19" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 19) selected @endif  @else @if($day == 19) selected @endif @endif>19th of the month</option> 
                                                        <option value="20" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 20) selected @endif  @else @if($day == 20) selected @endif @endif>20th of the month</option> 
                                                        <option value="21" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 21) selected @endif  @else @if($day == 21) selected @endif @endif>21th of the month</option> 
                                                        <option value="22" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 22) selected @endif  @else @if($day == 22) selected @endif @endif>22th of the month</option> 
                                                        <option value="23" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 23) selected @endif  @else @if($day == 23) selected @endif @endif>23rd of the month</option> 
                                                        <option value="24" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 24) selected @endif  @else @if($day == 24) selected @endif @endif>24th of the month</option> 
                                                        <option value="25" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 25) selected @endif  @else @if($day == 25) selected @endif @endif>25th of the month</option> 
                                                        <option value="26" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 26) selected @endif  @else @if($day == 26) selected @endif @endif>26th of the month</option> 
                                                        <option value="27" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 27) selected @endif  @else @if($day == 27) selected @endif @endif>27th of the month</option> 
                                                        <option value="28" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 28) selected @endif  @else @if($day == 28) selected @endif @endif>28th of the month</option> 
                                                        <option value="29" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 29) selected @endif  @else @if($day == 29) selected @endif @endif>29th of the month</option> 
                                                        <option value="30" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 30) selected @endif  @else @if($day == 30) selected @endif @endif>30th of the month</option> 
                                                        <option value="31" @if($tenant->rent_due_date) @if($tenant->rent_due_date == 31) selected @endif  @else @if($day == 31) selected @endif @endif>31th of the month</option> 

                                                       

                                                    </select>
                                                        <!-- <input type="text" value="@if($tenant->rent_due_date){{date('m/d/Y',strtotime($tenant->rent_due_date))}}@endif" name="rent_due_date" autocomplete="off" class="form-control form-control-sm" placeholder="1st">
                                                 -->
                                                 </div>
                                                <div class="data-row"><label for="">Secondary Tenant Name</label><input type="text" name="secondary_name" value="{{$tenant->secondary_first_name.' '.$tenant->secondary_last_name}}" class="form-control form-control-sm" placeholder="Secondary Tenant Name"></div>
                                                <div class="data-row"><label for="">Pets</label><input type="text" name="pets" value="{{$tenant->pets}}" class="form-control form-control-sm" placeholder="No"></div>
                                                
                                                <div class="data-row"><label for="">Storage</label><input type="text" name="storage" value="{{$tenant->storage}}" class="form-control form-control-sm" placeholder="Yes"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Parking</label><input type="text" name="parking" value="{{$tenant->parking}}" class="form-control form-control-sm" placeholder="Yes"></div>
                                                <div>
                                                    <label for="" class="fw-semibold">Notes:</label>
                                                    <textarea name="notes" id="" cols="30" rows="2" class="form-control form-control-sm">{{$tenant->notes}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-end">

                                        </div>
                                    </div>
                                    <div>
                                    <a href="{{url()->previous()}}" class="btn btn-color-11 text-white rounded-2 px-4 me-2">Cancel</a>
                                        <button class="btn btn-sm btn-2 rounded-2">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
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

    $("#late_fee_amount").on("keyup", function() {
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

    
    $("#security_deposit").on("keyup", function() {
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
    });
</script>

</html>