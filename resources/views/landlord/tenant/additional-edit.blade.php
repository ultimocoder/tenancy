<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenant Additional Information</title>
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
                                <div class="page-card">
                                    <div class="title">
                                        <!-- <div class="d-flex column-gap-3">
                                            <a href="tenant-information-2.php" class="btn-xs btn-4"><i class="fa-regular fa-pen-to-square"></i>Save</a>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Account number</label><input type="text" class="form-control form-control-sm" value="{{$tenant->unique_id}}"></div>
                                                <div class="data-row"><label for="">late Fee Amount</label><input type="text" class="form-control form-control-sm" value="$25.00"></div>
                                                <div class="data-row"><label for="">Grace Period Days</label><input type="text" class="form-control form-control-sm" value="10"></div>
                                                <div class="data-row"><label for="">Number of Security Deposit</label><input type="text" class="form-control form-control-sm" value="2"></div>
                                                <div class="data-row"><label for="">Total Security Deposit</label><input type="text" class="form-control form-control-sm" value="$3700.00"></div>
                                                <div class="data-row"><label for="">Rent Due Date</label><input type="text" class="form-control form-control-sm" value="1st"></div>
                                                <div class="data-row"><label for="">Pet</label><input type="text" class="form-control form-control-sm" value="No"></div>
                                                <div class="data-row"><label for="">Storage</label><input type="text" class="form-control form-control-sm" value="Yes"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="data-box">
                                                <div class="data-row"><label for="">Parking</label><input type="text" class="form-control form-control-sm" value="Yes"></div>
                                                <div>
                                                    <label for="" class="fw-semibold">Notes:</label>
                                                    <textarea name="" id="" cols="30" rows="2" class="form-control form-control-sm">Other residents of this lease agreement are John Doe, Jane Doe</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-end">

                                        </div>
                                    </div>
                                    <div>
                                    <a href="{{url()->previous()}}" class="btn btn-color-11 text-white rounded-2 px-4 me-2">Cancel</a>
                                        <button class="btn btn-sm btn-2 rounded-2">Save</button>
                                    </div>
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
</body>

</html>