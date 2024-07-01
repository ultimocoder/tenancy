<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
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

                                    <div class="heading-underline">User Details</div>

                                    <div class="form-group">
                                        <label for="">User Name</label>
                                        <div class="data-value">{{$user->username}}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <div class="data-value">{{$user->first_name}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <div class="data-value">{{$user->last_name}}</div>
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <div class="data-value">{{$user->phone}}</div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <div class="data-value">{{$user->email}}</div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                  

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="page-card">
                                            
                                <div class="form-group">
                                        <label for="">Status</label>
                                         @if($user->status =='1')
                                          <div class="data-value">Active</div>

                                                                                                              
                                              @else
                                              <div class="data-value">Inactive</div>

                                                                        
                                              @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="">City</label>
                                        <div class="data-value">{{$user->city}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <div class="data-value">{{$user->state}}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Country</label>
                                        <div class="data-value">{{$user->country}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Zip Code</label>
                                        <div class="data-value">{{$user->zipcode}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <div class="data-value">{{$user->address}}</div>
                                    </div>
                                
                            
                                    
                                       
                                
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <!-- <button class="btn btn-color-8 text-white rounded-2 col-sm-2">Save</button> -->
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