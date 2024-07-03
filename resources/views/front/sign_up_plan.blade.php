@extends('front_layouts.master')

    @section('title' , 'Tenancy')

@section('main-content')

<body class="underpage">

@include('front_layouts.navbar')

    <div class="section payments">
        <div class="container">
            <h2 class="heading-tag">Subscription Plans</h2>
            <div class="row mb-4">
                <div class="col-sm-12 text-center">
                    <h3 class="heading-1">Add additional units to your selected plan!</h3>
                    <h4 class="mb-5">Add 3 units or more and receive 20% off subscription price</h4>
                </div>
                <div class="col-sm-4">
                    <!--<div class="heading-5">-->
                    <!--    Base Price<br>-->
                    <!--    $25 per added unit<br>-->
                    <!--    20% discount with 3 units or more-->
                    <!--</div>-->
                </div>
            </div>
            <div class="row">
            <div class="col-sm-4"></div>
            @if(count($package) > 0)
                    @foreach($package as $pack)
                    @if($pack->id == $package_id)
                    <div class="col-sm-4">
                        <div class="plan">
                        <input type="radio" class="btn-check package" id="plan1{{$pack->id}}" data-id="{{$pack->id}}" data-uid="{{$pack->min_qty}}" @if($pack->id == $package_id) checked @elseif($pack->id == 1) checked  @endif name="plan" autocomplete="off">
                        <label class="mb-4" for="plan1{{$pack->id}}">    
                            <div class="plan-header">
                                    <div class="plan-matter">
                                        <div class="icon"><img src="@if($pack->id==1) {{ asset('images/icons/1.png')}} @elseif($pack->id == 2) {{ asset('images/icons/2.png')}} @else {{ asset('images/icons/3.png')}} @endif" alt=""></div>
                                        <div class="text">
                                        {{$pack->package_name}}
                                            <div class="price">${{$pack->package_price}}</div>
                                            <input type="hidden" name="amount" id="amount" value="{{$pack->package_price}}">
                                            {{$pack->package_schedule}}
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p>Registered Units</p>

                                        <div class="no-unit shadow-1">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus">-</button>
                                            <input type="number" class="currentUnit" id="unitcount{{$pack->id}}"  value="{{$pack->min_qty}}" min="{{$pack->min_qty}}" max="{{$pack->max_qty}}">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="plan-body">
                                <ul>
                                    @if(count($packageFeatures) > 0)
                                    @foreach($packageFeatures as $pf)
                                        @if($pf->package_id == $pack->id)
                                        <li>{{$pf->feature_name}}</li>
                                        @endif
                                    @endforeach
                                    @endif
                                </ul>
                                    <!-- <div class="text-center">
                                        <a href="{{url('plan-and-pricing', $pack->id)}}" class="btn-rounded-outline">
                                            <i class="fa-solid fa-cloud-arrow-down"></i>
                                            Try it now
                                        </a>
                                    </div> -->
                                </div>
                            </div>
                            <!-- <div class="text-center">
                                <div class="fw-medium"># of Units</div>
                                
                            </div> -->
                        </label>
                    </div>
                    @endif
                @endforeach
                @endif
            <div class="col-sm-4"></div>   
            </div>
            <div class="text-center">
                <div class="py-4 text-center mb-4">
                    Select plans start at the lowest number of units form the plan selected. You can add more units to
                    your selected plan by using the toggle above. Receive a 20% discount on your monthly plan when
                    adding 3
                    units or more.
                </div>
                <div class="d-inline-flex">
                    <a href="{{ url()->previous() }}" class="btn-rounded-outline">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        <span>Back</span>
                    </a>
                    <div class="px-3"></div>
                    @if($package_id == 1)
                    <input type="hidden" name="unit" id="unit" value="1">
                    <input type="hidden" name="package_id" id="package_id" value="{{$package_id}}">
                    @elseif($package_id == 2)
                        <input type="hidden" name="unit" id="unit" value="2">
                        <input type="hidden" name="package_id" id="package_id" value="{{$package_id}}">
                    @else
                        <input type="hidden" name="unit" id="unit" value="5">
                        <input type="hidden" name="package_id" id="package_id" value="{{$package_id}}">
                    @endif  
                    <!-- <a href="{{route('user-sign-up', ['param1' => 1,'param2' => $package[0]->id])}}" class="btn-rounded-outline"> -->
                    <a href="javascript:void(0);" id="next" class="btn-rounded-outline">
                     
                    <span>Next</span>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>

    @include('front_layouts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    $(function(){
        $('.package').on('change', function(){
            var packid = $(this).data('id');
            var unitnum = $(this).data('uid');
            
            $('#package_id').val(packid);
            $('#unit').val(unitnum);

        });

        $('.minus').on('click', function(){
           var hpid = $('#package_id').val();
           var unitc = $('#unitcount'+hpid).val();
           $('#unit').val(unitc);
        });
        $('.plus').on('click', function(){
           var hpid = $('#package_id').val();
           var unitc = $('#unitcount'+hpid).val();
           $('#unit').val(unitc);
        });

        $('#next').on('click', function(){
            var pid = $('#package_id').val();
            var unit = $('#unit').val();

            var url = '/tenancy/public/user-sign-up/'+unit+'/'+pid;
            location.href = url;
        });
        
        //discount feature
        
        var amount = $('#amount').val();
        var unit = $('#unit').val();
        
        if(unit == 5 ){
            var unit_price = 25;
        }
        else if(unit == 2){
            var unit_price = 25; 
        }else{
            var unit_price = 25;
        }
        
        var discount;
        var totalPrice;
        //alert(amount);
        $('.plus').click(function(){
            var current_unit = $('.currentUnit').val();
            var totalPrice = current_unit * unit_price;
            if(current_unit >= 2){
                //alert(totalPrice);
                var discount  = (totalPrice * 20 ) / 100 ;
                totalPrice -= discount;
                $('.price').text('$'+totalPrice);
                $('#amount').val(totalPrice);
            }
            
        });
        $('.minus').click(function(){
            var current_unit = $('.currentUnit').val();
            //alert(current_unit);
            if(current_unit == 2){
                $('.price').text('$'+amount);
                $('#amount').val(amount);
            }else if(current_unit >= 2){
                var totalPrice = current_unit * 25;
                //alert(totalPrice);
                var discount  = (totalPrice * 20 ) / 100 ;
                totalPrice -= discount;
                $('.price').text('$'+totalPrice);
                $('#amount').val(totalPrice);
            }else{
                $('.price').text('$'+amount);
                $('#amount').val(amount);
            }
        });

    });
</script>
  @endsection