


<!-- The Modal -->
<div id="LoginModal" class="loginModal">
	<!-- Modal Content -->
	<form class="loginModal-content animate" method="post" action="" onsubmit="return doLogin(event)">
		<div class="loginHead">
			<span onclick="closeLoginModal()" class="close" title="Close Modal">&times;</span>
			<h1>LOGIN FORM</h1>
		</div>
		<div class="container">
			<label for="uname"><b>Username</b></label>
			<input id="usr" type="text" placeholder="Enter Username" name="uname" required>

			<label for="psw"><b>Password</b></label>
			<input id="pwd" type="password" placeholder="Enter Password" name="psw" required>

		</div>
		<div class="container" id="InvalidLogin">
			<!--container for invalid login message-->
			
		</div>
		
		<div class="container loginFotter" >
			<button type="submit">Login</button>
			<button type="button" onclick="closeLoginModal()" class="cancelbtn">Cancel</button>
		</div>

	</form>
</div>
	