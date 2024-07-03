<div class="leftbar">
    <a href="" class="logo text-black text-center">
        <img src="{{asset('images/logo-icon.svg')}}" alt="">
        Tenancy
    </a>
    <div class="accordion" id="leftMenu">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu1" aria-expanded="true" aria-controls="menu1">
                    Tenants
                </button>
            </h2>
            <div id="menu1" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">
                    <a href="{{url('tenantinformation')}}"><i class="fa-regular fa-file-invoice"></i> Tenant Listing</a>
                
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu2" aria-expanded="false" aria-controls="menu2">
                    Property
                </button>
            </h2>
            <div id="menu2" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">
                    <a href="{{url('properties')}}"><i class="fa-regular fa-folder-open"></i> Property Listing</a>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu3" aria-expanded="false" aria-controls="menu3">
                    Users / Landlord
                </button>
            </h2>
            <div id="menu3" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">
                <a href="{{url('userlisting')}}"><i class="fa-regular fa-folder-open"></i>  User Listing</a>
            
                </div>
            </div>
        </div>
       
        
    
    </div>
</div>
<script>
    $(".accordion .accordion-item .accordion-collapse .accordion-body a").filter(function() {
        return this.href == location.href.replace(/#.*/, "");
    }).addClass("active");
    $(document).ready(function() {
        $("a.active").parents(".accordion-collapse").addClass("show");
    });
</script>