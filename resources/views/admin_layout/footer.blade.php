<div id="popup-message" class="popup-message">
    <div class="popupcenter">
        <div class="popup-content">
            <div class="popup-messages">
                <p>Your session will expire in <span id="countdown"></span> seconds.<br>Do you want to stay signed in</p>
            </div>
            <div class="button-container">
                <button id="stay-logged-in" class="btn btn-success me-2">Stay Signed In</button>
                <button id="logout" class="btn btn-danger ms-2">Log Out</button>
            </div>        
        </div>
    </div>
</div>

<div class="footer">
    <div>© 2024 copy Tenancy right all rights reserved.</div>
    <div class="links">
        <a href="#">License</a>
        <a href="#">Terms of Use</a>
    </div>
</div>
<script>
$(document).ready(function(){
    var inactiveTimeout;
    var logoutTimeout;
    var inactivityDuration =  10 * 1000; // 4 minutes in milliseconds
    var logoutDuration = 60*1000; // 60 seconds before automatic logout after showing the popup

    // Function to update interaction status
    function updateInteractionStatus(status) {
        $('#interaction-status').text(status);
    }

    // Function to handle inactivity
    function handleInactivity() {
        $('#popup-message').fadeIn(); 
        startLogoutCountdown();
        
    }
    function startLogoutCountdown() {
        var remainingTime = logoutDuration / 1000; // Convert milliseconds to seconds
        updateCountdown(remainingTime); // Update the countdown text initially

        logoutTimeout = setInterval(function() {
            remainingTime -= 1;
            updateCountdown(remainingTime);

            if (remainingTime <= 0) {
                logoutUser();
            }
        }, 1000); 
    }

    // Function to update countdown text
    function updateCountdown(seconds) {
        $('#countdown').text(seconds);
    }

    // Function to logout user
    function logoutUser() {
        // Add your logout logic here
        window.location.href = "/tenancy/public/logout";
    }

    // Function to reset the inactivity timer
    function resetInactivityTimer() {
        clearTimeout(inactiveTimeout);
        inactiveTimeout = setTimeout(handleInactivity, inactivityDuration);
    }

    // Event listeners to detect user interaction
    $(document).on('click mousemove scroll keydown', function(){
        updateInteractionStatus();
        resetInactivityTimer(); // Reset the timer on every interaction
        // $('#popup-message').fadeOut(5000); // Hide the popup message if it's visible
        clearTimeout(logoutTimeout); // Clear automatic logout timeout if user interacts
    });

    // Call reset function initially
    resetInactivityTimer();

    // Button click event handlers
    $('#stay-logged-in').on('click', function(){
        $('#popup-message').fadeOut(); // Hide the popup message
        clearTimeout(logoutTimeout); // Clear automatic logout timeout
        resetInactivityTimer(); // Reset the inactivity timer
        // Add your logic to handle staying logged in
        console.log('Stay Logged In');
    });

    $('#logout').on('click', function(){
        $('#popup-message').fadeOut(); // Hide the popup message
        clearTimeout(logoutTimeout); // Clear automatic logout timeout
        // Add your logout logic here
        window.location.href = "/tenancy/public/logout";
    });
});
</script>