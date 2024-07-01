@extends('front_layouts.master')

    @section('title' , 'Tenancy')

@section('main-content')
<body class="home">
@include('front_layouts.navbar')
 <div class="banner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-sm-5">
          <h2 class="heading-tag">Tenancy</h2>
          <h3 class="main-heading"><b>Tenant & Property</b>Management Software</h3>
          <div class="mb-4">
            Navigate the world of property management with ease – where efficiency meets satisfaction, and tenants feel
            right at home.
          </div>
          <a href="#" class="btn-rounded-outline">
            <i class="fa-solid fa-clipboard-list"></i>
            Request a demo
          </a>
        </div>
        <div class="col-sm-7">
          <img src="images/img-1.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </div>
   <div class="section payments" id="Payments">
    <div class="container">
      <h2 class="heading-tag">Payments</h2>
      <h3 class="heading-1"><span>Simplify</span> Rent collection and payments<br>
        <span>with our integrated feature.</span>
      </h3>
      <div class="row">
        <div class="col-sm-7">
          <img src="images/img-payment.png" class="img-fluid" alt="">
        </div>
        <div class="col-sm-5">
          <hr class="style-1">
          <div class="mb-4">
            Simplify rent collection and payments for landlords and tenants alike with our intuitive payment feature.
            Streamline transactions, track payments, and ensure financial accuracy seamlessly within our property
            management software.
          </div>
          <a href="{{url('plan-and-pricing', 1)}}" class="btn-rounded-outline">
            <i class="fa-solid fa-cloud-arrow-down"></i>
            Get Started
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--<div class="section payments">-->
  <!--  <div class="container">-->
  <!--    <h2 class="heading-tag">Payments</h2>-->
  <!--    <div class="row mb-4">-->
  <!--      <div class="col-sm-4">-->
  <!--        <h3 class="heading-1">Our best pricing to give you offer!</h3>-->
  <!--      </div>-->
  <!--      <div class="col-sm-4">-->
  <!--        <div class="heading-5">-->
  <!--          Base Price<br>-->
  <!--          $25 per added unit<br>-->
  <!--          20% discount with 3 units or more-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--    <div class="row">-->
  <!--     @if(count($package) > 0)-->
  <!--     @foreach($package as $pack)-->
  <!--      <div class="col-sm-4">-->
  <!--        <div class="plan">-->
  <!--        <input type="radio" class="btn-check package" id="plan1{{$pack->id}}" name="plan" autocomplete="off">-->
  <!--        <label class="mb-4" for="plan1{{$pack->id}}">-->
  <!--          <div class="plan-header">-->
  <!--            <div class="icon"><img src="{{ asset('images/icons/3.png')}}" alt=""></div>-->
  <!--            <div class="text">-->
  <!--              {{$pack->package_name}}-->
  <!--              <div class="price">${{$pack->package_price}}</div>-->
  <!--              {{$pack->package_schedule}}-->
  <!--            </div>-->
  <!--          </div>-->
  <!--          <div class="plan-body">-->
  <!--            <ul>-->
  <!--              @if(count($packageFeatures) > 0)-->
  <!--                @foreach($packageFeatures as $pf)-->
  <!--                  @if($pf->package_id == $pack->id)-->
  <!--                  <li>{{$pf->feature_name}}</li>-->
  <!--                  @endif-->
  <!--                @endforeach-->
  <!--              @endif-->
  <!--            </ul>-->
  <!--            <div class="text-center">-->
  <!--              <a href="{{url('plan-and-pricing', $pack->id)}}" class="btn-rounded-outline">-->
  <!--                <i class="fa-solid fa-cloud-arrow-down"></i>-->
  <!--                Try it now-->
  <!--              </a>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </label>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--      @endforeach-->
  <!--     @endif -->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->
 <div class="section correspondence bg-color-8 bg-img-1" id="Correspondence">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <h2 class="heading-tag">Correspondence</h2>
          <h3 class="heading-1">Real-time communication hub <span>with centralized inbox and priority tagging.</span></h3>
          <hr class="style-1">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/4.png" alt="">
            <h4 class="heading">Centralized Inbox</h4>
            <div>A unified inbox where you can view and respond to messages from tenants.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/5.png" alt="">
            <h4 class="heading">Document Sharing</h4>
            <div>Ability to share documents, such as lease agreements or inspection reports, securely within the
              messaging platform.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/6.png" alt="">
            <h4 class="heading">Threaded Conversations</h4>
            <div>Organized threads for each conversation to keep track of communication history and follow ups.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/7.png" alt="">
            <h4 class="heading">Bulk Messaging</h4>
            <div>Capability to send mass messages or announcements to all tenants or specific groups.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/8.png" alt="">
            <h4 class="heading">Priority Tagging</h4>
            <div>Allows tenants and management to tag messages or tasks with priority levels such as high, medium, or
              low importance.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/9.png" alt="">
            <h4 class="heading">Notification Alerts</h4>
            <div>Receive instant alerts for new messages, maintenance requests, lease renewals, and important updates.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 <div class="section document-management bg-img-2" id="DocumentManagement">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2 class="heading-tag">Document Management</h2>
          <h3 class="heading-1"><span>Efficiently</span> organize and streamline <span>your documents</span></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-7">
          <img src="images/img-2.png" class="img-fluid" alt="">
        </div>
        <div class="col-sm-5">
          <hr class="style-1">
          <div class="mb-4">
            Revolutionize your property management workflow with our cutting-edge document management feature.
            Seamlessly organize, access, and share critical documents such as leases, agreements, and maintenance
            requests. Boost efficiency, ensure compliance, and elevate your tenant experience with ease.
          </div>
          <a href="{{url('plan-and-pricing', 1)}}" class="btn-rounded-outline">
            <i class="fa-solid fa-cloud-arrow-down"></i>
            Get Started
          </a>
        </div>
      </div>
    </div>
  </div>
   <div class="section Reporting bg-color-8 bg-img-3" id="Reporting">
    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <h2 class="heading-tag">Reporting</h2>
          <h3 class="heading-1">
            <span>Maximize insights with</span>
            Powerful Reporting <span>functionality</span>
          </h3>
          <hr class="style-1">
          <div class="mb-4">
            Access in-depth understanding of your property operations through advanced reporting capabilities. Easily
            track rent payments, occupancy rates, maintenance requests, financial performance, late payments, and more
            within our management solution.
          </div>
          <a href="{{url('plan-and-pricing', 1)}}" class="btn-rounded-outline">
            <i class="fa-solid fa-cloud-arrow-down"></i>
            Get Started
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="section Property Management bg-img-4" id="PropertyManagement">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <img src="images/img-4.png" class="img-fluid" alt="">
        </div>
        <div class="col-sm-6">
          <h2 class="heading-tag">Property Management</h2>
          <h3 class="heading-1"><span>Efficiently manage properties with</span>
            our intuitive software solution</h3>
          <div class="mb-4">
            Elevate your property management experience with our all-in-one software solution. From organizing leases,
            to tracking maintenance requests and financial transactions, streamline your operations for maximum
            efficiency and tenant satisfaction. Simplify management, elevate performance, and exceed expectations with
            ease.
          </div>
          <a href="{{url('plan-and-pricing', 1)}}" class="btn-rounded-outline">
            <i class="fa-solid fa-cloud-arrow-down"></i>
            Get Started
          </a>
        </div>
      </div>
    </div>
  </div>
<div class="section Expense Tracking bg-color-8 bg-img-5" id="ExpenseTracking">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2 class="heading-tag">Expense Tracking</h2>
          <h3 class="heading-1">
            Seamless expense tracking
            <span>for enhanced property oversight</span>
          </h3>
          <hr class="style-1">
          <div class="mb-4">
            Gain control over your property finances with our expense tracking system. Monitor expenses, analyze
            spending trends, and optimize budget allocation to maximize profitability and operational efficiency. Stay
            ahead of financial challenges with confidence.
          </div>
          <a href="{{url('plan-and-pricing', 1)}}" class="btn-rounded-outline">
            <i class="fa-solid fa-cloud-arrow-down"></i>
            Get Started
          </a>
        </div>
        <div class="col-sm-6">
          <img src="images/img-5.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </div>
  @include('front_layouts.footer')
  

@endsection