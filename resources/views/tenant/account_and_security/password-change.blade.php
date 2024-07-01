<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
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
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
                        <h1><span id="title"></span></h1>
                    </div>

                    <form action="{{route('tenant.password.save')}}" method="post" class="page-card mx-auto" style="width:500px;">
                        @csrf
                        <div class="form-group-1">
                            <label for="">New Password</label>
                            <!-- <div class="input-icon"> -->
                                <input type="password" name="new_password" class="form-control form-control-sm @error('new_password') is-invalid @enderror" placeholder="Enter New Password">
                                <!-- <i class="fa-solid fa-eye"></i> -->
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!-- </div> -->
                        </div>

                        <div class="form-group-1">
                            <label for="">Re-enter Password</label>
                            <!-- <div class="input-icon"> -->
                                <input type="password" name="new_confirm_password" class="form-control form-control-sm @error('new_confirm_password') is-invalid @enderror" placeholder="Re-enter New Password">
                                <!-- <i class="fa-solid fa-eye"></i> -->
                                @error('new_confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!-- </div> -->
                        </div>

                        <div class="text-center">
                            <button class="btn btn-2">Save</button>
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