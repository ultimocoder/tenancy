<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documents</title>
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
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th> Description</th>
                                                <th> Date</th>
                                                <th> Size</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> Lease Agreement.docx</td>
                                                <td> Lease Agreement</td>
                                                <td> 10/20/2022</td>
                                                <td> 114 KB</td>
                                            </tr>
                                            <tr>
                                                <td> Credit Report.docx</td>
                                                <td> Credit Report</td>
                                                <td> 09/25/2019</td>
                                                <td> 130 KB</td>
                                            </tr>
                                            <tr>
                                                <td> Application.pdf</td>
                                                <td> Application for tenancy</td>
                                                <td> 09/25/2016</td>
                                                <td> 120 KB</td>
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