var categoryActual = categoryInicial; //ira variando...

$(document).ready(function() {
	$.get( "php/Backend.php?action=init&arg0="+playerID, function( data ) {
	  if(data == "OK") {
		cargarFront(categoryActual);
	  }
	});

	$.getJSON( "php/Backend.php?action=getCategoryList&arg0="+categoryActual, function( categories ) {
	  if(categories) {
		$("#select-category").append(listarCategorias(categories));
	  }
	}); 
	
	$("#select-category").change(function() {
		cargarFront($(this).val());
	});
	
	$(document.body).on("click", ".video", function() {
		cargarReproductor($(this).attr("id"));
	});
});

function cargarFront(categoryActual) {
	// Obtener la lista de la categoria actual.
	$.getJSON( "php/Backend.php?action=getList&arg0="+categoryActual, function( entryIds ) {
	  if(entryIds) {
		listarVideos(entryIds);
	  }
	}); 
}

function listarVideos(entryIds) {
	$("#videos").html("");
	for(index in entryIds) {
		$.ajax( {url: "php/Backend.php?action=printThumb&arg0="+entryIds[index], indexValue: index, success: function( url ) {
		  if(url) {
			$("#videos").append(imprimirThumb(entryIds[this.indexValue], url));
			if(this.indexValue == 0) {
				cargarReproductor(entryIds[this.indexValue]);
			}
		  }
		}}); 
	}
}

function imprimirThumb(id, url) {
	return '<img id="'+id+'" src="'+url+'" class="video"/>';
}


function cargarReproductor(entryId) {
	$.get( "php/Backend.php?action=printVideo&arg0="+entryId, function(iframe) {
		if(iframe) {
			$("#video-player").html(iframe);
		}
	}); 
}

function listarCategorias(categories) {
	var options = "";
	for(index in categories) {
		if(index != 0)
			options += "<option value='"+ categoryInicial + ">" + categories[index] +"'>" + categories[index] +"</option>";
		else
			options += "<option value='"+ categoryInicial + "'>" + categories[index] +"</option>";
	}
	return options;
}