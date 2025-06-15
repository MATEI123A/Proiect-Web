<?php
include '../config/database.php'
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #1d2033;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items:center;
            height: 100vh;
        }

        p {
            color: white;
            text-align: center;
            margin-top: 70px;
            font-size: 20px;
        }

        .button-container {
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }

        button {
            text-align: center;
            color: white;
            background-color: #141724;
            border: none;
            padding: 10px;
            width: 150px;
            height: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #2a2f4a;
            transform: scale(1.05);
        }
    </style>
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
            fetch('create_account.html?v=' + Date.now())
                .then(response => response.text())        
                .then(html => document.body.innerHTML = html);  
        }

        function login() {
            fetch('login_account.html?v='+Date.now())
                .then(response => response.text())        
                .then(html => document.body.innerHTML = html);  
        }

        function check_response() {
            const params = new URLSearchParams(window.location.search);
            const status = params.get('status');

            if (!status) return;

            if (status === 'valid') {
                fetch('data_user.html?v='  + Date.now())
                    .then(res => res.text())
                    .then(html => document.body.innerHTML = html);
            } else if (status === 'invalid') {
                        alert("Username or email invalid!");
                        fetch('create_account.html?v=' + Date.now())
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                   }
                   else if (status === 'underage') {
                        alert("Minim age is 14 years!");
                        fetch('data_user.html')
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                   }
                   else if (status === 'weightproblem') {
                        alert("Please check the accuracy of information!");
                        fetch('data_user.html')
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                   }
                   else if (status === 'underheight') {
                        alert("Put correct height!");
                        fetch('data_user.html')
                            .then(res => res.text())
                            .then(html => document.body.innerHTML = html);
                   }
                   else if (status === 'inccorect') {
                        alert("Inccorect username or password!");
                        fetch('login_account.html')
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
