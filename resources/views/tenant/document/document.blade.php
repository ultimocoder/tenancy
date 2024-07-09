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
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Size</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($document_info) > 0)
                                        @foreach($document_info as $document)
                                        <tr>
                                            <td><a href="/landlord/upload-documents/{{$document->document}}" download>{{$document->document}}</a></td>
                                            <td>{{$document->desc}}</td>
                                            <td>@if($document->date){{ date('m/d/Y', strtotime($document->date))}} @endif</td>
                                            <td>{{$document->size}}</td>
                                        </tr>
                                          
                                            @endforeach
                                            @endif
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