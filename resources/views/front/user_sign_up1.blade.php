@extends('front_layouts.master')

    @section('title' , 'Tenancy')

@section('main-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<body class="underpage bg-main">
@include('front_layouts.navbar')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 mx-auto">
                  
                    <form action="{{route('subscription.index')}}" method="POST">
                        @csrf
                        <script
                            src="https://checkout.stripe.com/checkout.js"
                            class="stripe-button"
                            data-key="pk_test_51NWbXPSGWHKGovf6weIYkk34WWwOBmxMhrGbpe1oalwZ0P6aTyBMorQxDSv3aZy4Dd3OqdUCGPOWpExeVRBPUfj9007GuF1Lyh"
                            data-name="Gold Tier"
                            data-description="Monthly subscription with 30 days trial"
                            data-amount="2000"
                            data-label="Subscribe">
                        </script>
                        </form>
                </div>
            </div>
        </div>
    </div>

@include('front_layouts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(function(){
        $('.check-schedule').on('click', function(){
            var sch = $(this).data('sch');
            if(sch == 'monthly'){
                $('#schedule').val('monthly');
            }else{
                $('#schedule').val('yearly');
            }
        })

        
    var $form = $(".require-validation");
     
     $('form.require-validation').bind('submit', function(e) {
         var $form = $(".require-validation"),
         inputSelector = ['input[type=email]', 'input[type=password]',
                          'input[type=text]', 'input[type=file]',
                          'textarea'].join(', '),
         $inputs = $form.find('.required').find(inputSelector),
         $errorMessage = $form.find('div.error'),
         valid = true;
         $errorMessage.addClass('hide');
     
         $('.has-error').removeClass('has-error');
         $inputs.each(function(i, el) {
           var $input = $(el);
           if ($input.val() === '') {
             $input.parent().addClass('has-error');
             $errorMessage.removeClass('hide');
             e.preventDefault();
           }
         });

        var username = document.getElementById("username").value;
        var firstname = document.getElementById("first_name").value;
        var lastname = document.getElementById("last_name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var password = document.getElementById("password").value;
        var cpassword = document.getElementById("password_confirmation").value;
        var address = document.getElementById("address").value;
        var zip_code = document.getElementById("zip_code").value;
        var city = document.getElementById("city").value;
        var state = document.getElementById("state").value;
        var country = document.getElementById("country").value;
        var card_number = document.getElementById("card_number").value;
        var exp_month = document.getElementById("exp_month").value;
        var exp_year = document.getElementById("exp_year").value;
        var security_code = document.getElementById("security_code").value;
        var billing_zip_code = document.getElementById("billing_zip_code").value;

        // Reset previous error messages
        document.getElementById("usernameError").textContent = "";
        document.getElementById("fnameError").textContent = "";
        document.getElementById("lnameError").textContent = "";
        document.getElementById("emailError").textContent = "";
        document.getElementById("phoneError").textContent = "";
        document.getElementById("emailError").textContent = "";
        document.getElementById("passwordError").textContent = "";
        document.getElementById("cpasswordError").textContent = "";
        document.getElementById("addressError").textContent = '';
        document.getElementById("zipError").textContent='';
        document.getElementById("cityError").textContent = '';
        document.getElementById("stateError").textContent ='';
        document.getElementById("cardError").textContent ='';
        document.getElementById("monthError").textContent ='';
        document.getElementById("yearError").textContent ='';
        document.getElementById("securityError").textContent ='';
        document.getElementById("billzipError").textContent ='';

        if (username.trim() === "") {
            document.getElementById("usernameError").textContent = "Name is required.";
            event.preventDefault(); // Prevent form submission
        }

        if (firstname.trim() === "") {
            document.getElementById("fnameError").textContent = "First Name is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (lastname.trim() === "") {
            document.getElementById("lnameError").textContent = "Last Name is required.";
            event.preventDefault(); // Prevent form submission
        }

        // Validate email
        if (email.trim() === "") {
            document.getElementById("emailError").textContent = "Email is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (phone.trim() === "") {
            document.getElementById("phoneError").textContent = "Email is required.";
            event.preventDefault(); // Prevent form submission
        }

        // Validate password
        if (password.trim() === "") {
            document.getElementById("passwordError").textContent = "Password is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (cpassword.trim() === "") {
            document.getElementById("cpasswordError").textContent = "Confirm Password is required.";
            event.preventDefault(); // Prevent form submission
        }

        if (cpassword.trim() !== password.trim()) {
            document.getElementById("cpasswordError").textContent = "Confirm Password do not match.";
            event.preventDefault(); // Prevent form submission
        }
      
        if (address.trim() === "") {
            document.getElementById("addressError").textContent = "Address is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (zip_code.trim() === "") {
            document.getElementById("zipError").textContent = "Zip Code is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (city.trim() === "") {
            document.getElementById("cityError").textContent = "City is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (state.trim() === "") {
            document.getElementById("stateError").textContent = "State is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (card_number.trim() === "") {
            document.getElementById("cardError").textContent = "Card Number is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (exp_month.trim() === "") {
            document.getElementById("monthError").textContent = "Month is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (exp_month.trim() === "") {
            document.getElementById("yearError").textContent = "Year is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (security_code.trim() === "") {
            document.getElementById("securityError").textContent = "Security is required.";
            event.preventDefault(); // Prevent form submission
        }
        if (billing_zip_code.trim() === "") {
            document.getElementById("billzipError").textContent = "Billing Zip is required.";
            event.preventDefault(); // Prevent form submission
        }
        
         if (!$form.data('cc-on-file')) {
            
           e.preventDefault();
           Stripe.setPublishableKey('pk_test_51NWbXPSGWHKGovf6weIYkk34WWwOBmxMhrGbpe1oalwZ0P6aTyBMorQxDSv3aZy4Dd3OqdUCGPOWpExeVRBPUfj9007GuF1Lyh');
           Stripe.createToken({
             number: $('.card-number').val(),
             cvc: $('.card-cvc').val(),
             exp_month: $('.card-expiry-month').val(),
             exp_year: $('.card-expiry-year').val()
           }, stripeResponseHandler);
         }
     
     });

     function stripeResponseHandler(status, response) {
        if (response.error) {
           console.log('error');
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            console.log(token);  
            $('#stripeToken').val(token);   
            // $form.find('input[type=text]').empty();
            // $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
        
    });

</script>

@endsection