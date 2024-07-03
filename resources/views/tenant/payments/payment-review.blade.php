<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Review</title>
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
                                <form action="" method="POST" class="page-card">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Account Number</label>
                                                    <div class="value">{{$tenant_info->unique_id}}</div>
                                                </div>
                                                <div class="data-row"><label for="">Payment due date</label>
                                                    <div class="value">01/01/2024</div>
                                                </div>
                                                <div class="data-row"><label for="">Amount to Pay</label>
                                                    <div class="value">${{$tenant_info->rental_amount}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Late fee</label>
                                                    <div class="value">${{$tenant_info->late_fee}}</div>
                                                </div>
                                                <div class="data-row"><label for="">Total payment amount</label>
                                                    <div class="value">${{$tenant_info->rental_amount}}</div>
                                                </div>
                                                <div class="data-row"><label for="">Payment method</label>
                                                    <div class="value">CHASE</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="data-box"> 
                                                <div class="data-row"><label for="">Payment date</label>
                                                    <div class="value">@if($tenant_info->lease_end_date){{ date('m/d/Y', strtotime($tenant_info->lease_end_date))}} @endif</div>
                                                </div>
                                                <div class="data-row"><label for="">Confirmation Email</label>
                                                    <div class="value">{{$tenant_info->email}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree to the <b>Payment Terms & Conditions</b>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-2 rounded-2">Submit Payment</button>
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
</body>

</html>