<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100..1000&display=swap" rel="stylesheet">
<link href="{{ asset('css/font-awesome-all.css')}}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" />
<link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}" />
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" rel="stylesheet" />
<link href="{{ asset('landlord/css/style.css')}}" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<style>
 .popup-message {background-color:rgba(0,0,0,0.3); display: none; position: fixed; top:0px; bottom:0px; left:0px; right:0px; z-index: 1000;}
 .popup-message .popupcenter{display:flex; align-items: center; justify-content: center; height: 100vh;}
 .popup-message .popup-content{border-radius:10px; background-color:#fff; text-align:center; width:500px;}
 .popup-message .popup-messages, .popup-message .button-container{padding:20px;}
 .popup-message .popup-messages p{margin:0px;}
 .popup-message .button-container{border-top:1px solid rgba(0,0,0,0.1);}

/* Styles for popup message */
 .popup-message {
    font-size: 18px;
    position: fixed;
    margin-bottom: 10px;
} 

/* Styles for countdown timer */
.countdown {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Styles for buttons */
.button-container {
    text-align: center;
}

.button {
    padding: 10px 20px;
    margin: 0 10px;
    font-size: 16px;
    border: none;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
}

.button:hover {
    background-color: #0056b3;
}
/*
#interaction-status {
    position: fixed;
    bottom: 10px;
    right: 10px;
    background-color: #333;
    color: #fff;
    padding: 10px;
}
#popup-message {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    z-index: 9999;
}
*/
</style>

<div id="popup-message" class="popup-message">
    <div class="popupcenter">
        <div class="popup-content">
            <div class="popup-messages">
                <p id="popup-timer">Your session will expire in 60 seconds.<br>Do you want to stay signed in</p>
            </div>
            <div class="button-container">
                <button id="stay-logged-in" onclick="stayLoggedIn()" class="btn btn-success me-2">Stay Signed In</button>
                <a href="{{ route('logout') }}" id="logout" class="btn btn-danger ms-2 logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>        
        </div>
    </div>
</div>