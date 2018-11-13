<!-- The Modal -->
<div id="SearchModal" class="Modal">
	<!-- Modal Content -->
	<form class="modal-content animate container1024" method="get" action="gallery.php">
        <div class="modalHead">
			<span onclick="closeSearchModal()" class="close" title="Close Modal">&times;</span>
			<h1>Search images</h1>
		</div>
		<div class="container">
            <div class="inputSearch">
                <input type="text" placeholder="Cerca per categoria, artista o descrizione .." name="gallerySearch"/>
                <button class="btnSearch" type="submit"><span class="searchIcon"></span></button>
            </div>
		</div>
	</form>
</div>
