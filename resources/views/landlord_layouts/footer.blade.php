<div id="popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); z-index: 9999;">
    <p>Your session is about to expire due to inactivity.</p>
    <p>Would you like to stay signed in?</p>
    <button onclick="staySignedIn()">Stay Signed In</button>
    <button onclick="logout()">Log Out</button>
</div>



<div class="footer">
    <div>© 2024 copy Tenancy right all rights reserved.</div>
    <div class="links">
        <a href="#">License</a>
        <a href="#">Terms of Use</a>
    </div>
</div>

<script>
//     // alert('fdf');
//     let timeout;
//     let popupShown = false;

//     startTimer();
//     function startTimer() {
//         timeout = setTimeout(showPopup, 2000);
//     }

//     function showPopup() {
//         // alert("come");
//         if (!popupShown) {
//             //alert("yes");
//             // Show popup
//             popupShown = true;
//             // Code to display the popup
//             //alert(popupShown);

//            // $('#popup').show();

//             // If the user doesn't interact with the popup after 60 seconds, log out
//             //setTimeout(logout, 60000); // 60 seconds
//         }
//     }

    
// function staySignedIn() {
//     // Code to handle staying signed in
//     clearTimeout(timeout);
//     popupShown = false;
//     $('#popup').hide();
//     startTimer();

// }

// function logout() {
//     // Code to handle logout
//     window.location.href="{{route('logout')}}";
// }
</script>