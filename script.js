//function to close the login modal with button
function closeLoginModal() {
	document.getElementById('LoginModal').style.display='none'
}
//function to open the login modal
function openLoginModal() {
	document.getElementById('LoginModal').style.display='block'
}

//function to close the login modal clicking outside 
function eventListnerforLoginModal() {
	// Get the modal
	var modal = document.getElementById('LoginModal');

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
}
//function to login using ajax
function doLogin(event) {
	event.preventDefault()//prevents to reload the page if login data arent correct

	// creating ajax object
	var xhttp;
	if (window.XMLHttpRequest) {
	// code for modern browsers
	xhttp = new XMLHttpRequest();
	} else {
	// code for IE6, IE5
	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	//calback function for the request
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//if status is ok
		if(this.responseText=="Invalid username/password"){
			document.getElementById("InvalidLogin").innerHTML = this.responseText;
		}else{
			if(this.responseText=="Success")
				location.reload();
						document.getElementById("InvalidLogin").innerHTML = this.responseText;

		}

	}
	};
	//getting the values of the fields
	var usr=document.getElementById('usr').value;
	var pwd=document.getElementById('pwd').value;

	//doing th ajax request
	xhttp.open("POST", "doLogin.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("usr="+usr+"&pwd="+pwd);

  return false;
}


