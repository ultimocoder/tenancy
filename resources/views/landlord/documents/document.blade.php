<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    @if(Session::has('tenant_id'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-card mb-4">
                                    <div class="title">
                                        <div></div>
                                        <div class="d-flex column-gap-3">
                                            <a href="{{route('landlord.document.edit')}}" class="btn-xs btn-1"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                                        </div>
                                    </div>
                                    <table id="example" class="data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th> Description</th>
                                                <th> Date</th>
                                                <th> Size</th>
                                                <th> Shared</th>
                                            </tr>
                                        </thead>
                                        <tbody class="clickable">
                                            @if(count($docs) > 0)
                                                @foreach($docs as $doc)
                                                <tr>
                                                    <td> <a href="/tenancy/public/landlord/upload-documents/{{$doc->document}}" download>{{$doc->document}}</a></td>
                                                    <td> {{$doc->desc}}</td>
                                                    <td> {{$doc->date}}</td>
                                                    <td> {{$doc->size}}</td>
                                                    <td> @if($doc->share == '1') {{'Yes'}} @else {{"No"}} @endif</td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-lg btn-2 rounded-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload</button>
                                </div>
                            </div>
                        </div>
                    @endif    
                    </div>
                </div>
            </div>
            @include('landlord_layouts.footer')
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{route('landlord.document.save')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Document Upload</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body col">
                    <div class="row mb-2">
                        <div class="col-4"><b>File:</b></div>
                        <div class="col-8">
                            <input type="file" required="" id="uploadFileInput" name="file" accept=".doc,.docx,.pdf" class="form-control form-control-sm @error('file') is-invalid @enderror">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><b>Description:</b></div>
                        <div class="col-8"><input type="text" name="desc" class="form-control form-control-sm" placeholder="Lease Agreement"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><b>Size:</b></div>
                        <div class="col-8"><input type="text" name="size" id="fileSizeDisplay" class="form-control form-control-sm"></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><b>Share document:</b></div>
                        <div class="col-8">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="share" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Yes</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
            </form>
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
                bottomEnd: null,
                ordering: false,
            },
            order: [
                [1, 'desc']
            ]
        });
    </script>
    <script>
    $(document).ready(function() {
        $('#uploadFileInput').on('change', function() {
            var fileSize = this.files[0].size; // Get the size of the first file in the input field
            var fileSizeInKB = fileSize / 1024; // Convert to KB
            $('#fileSizeDisplay').val(fileSizeInKB.toFixed(2) + ' KB');
        });
    });
</script>

</body>

</html>