<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Documents</title>
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
                    <div class="withButton">
                            <div>
                                <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span> / Edit</div>
                                <h1><span id="title"></span></h1>
                            </div>
                            <a href="{{route('landlord.document')}}" class="btn btn-xs btn-danger"><i class="fa-solid fa-delete-left"></i> Cancel</a>
                        </div>
                    </div>
                    <div class="container-fluid">
                   

                    @if(session()->has('error'))    
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif 
                    <div class="alert alert-danger " id="msg" style="display:none;"></div>
                        <div class="row" id="mydiv">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <div class="title">
                                        <div></div>
                                        <div class="d-flex column-gap-3">
                                            <a href="#"  class="btn-xs btn-3 delete_all" style="display:none"><i class="fa-solid fa-trash-can"></i>Delete</a>
                                        </div>
                                    </div>
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="sub_chk" id="master"></th>
                                                <th>Name</th>
                                                <th> Description</th>
                                                <th> Date</th>
                                                <th> Size</th>
                                                <th> Shared</th>
                                                <th> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="clickable">
                                        @if(count($docs) > 0)
                                            @foreach($docs as $doc)
                                            <tr id="tr_{{$doc->id}}">
                                                <td><input type="checkbox" class="sub_chk" data-id="{{$doc->id}}" data-status="{{$doc->share}}"></td>
                                                <td>{{$doc->document}}</td>
                                                <td> {{$doc->desc}}</td>
                                                <td> {{$doc->date}}</td>
                                                <td> {{$doc->size}}</td>
                                                
                                                <td>
                                                    <div class="form-check form-switch mb-0 mh-auto">
                                                        <input class="form-check-input toggle-class" type="checkbox" data-id="{{ $doc->id }}" data-status="{{ $doc->share }}" role="switch" id="flexSwitchCheckChecked" {{ $doc->share == true ? 'checked' : '' }}>
                                                        <label class="form-check-label mb-0" for="flexSwitchCheckChecked">Yes</label>
                                                    </div>
                                                </td>
                                                <td> <a href="javascript:void(0);" class="delete-doc" data-status="{{$doc->share}}" data-id="{{$doc->id}}"><i class="fa-solid fa-trash-can text-color-11 fs-20"></i></a> </td>
                                                
                                            </tr>
                                            @endforeach
                                        @endif    
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
    <script>
        new DataTable('#example', {
            layout: {
                topStart: '',
                topEnd: '',
                bottom: '',
                bottomStart: null,
                bottomEnd: null
            },
            // columnDefs: [{
            //     orderable: false,
            //     render: DataTable.render.select(),
            //     targets: 0
            // }],
            // select: {
            //     style: 'os',
            //     selector: 'td:first-child'
            // },
            order: [
                [1, 'asc']
            ]
        });

    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var doc_id = $(this).data('id'); 
            //alert(status);
            
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{route("landlord.document.changeStatus")}}',
                data: {'status': status, 'doc_id': doc_id},
                success: function(data){
                console.log(data.success)
                    if(status)
                    {
                        $("#msg").html("Document changed to shared mode.");
                    }else{
                        $("#msg").html("Document chnaged to unshared mode.");
                    }
                    $("#msg").show();
                    $("#msg").fadeOut(3000);
                    setTimeout(function() {
                        location.reload();
                            }, 3000);
                        }
            });
        });

        //checkbox functionality
        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $('.delete_all').show();
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
            $('.delete_all').hide();
         }  
        });//#master end 

        // $('.delete_all').display('hide');
        // Show/hide delete button based on checkbox status
        $('.sub_chk').on('change', function(){
           
            if (anyCheckboxChecked())
            {   
                $('.delete_all').show();
            }else{
                $('.delete_all').hide(); 
            }
        });

    
        // Function to check if any checkbox is checked
        function anyCheckboxChecked() {
            return $('.sub_chk:checked').length > 0;
        }

        $('.delete-doc').on('click', function(){
            var status = $(this).data('status');
            var doc_id = $(this).data('id');

            if(status == false){
                if(confirm('Are you sure you need to delete this document ?')){
                    $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('landlord.document.delete')}}",
                data: {'status': status, 'doc_id': doc_id},
                success: function(data){
                    console.log(data.success)
                        
                        $("#msg").html("Document Deleted successfully.");
                    
                        $("#msg").show();
                        $("#msg").fadeOut(3000);
                        setTimeout(function() {
                        location.reload();
                            }, 3000);
                    }
                });
                }

               
            }else{
                $("#msg").html("Document is in shared mode.");
                $("#msg").show();
                $("#msg").fadeOut(5000);
            }
        })
        

         $('.delete_all').on('click', function(e){
            var allVals = []; 
            var mode = []; 
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            }); 
            $(".sub_chk:checked").each(function() {  
                mode.push($(this).attr('data-status'));
            }); 
            if(mode.length > 0){
                
                var stringWithoutFirstComma = mode.join(',');

                // Remove the comma from the beginning
                stringWithoutFirstComma = stringWithoutFirstComma.replace(/^,/, '');

                // Convert the string back to an array
                var newArray = stringWithoutFirstComma.split(',');
                // alert(newArray);
                console.log(newArray);
                 
                var count=0;
                $.each(newArray, function(index, value) {
                    if(value == 1){
                        $("#msg").html("Some documents are in shared mode so can not delete.");
                        $("#msg").show();
                        $("#msg").fadeOut(5000);
                        //alert("Some documents are in shared mode so can not delete");
                        count = 1;
                        return false;
                    }else{
                        count=0;
                    }
                   
                    
                });  
            }
            //alert(count);
            if(count == 1){
                return false;
            }
            
            console.log(allVals);
            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }else{
                var check = confirm("Are you sure you need to delete the selected documents?"); 
                if(check == true){
                    var join_selected_values = allVals.join(",");
                    // alert(join_selected_values);
                    // return false;
                    $.ajax({
                        url: "{{route('landlord.multiple.document.delete')}}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                    $("#mydiv").load(location.href + " #mydiv");
                                });
                                
                                $("#msg").html("All Documents has been removed.");
                                $("#msg").show();
                                $("#msg").fadeOut(3000);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                            
                            //alert(data['success']);
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                        
                    });

                    $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                    
                    location.reload();
                }
            } 
         }); //.delete_all end  
    });
    </script>
</body>

</html>