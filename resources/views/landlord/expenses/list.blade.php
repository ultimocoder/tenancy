<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expenses</title>
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
                    @if(session()->has('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif 
                    <div class="container-fluid">
                    <div class="alert alert-danger " id="msg" style="display:none;"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                @php
                                    $currentYear = date('Y');
                                    $lastFiveYears = range($currentYear, $currentYear - 4);
                                @endphp
                               
                                    <div>
                                        <div><b>Please select year for which you want to see expenses</b></div>
                                        <div class="d-flex column-gap-2">
                                        @foreach ($lastFiveYears as $year)
                                            <a href="javascript:void(0);" class="cus-btn-sm btn-outline-color-2 filter {{ $year == $lastFiveYears[0] ? 'active' : '' }}">{{ $year }}</a>
                                        @endforeach
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="year" id="year" value="{{ date('Y')}} ">
                                    <hr class="my-0">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="heading-3">Current Expenses for <span class="text-color-6 ms-1 year-text">{{$lastFiveYears[0]}}</span></div>
                                        <a href="{{route('landlord.add.expenses')}}" class="btn btn-xs btn-2"><i class="fa-regular fa-file-circle-plus"></i> Add Expense</a>
                                    </div>

                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Expenses Type</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Property</th>
                                                <th>File Attachments</th>
                                                <!-- <th class="text-end">Action</th>  -->
                                            </tr>
                                        </thead>
                                        <tbody class="clickable">
                                            
                                            <!-- <tr>
                                                <td>Utility</td>
                                                <td>$100.00</td>
                                                <td>02/05/2024</td>
                                                <td>51 Jordan Avenue</td>
                                                <td>lightbill.pdf</td>
                                                <td class="text-end">
                                                    <a href="view-expense.php" class="text-color-15 mx-2"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="edit-expenses.php" class="text-color-6 mx-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a href="#" class="text-color-11 mx-2"><i class="fa-solid fa-trash-can"></i></a>
                                                </td>
                                            </tr> -->
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
            ajax: {
            url: '{{route('landlord.expenses.list')}}',
                data: function(func) {
                    func.year = $('#year').val();
                    // Add more filters as needed
                    }
                },
                columns: [
                    { data: 'expense_type' },
                    { data: null ,
                        render : function(data, type, row) {
                        // Assuming extraVar is the extra variable
                        var extraVar = '$'; // Change 'extra_var' to your actual column name
                        return extraVar + '' + data.amount; // Concatenate the extra variable with the name
                    },
                    },
                    // { data: 'date' },
                    // {
                    //     data:null,
                    //     render:function(data,type,row){
                    //         const date = new Date(data.date);
                    //         let day = date.getDate().toString(); day = day.length > 1 ? day : '0' + day;
                    //         let month = (1 + date.getMonth()).toString(); month = month.length > 1 ? month : '0' + month;
                    //         let year = date.getFullYear();
                            
                    //         //return `<td>`+date("m/d/Y", strtotime(data.date))+`</td>`;
                    //         return month + '/' + day + '/' + year;
                    //     },
                    // },
                    {
                        data: 'show_date'
                    },
                    { data: 'property_name' },
                    {data: 'receipt'},
                    // {
                    //     data:null,
                    //     render:function(data,type,row){
                    //         return `<td><a href="javascript:void(0);" onclick="editExpense(`+data.id+`)" class="text-color-15 mx-2"><i class="fa-solid fa-eye"></i></a>
                    //         <a href="javascript:void(0);" onclick="deleteExpense(`+data.id+`)" class="text-color-11 mx-2"><i class="fa-solid fa-trash-can"></i></a></td>`;
                    //     }
                        
                    
                    // }

                   

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

        $('.filter').click(function() {
            var year = $(this).text();
            $('#year').val(year);

            $('.year-text').text(year);


           
            $(".filter").removeClass("active");
        
            // Add active class to the clicked tab
            $(this).addClass("active");

            dataTable.ajax.reload();
        });

        // function deleteExpense(id) {
        //     // Implement your delete logic, for example, showing a confirmation dialog and sending an AJAX request to delete the record
        //     if (confirm('Are you sure you want to delete this Expense?')) {
        //         $.ajax({
        //             {{--url: '{{route("landlord.expenses.delete")}}',--}}
        //             type: 'post',
        //             data: {
        //                 id: id,
        //                 _token: '{{csrf_token()}}'
        //             },
        //             success: function(result) {
        //                 $("#msg").html("Expense deleted successfully.");
        //                         $("#msg").show();
        //                         $("#msg").fadeOut(3000);
        //                 // Handle success, for example, reloading the DataTable
        //                 $('#example').DataTable().ajax.reload();
        //             },
        //             error: function(xhr, status, error) {
        //                 // Handle error
        //                 console.error(error);
        //             }
        //         });
        //     }
        // };

        function editExpense(id) {
            // Implement your edit logic, for example, redirecting to edit page
            window.location.href = '/tenancy/public/landlord/expense/edit/'+ id;
        }

        $('#example tbody').on('click', 'tr', function () {
        var data = dataTable.row(this).data();
        //alert(data.id);
          //  console.log(data);
        // Do something with the clicked row data, for example, redirect to a details page
            window.location.href = '/tenancy/public/landlord/expense/view/'+ data.id; // Assuming there is a 'id' field in your data
        });

        
    </script>
</body>

</html>