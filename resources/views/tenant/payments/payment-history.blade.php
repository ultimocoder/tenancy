<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment History</title>
    @include('tenant_layouts.header')
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

                    <div class="fs-18 mb-4 text-color fw-semibold mb-4">Account number: <span class="text-color-6 ms-1">{{AUth::user()->unique_id}}</span></div>

                    <div class="container-fluid">
                        <div class="row"> 
                            <div class="col-sm-12">
                                <div class="page-card">

                                    <table id="example" class="data-table">
                                        <thead>
                                            <tr>
                                                <th>Payment date</th>
                                                <th>Status</th>
                                                <th>Rent Amount</th>
                                                <th>Paid Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--<tr>-->
                                            <!--    <td>November 05, 2023</td>-->
                                            <!--    <td class="text-uppercase"><i class="fa-solid fa-circle-minus text-color-11 me-2"></i>Pending</td>-->
                                            <!--    <td>$2,100.00</td>-->
                                            <!--</tr>-->
                                            @if(count($payment_histories) > 0)
                                                @foreach($payment_histories as $pay)
                                                    <tr>
                                                        <td>{{date('F d, Y',strtotime($pay->transaction_date))}}</td>
                                                        @if($pay->payment_status == 'completed')
                                                        <td class="text-uppercase"><i class="fa-solid fa-circle-check text-color-9 me-2"></i>{{$pay->payment_status}}</td>
                                                        @else
                                                        <td class="text-uppercase"><i class="fa-solid fa-circle-minus text-color-11 me-2"></i>{{$pay->payment_status}}</td>
                                                        @endif
                                                        
                                                        <td>${{$pay->rental_amount}}</td>
                                                        <td>${{ number_format($pay->paid_amount, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            <!--<tr>-->
                                            <!--    <td>August 08, 2023</td>-->
                                            <!--    <td class="text-uppercase"><i class="fa-solid fa-circle-check text-color-9 me-2"></i>processed</td>-->
                                            <!--    <td>$1,650.00</td>-->
                                            <!--</tr>-->
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('tenant_layouts.footer')
        </div>
    </div>
    @include('tenant_layouts.script')
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script>
        // Object.assign(DataTable.defaults, {
        //     searching: false,
        //     ordering: false,
        //     info: false,
        //     ordering: false,
        //     paging: true
        // });

        // new DataTable('#example');
        new DataTable('#example', {
            layout: {
                topStart: null,
                topEnd:null,
                bottom: null,
                bottomStart: 'paging',
                bottomEnd: 'pageLength'
            },
            order: [['desc']]
        });
    </script>
    <script>
        $("#example_wrapper").addClass("reset");
    </script>
</body>

</html>