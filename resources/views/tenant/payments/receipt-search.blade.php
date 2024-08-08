<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipts</title>
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
                        <form action="rental-receipt.php">
                            <div class="page-card mb-4">
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <div class="fw-semibold mb-3">Enter the month and year of the receipt</div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <label for="" class="fw-semibold me-2 text-nowrap">Month</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="">- Select Month -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <label for="" class="fw-semibold me-2 text-nowrap">Year</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="">- Select Month -</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <h4 class="mb-0">- Advanced -</h4>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="fw-semibold mb-3">Enter the dates for which
                                            you want to see receipts for:</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row align-items-center">
                                            <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-sm-0 mb-3">
                                                            <label for="" class="fw-semibold me-2 text-nowrap">Month</label>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">- Select Month -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-sm-0 mb-3">
                                                            <label for="" class="fw-semibold me-2 text-nowrap">Year</label>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">- Select Month -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 text-center">
                                                <h4 class="mb-0">To</h4>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-sm-0 mb-3">
                                                            <label for="" class="fw-semibold me-2 text-nowrap">Month</label>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">- Select Month -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-sm-0 mb-3">
                                                            <label for="" class="fw-semibold me-2 text-nowrap">Year</label>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">- Select Month -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end"><button class="btn btn-2 rounded-2">Search</button></div>
                        </form>
                    </div>
                </div>
            </div>
            @include('tenant_layouts.footer')
        </div>
    </div>
    @include('tenant_layouts.script')
</body>

</html>