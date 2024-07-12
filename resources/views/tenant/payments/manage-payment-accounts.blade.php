<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Payment Accounts</title>
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
                    @if(session()->has('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="page-card mx-auto" style="width: 600px;">
                        <div class="heading-underline">Payment Methods</div>
                        @foreach($cardlist as $card)
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-group">
                                <label for="">{{$card->nickname}} <span class="badge text-bg-success">@if($card->primary == 'on') PRIMARY @endif</span></label>
                                <div><b class="ls-2 text-black-50">{{ '**************' . substr($card->card_number,-4);}}</b></div>
                            </div>
                            <a href="{{route('tenant.tenant-edit-bank-account', $card->id)}}" class="btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                        </div>
                        @endforeach
                        <div class="lr-line-text">Add a payment method</div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-group">
                                <label for="">Auto Pay</label>
                                <div class="text-black-50">Set up auto pay</div>
                            </div>
                            <a href="{{route('tenant.tenant-add-payment-method')}}" class="btn-xs btn-1"><i class="fa-regular fa-circle-plus"></i>Add</a>
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