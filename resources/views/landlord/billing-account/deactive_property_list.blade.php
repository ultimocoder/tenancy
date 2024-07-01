<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Properties</title>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit</th>
                                                <th>Tenant</th>
                                                <th>Property Name</th>
                                                <!-- <th class="text-end">Status</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($property) > 0)
                                            @foreach($property as $prop)
                                                @if(count($propertyUnits) > 0)
                                                @foreach($propertyUnits as $unit)
                                                @if($unit->property_id == $prop->id)
                                            <tr>
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
                                                
                                                <td><span class="h-line-1">{{$prop->property_name}}</span></td>
                                                <!-- <td class="text-end"></td> -->
                                            </tr>
                                                @endif
                                                @endforeach
                                                @endif
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" name="unit" id="unit" value="{{$unit_number}}">
                                <input type="hidden" name="package_id" id="package_id" value="{{$id}}">
                                <div class="text-center">
                                    <a href="{{route('billing.cycle', [$unit_number, $id])}}" class="btn btn-color-11 text-white rounded-2 mx-2">Cancel</a>
                                    <button class="btn btn-color-6 text-white rounded-2 mx-2" id="confirm">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    <!-- Modal -->
   
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

        $('#confirm').on('click', function(){
            var pid = $('#package_id').val();
            var unit = $('#unit').val();

            //var url = '/user-sign-up/'+unit+'/'+pid;
            var url = '/landlord/account/subscription/downgrade-billing-cycle/'+unit+'/'+pid;
            location.href = url;
        });
    </script>
</body>

</html>