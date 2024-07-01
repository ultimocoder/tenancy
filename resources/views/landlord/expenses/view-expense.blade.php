<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Expense</title>
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
                    <div class="page-card mx-auto" style="width: 600px;">

                    
                    <div class="text-end">
                        <a href="{{route('landlord.expenses.edit', $expense->id)}}" class="btn btn-sm btn-color-8 text-white">Edit</a>
                        <a href="{{route('landlord.expenses.delete', $expense->id)}}" onclick="return confirm('Are you sure you want to delete this expense?')" class=" btn btn-danger btn-sm">Delete</a>
                    </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Expenses Type</label>
                                    <div class="data-value">{{$expense->expense_type}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Property</label>
                                    <div class="data-value">@foreach($property as $pr) @if($pr->id == $expense->property) {{$pr->property_name}} @endif @endforeach</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <div class="data-value">{{$expense->desc}}</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <div class="data-value">${{$expense->amount}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <div class="data-value">
                                        <!-- {{ date_format(new DateTime($expense->date),"d-M-Y") }}     -->
                                        {{ date_format(new DateTime($expense->date),"m/d/Y") }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Company name</label>
                                    <div class="data-value">{{$expense->company_name}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Attach receipt</label>
                                    <div class="data-value"><a href="/landlord/expenses/{{$expense->receipt}}" download>{{$expense->receipt}}</a></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Note</label>
                            <div class="data-value">{{$expense->note}}</div>
                        </div>
                        <div class="text-center">
                        <a href="{{route('landlord.list.expenses')}}" class="btn btn-color-11 text-white rounded-2 me-2">Cancel</a> 
                        </div>

                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>

</html>