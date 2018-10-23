function filterImages(){
    
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
            result = JSON.parse(this.responseText);
            if(result.length > 0){
                emptyGallery();
                fillGallery(result);
            }
        }
	};
	//doing th ajax request
	xhttp.open("POST", "findImages.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    var cat = document.getElementById("dropCat").value;
    var art = document.getElementById("dropArt").value;
	xhttp.send("cat="+cat+"&art="+art);
}

function submitArtFilterForm(){
    document.getElementsByName("formArtFilter")[0].submit();
}

function emptyGallery(){
    var myNode = document.getElementById("galleryBoard");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
    }
}

function fillGallery(arr){
    var li = document.createElement('li');
    for(i=0; i < arr.length;i++){
        li.innerHTML = 
        '<figure>\
        <img src="http://127.0.0.1/TecWeb/Images/Art/" alt="">\
        <figcaption>\
        Enterdum et malesuada fames ac ante ipsum primis in faucibus.\
        <button class="btnGreen" type="button">Click Me!</button>\
        </figcaption>\
        </figure>';
    }
}

function galCatOnClick(){
    document.getElementsByName('gallerySearch')[0].value = "";
}