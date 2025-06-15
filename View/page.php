<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #1E2A36;
            margin: 0;
        }

        .top-buttons {
            display: flex;
            justify-content: center;
            align-items: center;     
            gap: 30px;
            padding: 20px;
        }

        button {
            color: white;
            background-color: transparent;
            border: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            cursor: pointer;
        }

		.user-button {
			color: white;
			background-color: #0437F2;
			border: none;
			padding: 10px 20px;
			border-radius: 6px;
			box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
			cursor: pointer;
			font-size: 16px;
			transition: 0.2s;
		}

		.clasament_user{
			color: white;
			background-color: #0437F2;
			border: none;
			padding: 10px 20px;
			border-radius: 6px;
			box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
			cursor: pointer;
			font-size: 16px;
			transition: 0.2s;
		}

		.user {
            display: flex;
            flex-direction: column;
            align-items: center;
			text-align: center;
            gap: 20px; 
			margin-top:-330px;
        }

		.user-button:hover {
			transform: scale(1.05);
			background-color: #0437F2;
		}

        .green-hover:hover {
            transform: scale(1.05);
            background-color: #50C878;
			padding-top: 20px;
			padding-bottom: 20px;
        }

		.username {
			position: fixed;
			margin-left:1050px;  
			font-size: 17px;
			padding: 6px 12px;
			border-radius: 6px;
			background-color: #2a2f4a;
        	transform: scale(1.05);
        	box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
		}

		.type{
			margin-left:40px;
			margin-bottom:20px;
			gap:30px;
		}

		.type:hover{
			transform: scale(1.05);
            background-color: #0047AB;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		.home-button{
			color: white;
            background-color: #50C878;
            border: 0;
            display: flex;
            align-items: center;
			padding-top:10px;
			padding-bottom:10px;
            gap: 10px;
            font-size: 16px;
            cursor: pointer;
		}

		.video{
			display: flex;
			justify-content: center;
			margin-top:-350px;
			gap:40px;
		}

		 form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
            gap: 15px; 
        }

		.button-on-click{
			color: white;
            background-color: #50C878;
            border: 0;
            display: flex;
            align-items: center;
			padding-top:20px;
			padding-bottom:20px;
            gap: 10px;
            font-size: 16px;
            cursor: pointer;
		}

		.type-on-click{
			color: white;
            background-color: #0047AB;
            border: 0;
            display: flex;
            align-items: center;
			padding-top:20px;
			padding-bottom:20px;
            gap: 10px;
            font-size: 16px;
            cursor: pointer;
		}

		.users {
            display: flex;
            flex-direction: column;
            align-items: center;
           margin-top:-50px;
			text-align: center;
            gap: 15px; 
        }

    </style>
</head>
<body>

<div class="top-buttons">
    <button onclick="exercices()" id="exercices" class="green-hover">EXERCICES</button>
    <button onclick="clasament()" id="clasament" class="green-hover">CLASAMENT</button>
    <button onclick="account()" id="account" class="green-hover">ACCOUNT</button>
    <button onclick="yourdata()" id="yourdata" class="green-hover">YOUR DATA</button>
	<button id="username" class="username"></button>
</div>

<div id="mainpage"></div>
<div id="user" class="user"></div>
	
<script>

	function clasament() {
            fetch('../View/clasament.html?v='+ Date.now())
                .then(response => response.text())        
                .then(html => document.getElementById('mainpage').innerHTML = html); 
				document.getElementById('clasament').classList.add("button-on-click");
				document.getElementById('exercices').classList.remove("button-on-click");
				document.getElementById('account').classList.remove("button-on-click");
				document.getElementById('yourdata').classList.remove("button-on-click");
				document.getElementById("user").innerHTML="";
	}

	function account() {
            fetch('../View/account.html?v=' + Date.now())
                .then(response => response.text())        
                .then(html => document.getElementById('mainpage').innerHTML = html); 
				document.getElementById('account').classList.add("button-on-click");
				document.getElementById('exercices').classList.remove("button-on-click");
				document.getElementById('clasament').classList.remove("button-on-click");
				document.getElementById('yourdata').classList.remove("button-on-click");
				document.getElementById("user").innerHTML="";
				get_data_account();
	}

	function yourdata() {
            fetch('../View/yourdata.html?v=' + Date.now())
                .then(response => response.text())        
                .then(html => document.getElementById('mainpage').innerHTML = html); 
				document.getElementById('yourdata').classList.add("button-on-click");
				document.getElementById('exercices').classList.remove("button-on-click");
				document.getElementById('clasament').classList.remove("button-on-click");
				document.getElementById('account').classList.remove("button-on-click");
				document.getElementById("user").innerHTML="";
				get_details_account();
	}


	function get_username() {
		fetch('../Controller/get_account.php')
			.then(response => response.json())
			.then(data => {
				document.getElementById('username').innerText = data.username;
			})
	}

	function get_data_account(){
        fetch('../Controller/get_info.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById("user").value = data.username;
                document.getElementById("email").value = data.email;
                document.getElementById("points").value = data.points;
            })
	}

	function get_details_account(){
        fetch('../Controller/get_data.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById("health").value = data.health;
                document.getElementById("gender").value = data.gender;
                document.getElementById("weight").value = data.weight;
				document.getElementById("height").value = data.height;
				document.getElementById("birthday").value = data.birthday;
				document.getElementById("health").value = data.health;
            })
	}

	function logout(){
    	window.location.href = "../Model/logout.php"; 
	}

	function update(){
		 fetch('update_data_user.html?v='+ Date.now())
                .then(response => response.text())        
                .then(html => document.getElementById('mainpage').innerHTML = html); 
				check_response();
	}

	function check_response() {
		get_username();
            const params = new URLSearchParams(window.location.search);
            const status = params.get('status');

            if (!status) return;

            if (status === 'weightproblem') {
                alert("Please check the accuracy of information!");
                   fetch('update_data_user.html')
                        .then(res => res.text())
                        .then(html => document.getElementById("mainpage").innerHTML = html);
                   }
                   else if (status === 'underheight') {
                        alert("Put correct height!");
                        fetch('update_data_user.html')
                            .then(res => res.text())
                            .then(html => document.getElementById("mainpage").innerHTML = html);
                   }
			
                   window.history.replaceState({}, document.title, "page.php");
				   
    }

	function back(){
		fetch('yourdata.html?v=' + Date.now())
            .then(response => response.text())        
            .then(html => document.getElementById('mainpage').innerHTML = html); 
			get_details_account();
	}

	function total_points() {
		document.getElementById('total_points').classList.add("type-on-click");
		document.getElementById('lower').classList.remove("type-on-click");
		document.getElementById('upper').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('pdf').classList.remove("type-on-click");
		document.getElementById('json').classList.remove("type-on-click");
		document.getElementById('csv').classList.remove("type-on-click");
		document.getElementById('rss').classList.remove("type-on-click");
		document.getElementById("user").innerHTML="";

		document.cookie = "points=total_points; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 

		fetch('../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const wrapper = document.createElement("div");
				wrapper.style.display = "flex";
				wrapper.style.justifyContent = "center";
				wrapper.style.alignItems = "center";
				wrapper.style.width = "300px";  
				wrapper.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");        
				userButton.textContent = `${user.username} - ${user.total_points} points`;
				
				wrapper.appendChild(userButton);
				container.appendChild(wrapper);
			});
		});
	}

	function lower_points() {
		document.getElementById('lower').classList.add("type-on-click");
		document.getElementById('total_points').classList.remove("type-on-click");
		document.getElementById('upper').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('pdf').classList.remove("type-on-click");
		document.getElementById('json').classList.remove("type-on-click");	
		document.getElementById('csv').classList.remove("type-on-click");
		document.getElementById('rss').classList.remove("type-on-click");
		document.getElementById("user").innerHTML="";

		document.cookie = "points=lower_points; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 

		fetch('../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const wrapper = document.createElement("div");
				wrapper.style.display = "flex";
				wrapper.style.justifyContent = "center";
				wrapper.style.alignItems = "center";
				wrapper.style.width = "300px";  
				wrapper.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");        
				userButton.textContent = `${user.username} - ${user.pull_points} points`;
				
				wrapper.appendChild(userButton);
				container.appendChild(wrapper);
			});
		});
	}

	function upper_points() {
		document.getElementById('upper').classList.add("type-on-click");
		document.getElementById('lower').classList.remove("type-on-click");
		document.getElementById('total_points').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('pdf').classList.remove("type-on-click");
		document.getElementById('json').classList.remove("type-on-click");		
		document.getElementById('csv').classList.remove("type-on-click");
		document.getElementById('rss').classList.remove("type-on-click");
		document.getElementById("user").innerHTML="";

		document.cookie = "points=upper_points; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 

		fetch('../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const wrapper = document.createElement("div");
				wrapper.style.display = "flex";
				wrapper.style.justifyContent = "center";
				wrapper.style.alignItems = "center";
				wrapper.style.width = "300px";  
				wrapper.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");        
				userButton.textContent = `${user.username} - ${user.push_points} points`;
				
				wrapper.appendChild(userButton);
				container.appendChild(wrapper);
			});
		});
	}

	function leg_points() {
		document.getElementById('legs').classList.add("type-on-click");
		document.getElementById('lower').classList.remove("type-on-click");
		document.getElementById('upper').classList.remove("type-on-click");
		document.getElementById('total_points').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('pdf').classList.remove("type-on-click");
		document.getElementById('json').classList.remove("type-on-click");
		document.getElementById('csv').classList.remove("type-on-click");
		document.getElementById('rss').classList.remove("type-on-click");
		document.getElementById("user").innerHTML="";

		document.cookie = "points=legs_points; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 

		fetch('../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const wrapper = document.createElement("div");
				wrapper.style.display = "flex";
				wrapper.style.justifyContent = "center";
				wrapper.style.alignItems = "center";
				wrapper.style.width = "300px";  
				wrapper.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");        
				userButton.textContent = `${user.username} - ${user.legs_points} points`;
				
				wrapper.appendChild(userButton);
				container.appendChild(wrapper);
			});
		});
	}

	
	function abd_points() {
		document.getElementById('abs').classList.add("type-on-click");
		document.getElementById('lower').classList.remove("type-on-click");
		document.getElementById('total_points').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");
		document.getElementById('upper').classList.remove("type-on-click");
		document.getElementById('pdf').classList.remove("type-on-click");
		document.getElementById('json').classList.remove("type-on-click");	
		document.getElementById('csv').classList.remove("type-on-click");	
		document.getElementById('rss').classList.remove("type-on-click");
		document.getElementById("user").innerHTML="";

		document.cookie = "points=abs_points; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 

		fetch('../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const wrapper = document.createElement("div");
				wrapper.style.display = "flex";
				wrapper.style.justifyContent = "center";
				wrapper.style.alignItems = "center";
				wrapper.style.width = "300px";  
				wrapper.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");        
				userButton.textContent = `${user.username} - ${user.abs_points} points`;
				
				wrapper.appendChild(userButton);
				container.appendChild(wrapper);
			});
		});
	}

	function pdf() {
		document.getElementById('pdf').classList.add("type-on-click");
		document.getElementById('lower').classList.remove("type-on-click");
		document.getElementById('total_points').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('upper').classList.remove("type-on-click");
		document.getElementById('json').classList.remove("type-on-click");	
		document.getElementById('csv').classList.remove("type-on-click");
		document.getElementById('rss').classList.remove("type-on-click");
		document.getElementById("user").innerHTML="";	

		document.cookie = "points=pdf; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 
		window.open('../Controller/get_points.php?v=' + Date.now());
	}

	function json() {
		document.getElementById('json').classList.add("type-on-click");
		document.getElementById('lower').classList.remove("type-on-click");
		document.getElementById('total_points').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('upper').classList.remove("type-on-click");
		document.getElementById('pdf').classList.remove("type-on-click");	
		document.getElementById('csv').classList.remove("type-on-click");	
		document.getElementById('rss').classList.remove("type-on-click");
		document.getElementById("user").innerHTML="";

		document.cookie = "points=json; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 
		window.open("../Controller/get_points.php?v=" + Date.now());
	}

	function csv() {
		document.getElementById('csv').classList.add("type-on-click");
		document.getElementById('lower').classList.remove("type-on-click");
		document.getElementById('total_points').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('upper').classList.remove("type-on-click");
		document.getElementById('pdf').classList.remove("type-on-click");	
		document.getElementById('json').classList.remove("type-on-click");	
		document.getElementById('rss').classList.remove("type-on-click");	
		document.getElementById("user").innerHTML="";

		document.cookie = "points=csv; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 
		window.open("../Controller/get_points.php?v=" + Date.now());
	}

	function rss() {
		document.getElementById('rss').classList.add("type-on-click");
		document.getElementById('lower').classList.remove("type-on-click");
		document.getElementById('total_points').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('upper').classList.remove("type-on-click");
		document.getElementById('pdf').classList.remove("type-on-click");	
		document.getElementById('json').classList.remove("type-on-click");	
		document.getElementById('csv').classList.remove("type-on-click");	
		document.getElementById("user").innerHTML="";

		document.cookie = "points=rss; path=/";
		
		const container = document.getElementById("user");
		container.innerHTML = ""; 
		window.open("../Controller/get_points.php?v=" + Date.now());
	}

	
	window.onload=get_username; 
	window.onload=check_response; 

</script>
</body>
</html>
