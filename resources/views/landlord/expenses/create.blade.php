<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Expense</title>
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
                    <form action="{{route('landlord.expenses.save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="page-card mx-auto" style="width: 600px;">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Expenses Type</label>
                                    <select name="expense" id="" class="form-select @error('expense') is-invalid @enderror" >
                                        <option value="">Select Expense Type</option>
                                        @foreach($expense_types as $et)
                                        <option value="{{$et->name}}" {{ old('expense') == $et->name ? 'selected' : '' }}>{{$et->name}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" class="form-control @error('expense') is-invalid @enderror" name="expense" placeholder="Enter expense type"> -->
                                    @error('expense')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Property</label>
                                    <select name="property" id="" class="form-select @error('property') is-invalid @enderror">
                                        <option value="">Select Property</option>
                                        @foreach($property as $prop)
                                        <option value="{{$prop->id}}" {{ old('property') == $prop->id ? 'selected' : '' }}>{{$prop->property_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('property')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="desc" placeholder="e.g. water bill" class="form-control" value="{{ old('desc') }}" >
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="text" name="amount" value="{{ old('amount') }}" id="price" placeholder="Enter amount" class="form-control @error('amount') is-invalid @enderror" title="Please enter a valid price (e.g., $10.00)">
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
                                    <input type="text" name="date" autocomplete="off" class="date form-control @error('date') is-invalid @enderror">
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
                                    <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Enter company name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Attach receipt</label>
                                    <input type="file" name="receipt" accept="" placeholder="warter-bill.pdf" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Note</label>
                            <input type="text" placeholder="Enter note" name="note" value="{{ old('note') }}" class="form-control">
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