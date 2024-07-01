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

<script>
        const INACTIVITY_DURATION = 4 * 60 * 1000;
        //const INACTIVITY_DURATION = 20 * 1000;
        const POPUP_DURATION = 60 * 1000;

        let timeoutId;
        let popupTimeoutId;
        let timerInterval;

        function startInactivityTimer() {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(displayPopup, INACTIVITY_DURATION);
        }

        function displayPopup() {
            document.getElementById('popup-message').style.display = 'block';
            popupTimeoutId = setTimeout(logoutUser, POPUP_DURATION);
            startPopupTimer();
        }

        function stayLoggedIn() {
            clearTimeout(timerInterval);
            clearTimeout(popupTimeoutId);

            document.getElementById('popup-message').style.display = 'none';
            startInactivityTimer();
        }

        function logoutUser() {
            $(".logout-button").trigger("click");
        }

        function startPopupTimer() {
            let timeLeft = POPUP_DURATION / 1000; 
            let timerDisplay = document.getElementById('popup-timer');

            timerInterval = setInterval(function () {
                timeLeft--;
                timerDisplay.innerHTML = 'Your session will expire in ' + timeLeft + ' seconds.<br>Do you want to stay signed in';
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    logoutUser();
                }
            }, 1000);
        }
        document.addEventListener('mousemove', function() {
            activityDetected = true;
            startInactivityTimer();
        });
        document.addEventListener('mousedown', function() {
            activityDetected = true;
            startInactivityTimer();
        });
        document.addEventListener('keyup', function(e) {
            activityDetected = true;
            startInactivityTimer();
        });
        $('body').on('keypress', function() {
            activityDetected = true;
            startInactivityTimer();
        });
        startInactivityTimer();
    </script>