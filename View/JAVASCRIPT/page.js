function exercices() {
		
            fetch('../HTML/exercices.html?v='+ Date.now())
                .then(response => response.text())        
                .then(html => document.getElementById('mainpage').innerHTML = html); 
				document.getElementById('exercices').classList.add("button-on-click");
				document.getElementById('clasament').classList.remove("button-on-click");
				document.getElementById('account').classList.remove("button-on-click");
				document.getElementById('yourdata').classList.remove("button-on-click");
				document.getElementById("user").innerHTML="";
				document.getElementById("generate").innerHTML="";
				document.getElementById("welcome").innerHTML="";		
	}

	function clasament() {
            fetch('../HTML/clasament.html?v='+ Date.now())
                .then(response => response.text())        
                .then(html => document.getElementById('mainpage').innerHTML = html); 
				document.getElementById('clasament').classList.add("button-on-click");
				document.getElementById('exercices').classList.remove("button-on-click");
				document.getElementById('account').classList.remove("button-on-click");
				document.getElementById('yourdata').classList.remove("button-on-click");
				document.getElementById("user").innerHTML="";
				document.getElementById("generate").innerHTML="";
				document.getElementById("welcome").innerHTML="";
	}

	function account() {
            fetch('../HTML/account.html?v=' + Date.now())
                .then(response => response.text())        
                .then(html => document.getElementById('mainpage').innerHTML = html); 
				document.getElementById('account').classList.add("button-on-click");
				document.getElementById('exercices').classList.remove("button-on-click");
				document.getElementById('clasament').classList.remove("button-on-click");
				document.getElementById('yourdata').classList.remove("button-on-click");
				document.getElementById("user").innerHTML="";
				document.getElementById("generate").innerHTML="";
				document.getElementById("welcome").innerHTML="";
				get_data_account();
	}

	function yourdata() {
            fetch('../HTML/yourdata.html?v=' + Date.now())
                .then(response => response.text())        
                .then(html => document.getElementById('mainpage').innerHTML = html); 
				document.getElementById('yourdata').classList.add("button-on-click");
				document.getElementById('exercices').classList.remove("button-on-click");
				document.getElementById('clasament').classList.remove("button-on-click");
				document.getElementById('account').classList.remove("button-on-click");
				document.getElementById("user").innerHTML="";
				document.getElementById("generate").innerHTML="";
				document.getElementById("welcome").innerHTML="";
				get_details_account();
	}


	function get_username() {
		fetch('../../Controller/get_account.php')
			.then(response => response.json())
			.then(data => {
				document.getElementById('username').innerText = data.username;

				if (data.username === 'Admin') 
                	window.location.href = "../HTML/admin.html"; 

				if(!data.username)
					window.location.href = "../PHP/mainpage.php"; 	
			})
	}

	function get_data_account(){
        fetch('../../Controller/get_info.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById("user").value = data.username;
                document.getElementById("email").value = data.email;
                document.getElementById("points").value = data.points;
            })
	}

	function get_details_account(){
        fetch('../../Controller/get_data.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById("health").value = data.health;
                document.getElementById("gender").value = data.gender;
                document.getElementById("weight").value = data.weight;
				document.getElementById("height").value = data.height;
				document.getElementById("birthday").value = data.birthday;
				document.getElementById("health").value = data.health;
				document.getElementById("preference").value = data.preferences;
            })
	}

	function logout(){
    	window.location.href = "../../Model/logout.php"; 
	}

	function update(){
		document.getElementById("welcome").innerHTML="";
		 fetch('../HTML/update_data_user.html?v='+ Date.now())
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
				document.getElementById("welcome").innerHTML="";
                   fetch('../HTML/update_data_user.html')
                        .then(res => res.text())
                        .then(html => document.getElementById("mainpage").innerHTML = html);
                   }
                   else if (status === 'underheight') {
					document.getElementById("welcome").innerHTML="";
                        alert("Put correct height!");
                        fetch('../HTML/update_data_user.html')
                            .then(res => res.text())
                            .then(html => document.getElementById("mainpage").innerHTML = html);
                   }
			
                   window.history.replaceState({}, document.title, "page.php");
				   
    }

	function back(){
		fetch('../HTML/yourdata.html?v=' + Date.now())
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

		fetch('../../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.width = "300px";  
				div.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");        
				userButton.textContent = `${user.username} - ${user.total_points} points`;
				
				div.appendChild(userButton);
				container.appendChild(div);
			});
		});
	}

	function pull() {
		document.getElementById('pull').classList.add("type-on-click");
		document.getElementById('push').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");	
		document.getElementById("user").innerHTML="";
		document.getElementById("generate").innerHTML="";

		document.cookie = "group=pull; path=/";

		const container = document.getElementById("generate");
		container.innerHTML = ""; 

		fetch('../../Controller/get_exercices.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.flexDirection = "column";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.maxWidth = "500px";
				div.style.width = "100%";
				div.style.margin = "20px auto";
				div.style.padding = "20px";
				div.style.border = "1px solid #ccc";
				div.style.borderRadius = "10px";
				div.style.boxShadow = "0 4px 10px rgba(0,0,0,0.1)";
				div.style.backgroundColor = "#581845";

				const name = document.createElement("h2");       
				name.textContent = user.name;
				div.appendChild(name);

				const description = document.createElement("p");       
				description.textContent = user.description;
				description.style.marginTop = "10px";
				div.appendChild(description);

				const iframe = document.createElement("iframe");
				const videoId = extractYoutubeID(user.link);
				iframe.src = "https://www.youtube.com/embed/" + videoId;
				iframe.width = "100%";
				iframe.height = "250";
				iframe.allowFullscreen = true;
				iframe.style.border = "none";
				iframe.style.marginTop = "15px";
				div.appendChild(iframe);

				const button = document.createElement("button");       
				button.textContent = "Finish";
				button.style.marginTop = "10px";
				button.onclick = function() {
					user_point("pull"); 
				};
				button.classList.add("generate-button");
				div.appendChild(button);

				container.appendChild(div);

				});
			});
	}

	function extractYoutubeID(cod){
		var nr=0;
		var videoID="";

		for(let i=0;i<cod.length;i++){
			if(cod.substring(i,i+2) === "v="){
				videoID = cod.substring(i+2,i+13);
				break;
			}
		}

		return videoID;
	}	

	function push() {
		document.getElementById('push').classList.add("type-on-click");
		document.getElementById('pull').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");	
		document.getElementById("user").innerHTML="";
		document.getElementById("generate").innerHTML="";

		document.cookie = "group=push; path=/";

		const container = document.getElementById("generate");
		container.innerHTML = ""; 

		fetch('../../Controller/get_exercices.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.flexDirection = "column";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.maxWidth = "500px";
				div.style.width = "100%";
				div.style.margin = "20px auto";
				div.style.padding = "20px";
				div.style.border = "1px solid #ccc";
				div.style.borderRadius = "10px";
				div.style.boxShadow = "0 4px 10px rgba(0,0,0,0.1)";
				div.style.backgroundColor = "#581845";

				const name = document.createElement("h2");       
				name.textContent = user.name;
				div.appendChild(name);

				const description = document.createElement("p");       
				description.textContent = user.description;
				description.style.marginTop = "10px";
				div.appendChild(description);

				const iframe = document.createElement("iframe");
				const videoId = extractYoutubeID(user.link);
				iframe.src = "https://www.youtube.com/embed/" + videoId;
				iframe.width = "100%";
				iframe.height = "250";
				iframe.allowFullscreen = true;
				iframe.style.border = "none";
				iframe.style.marginTop = "15px";
				div.appendChild(iframe);

				const button = document.createElement("button");       
				button.textContent = "Finish";
				button.onclick = function() {
					user_point("push"); 
				};
				button.style.marginTop = "10px";
				button.classList.add("generate-button");
				div.appendChild(button);

				container.appendChild(div);

				});
			});
	}

	function abs() {
		document.getElementById('abs').classList.add("type-on-click");
		document.getElementById('push').classList.remove("type-on-click");
		document.getElementById('pull').classList.remove("type-on-click");
		document.getElementById('legs').classList.remove("type-on-click");	
		document.getElementById("user").innerHTML="";

		document.cookie = "group=abs; path=/";

		const container = document.getElementById("generate");
		container.innerHTML = ""; 

		fetch('../../Controller/get_exercices.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.flexDirection = "column";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.maxWidth = "500px";
				div.style.width = "100%";
				div.style.margin = "20px auto";
				div.style.padding = "20px";
				div.style.border = "1px solid #ccc";
				div.style.borderRadius = "10px";
				div.style.boxShadow = "0 4px 10px rgba(0,0,0,0.1)";
				div.style.backgroundColor = "#581845";

				const name = document.createElement("h2");       
				name.textContent = user.name;
				div.appendChild(name);

				const description = document.createElement("p");       
				description.textContent = user.description;
				description.style.marginTop = "10px";
				div.appendChild(description);

				const iframe = document.createElement("iframe");
				const videoId = extractYoutubeID(user.link);
				iframe.src = "https://www.youtube.com/embed/" + videoId;
				iframe.width = "100%";
				iframe.height = "250";
				iframe.allowFullscreen = true;
				iframe.style.border = "none";
				iframe.style.marginTop = "15px";
				div.appendChild(iframe);

				const button = document.createElement("button");       
				button.textContent = "Finish";
				button.onclick = function() {
					user_point("abs"); 
				};
				button.style.marginTop = "10px";
				button.classList.add("generate-button");
				div.appendChild(button);

				container.appendChild(div);

				});
			});
	}

	function legs() {
		document.getElementById('legs').classList.add("type-on-click");
		document.getElementById('push').classList.remove("type-on-click");
		document.getElementById('pull').classList.remove("type-on-click");
		document.getElementById('abs').classList.remove("type-on-click");	
		document.getElementById("user").innerHTML="";

		document.cookie = "group=legs; path=/";

		const container = document.getElementById("generate");
		container.innerHTML = ""; 

		fetch('../../Controller/get_exercices.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.flexDirection = "column";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.maxWidth = "500px";
				div.style.width = "100%";
				div.style.margin = "20px auto";
				div.style.padding = "20px";
				div.style.border = "1px solid #ccc";
				div.style.borderRadius = "10px";
				div.style.boxShadow = "0 4px 10px rgba(0,0,0,0.1)";
				div.style.backgroundColor = "#581845";

				const name = document.createElement("h2");       
				name.textContent = user.name;
				div.appendChild(name);

				const description = document.createElement("p");       
				description.textContent = user.description;
				description.style.marginTop = "10px";
				div.appendChild(description);

				const iframe = document.createElement("iframe");
				const videoId = extractYoutubeID(user.link);
				iframe.src = "https://www.youtube.com/embed/" + videoId;
				iframe.width = "100%";
				iframe.height = "250";
				iframe.allowFullscreen = true;
				iframe.style.border = "none";
				iframe.style.marginTop = "15px";
				div.appendChild(iframe);

				const button = document.createElement("button");       
				button.textContent = "Finish";
				button.onclick = function() {
					user_point("legs"); 
				};
				button.style.marginTop = "10px";
				button.classList.add("generate-button");
				div.appendChild(button);

				container.appendChild(div);

				});
			});
	}

	function user_point(muscle){
		document.cookie = "muscle=" + muscle + "; path=/";
		//window.open('../Model/insert_points.php?v=' + Date.now());
		fetch('../../Model/insert_points.php?v=' + Date.now())
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

		fetch('../../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.width = "300px";  
				div.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");   
				
				if(user.pull_points === 0){
					userButton.textContent = `${user.username}`;
				} else
					userButton.textContent = `${user.username} - ${user.pull_points} points`;
				
				div.appendChild(userButton);
				container.appendChild(div);
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

		fetch('../../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.width = "300px";  
				div.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user"); 
				
				if(user.push_points === 0){
					userButton.textContent = `${user.username}`;
				} else
					userButton.textContent = `${user.username} - ${user.push_points} points`;
				
				div.appendChild(userButton);
				container.appendChild(div);
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

		fetch('../../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.width = "300px";  
				div.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");        
				
				if(user.legs_points === 0){
					userButton.textContent = `${user.username}`;
				} else
					userButton.textContent = `${user.username} - ${user.legs_points} points`;
				
				div.appendChild(userButton);
				container.appendChild(div);
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

		fetch('../../Controller/get_points.php?v=' + Date.now())
		.then(response => response.json())  
		.then(users => {
			users.forEach(user => {
				const div = document.createElement("div");
				div.style.display = "flex";
				div.style.justifyContent = "center";
				div.style.alignItems = "center";
				div.style.width = "300px";  
				div.style.marginBottom = "10px";

				const userButton = document.createElement("button");
				userButton.classList.add("clasament_user");        
				
				if(user.abs_points === 0){
					userButton.textContent = `${user.username}`;
				} else
					userButton.textContent = `${user.username} - ${user.abs_points} points`;
				
				div.appendChild(userButton);
				container.appendChild(div);
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
		window.open('../../Controller/get_points.php?v=' + Date.now());
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
		window.open("../../Controller/get_points.php?v=" + Date.now());
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
		window.open("../../Controller/get_points.php?v=" + Date.now());
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
		window.open("../../data/RSS-format.php?v=" + Date.now());
	}

window.onload=get_username; 
window.onload=check_response; 