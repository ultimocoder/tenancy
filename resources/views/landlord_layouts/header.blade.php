<link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100..1000&display=swap" rel="stylesheet">
<link href="{{ asset('css/font-awesome-all.css')}}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" rel="stylesheet" />
<link href="{{ asset('landlord/css/style.css')}}" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!--      
         
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
$(function() {
    $( "#dialog" ).dialog();
});
</script>
      <body>    
            <div id="dialog" title="Automatically Logout" >
            <div class="time">Time left = <span id="timer">1:00</span></div><br>        
                <div class="modal-footer">               
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="window.location.reload();">Stay SignIn</button>&nbsp;
                        <a class="btn btn-1" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>Logout</a>
                    </div>
            </div> 
            
      </body>
    </html>
<script>
    setTimeout(function() {
        // Select the element with class .ui-dialog
        $(document).find(".ui-dialog").css("visibility","visible");
        // $(document).find(".rightside").css("filter","blur(3px)");
        // $(document).find(".leftbar").css("filter","blur(3px)");       
        // $(document).find('a').removeAttr('href');
        var timerInterval = setInterval(startTimer, 1000);
    }, 240000); // 4 minutes = 240000 milliseconds


    var timeLimitInMinutes = 1;
    var timeLimitInSeconds = timeLimitInMinutes * 60;
    var timerElement = document.getElementById('timer');

    function startTimer() {
        timeLimitInSeconds--;
        var minutes = Math.floor(timeLimitInSeconds / 60);
        var seconds = timeLimitInSeconds % 60;

        if (timeLimitInSeconds == 0) {
            window.location.reload();
        }

        if (timeLimitInSeconds < 0) {
            timerElement.textContent = '00:00';
            clearInterval(timerInterval);
            return;
        }

        if (minutes < 1) {
            minutes = '0' + minutes;
        }
        if (seconds < 1) {
            seconds = '0' + seconds;
        }

        timerElement.textContent = minutes + ':' + seconds;
    }
</script> -->
