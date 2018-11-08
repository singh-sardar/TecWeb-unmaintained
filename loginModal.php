<!-- The Modal -->
<div id="LoginModal" class="Modal">
	<!-- Modal Content -->
	<form class="modal-content animate" method="post" action="#" onsubmit="return doLogin(event)">
		<div class="modalHead">
			<span onclick="closeLoginModal()" class="close" title="Close Modal">&times;</span>
			<h1>LOGIN FORM</h1>
		</div>
		<div class="container">
			<label for="usr">Username</label>
			<input id="usr" type="text" placeholder="Enter Username" name="usr" maxlength="20"/>

			<label for="pwd">Password</label>
			<input  id="pwd" type="password" placeholder="Enter Password" name="pwd" maxlength="30"/>

		</div>
		<div class="container" id="InvalidLogin">
			<!--container for invalid login message-->

		</div>

		<div class="container modalFotter" >
			<button type="submit">Login</button>
			<button type="button" onclick="closeLoginModal()" class="cancelbtn">Cancel</button>
		</div>

	</form>
</div>
