<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenant</title>
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
                        <h1><span id="title"></span> - View</h1>
                    </div>
                    <div class="container-fluid">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="page-card">

                                    <div class="heading-underline">Tenant Details</div>


                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <div class="data-value">{{$tenant->first_name}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <div class="data-value">{{$tenant->last_name}}</div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Secondary First Name</label>
                                                <div class="data-value">{{$tenant->secondary_first_name}}</div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="">Secondary First Name</label>
                                                <div class="data-value">{{$tenant->secondary_last_name}}</div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Tenant Created</label>
                                                <div class="data-value">{{$tenant->created_at}}</div>
                                            </div>
                                        </div>
                                      
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="page-card">
                                            
                                <div class="form-group">
                                        <label for="">Email</label>
                                        <div class="data-value">{{$tenant->email}}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Lease Start Date</label>
                                        <div class="data-value">{{$tenant->lease_start_date}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Lease End Date</label>
                                        <div class="data-value">{{$tenant->lease_end_date}}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Rental Amount</label>
                                        <div class="data-value">{{$tenant->rental_amount}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        @if($tenant->status =='1')
                                                                    
                                        <div class="data-value">Active</div>
                                                       
                                                                @else
                                                                <div class="data-value">InActive</div>
                                                                
                                                                @endif
                                    </div>
                             
                                
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-color-8 text-white rounded-2 col-sm-2">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            @include ('admin_layout.footer')   

        </div>
    </div>
    @include ('admin_layout.script')   

</body>

</html>