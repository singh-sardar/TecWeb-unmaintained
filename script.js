function closeLoginModal() {
	document.getElementById('LoginModal').style.display='none'
}
function openLoginModal() {
	document.getElementById('LoginModal').style.display='block'
}

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
