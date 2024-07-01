<div class="leftbar">
    <a href="{{route('tenant-dashboard')}}" class="logo text-black text-center">
        <img src="{{ asset('images/logo-icon.svg')}}" alt="">
        Teanat
    </a>
    <div class="accordion" id="leftMenu">
        <div class="accordion-item">
            <h2 class="accordion-header">
               <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu1" aria-expanded="true" aria-controls="menu1">
                    Tenant Information
                </button>
            </h2>
            <div id="menu1" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">
                    <a href="{{route('tenant.tenant-information')}}" class="{{ Request()->is('tenant/tenant-info/*') || Request()->is('tenant/tenant/*') ? 'active' : '' }}"><i class="fa-regular fa-file-invoice"></i>Tenant Information</a>
                    <a href="{{route('tenant.tenant-additional-information')}}" class="{{ Request()->is('tenant/tenant-additional-info') ? 'active' : '' }}"><i class="fa-regular fa-file-invoice"></i> Additional Information</a>
                </div>
            </div>
        </div>
        <!--<div class="accordion-item">-->
        <!--    <h2 class="accordion-header">-->
        <!--        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu2" aria-expanded="false" aria-controls="menu2">-->
        <!--            Documents-->
        <!--        </button>-->
        <!--    </h2>-->
        <!--    <div id="menu2" class="accordion-collapse collapse" data-bs-parent="#leftMenu">-->
        <!--        <div class="accordion-body">-->
        <!--            <a href="{{route('landlord.document')}}"><i class="fa-regular fa-folder-open"></i> Documents</a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
       
      
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu4" aria-expanded="true" aria-controls="menu4">
                    Payments
                </button>
            </h2>
            <div id="menu4" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">
                    <a href="#"><i class="fa-solid fa-clock-rotate-left"></i> Payment History</a>
                    <a href="#"><i class="fa-regular fa-receipt"></i> Receipts</a>
                </div>
            </div>
        </div>

        <a href="{{route('landlord.document')}}">Documents</a>
          <!-- <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu3" aria-expanded="false" aria-controls="menu3">
                    Correspondence
                </button>
            </h2>
            <div id="menu3" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">

                </div>
            </div>
        </div> -->
        <!-- <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu5" aria-expanded="true" aria-controls="menu5">
                    Expenses
                </button>
            </h2>
            <div id="menu5" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">
                    <a href="{{route('landlord.add.expenses')}}"><i class="fa-regular fa-file-circle-plus"></i> Add Expenses</a>
                    <a href="{{route('landlord.list.expenses')}}"><i class="fa-regular fa-eye"></i> View Expenses</a>
                </div>
            </div>
        </div> -->
        <!-- <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu5" aria-expanded="true" aria-controls="menu5">
                    Expenses
                </button>
            </h2>
            <div id="menu5" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">
                    <a href="{{route('landlord.list.expenses')}}" class="{{ Request()->is('landlord/list/expenses') || Request()->is('landlord/expense/edit/*') || Request()->is('landlord/expense/view/*') ? 'active' : '' }}"><i class="fa-solid fa-hand-holding-dollar"></i>Expenses</a>
                    <a href="{{route('landlord.add.expenses')}}"><i class="fa-regular fa-file-circle-plus"></i> Add Expense</a>
                </div>
            </div>
        </div> -->
        <!-- <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu6" aria-expanded="true" aria-controls="menu6">
                    Reports
                </button>
            </h2>
            <div id="menu6" class="accordion-collapse collapse" data-bs-parent="#leftMenu">
                <div class="accordion-body">
                    <a href="#"><i class="fa-solid fa-dollar-sign"></i> Total Earnings Year to Date</a>
                    <a href="#"><i class="fa-regular fa-calendar-days"></i> Total Expenses Year to Date</a>
                    <a href="#"><i class="fa-regular fa-receipt"></i> Upcoming Lease Expirations</a>
                    <a href="#"><i class="fa-regular fa-screwdriver-wrench"></i> Open Repair Requests</a>
                    <a href="#"><i class="fa-solid fa-users-line"></i> All Tenants</a>
                    <a href="#"><i class="fa-regular fa-building-user"></i> All Vacancies</a>
                </div>
            </div>
        </div> -->
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