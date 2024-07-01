@extends('front_layouts.master')

    @section('title' , 'Tenancy')

@section('main-content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
<body class="underpage bg-main">
@include('front_layouts.navbar')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 mx-auto">
                    <form action="{{route('subscription.index')}}" method="Post" enctype="multipart/form-data"
                    role="form" 
                    data-cc-on-file="false"
                    class="require-validation"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form"
                    >
                    @csrf    
                        <div class="new-form">
                            <div class="box">
                                <!-- <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-sm-6 required">
                                        <h2 class="heading-1">Register new account</h2>
                                        <h3 class="heading-2">Account Information</h3>
                                        <input type="hidden" name="package_id" value="{{$package->id}}">
                                        <label for="">User name</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror " value="{{old('username')}}" name="username" id="username" placeholder="Enter user name">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="usernameError" class="error text-danger"></span><br>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ asset('images/sign-up-img.jpg')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 required">
                                        <label for="">Password</label>
                                        <div class="password-control">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter password">
                                            <!-- <a href="#"><i class="fa-regular fa-eye"></i></a> -->
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="passwordError" class="error text-danger"></span><br>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 required">
                                        <label for="">Confirm password</label>
                                        <div class="password-control">
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Enter confirmed password">
                                            <!-- <a href="#"><i class="fa-regular fa-eye"></i></a> -->
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="cpasswordError" class="error text-danger"></span><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="new-form">
                            <div class="box">
                                <h3 class="heading-2">Personal Information</h3>
                                <div class="row">
                                    <div class="col-sm-6 required">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{old('first_name')}}" name="first_name" placeholder="Enter first name">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="fnameError" class="error text-danger"></span><br>
                                    </div>
                                    <div class="col-sm-6 required">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{old('last_name')}}" name="last_name" placeholder="Enter last name">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="lnameError" class="error text-danger"></span><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 required">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phoneInput" maxlength="10" minlength="10" value="{{old('phone')}}" name="phone" placeholder="Enter phone">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="phoneError" class="error text-danger"></span>
                                            <span id="phone-error" style="color: red;font-weight: bolder"></span>
                                    </div>
                                    <div class="col-sm-6 required">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" name="email" placeholder="Enter email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="emailError" class="error text-danger"></span><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 required">
                                        <label for="">Address</label>
                                        <input name="address" id="address" value="{{old('address')}}" class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Enter address"></input>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="addressError" class="error text-danger"></span><br>

                                    </div>
                                    <div class="col-sm-3 required">
                                        <label for="">Zipcode</label>
                                        <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" value="{{old('zip_code')}}" name="zip_code" placeholder="Enter Zip Code">
                                            @error('zip_code')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="zipError" class="error text-danger"></span><br>

                                    </div>
                                    </div>
                                    <div class="row required">
                                    <div class="col-sm-4">
                                        <label for="">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" value="{{old('city')}}" name="city" placeholder="Enter City">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="cityError" class="error text-danger"></span><br>

                                    </div>
                                    <div class="col-sm-4 required">
                                        <label for="">State</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" value="{{old('state')}}" name="state" placeholder="Enter State">
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="stateError" class="error text-danger"></span><br>
                                            
                                    </div>
                                    <div class="col-sm-4 required">
                                        <label for="">Country</label>
                                        <!-- <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" placeholder="Enter Country">-->
                                        <select class="form-select @error('country') is-invalid @enderror"  name="country" id="country">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->nicename}}" {{ old('country') == $country->nicename ? 'selected' : '' }}>{{$country->nicename}}</option> 
                                            @endforeach   
                                        </select>
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="countryError" class="error text-danger"></span><br>

                                    </div>
                                    </div>
                                </div>
                                <div class=""></div>
                                <h3 class="heading-2">Payment Information</h3>
                                <!-- <div>
                                    <label for="Credit or Debit Card">Credit or Debit Card</label>
                                    <div>
                                        <img src="{{ asset('images/cards.png')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 required">
                                        <label for="">Card number</label>
                                        <input type="text" class="form-control @error('card_number') is-invalid @enderror card-number" id="card_number" name="card_number" placeholder="Enter card number">
                                            @error('card_number')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="cardError" class="error text-danger"></span><br>

                                    </div>
                                    <div class="col-sm-6 required">
                                        <label for="">Expiration</label>
                                        <div class="d-flex w-75">
                                            <input type="text" class="form-control w-25 @error('exp_month') is-invalid @enderror card-expiry-month" id="exp_month" name="exp_month" placeholder="MM">
                                            @error('exp_month')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="monthError" class="error text-danger"></span><br>

                                            <div class="px-2"></div>
                                            <input type="text" class="form-control w-50 @error('exp_year') is-invalid @enderror card-expiry-year" id="exp_year" name="exp_year" placeholder="YYYY">
                                            @error('exp_year')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span id="yearError" class="error text-danger"></span><br>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 required">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="">Security code <i
                                                        class="fa-solid fa-circle-info text-black-50"></i></label>
                                                <input type="text" class="form-control @error('security_code') is-invalid @enderror card-cvc" id="security_code" name="security_code" placeholder="">
                                                @error('security_code')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            <span id="securityError" class="error text-danger"></span><br>

                                            </div>
                                            <div class="col-6">
                                                <label for="">Billing zip code</label>
                                                <input type="text" class="form-control @error('billing_zip_code') is-invalid @enderror" id="billing_zip_code" name="billing_zip_code" placeholder="">
                                                @error('billing_zip_code')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            <span id="billzipError" class="error text-danger"></span><br>

                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <input type="radio" class="btn-check check-schedule" name="price" id="option1" data-sch="monthly" value="{{$package->package_price}}" checked {{ old('price') == $package->package_price ? 'checked' : '' }}>
                                            <label class="billing-box" for="option1">
                                                <?php  
                                                    if($unit >2 ) 
                                                       $discount = ((25 * $unit) * 20)/100;
                                                    else
                                                        $discount = 0;

                                                ?>
                                                <b>Total: ${{number_format(((25 * $unit) - $discount), 2)}}</b>
                                                billed monthly
                                            </label>
                                            {{-- {{number_format((($package->package_price/$package->min_qty) * $unit), 2)}} --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>
                                            <input type="radio" class="btn-check check-schedule" name="price" id="option2" data-sch="yearly" value="{{$package->package_price * 12}}" {{ old('price') == $package->package_price * 12 ? 'checked' : '' }}>
                                            <label class="billing-box" for="option2">
                                                <b>Total: ${{number_format(((25 * $unit) - $discount) * 12, 2)}} </b>
                                                billed annually
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <input type="hidden" name="unit" value="{{$unit}}">
                        <input type="hidden" id="schedule" name="schedule" value="@if(old('schedule') == 'yearly') yearly @else monthly @endif">
                        <input type='hidden' name='stripeToken' id="stripeToken" value=''/>
                        
    
                        <div class="text-center">
                            <button class="btn-gradient">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@include('front_layouts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script> -->
<script>
    $(function(){
        $('.check-schedule').on('click', function(){
            var sch = $(this).data('sch');
            if(sch == 'monthly'){
                $('#schedule').val('monthly');
            }else{
                $('#schedule').val('yearly');
            }
        });

         //phone number implementation
         $('#phoneInput').on('input', function(){
            // Get the current value of the input field
            var inputValue = $(this).val();
            
            // Remove non-numeric characters from the input
            var numericValue = inputValue.replace(/\D/g,'');
            
            // Format the phone number as (###) ###-####
            var formattedValue = numericValue.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            
            // Set the formatted value back to the input field
            $(this).val(formattedValue);
        });//phone number implementation end

        $('#phoneInput').on('input', function() {
            var phoneNumber = $(this).val();
            if (phoneNumber.charAt(0) === '0') {
                $('#phone-error').text('Phone number cannot start with 0.');
                return false;
            }if (phoneNumber.charAt(1) === '0') {
                $('#phone-error').text('Phone number cannot start with 0.');
                return false;
            } else {
                $('#phone-error').text('');
            }
        });

        
    // var $form = $(".require-validation");
     
    //  $('form.require-validation').bind('submit', function(e) {
    //      var $form = $(".require-validation"),
    //      inputSelector = ['input[type=email]', 'input[type=password]',
    //                       'input[type=text]', 'input[type=file]',
    //                       'textarea'].join(', '),
    //      $inputs = $form.find('.required').find(inputSelector),
    //      $errorMessage = $form.find('div.error'),
    //      valid = true;
    //      $errorMessage.addClass('hide');
     
    //      $('.has-error').removeClass('has-error');
    //      $inputs.each(function(i, el) {
    //        var $input = $(el);
    //        if ($input.val() === '') {
    //          $input.parent().addClass('has-error');
    //          $errorMessage.removeClass('hide');
    //          e.preventDefault();
    //        }
    //      });

    //     var username = document.getElementById("username").value;
    //     var firstname = document.getElementById("first_name").value;
    //     var lastname = document.getElementById("last_name").value;
    //     var email = document.getElementById("email").value;
    //     var phone = document.getElementById("phone").value;
    //     var password = document.getElementById("password").value;
    //     var cpassword = document.getElementById("password_confirmation").value;
    //     var address = document.getElementById("address").value;
    //     var zip_code = document.getElementById("zip_code").value;
    //     var city = document.getElementById("city").value;
    //     var state = document.getElementById("state").value;
    //     var country = document.getElementById("country").value;
    //     var card_number = document.getElementById("card_number").value;
    //     var exp_month = document.getElementById("exp_month").value;
    //     var exp_year = document.getElementById("exp_year").value;
    //     var security_code = document.getElementById("security_code").value;
    //     var billing_zip_code = document.getElementById("billing_zip_code").value;

    //     // Reset previous error messages
    //     document.getElementById("usernameError").textContent = "";
    //     document.getElementById("fnameError").textContent = "";
    //     document.getElementById("lnameError").textContent = "";
    //     document.getElementById("emailError").textContent = "";
    //     document.getElementById("phoneError").textContent = "";
    //     document.getElementById("emailError").textContent = "";
    //     document.getElementById("passwordError").textContent = "";
    //     document.getElementById("cpasswordError").textContent = "";
    //     document.getElementById("addressError").textContent = '';
    //     document.getElementById("zipError").textContent='';
    //     document.getElementById("cityError").textContent = '';
    //     document.getElementById("stateError").textContent ='';
    //     document.getElementById("cardError").textContent ='';
    //     document.getElementById("monthError").textContent ='';
    //     document.getElementById("yearError").textContent ='';
    //     document.getElementById("securityError").textContent ='';
    //     document.getElementById("billzipError").textContent ='';

    //     if (username.trim() === "") {
    //         document.getElementById("usernameError").textContent = "Name is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }

    //     if (firstname.trim() === "") {
    //         document.getElementById("fnameError").textContent = "First Name is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (lastname.trim() === "") {
    //         document.getElementById("lnameError").textContent = "Last Name is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }

    //     // Validate email
    //     if (email.trim() === "") {
    //         document.getElementById("emailError").textContent = "Email is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (phone.trim() === "") {
    //         document.getElementById("phoneError").textContent = "Email is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }

    //     // Validate password
    //     if (password.trim() === "") {
    //         document.getElementById("passwordError").textContent = "Password is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (cpassword.trim() === "") {
    //         document.getElementById("cpasswordError").textContent = "Confirm Password is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }

    //     if (cpassword.trim() !== password.trim()) {
    //         document.getElementById("cpasswordError").textContent = "Confirm Password do not match.";
    //         event.preventDefault(); // Prevent form submission
    //     }
      
    //     if (address.trim() === "") {
    //         document.getElementById("addressError").textContent = "Address is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (zip_code.trim() === "") {
    //         document.getElementById("zipError").textContent = "Zip Code is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (city.trim() === "") {
    //         document.getElementById("cityError").textContent = "City is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (state.trim() === "") {
    //         document.getElementById("stateError").textContent = "State is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (card_number.trim() === "") {
    //         document.getElementById("cardError").textContent = "Card Number is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (exp_month.trim() === "") {
    //         document.getElementById("monthError").textContent = "Month is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (exp_month.trim() === "") {
    //         document.getElementById("yearError").textContent = "Year is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (security_code.trim() === "") {
    //         document.getElementById("securityError").textContent = "Security is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
    //     if (billing_zip_code.trim() === "") {
    //         document.getElementById("billzipError").textContent = "Billing Zip is required.";
    //         event.preventDefault(); // Prevent form submission
    //     }
        
    //      if (!$form.data('cc-on-file')) {
            
    //        e.preventDefault();
    //        Stripe.setPublishableKey('pk_test_51NWbXPSGWHKGovf6weIYkk34WWwOBmxMhrGbpe1oalwZ0P6aTyBMorQxDSv3aZy4Dd3OqdUCGPOWpExeVRBPUfj9007GuF1Lyh');
    //        Stripe.createToken({
    //          number: $('.card-number').val(),
    //          cvc: $('.card-cvc').val(),
    //          exp_month: $('.card-expiry-month').val(),
    //          exp_year: $('.card-expiry-year').val()
    //        }, stripeResponseHandler);
    //      }
     
    //  });

    //  function stripeResponseHandler(status, response) {
    //     if (response.error) {
    //        console.log('error');
    //     } else {
    //         /* token contains id, last4, and card type */
    //         var token = response['id'];
    //         console.log(token);  
    //         $('#stripeToken').val(token);   
    //         // $form.find('input[type=text]').empty();
    //         // $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
    //         $form.get(0).submit();
    //     }
    // }
        
    });

</script>

@endsection