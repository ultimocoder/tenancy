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
            Even in the most uncertain times,<br>
            Help Scout keeps you connected with customers.
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
  <div class="section payments">
    <div class="container">
      <h2 class="heading-tag">Payments</h2>
      <div class="row mb-4">
        <div class="col-sm-4">
          <h3 class="heading-1">Our best pricing to give you offer!</h3>
        </div>
        <div class="col-sm-4">
          <div class="heading-5">
            Base Price<br>
            $25 per added unit<br>
            20% discount with 3 units or more
          </div>
        </div>
      </div>
      <div class="row">
       @if(count($package) > 0)
       @foreach($package as $pack)
        <div class="col-sm-4">
          <div class="plan">
          <input type="radio" class="btn-check package" id="plan1{{$pack->id}}" name="plan" autocomplete="off">
          <label class="mb-4" for="plan1{{$pack->id}}">
            <div class="plan-header">
              <div class="icon"><img src="{{ asset('images/icons/3.png')}}" alt=""></div>
              <div class="text">
                {{$pack->package_name}}
                <div class="price">${{$pack->package_price}}</div>
                {{$pack->package_schedule}}
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
                <a href="{{url('plan-and-pricing', $pack->id)}}" class="btn-rounded-outline">
                  <i class="fa-solid fa-cloud-arrow-down"></i>
                  Try it now
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
  <div class="section correspondence bg-color-8 bg-img-1">
    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <h2 class="heading-tag">Correspondence</h2>
          <h3 class="heading-1">We can give the <span>best facilitie</span> for you!</h3>
          <hr class="style-1">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/4.png" alt="">
            <h4 class="heading">Faster docs. Faster deals</h4>
            <div>Get your documents out the door fast to keep deals with automatic notifications, on-the-fly editing,
              and integrated.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/5.png" alt="">
            <h4 class="heading">Faster docs. Faster deals</h4>
            <div>Get your documents out the door fast to keep deals with automatic notifications, on-the-fly editing,
              and integrated.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/6.png" alt="">
            <h4 class="heading">Faster docs. Faster deals</h4>
            <div>Get your documents out the door fast to keep deals with automatic notifications, on-the-fly editing,
              and integrated.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/7.png" alt="">
            <h4 class="heading">Faster docs. Faster deals</h4>
            <div>Get your documents out the door fast to keep deals with automatic notifications, on-the-fly editing,
              and integrated.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/8.png" alt="">
            <h4 class="heading">Faster docs. Faster deals</h4>
            <div>Get your documents out the door fast to keep deals with automatic notifications, on-the-fly editing,
              and integrated.</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="service-box">
            <img src="images/icons/9.png" alt="">
            <h4 class="heading">Faster docs. Faster deals</h4>
            <div>Get your documents out the door fast to keep deals with automatic notifications, on-the-fly editing,
              and integrated.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section document-management bg-img-2">
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
            Simplify document organization with our intuitive management system. Easily store, retrieve, and share files
            securely. Streamline collaboration with version control and access permissions. Say goodbye to clutter and
            hello to efficiency with our document management solution.
          </div>
          <a href="#" class="btn-rounded-outline">
            <i class="fa-solid fa-cloud-arrow-down"></i>
            Get Started
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="section Reporting bg-color-8 bg-img-3">
    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <h2 class="heading-tag">Reporting</h2>
          <h3 class="heading-1"><span>Streamline insights with </span>
            Powerful reporting software</h3>
          <hr class="style-1">
          <div class="mb-4">
            Data distilled, insights clear, Software reports, graphs appear.Trends analyzed, patterns found, In bytes
            and bits, wisdom abound.
          </div>
          <a href="#" class="btn-rounded-outline">
            <i class="fa-solid fa-cloud-arrow-down"></i>
            Get Started
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="section Property Management bg-img-4">
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
            Property Management software streamlines the intricate processes involved in managing real estate assets.
            From tenant management to financial tracking, it offers comprehensive solutions. With features like lease
            management and maintenance tracking, it simplifies operations for property managers. Its intuitive interface
            enhances efficiency and ensures seamless communication between stakeholders.
          </div>
          <a href="#" class="btn-rounded-outline">
            <i class="fa-solid fa-cloud-arrow-down"></i>
            Get Started
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="section Expense Tracking bg-color-8 bg-img-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2 class="heading-tag">Expense Tracking</h2>
          <h3 class="heading-1"><span>Efficiently</span> Monitor Software
            <span>Activities with Precision</span>
          </h3>
          <hr class="style-1">
          <div class="mb-4">
            Code commits, branches, and merges in sight, Tracking changes to keep our code right. Bug fixes,
            enhancements, all in line, Software tracking keeps our project fine.
          </div>
          <a href="#" class="btn-rounded-outline">
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