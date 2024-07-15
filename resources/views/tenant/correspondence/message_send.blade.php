<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Message Send</title>
    @include('tenant_layouts.header')
</head>

<body>
    <div class="admin-container">
    @include('tenant_layouts.navbar') 
        <div class="rightside">
            <div class="top">
            @include('tenant_layouts.topbar')
                <div class="page">
                    <div class="page-title">
                        <div class="admin-breadcrumb"><a href="#">Dashboard</a> / <span id="activepage"></span></div>
                        <h1><span id="title"></span> - Send</h1>
                    </div>

                    <div class="page-card">
                        <form action="">
                            <div class="title">
                                New Message
                                <div class="d-flex column-gap-3">
                                    <div class="custom-attach">
                                        <label for="attach-file" class="btn btn-xs btn-2"><i class="fa-solid fa-paperclip"></i>Attach File</label>
                                        <input type="file" name="photo" id="attach-file" />
                                    </div>
                                </div>
                            </div>
                            <hr class="">
                            <div>
                                <div class="d-flex align-items-center"><b class="me-2">To:</b> <input type="text" class="form-control"></div>
                            </div>
                            <hr class="">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="d-flex align-items-center flex-grow-1 me-4"><b class="me-2">Subject:</b> <input type="text" class="form-control form-control-sm"></div>
                                <div class="d-flex column-gap-3 text-center">
                                    <div>
                                        <div><b>Matter</b></div>
                                        <select name="" id="">
                                            <option value="Repair">Repair</option>
                                        </select>
                                    </div>
                                    <div>
                                        <div><b>Priority!</b></div>
                                        <select name="" id="">
                                            <option value="Low">Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <textarea class="p-3 border bg-light rounded-3 w-100 mb-3" rows="7">Greetings,
                            
                            We will be having elevator maintenance on October 12th, 2023. Maintenance will be performed between the hours of 10:00 - 2:00 PM. Please plan ahead to avoid further inconvenience.
                                                    
                            Thank you,
                            Management
                        </textarea>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center"><i class="fa-solid fa-paperclip me-2"></i> Maintenance notice.pdf</div>
                                <div class="d-flex align-items-center column-gap-3">
                                    <button type="submit" class="btn btn-success">Send</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('tenant_layouts.footer')
        </div>
    </div>
    @include('tenant_layouts.script')
</body>

</html>