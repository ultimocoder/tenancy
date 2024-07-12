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

                    <div class="heading-3 mb-4">Account number: <span class="text-color-6 ms-1">SC417956</span></div>

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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>November 05, 2023</td>
                                                <td class="text-uppercase"><i class="fa-solid fa-circle-minus text-color-11 me-2"></i>Pending</td>
                                                <td>$2,100.00</td>
                                            </tr>
                                            <tr>
                                                <td>October 09, 2023</td>
                                                <td class="text-uppercase"><i class="fa-solid fa-circle-check text-color-9 me-2"></i>processed</td>
                                                <td>$1,900.00</td>
                                            </tr>
                                            <tr>
                                                <td>September 01, 2023</td>
                                                <td class="text-uppercase"><i class="fa-solid fa-circle-check text-color-9 me-2"></i>processed</td>
                                                <td>$1,650.00</td>
                                            </tr>
                                            <tr>
                                                <td>August 08, 2023</td>
                                                <td class="text-uppercase"><i class="fa-solid fa-circle-check text-color-9 me-2"></i>processed</td>
                                                <td>$1,650.00</td>
                                            </tr>
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
        Object.assign(DataTable.defaults, {
            searching: false,
            ordering: false,
            info: false,
            ordering: false,
            paging: true
            
        });

        new DataTable('#example');
    </script>
    <script>
        $("#example_wrapper").addClass("reset");
    </script>
</body>

</html>