<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Expenses</title>
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
                    <form class="page-card mx-auto" action="{{route('landlord.expenses.update')}}" enctype="multipart/form-data" method="post" style="width: 600px;">
                        @csrf
                        <input type="hidden" name="id" value="{{$expense->id}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Expenses Type</label>
                                    <select name="expense" id="" class="form-select">
                                        @foreach($expense_types as $ex)
                                            <option value="{{$ex->name}}" @if($ex->name == $expense->expense_type) selected @endif>{{$ex->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Property</label>
                                    <select name="property" id="" class="form-select">
                                        @foreach($property as $prop)
                                        <option value="{{$prop->id}}" @if($prop->id == $expense->property) selected @endif>{{$prop->property_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" placeholder="e.g. water bill" name="desc" value="{{$expense->desc}}" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="text" name="amount" id="price" placeholder="Enter amount" value="${{number_format($expense->amount, 2)}}" class="form-control @error('amount') is-invalid @enderror">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="text" name="date" value="{{date('m/d/Y',strtotime($expense->date))}}"  class="date form-control @error('date') is-invalid @enderror">
                                    @error('date')
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
                                    <label for="">Company name</label>
                                    <input type="text" name="company_name" placeholder="Enter company name" value="{{$expense->company_name}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Attach receipt</label>
                                    <input type="file" name="receipt" placeholder="warter-bill.pdf" class="form-control">
                                </div>
                                @if($expense->receipt)
                                    <a href="/landlord/expenses/{{$expense->receipt}}" download>{{$expense->receipt}}</a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Note</label>
                            <input placeholder="Enter note" class="form-control" name="note" placeholder="Period monthly light bill" value="{{$expense->note}}">
                        </div>

                        <div class="text-center">
                            <a href="{{URL::previous()}}" class="btn btn-color-11 text-white rounded-2 me-2">Cancel</a>
                            <button type="submit" class="btn btn-color-8 rounded-2">Save Changes</button>
                            
                        </div>
                    </form>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function(){
        $( ".date" ).datepicker(
            {
                dateFormat: "mm/dd/yy",
            }
        );
        // $('#price').on('keyup', function(){
        //         var value = $(this).val().replace(/[^0-9.]/g, '');
        //         if(value !== '' && !isNaN(value)){
        //             $(this).val('$' + value);
        //         }
        //     });

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
    });
</script>

</html>