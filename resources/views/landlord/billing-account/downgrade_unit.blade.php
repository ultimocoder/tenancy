<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Plan</title>
    @include('landlord_layouts.header')

    <style>
        .alert-danger {
            display: none;
        }
    </style>
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
                                <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
                                <h1><span id="title"></span></h1>
                            </div>
                            <a href="{{route('landlord.account.subscription.change.plan')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                        </div>
                    </div>
                    <hr>
                    <div class="container-fluid">
                        
                        @if(session()->has('message'))  
                        <div class="mb-3">
                            <b> {{ session()->get('message') }}</b>
                        </div>
                        @else
                        <div class="mb-3">
                            <b>In order to lower your plan, you must deactivate {{(count($oldPropertyUnits) - $unit_number)}} of {{count($oldPropertyUnits)}} registered units. Please select the units you wish to deactivate.</b>
                        </div>
                        @endif
                        <form action="{{route('landlord.account.deactivate.property')}}" method="post">
                            @csrf
                        <div class="row">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            You can only select up to {{(count($oldPropertyUnits) - $unit_number)}} units.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="error-message fw-semibold"></div>
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Property name</th>
                                                <th>Street Address</th>
                                                <th>Unit</th>
                                                <th>Tenant</th>
                                                <th class="text-center">Deactivate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($propertyUnits) > 0)
                                            @foreach($propertyUnits as $unit)
                                            
                                            <tr>
                                                <td>@foreach($property as $prop) @if($prop->id == $unit->property_id) {{$prop->property_name}} @endif @endforeach</td>
                                                <td>@foreach($property as $prop) @if($prop->id == $unit->property_id) {{$prop->address}} @endif @endforeach</td>
                                                <td>{{$unit->unit_name}}</td>
                                                @if(count($tenants) > 0)
                                                    @if(in_array($unit->id, array_column($tenants->toArray(), 'property_unit_id')))
                                                        
                                                        @foreach($tenants as $te)
                                                            @if($te->property_unit_id == $unit->id)
                                                                <td>{{$te->first_name." ".$te->last_name}}</td>
                                                            @endif
                                                        @endforeach
                                                        
                                                    @else
                                                        <td class="text-danger">Vacant</td>

                                                    @endif
                                                @else
                                                    <td>Vacant</td>
                                                @endif
                                                <td class="text-center"><input type="checkbox" name="delete[]" value="{{$unit->id}}"></td>
                                            </tr>
                                            
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" name="unit" value="{{ $unit_number }}">
                                <input type="hidden" name="id" value="{{  $id }}">

                                <!-- just for checkbox condtion only -->
                                <input type="hidden" name="limit" id="limit" value="{{(count($oldPropertyUnits) - $unit_number)}}">

                                <div class="text-center">
                                    <a href="{{route('landlord.account.subscription.change.plan')}}" class="btn btn-color-11 text-white rounded-2 mx-2">Cancel</a>
                                    <button class="btn btn-color-6 text-white rounded-2 mx-2">Next</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    @include('landlord_layouts.script')
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script>
        new DataTable('#example', {
            layout: {
                topStart: '',
                topEnd: '',
                bottom: '',
                bottomStart: null,
                bottomEnd: null
            }
        });



        $(document).ready(function() {
           const limit = $('#limit').val();
            //const limit = 3;
            //alert(limit);
            $('input[type="checkbox"]').on('change', function() {
                const checkedCount = $('input[type="checkbox"]:checked').length;
                if (checkedCount > limit) {
                    //$('.alert-danger').show();
                    $(this).prop('checked', false);
                } else {
                    $('.alert-danger').hide();
                    $('input[type="checkbox"]').prop('disabled', false);

                    if (checkedCount === limit) {
                        $('input[type="checkbox"]').not(':checked').prop('disabled', true);
                    }
                }
            });
        });
    </script>
</body>

</html>