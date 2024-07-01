@extends('front_layouts.master')

    @section('title' , 'Tenancy')

@section('main-content')

<body class="underpage">

@include('front_layouts.navbar')

  <div class="section payments">
    <div class="container">
      <h2 class="heading-tag">Subscription Plans</h2>
      <div class="row mb-4">
        <div class="col-sm-12">
          <h3 class="heading-1"> Choose the best plan for your business.<br>
            Add units as you grow!</h3>
        </div>
        <!-- <div class="col-sm-4">
          <div class="heading-5">
            Base Price<br>
            $25 per added unit<br>
            20% discount with 3 units or more
          </div>
        </div> -->
      </div>
      <div class="row">
       @if(count($package) > 0)
       @foreach($package as $pack)
        <div class="col-sm-4">
          <div class="plan">
          <input type="radio" class="btn-check package" id="plan1{{$pack->id}}" @if($pack->id == $package_id) checked @endif name="plan" autocomplete="off">
          <label class="mb-4" for="plan1{{$pack->id}}">
            <!-- <div class="plan-header">
              <div class="icon"><img src="{{ asset('images/icons/3.png')}}" alt=""></div>
              <div class="text">
                {{$pack->package_name}}
                <div class="price">${{$pack->package_price}}</div>
                {{$pack->package_schedule}}
              </div>
            </div> -->

            <div class="plan-header">
                <div class="plan-matter">
                  <div class="icon"><img src="@if($pack->id==1) {{ asset('images/icons/1.png')}} @elseif($pack->id == 2) {{ asset('images/icons/2.png')}} @else {{ asset('images/icons/3.png')}} @endif" alt=""></div>
                  <div class="text">
                  {{$pack->package_name}}
                    <div class="price">${{$pack->package_price}}</div>
                    {{$pack->package_schedule}}
                  </div>
                </div>
                <div class="text-center">
                  @if($pack->package_name == 'Single Unit')
                    Registers 1 unit
                  @elseif($pack->package_name == 'Multi Unit')
                    Registers 2 - 4 units
                  @else
                    Registers 5 - Unlimited units
                  @endif
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
              <div class="text-center">
                <a href="{{url('plan', $pack->id)}}" class="btn-rounded-outline">
                  <i class="fa-solid fa-cloud-arrow-down"></i>
                  Select
                </a>
              </div>
            </div>
          </label>
        </div>
        </div>
        @endforeach
       @endif 
      </div>
    </div>
  </div>
  @include('front_layouts.footer')

  @endsection