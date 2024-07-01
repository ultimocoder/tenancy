<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Information</title>
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
                        <div class="withButton">
                            <div>
                                <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
                                <h1><span id="title"></span> - Confirm</h1>
                            </div>
                            <a href="{{route('landlord.account.payment.info')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                        </div>
                    </div>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
                    <style>
                        body{font-size: 14px; background-color: #F6F7FB;}
                        .btn-xs{line-height: 28px;padding: 0 15px;display: inline-block;font-size: 13px;font-weight: 600;border-radius: 20px;}
                    </style>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide m-4' >
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-sm-6 mx-auto">
                            <div class="page-card">
                            <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false"
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                            <div class='row'>
                                <div class='col-sm-12 required'>
                                    <div class="form-group">
                                        <label for="">Address</label> 
                                        <input class='form-control address' required="" name="address" size='4' type='text' value="{{$request->address}}">
                                    </div>       
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-sm-6 required'>
                                    <div class="form-group">
                                        <label for="">City</label> 
                                        <input class='form-control city' name="city" required="" size='4' type='text' value="{{$request->city}}">
                                    </div>       
                                </div>
                                <div class='col-sm-6 required'>
                                    <div class="form-group">
                                        <label for="">state</label> 
                                        <input class='form-control state' size='4' name="state" required="" type='text' value="{{$request->state}}">
                                    </div>       
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-6 required'>
                                    <div class="form-group">
                                        <label for="">Country</label> 
                                            <select name="country" class="form-control country" id="">
                                                @foreach($countries as $c)
                                                <option value="{{$c->iso}}" @if($c->nicename == Auth::user()->country) selected @endif>{{$c->nicename}}</option>
                                                @endforeach
                                            </select>
                                    </div>       
                                </div>
                                <div class='col-sm-6 required'>
                                    <div class="form-group">
                                        <label for="">Postal Code</label> 
                                        <input class='form-control postal_code' size='4' required="" name="postal_code" type='text' value="{{$request->postal_code}}">
                                    </div>       
                                </div>
                            </div>
                            
                            <div class='row'>
                                <div class='col-sm-12 required'>
                                    <div class="form-group">
                                        <label for="">Name on Card</label> 
                                        <input class='form-control name' size='4' type='text' value="{{$request->name}}">
                                    </div>       
                                </div>
                            </div>
                            
                            <!--<input type="hidden" name="address" value="{{$request->address}}">-->
                            <!--<input type="hidden" name="city" value="{{$request->city}}">-->
                            <!--<input type="hidden" name="state" value="{{$request->state}}">-->
                            <!--<input type="hidden" name="country" value="{{$request->country}}">-->
                            <!--<input type="hidden" name="postal_code" value="{{$request->postal_code}}">-->
        
                            <div class='row'>
                                <div class='col-sm-12 required'>
                                    <div class="form-group">
                                        <label class='control-label'>Card Number</label> 
                                        <input autocomplete='off' class='form-control card-number' size='20' type='text' placeholder="Reconfirm the card number">
                                    </div>
                                </div>
                            </div>
                            
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label> <input autocomplete='off'
                                        class='form-control card-cvc' placeholder='ex. 311' size='4'
                                        type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label> 
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label> 
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                            </div>                   
        
                            <div class="row mt-2">
                                <div class=" text-center" >
                                    <a href="{{route('landlord.account.payment.info')}}" class="btn btn-danger" >Cancel</a>
                                    <button class="btn btn-color-8" type="submit">Confirm</button>
                                </div>
                            </div>
                                
                        </form>
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
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">  
    $(function() {
    // $('.hide').hide();
        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/
        
        var $form = $(".require-validation");
         
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                             'input[type=text]', 'input[type=file]',
                             'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            // $('.hide').css('display', 'block');
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
         
            if (!$form.data('cc-on-file')) {
              e.preventDefault();
              Stripe.setPublishableKey($form.data('stripe-publishable-key'));
              Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val(),
                name: $('.name').val()

              }, stripeResponseHandler);
            }
        
        });
          
        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                     
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
         
    });
</script>