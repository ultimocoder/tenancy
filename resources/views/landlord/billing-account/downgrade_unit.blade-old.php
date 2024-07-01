<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Plan</title>
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
                                <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <a href="#">Account</a> / <span id="activepage"></span></div>
                                <h1><span id="title"></span></h1>
                            </div>
                            <a href="{{route('landlord.account.subscription.change.plan')}}" class="btn btn-xs btn-7"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                        </div>
                    </div>
                    @if(session()->has('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="container-fluid">
                        @if(count($property) >0)
                        @foreach($property as $prop)
                        <div class="heading-2">{{$prop->property_name}}</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <table class="example" class="data-table " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit</th>
                                                <th>Tenant</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($propertyUnits) > 0)
                                            @foreach($propertyUnits as $unit)
                                            @if($unit->property_id == $prop->id)
                                            <tr>
                                                <td class="fw-bold">{{$unit->unit_name}}</td>
                                                
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
                                                @if($unit->status)
                                                <td class="text-end fw-bold"><a href="{{route('landlord.account.deactivate.unit', $unit->id)}}" class="text-color-6" onclick="return confirm('Are you sure want to deactivate this unit?')">Deactivate</a></td>
                                                @else
                                                <td class="text-end fw-bold"><a href="{{route('landlord.account.deactivate.unit', $unit->id)}}" class="text-danger" onclick="return confirm('Are you sure want to activate this unit?')">Activate</a></td>
                                                @endif
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endif
                                           
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <input type="hidden" name="unit" value="{{ $unit_number }}">
                        <input type="hidden" name="id" value="{{  $id }}">

                        <div class="text-center">
                                    <a href="{{route('landlord.account.subscription.change.plan')}}" class="btn btn-color-11 text-white rounded-2 mx-2">Cancel</a>
                                    <a href="{{route('landlord.account.deactivate.property', [$unit_number, $id])}}" class="btn btn-color-6 text-white rounded-2 mx-2">Next</a>
                                </div>
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    
    @include('landlord_layouts.script')
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script>
        new DataTable('.example', {
            layout: {
                topStart: '',
                topEnd: '',
                bottom: '',
                bottomStart: null,
                bottomEnd: null
            }
        });
    </script>
</body>

</html>