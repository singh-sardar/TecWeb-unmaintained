//function to close the login modal with button
function closeLoginModal() {
	document.getElementById('LoginModal').style.display='none';
}

//function to close the singh in modal with button
function closeSignUpModal() {
	document.getElementById('SignUpModal').style.display='none';
}

//function to close the edit profile Modal with button
function closeEditProfileModal() {
	document.getElementById('EditProfileModal').style.display='none';
}

//function to open the login modal
function openLoginModal() {
	document.getElementById('LoginModal').style.display='block';
}

//function to open the sign in Modal
function openSignUpModal() {
	document.getElementById('SignUpModal').style.display='block';
}

//function to open the edit profile Modal
function openEditProfileModal() {
	document.getElementById('EditProfileModal').style.display='block';
}

//function to close the  modal clicking outside
function eventListnerforLoginModal() {

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == document.getElementById('LoginModal')) {
			document.getElementById('LoginModal').style.display = "none";
		}
		if (event.target == document.getElementById('SignUpModal')) {
			document.getElementById('SignUpModal').style.display = "none";
		}
		if (event.target == document.getElementById('EditProfileModal')) {
			document.getElementById('EditProfileModal').style.display = "none";
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
		if(this.responseText=="Success")
			location.reload();
		else
			document.getElementById("InvalidLogin").innerHTML = this.responseText;

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

//function to lofOut using ajax
function doLogOut(event) {

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
		if(this.responseText=="success"){
			location.reload();//reload page if logged out

		}

	}
	};
	//doing th ajax request
	xhttp.open("POST", "doLogOut.php", true);
	xhttp.send();

}


//function to Singh Up using ajax
function doSignUp(event) {
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
		if(this.responseText=="Success"){
			location.reload();
		}else{
			document.getElementById("SignUpMessage").innerHTML = this.responseText;
		}

	}
	};
	//getting the values of the fields
	var usr=document.getElementById('usrSighUp').value;
	var pwd=document.getElementById('pwdSignUp').value;
	var name=document.getElementById('name').value;
	var surname=document.getElementById('surname').value;
	//doing th ajax request
	xhttp.open("POST", "doSignUp.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("usr="+usr+"&pwd="+pwd+"&name="+name+"&surname="+surname);

  return false;
}



//function to Edit Profile using ajax
function doEditProfile(event) {
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
		document.getElementById("EditProfileMessage").innerHTML = this.responseText;

	}
	};
	//getting the values of the fields
	var usr=document.getElementById('usrEdit').value;
	var pwd=document.getElementById('pwdEdit').value;
	var name=document.getElementById('nameEdit').value;
	var surname=document.getElementById('surnameEdit').value;
	//doing th ajax request
	xhttp.open("POST", "doEditProfile.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("usr="+usr+"&pwd="+pwd+"&name="+name+"&surname="+surname);

  return false;
}

//drobdown menu event
function openDrobDownMenu() {
    var x = document.getElementById("Topnav");
    if (x.className === "menu") {
        x.className += " responsive";
    } else {
        x.className = "menu";
    }
}

/*
Function by page gallery.php
*/
function btnLikeOnClick(obj){
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
            if(this.responseText=="0"){//finestra di login
                openLoginModal();
            }else if(this.responseText == "1"){//like inserito
                obj.classList.add("like-btn-added");
            }else if(this.responseText == "2"){//like rimosso
                obj.classList.remove("like-btn-added");
            }else{//errore
                alert("Errore");
            }
        }
	};
	//doing th ajax request
	xhttp.open("POST", "giveLike.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var thisId = obj.id;
    var nomeArtista = thisId.substring(0,thisId.indexOf('_'));
    var nomeImmagine = thisId.substring(thisId.indexOf('_')+1);
    xhttp.send("art="+nomeArtista+"&nomeImg="+nomeImmagine);
}