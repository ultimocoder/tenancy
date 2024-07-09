<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Payment Method</title>
    @include('tenant_layouts.header')
    <style>
        .has-error .form-control {
            border-color: #a94442 !important;
        }
        </style>
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
                    <form role="form" action="{{route('tenant.tenant-add-payment')}}" method="post" class="require-validation page-card mx-auto"
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

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group has-error">
                                    <label for="">Card number</label>
                                    <input type="number" class="form-control  card-number" name="card_number" placeholder="xxxx xxxx xxxx xxxx">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group has-error">
                                    <label for="">Expiration</label>
                                    <div class="d-flex column-gap-2">
                                        <input type="number" class="form-control card-expiry-month" placeholder="MM" name="card_expiry_month" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="xx">
                                        <input type="number" name="card_expiry_year" class="form-control card-expiry-year" placeholder="YYYY" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" value="xxxx">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group has-error fs-16">
                                    <label for="">Security code <i class="fa-solid fa-circle-info ms-2 text-black-50 "></i></label>
                                    <input type="number" class="form-control card-cvc" name="card_cvc">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group has-error fs-16">
                                    <label for="">Billing zip code</label>
                                    <input type="number" class="form-control" name="zip_code">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row align-items-center">
                            <div class="col-sm-6"><b>Nickname</b></div>
                            <div class="col-sm-6"><input type="text"  name="nick_name"class="form-control form-control-sm" placeholder="Account Nickname"></div>
                        </div>

                        <div class="d-flex">
                            <b class="me-3">Set as primary</b>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="primary">
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
        
          //  $('.has-error').removeClass('has-error');
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