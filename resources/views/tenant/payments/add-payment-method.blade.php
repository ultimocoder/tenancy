<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Payment Method</title>
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
                    <form action="set-up-auto-pay.php" class="page-card mx-auto" style="width: 600px;">
                        <div class="heading-underline">Account Information</div>

                        <div class="fs-18 text-black-50">Payment Information</div>

                        <div>
                            <div class="fs-16 fw-medium mb-2">Credit or Debit Card</div>
                            <img src="{{asset('tenants/cards.png')}}" class="img-fluid" alt="">
                        </div>


                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group fs-16">
                                    <label for="">Card number</label>
                                    <input type="number" class="form-control" placeholder="xxxx xxxx xxxx xxxx">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group fs-16">
                                    <label for="">Expiration</label>
                                    <div class="d-flex column-gap-2">
                                        <input type="number" class="form-control" placeholder="MM" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="xx">
                                        <input type="number" class="form-control" placeholder="YYYY" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" value="xxxx">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group fs-16">
                                    <label for="">Security code <i class="fa-solid fa-circle-info ms-2 text-black-50"></i></label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group fs-16">
                                    <label for="">Billing zip code</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row align-items-center">
                            <div class="col-sm-6"><b>Nickname</b></div>
                            <div class="col-sm-6"><input type="text" class="form-control form-control-sm" placeholder="Account Nickname"></div>
                        </div>

                        <div class="d-flex">
                            <b class="me-3">Set as primary</b>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked"><b>Yes</b></label>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="Submit" class="btn btn-2">Save Account</button>
                        </div>
                    </form>
                </div>
            </div>
            @include('tenant_layouts.footer')
        </div>
    </div>
    @include('tenant_layouts.script')
</body>

</html>