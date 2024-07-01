<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$property_slug}}</title>
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
                    @if(session()->has('message'))    
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif    
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Properties</th>
                                                <th>Street Address</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            @if(count($property) > 0)
                                                @foreach($property as $pt)
                                                <tr>
                                                    <td>
                                                        @if($property_slug == 'Properties')
                                                        <a class="nav-link" href="{{route('landlord.property.view', $pt->id)}}"> {{$pt->property_name}}</a>
                                                        @elseif($property_slug == 'View Property')
                                                        <a class="nav-link" href="{{route('landlord.property.view', $pt->id)}}"> {{$pt->property_name}}</a>
                                                        @else
                                                        <a class="nav-link" href="{{route('landlord.property.edit', $pt->id)}}"> {{$pt->property_name}}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($property_slug == 'Properties')
                                                        <a class="nav-link" href="{{route('landlord.property.view', $pt->id)}}">
                                                         {{$pt->address}}
                                                        </a>
                                                        @elseif($property_slug == 'View Property')
                                                        <a class="nav-link" href="{{route('landlord.property.view', $pt->id)}}">
                                                             {{$pt->address}}</a>
                                                        @else
                                                        <a class="nav-link" href="{{route('landlord.property.edit', $pt->id)}}"> {{$pt->address}}</a>
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
                topEnd: {
                    buttons: [{
                        text: '<i class="fa-regular fa-circle-plus"></i>Register New Property',
                        className: 'btn-xs btn-1',
                        action: function(e, dt, button, config) {
                            window.location = '/landlord/new-property-create';
                        }
                    }]
                },
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
    </script>
</body>

</html>