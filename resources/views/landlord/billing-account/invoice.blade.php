<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    @include('landlord_layouts.header')
</head>

<style>
    @page {margin: 0;}

    body {margin: 0;padding: 0;}

    @media print {
        body .page-card{padding: 30px; background-color: #ffffff; display: grid; row-gap: 24px;}
    }
</style>

<body>
    <div class="admin-container">
    @include('landlord_layouts.navbar')
        <div class="rightside">
            <div class="top">
                @include('landlord_layouts.topbar')
                <div class="page" >
                <div class="page-title">
                <div class="withButton">
                        <div>
                            <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
                            <h1><span id="title"></span></h1>
                        </div>
                        <a href="{{route('landlord.account.invoice.list')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                    </div>
                </div>
                    <div id="printable-section">
                    <div class="page-card mx-auto" style="width:700px;" >

                        <div class="text-end">
                            <a href="javascript:void(0);" id="printButton" onclick="printSection()" class="text-dark fw-bold">PRINT <i class="fa-solid fa-print fs-20 ms-2"></i></a>
                        </div>

                        <div class="form-group-1" >
                            <label for="">Account ID</label>
                            <div class="dataValue">{{Auth::user()->unique_id}}</div>
                        </div>

                        <div>
                            <div class="fw-semibold">#{{$invoice->number}}</div>
                            <div class="fw-semibold text-black-50">Charged on {{$nextDueDate}}</div>
                        </div>

                        <div class="box-style-2 mb-2">
                            <div class="heading-2">Issued TO</div>
                            <div class="mb-2">
                                <div class="fw-semibold fs-16">{{ucwords($invoice->customer_name)}}</div>
                                <div class="fs-14 fw-semibold text-black-50">{{$invoice['customer_address']['line1']}}, {{$invoice['customer_address']['city']}},<br>{{$invoice['customer_address']['state']}} @if($invoice['customer_address']['state'] == '') {{$invoice['customer_address']['state']}} @else {{Auth::user()->zipcode}}, @endif {{$invoice['customer_address']['country']}}</div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="fw-semibold fs-16">Card Number</div>
                                <div class="fw-semibold fs-16">**** **** **** {{$data['card']['last4']}}</div>
                            </div>
                        </div>
                        <div class="box-style-2">
                            <div class="heading-2">Issued by</div>
                            <div class="mb-0">
                                <div class="fw-semibold fs-16">Tech Hope LLC</div>
                                <div class="fs-14 fw-semibold text-black-50">USA</div>
                            </div>
                        </div>
                        <div class="box-style-2">
                            <div class="heading-2">Charges</div>
                            <div class="mb-2">All prices in US Dollar.</div>
                            <div class="d-flex p-2 border-bottom border-top align-items-center justify-content-between fs-16">
                                <div class="fw-bold">Subscription: 
                                    <!-- @if($package->package_id == 1) 
                                        Single Unit 
                                    @elseif($package->package_id == 2) 
                                        Multi Unit @else Commercial 
                                    @endif   -->
                                    @foreach($packageList as $list)
                                        @if($list->price_id == $plan->id)
                                            @if($list->package_id == 1) 
                                                Single Unit 
                                            @elseif($list->package_id == 2) 
                                                Multi Unit
                                             @else 
                                                Commercial 
                                            @endif 
                                        @endif
                                    @endforeach


                                    <span>
                                        @foreach($packageList as $list)
                                        @if($list->price_id == $plan->id)

                                        ({{$list->schedule_type}})
                                        @endif
                                        @endforeach
                                    </span> - 
                                    @if(count($invoice['lines']['data']) > 1) 
                                        {{$invoice['lines']['data'][1]['quantity']}} 
                                    @else 
                                        {{$invoice['lines']['data'][0]['quantity']}} 
                                    @endif  
                                        Unit</div>
                                <div class="fw-bold text-end">${{number_format($invoice->subtotal/100 ,2)}}</div>
                            </div>
                        <div class="d-flex p-2 align-items-center justify-content-between fs-16"><div class="fw-semibold text-black-50">Subtotal</div><div class="fw-bold text-end">${{number_format($invoice->subtotal/100 ,2)}}</div></div>
                        <div class="d-flex p-2 align-items-center justify-content-between fs-16"><div class="fw-semibold text-black-50">Discount</div><div class="fw-bold text-end">@if(count($invoice->total_discount_amounts)> 0) ${{ number_format($invoice['total_discount_amounts']['0']['amount']/100,2)}} @else - @endif</div></div>
                        <div class="d-flex p-2 align-items-center justify-content-between fs-16"><div class="fw-semibold text-black-50">Sales Tax (0.00%)</div><div class="fw-bold text-end">$0.00</div></div>
                        <div class="d-flex p-2 align-items-center justify-content-between fs-16"><div class="fw-semibold text-black-50">Due</div><div class="fw-bold text-end">$0.00</div></div>
                        <div class="d-flex p-2 align-items-center justify-content-between fs-16"><div class="fw-semibold">Paid</div><div class="fw-bold text-end">${{number_format($invoice->amount_paid/100 ,2)}}</div></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>

<script>
//     $(document).ready(function(){
//     // Select the element you want to attach the print functionality to
//     $('#printButton').click(function(){
//         // Call the print function when the button is clicked
//         //window.print();
//         var printContents = document.getElementById("printable-section").innerHTML;
//         var originalContents = document.body.innerHTML;
//         document.body.innerHTML = printContents;
//         window.print();
//         document.body.innerHTML = originalContents;
//     });
// });

function printSection() {
    var printContents = document.getElementById("printable-section").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>

</html>