<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
<script>
    $("#title").text(document.title);
    $("#activepage").text(document.title);
    
    $(".singleCollapse").click(function() {
        $(".singleCollapse").toggleClass("open");
    });

    $(".singleCollapse1").click(function() {
        $(".singleCollapse1").toggleClass("open");
    });
</script>