<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Listing</title>
  @include ('admin_layout.header')   
</head>

<body>
    <div class="admin-container">
       @include ('admin_layout.leftbar')   
        <div class="rightside">
            <div class="top">
            @include ('admin_layout.navbar')   
                <div class="page">
                    <div class="page-title">
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span></div>
                        <h1><span id="title"></span></h1>
                    </div>
                    <div class="container-fluid">
                        <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>country</th>
                                                <th>Status</th>
                                               
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user as $users)   

                                                    <tr>
                                                         <td>
                                                    <a class="nav-link" href="{{route('user-view', $users->id)}}"> {{$users->first_name}}</a>
                                                          </td>
                                                        <td> {{$users->last_name}}</td>
                                                        <td> {{$users->phone}}</td>
                                                        <td> {{$users->email}}</td>
                                                        <td> {{$users->city}}</td>
                                                        <td> {{$users->state}}</td>
                                                        <td> {{$users->country}}</td>
                                                        
                                                        @if($users->status =='1')
                                                                        
                                                                            <td>Active </td>                                                                    
                                                                        @else
                                                                        <td>Inactive</td>
                                                                        
                                                                        @endif

                                    
                                                    </tr>

                                                    @endforeach  
                                           
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include ('admin_layout.footer')   
        </div>
    </div>

    @include ('admin_layout.script')   
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.0/js/select.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
    <script>
        new DataTable('#example', {
            //dom: 'fBtpil',
            layout: {
                topStart: 'search',
                topEnd: {
                    // buttons: [{
                    //         // text: '<i class="fa-regular fa-circle-plus"></i>Register New Property',
                    //         // className: 'btn-xs btn-1',
                    //         // action: function(e, dt, button, config) {
                    //         //     // window.location = 'new-properties';
                    //         // }
                    //     },
                    //     {
                    //         // text: '<i class="fa-regular fa-circle-plus"></i>Add New Tenant',
                    //         // className: 'btn-xs btn-1',
                    //         // action: function(e, dt, button, config) {
                    //         //     // window.location = 'add-tenant-in-property.php';
                    //         // }
                    //     }
                    // ]
                },
                bottom: 'paging',
                bottomStart: 'info',
                bottomEnd: 'pageLength'
            },

            language: {
                paginate: {
                    previous: 'Previous',
                    next: 'Next'
                },
                searchPlaceholder: 'Search Properties'
            }
        });
    </script>
</body>

</html>