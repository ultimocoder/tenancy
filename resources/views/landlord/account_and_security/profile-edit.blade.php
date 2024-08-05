<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
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
                    <div class="container-fluid">
                        <form action="{{route('landlord.profile.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="page-card">

                                    <div class="profile-pic">
                                    @if(Auth::user()->image)
                                    <img src="{{ asset('landlord/profile/'.Auth::user()->image)}}" id="previewImage" alt="Preview Image">
                                    @else
                                    <img src="{{ asset('user.png')}}" id="previewImage" alt="Preview Image">
                                    @endif
                                        
                                        <input type="file" name="file" id="file">
                                        <label for="file"><i class="fa-solid fa-pen-to-square"></i></label>
                                    </div>

                                    <div class="form-group-1">
                                        <label for="">User name</label>
                                        <div class="dataValue">
                                            <span>{{Auth::user()->username}}</span>
                                             <a href="{{route('landlord.account.username.change')}}" class="btn btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        </div>
                                    </div>

                                    <div class="form-group-1">
                                        <label for="">Password</label>
                                        <div class="dataValue">
                                            <span>*****************</span>
                                            <a href="{{route('landlord.account.password.change')}}" class="btn btn-xs btn-1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="page-card">

                                    <div class="form-group-1">
                                        <label for="">Account ID</label>
                                        <div class="dataValue">{{Auth::user()->unique_id}}</div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div class="heading-2">Personal Information</div>
                                        <button class="btn btn-xs btn-4"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">First name</label>
                                                <input type="text" placeholder="Sharod" name="first_name" value="{{Auth::user()->first_name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Last name</label>
                                                <input type="text" placeholder="Sharodtest" name="last_name" value="{{Auth::user()->last_name}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="number" placeholder="Sharodtest" name="phone" value="{{Auth::user()->phone}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" placeholder="Email" readonly name="email" value="{{Auth::user()->email}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" placeholder="Address" name="address" value="{{Auth::user()->address}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Zipcode</label>
                                                <input type="number" placeholder="Zip code" name="zipcode" value="{{Auth::user()->zipcode}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">City</label>
                                                <input type="text" placeholder="City" name="city" value="{{Auth::user()->city}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">State</label>
                                                <input type="text" placeholder="State" name="state" value="{{Auth::user()->state}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Country</label>
                                                <select name="country" id="country-dropdown" class="form-control form-control-sm form-control-sm @error('country') is-invalid @enderror">
                                                    <option value="">-- Select Country --</option>
                                                    @if(count($countries) > 0)
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->nicename}}" @if($country->nicename == Auth::user()->country) selected @endif>{{$country->nicename}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" text-center">
                                        <a href="{{route('landlord.profile')}}" class="btn btn-danger btn-sm">Cancel</a>    
                                    </div>

                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
</body>

<script>
    $(function(){
        // Selecting input and image elements
        const uploadInput = document.getElementById('file');
        const previewImage = document.getElementById('previewImage');

        // Function to handle file selection
        uploadInput.addEventListener('change', function() {
            const file = this.files[0]; // Get the selected file

            if (file) {
                const reader = new FileReader(); // Create a FileReader object

                // Closure to capture the file information
                reader.onload = function(event) {
                    previewImage.src = event.target.result; // Set the src attribute of the image
                };

                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });
    });
</script>

</html>