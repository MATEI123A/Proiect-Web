<?php
include '../../config/database.php';

if( $_SERVER['REQUEST_URI'] == "/myproject//View/PHP/mainpage.php")
{
    if(isset($_COOKIE["username"]))
    {
        if($_COOKIE["username"] == "Admin"){
            header("Location:../HTML/admin.html");
            exit;
        } else
            if($_COOKIE["username"] != "Admin" && $_COOKIE["username"] != ""){
                header("Location:../HTML/page.html");
                exit;
            } 
    }
}  
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/mainpage.css"> 
</head>
<body>
    <div id="main">
        <p>Welcome to Workout Web Generator</p>
        <p>This web app is designed to help you maintain a healthy lifestyle.</p>
        
        <div class="button-container">
            <button onclick="createAccount()">Create account</button>
            <button onclick="login()">Log in</button>
        </div>
    </div>

    <script>
       function createAccount() {
            fetch('../HTML/create_account.html?v=' + Date.now())
                .then(response => response.text())        
                .then(html => document.body.innerHTML = html);  
        }

        function login() {
            fetch('../HTML/login_account.html?v='+Date.now())
                .then(response => response.text())        
                .then(html => document.body.innerHTML = html);  
        }

        function check_response() {
            const params = new URLSearchParams(window.location.search);
            const status = params.get('status');

            if (!status) return;

            if (status === 'valid') {
                fetch('../HTML/data_user.html?v='  + Date.now())
                    .then(res => res.text())
                    .then(html => document.body.innerHTML = html);
            } else if (status === 'invalid') {
                        alert("Username or email invalid!");
                        fetch('../HTML/create_account.html?v=' + Date.now())
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                   }
                   else if (status === 'underage') {
                        alert("Minim age is 14 years and maximum 100 years!");
                        fetch('../HTML/data_user.html')
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                   }
                   else if (status === 'weightproblem') {
                        alert("Please check the accuracy of information!");
                        fetch('../HTML/data_user.html')
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                   }
                   else if (status === 'underheight') {
                        alert("Put correct height!");
                        fetch('../HTML/data_user.html')
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                   }
                   else if (status === 'inccorect') {
                        alert("Inccorect username or password!");
                        fetch('../HTML/login_account.html')
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                            
                   }
                   window.history.replaceState({}, document.title, "mainpage.php");
        }

        function back() {
                window.location.href = 'mainpage.php';
        }

    window.onload=check_response;        
    </script>
</body>
</html>
