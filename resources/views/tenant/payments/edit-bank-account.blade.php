<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Bank Account</title>
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
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
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
                    <form role="form" action="{{route('tenant.tenant-update-bank-account')}}" method="post" class="require-validation page-card mx-auto"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form" style="width: 600px;">           
                    @csrf    
                   
                        <div class="heading-underline">Account Information</div>
                        <div class="fs-18 text-black-50">Payment Information</div>
                        <div>
                            <div class="fs-16 fw-medium mb-2">Credit or Debit Card</div>
                            <img src="{{asset('tenants/cards.png')}}" class="img-fluid" alt="">
                        </div>
                        <input class='form-control address' name="address" size='4' type='hidden' value="{{$user->address}}">
                        <input class='form-control city' name="city"  size='4' type='hidden' value="{{$user->city}}">
                        <input class='form-control state' size='4' name="state" type='hidden' value="{{$user->state}}">
                        <input class='form-control country' size='4' name="country"  type='hidden' value="{{$user->country}}">

                        <input class='form-control postal_code' size='4' name="postal_code" type='hidden' value="{{$user->zipcode}}">
                    <input class='form-control' size='4' name="id" type='hidden' value="{{$editbankaccount->id}}">

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group fs-16">
                                    <label for="">Card number</label>
                                    <input autocomplete='off' class='form-control card-number' minlength="16" maxlength="16" size='20' name="card_number" type='text' placeholder="Confirm the card number" value="{{$editbankaccount->card_number}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group fs-16">
                                    <label for="">Expiration</label>
                                    <div class="d-flex column-gap-2">
                                    <input type="number" class="form-control card-expiry-month"  placeholder='MM' size='2'  minlength="2" maxlength="2" name="card_expiry_month" value="{{$editbankaccount->card_month}}">

                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' minlength="4" maxlength="4"  name="card_expiry_year" value="{{$editbankaccount->card_year}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group fs-16">
                                    <label for="">CVV <i class="fa-solid fa-circle-info ms-2 text-black-50"></i></label>
                                    <input autocomplete='off'
                                        class='form-control card-cvc' placeholder='ex. 311' size='4'
                                        type='text' placeholder="" minlength="3" maxlength="3" name="card_cvc"  value="{{$editbankaccount->security_code}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group fs-16">
                                    <label for="">Billing zip code</label>
                                    <input type="number" class="form-control" name="zip_code" value="{{$editbankaccount->billing_zip_code}}">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row align-items-center">
                            <div class="col-sm-6"><b>Nickname</b></div>
                            <div class="col-sm-6"><input type="text"  name="nick_name"class="form-control form-control-sm" placeholder="Account Nickname" value="{{$editbankaccount->nickname}}"></div>
                        </div>

                        <div class="d-flex">
                            <b class="me-3">Set as primary</b>
                            <div class="form-check form-switch mb-0">
                           
                                <input class="form-check-input" name="primary" type="checkbox" role="switch" id="flexSwitchCheckChecked"  @if($editbankaccount->primary == 'on') checked @endif>
                                <label class="form-check-label" for="flexSwitchCheckChecked"><b>Yes</b></label>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="Submit" class="btn btn-success mx-1">Save</button>
                            <button type="reset" class="btn btn-danger mx-1">Cancel</button>
                        </div>
                    
                </div>
            </div>
            @include('tenant_layouts.footer')
        </div>
    </div>
    @include('tenant_layouts.script')
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