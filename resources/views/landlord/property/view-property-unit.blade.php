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
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span> / <span>Units</span></div>
                        <!-- <h1><span id="title"></span></h1> -->
                    </div>
                    @if(session()->has('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route('landlord.property')}}" class="btn-xs btn-5 mb-3 mt-5"><i class="fa-solid fa-arrow-left-long"></i>Back</a>
                                <div class="heading-3 mb-2">{{$property->property_name}}</div>
                                <div class="page-card mb-4">
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit</th>
                                                <th>Tenant</th>
                                                <th class="text-end">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($property_unit) > 0)
                                            @foreach($property_unit as $unit)
                                            <tr>
                                                <td>{{$unit->unit_name}}</td>
                                                <td><span class="text-body-tertiary">
                                                <!-- @if(count($tenants) > 0)
                                                    @foreach($tenants as $te)
                                                        @if(in_array($te->property_unit, array_column($property_unit->toArray(), 'unit_name')))
                                                                {{$te->first_name}}
                                                        @endif
                                                    @endforeach

                                                @else
                                                    {{ "tenant not assigned" }}
                                                @endif -->

                                                @if(count($tenants) > 0)
                                                    @if(in_array($unit->id, array_column($tenants->toArray(), 'property_unit_id')))
                                                    
                                                        @foreach($tenants as $te)
                                                            @if($te->property_unit_id == $unit->id)
                                                                <a href="{{route('landlord.tenant-information', $te->id)}}" class="nav-link">{{$te->first_name." ".$te->last_name}}</a>
                                                            @endif
                                                        @endforeach
                                                        
                                                    @else
                                                        <span class="text-danger">Vacant</span>

                                                    @endif
                                                    <!-- @foreach($tenants as $te)
                                                        @if($te->property_unit_id == $unit->id)
                                                            <a href="{{route('landlord.tenant-information', $te->id)}}" class="nav-link">{{$te->first_name." ".$te->last_name}}</a>
                                                        @endif
                                                    @endforeach -->
                                                @else
                                                    <span class="text-danger">Vacant</span>
                                                @endif

                                                
                                                
                                                </span></td>
                                                <td class="text-end">
                                                @if(count($tenants) > 0)
                                                        @if(!in_array($unit->id, array_column($tenants->toArray(), 'property_unit_id')))
                                                        <a href="{{route('landlord.new.tenant.unit', $unit->id)}}" class="btn-xs btn-1">
                                                            <i class="fa-regular fa-circle-plus">
                                                            </i>Register New Tenant
                                                        </a>
                                                        @endif
                                                @else
                                                <a href="{{route('landlord.new.tenant.unit', $unit->id)}}" class="btn-xs btn-1">
                                                        <i class="fa-regular fa-circle-plus">
                                                        </i>Register New Tenant
                                                    </a>
                                                @endif
                                                    
                                                </td>
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
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
    <script>
        new DataTable('#example', {
            //dom: 'fBtpil',
            layout: {
                topStart: 'search',
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
                searchPlaceholder: 'Search Unit'
            }
        });
    </script>
</body>

</html>