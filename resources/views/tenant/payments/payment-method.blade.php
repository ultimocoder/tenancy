<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Methods</title>
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
                                <form action="" class="page-card mx-auto" style="width: 600px;">
                                    <div class="heading-underline justify-content-between">
                                        <span>Bank Accounts</span>
                                        <a href="" class="btn btn-xs btn-1"><i class="fa-regular fa-circle-plus"></i>Add New</a>
                                    </div>

                                    <div class="cus-radio-1">
                                        <input type="radio" name="payment-amount" id="Monthly" checked>
                                        <label for="Monthly">
                                            <span class="d-flex">
                                                <i class="fa-solid fa-circle-check mt-1 me-2 check"></i>
                                                <span>
                                                    <b class="d-block">Chase</b>
                                                    <span class="text-black-50 fw-bold ls-2 d-block">********4839</span>
                                                    <span class="fs-12 text-black-50 d-block lh-1">Checking Account</span>
                                                </span>
                                            </span>
                                            <a href="" class="icon fs-14"><i class="fa-solid fa-pencil"></i></a>
                                        </label>
                                    </div>

                                    <div class="cus-radio-1">
                                        <input type="radio" name="payment-amount" id="Past">
                                        <label for="Past">
                                            <span class="d-flex">
                                                <i class="fa-solid fa-circle-check mt-1 me-2 check"></i>
                                                <span>
                                                    <b class="d-block">Discover</b>
                                                    <span class="text-black-50 fw-bold ls-2 d-block">********2154</span>
                                                    <span class="fs-12 text-black-50 d-block lh-1">Checking Account</span>
                                                </span>
                                            </span>
                                            <a href="" class="icon fs-14"><i class="fa-solid fa-pencil"></i></a>
                                        </label>
                                    </div>

                                    <div class="text-center">
                                        <button type="Submit" class="btn btn-2">Done</button>
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