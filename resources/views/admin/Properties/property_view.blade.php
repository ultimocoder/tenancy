<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property</title>
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

                                    <div class="heading-underline">Property Details</div>

                                    <div class="form-group">
                                        <label for="">Property Name</label>
                                        <div class="data-value">{{$property->property_name}}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Street Address</label>
                                        <div class="data-value">{{$property->address}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">City</label>
                                                <div class="data-value">{{$property->city}}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">State</label>
                                                <div class="data-value">{{$property->state}}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Postal Code</label>
                                                <div class="data-value">{{$property->postal_code}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Property Type</label>
                                                @if($property->property_type_id =='1')
                                                <div class="data-value">Single Family </div>
                                                                                             
                                                        @elseif($property->property_type_id =='2')
                                                        <div class="data-value"> Multiple Unit</div>
                                                        @elseif($property->property_type_id =='3')
                                                        <div class="data-value"> Commercial</div>
                                                        @endif
                                            
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Active Property</label>
                                                @if($property->active_property =='1')
                                                <div class="data-value">Active </div>
                                                                                             
                                                        @else
                                                        <div class="data-value"> Inactive</div>
                                                        
                                                        @endif
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="page-card">
                                    <div class="heading-underline">Enter Units</div>
                                    <div class="units">
                                    @foreach($unit as $units)
                      
                                        <div class="heading-2">Unit {{$loop->index+1}}</div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group mb-3">
                                                    <label for="">Unit Number</label>
                                                    <div class="data-value">{{$units->unit_name}}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-3">
                                                    <label for=""># of Rooms</label>
                                                    <div class="data-value">{{$units->room}}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                    <label for="">Kitchen</label>
                                                    <div class="data-value">{{$units->kitchen}}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                    <label for="">Bathtoom?</label>
                                                    <div class="data-value">{{$units->bathroom}}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                    <label for="">Sq Ft</label>
                                                    <div class="data-value">{{$units->sqfeet}}</div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                          
                                    @endforeach
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