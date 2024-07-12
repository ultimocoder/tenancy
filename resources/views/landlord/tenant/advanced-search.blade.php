<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenant Search</title>
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
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span></div>
                        <h1><span id="title"></span></h1>
                    </div>
                    <div class="container-fluid">
                        <!-- <form action=""> -->
                            <div class="row mb-4">
                                <input type="hidden" name="click" id="click" value = "@if(isset($data->click)){{$data->click}}@endif">
                                

                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center mb-3">
                                                <label for="" class="fw-semibold me-2 text-nowrap">First Name</label>
                                                <input type="text" name="first_name" id="first_name" value="@if(isset($data->first_name)){{$data->first_name}}@endif" class="form-control form-control-sm" placeholder="Enter First Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center mb-3">
                                                <label for="" class="fw-semibold me-2 text-nowrap">Last Name</label>
                                                <input type="text" name="last_name" id="last_name" value="@if(isset($data->last_name)){{$data->last_name}}@endif" class="form-control form-control-sm" placeholder="Enter Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <label for="" class="fw-semibold me-2 text-nowrap">Street Address</label>
                                    <input type="text" id="address" class="form-control form-control-sm" placeholder="Street Address" value="@if(isset($data->address)){{$data->address}}@endif">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <div class="fs-16 fw-semibold text-color-6 mb-3 cursor-pointer singleCollapse1" data-bs-toggle="collapse" href="#collapseExample">Advanced</div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <label for="" class="fw-semibold me-2 text-nowrap">Account Number</label>
                                                    <input type="text" name="account" id="account" class="form-control form-control-sm" placeholder="Enter Account Number">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <label for="" class="fw-semibold me-2 text-nowrap">Property Name</label>
                                                    <input type="text" name="property_name" id="property_name" class="form-control form-control-sm" placeholder="Enter Property Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-sm-0 mb-3">
                                                    <label for="" class="fw-semibold me-2 text-nowrap">Phone</label>
                                                    <input type="tel" id="phone" class="form-control form-control-sm" placeholder="Enter Phone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center mb-sm-0 mb-3">
                                                    <label for="" class="fw-semibold me-2 text-nowrap">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Enter Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                                
                            <div class="text-center"><button class="btn btn-2 rounded-2" id="filter">Search</button></div>
                                
                        <!-- </form> -->

                        <hr class="my-4">

                        <div class="heading-3">Search Results</div>

                        <div class="row exm">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Account No.</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>   
                                                <th>Address</th>
                                                <th>Unit Number</th> 
                                                <th>Property Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="clickable">
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>

    @include('landlord_layouts.script')
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.0/js/select.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
    <script>
      var dataTable = new DataTable('#example', {
            //dom: 'fBtpil',
            //ajax: '{{route('landlord.advanced.search.tenant')}}',
            ajax: {
            url: '{{route('landlord.advanced.search.tenant')}}',
                data: function(func) {
                    func.first_name = $('#first_name').val();
                    func.last_name = $('#last_name').val();
                    func.email = $('#email').val();
                    func.property_name = $('#property_name').val();
                    func.address = $('#address').val();
                    func.phone = $('#phone').val();
                    func.account = $('#account').val();


                    // Add more filters as needed
                    }
                },
                columns: [
                    { data: 'unique_id' },
                    { data: 'first_name' },
                    { data: 'last_name' },
                    {data: 'address'},
                    {data: 'property_unit'},
                    {data: 'property_name'},
                    { data: 'email' },
                    {data: 'phone'},
                    
                    

                ],

            layout: {
                topStart: '',
                topEnd: '',
                bottom: 'paging',
                bottomStart: 'info',
                bottomEnd: 'pageLength'
            },

            language: {
                paginate: {
                    previous: 'Previous',
                    next: 'Next'
                },
                searchPlaceholder: 'Search Properties'
            }
        });

        $('#filter').click(function() {
            $('.exm').show()
            dataTable.ajax.reload();
        });

        $('#example tbody').on('click', 'tr', function () {
        var data = dataTable.row(this).data();
           // alert(data.id);
          //  console.log(data);
        // Do something with the clicked row data, for example, redirect to a details page
            window.location.href = '/landlord/tenant-info/' + data.id; // Assuming there is a 'id' field in your data
        });
        //tenancy/public/

        $(function(){
            

            var fname = $('#first_name').val();
            var lname = $('#last_name').val();
            var address = $('#address').val();
            var click = $('#click').val();

            //alert(fname);
            if(fname != '' || lname != '' || address != '' || click != ''){
                $('.exm').show();
                //dataTable.ajax.reload();
            }else{
                //alert('fjdf');
                $('.exm').hide();
                //dataTable.ajax.reload();
            }


        })


    </script>
</body>

</html>