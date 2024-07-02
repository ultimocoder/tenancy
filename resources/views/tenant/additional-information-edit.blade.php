<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenant Information</title>
    @include('tenant_layouts.header')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                    @if(session()->has('message'))    
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <div class="row">
                            <div class="col-sm-12">
                            <form action="{{route('tenant.additional-information-update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="page-card">
                                    <div class="title">
                                        <!-- <div class="d-flex column-gap-3">
                                            <a href="additional-information.php" class="btn-xs btn-4"><i class="fa-regular fa-pen-to-square"></i>Save</a>
                                        </div> -->
                                    </div>
                                    <input type="hidden" name="id" value="{{$tenant->id}}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Account number</label><input type="text" class="form-control form-control-sm" value="{{$tenant->unique_id}}" readonly></div>

                                                <div class="data-row"><label for="">late Fee Amount</label><input type="text" name="late_fee" class="form-control form-control-sm" value="{{$tenant->late_fee}}"></div>

                                                <div class="data-row"><label for="">Grace Period Days</label><input type="text"  name="grace_period_days" class="form-control form-control-sm" value="{{$tenant->grace_period_days}}"></div>

                                                <div class="data-row"><label for="">Number of Security Deposit</label><input type="text" name="number_of_decurity_deposit"   class="form-control form-control-sm" value="{{$tenant->number_of_decurity_deposit}}"></div>

                                                
                                                <div class="data-row"><label for="">Total ecurity Deposit</label><input type="text" name="total_security_deposit"  class="form-control form-control-sm" value="{{$tenant->total_security_deposit}}"></div>

                                                <div class="data-row"><label for="">Rent Due Date</label><input type="text" name="rent_due_date" class="form-control form-control-sm" value="{{$tenant->rent_due_date}}"></div>

                                                <div class="data-row"><label for="">Pet</label><input type="text" class="form-control form-control-sm" name="pets" value="{{$tenant->pets}}"></div>

                                                <div class="data-row"><label for="">Storage</label><input type="text" class="form-control form-control-sm" name="storage"  value="{{$tenant->storage}}"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Parking</label><input type="text" class="form-control form-control-sm"  name="parking"   value="{{$tenant->parking}}"></div>
                                                <div>
                                                    <label for="" class="fw-semibold">Notes:</label>
                                                    <textarea name="notes" id="" cols="30" rows="2" class="form-control form-control-sm">{{$tenant->notes}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-lg btn-2 rounded-2">Submit</button>
                                    </div>
                                </div>
                           </form>
                            </div>
                          
                        </div>

                    </div>
                </div>
            </div>
            @include('tenant_layouts.footer')
        </div>
    </div>
    @include('tenant_layouts.script')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</body>

</html>