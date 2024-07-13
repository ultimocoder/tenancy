<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Correspondence</title>
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <div class="title">
                                        <div></div>
                                        <div class="d-flex column-gap-3">
                                            <a href="message-send.php" class="btn-xs btn-2"><i class="fa-regular fa-envelope"></i>New Message</a>
                                        </div>
                                    </div>
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Property Address</th>
                                                <th> Submitted by</th>
                                                <th> Subject</th>
                                                <th> Status</th>
                                                <th> Date Opened</th>
                                                <th> Date Closed</th>
                                                <th> Priority</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="message-receive.php">51 Blake Avenue</a></td>
                                                <td> Amy Smith</td>
                                                <td> Refrigerator water filter</td>
                                                <td> Closed</td>
                                                <td>07/04/2023</td>
                                                <td>08/04/2023</td>
                                                <td>Low</td>
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
    <script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.0/js/select.dataTables.js"></script>
    <script>
        new DataTable('#example', {
            layout: {
                topStart: '',
                topEnd: '',
                bottom: '',
                bottomStart: null,
                bottomEnd: null
            }
        });
    </script>
</body>

</html>