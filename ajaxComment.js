function doComment(Opera, Creatore)
{
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	 var res = this.response;
         if(res.startsWith("<script>"))
         	document.getElementById("imageAndCommentSection").innerHTML += res;
         else
    	 	document.getElementById("commentSection").innerHTML += res;
    }
    }
    var text = document.getElementById("texxt");
    xhttp.open("POST","AddComment.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("Opera="+Opera+"&Creatore="+Creatore+"&Commento="+text.value);
}