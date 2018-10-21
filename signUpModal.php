


<!-- The Modal -->
<div id="SignUpModal" class="Modal">
	<!-- Modal Content -->
	<form class="modal-content animate" method="post" action="" onsubmit="return doSignUp(event)">
		<div class="modalHead">
			<span onclick="closeSignUpModal()" class="close" title="Close Modal">&times;</span>
			<h1>SIGN UP FORM</h1>
		</div>
		<div class="container">
			<label for="usrSighUp">Username</label>
			<input id="usrSighUp" type="text" placeholder="Enter Username" name="usrSighUp" required/>

			<label for="pwdSignUp">Password</label>
			<input id="pwdSignUp" type="password" placeholder="Enter Password" name="pwdSignUp" required/>
			
			<label for="name">Name</label>
			<input id="name" type="text" placeholder="Enter Name" name="name" required/>
			
			<label for="surname">Surname</label>
			<input id="surname" type="text" placeholder="Enter Surname" name="surname" required/>

		</div>
		<div class="container" id="SignUpMessage">
			<!--container for invalid login message-->
			
		</div>
		
		<div class="container modalFotter" >
			<button type="submit">Register</button>
			<button type="button" onclick="closeSignUpModal()" class="cancelbtn">Cancel</button>
		</div>

	</form>
</div>
	