<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change User Name</title>
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
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
                        <h1><span id="title"></span></h1>
                    </div>

                    <form method="post" action="{{route('landlord.username.save')}}" class="page-card mx-auto" style="width:500px;">
                        @csrf
                        <div class="form-group-1">
                            <label for="">Current user name</label>
                            <input type="text" class="form-control" name="" value="{{Auth::user()->username}}" placeholder="Enter New Password" disabled>
                        </div>

                        <div class="form-group-1">
                            <label for="">New User name</label>
                            <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" placeholder="Enter User Name">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="text-center">
                            <button class="btn btn-2">Save</button>
                        </div>

                    </form>

                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>

</html>