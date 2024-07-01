<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
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
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Tenant</th>
                                                <!-- <th>Properties Address</th> -->
                                                <th>Phone</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($tenants) > 0)
                                                @foreach($tenants as $t)
                                                <tr>
                                                    <td><a href="{{route('landlord.tenant.edit', $t->user_id)}}" class="nav-link">{{$t->first_name}} {{$t->last_name}} </a></td>
                                                    <!-- <td>51 Jordan Avenue</td> -->
                                                    <td><a href="{{route('landlord.tenant.edit', $t->user_id)}}" class="nav-link">{{$t->phone}} </a></td>
                                                    <td><a href="{{route('landlord.tenant.edit', $t->user_id)}}" class="nav-link">{{$t->email}}</a></td>
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
            @include('landlord_layouts.footer')
        </div>
    </div>

    @include('landlord_layouts.script')
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
                     buttons: [
                        {
                            text: '<i class="fa-regular fa-circle-plus"></i>Add New Tenant',
                            className: 'btn-xs btn-1',
                            action: function(e, dt, button, config) {
                                window.location = '{{route('landlord.new.tenant')}}';
                            }
                        }
                    ]
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