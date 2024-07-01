<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoices</title>
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
                    <div class="withButton">
                            <div>
                                <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <a href="#">Billing</a> / <span id="activepage"></span></div>
                                <h1><span id="title"></span></h1>
                            </div>
                            <a href="{{route('landlord.account.billing')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                        </div>
                    </div>

                    <div class="page-card mx-auto" style="width:600px;">

                        <div class="form-group-1">
                            <label for="">Account ID</label>
                            <div class="dataValue">{{Auth::user()->unique_id}}</div>
                        </div>

                        <div class="heading-2"> {{ date('Y') }} </div>

                        <table id="example" class="data-table table" style="width:100%">
                            <thead class="d-none">
                                <tr>
                                    <th>Properties</th>
                                    <th>Properties Address</th>
                                    <th width="110">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($invoices) > 0)
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ date('F d, Y, g:i A',$invoice->created)}}</td>
                                        <td>${{ number_format($invoice->amount_paid/100,2)}}</td>
                                        <td class="text-end"><a href="{{route('landlord.account.invoice', $invoice->id)}}" class="text-black-50"><i class="fa-regular fa-eye"></i></a></td>
                                    </tr>
                                    
                                    @endforeach
                                @endif
                               

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script>
        // Object.assign(DataTable.defaults, {
        //     searching: false,
        //     ordering: false,
        //     info: false,
        //     ordering: false,
        //     paging: true
        // });

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