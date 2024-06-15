<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: Web-services-prueba
* @type: js
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2024-06-14 20:21:33
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_footer
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
$(document).on("ready", main);
	function main() {
		$("#buscar").on("click", function(){
var texto = "";
var tag = $("#b").val();
$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags=" + tag +"&tagmode=any&format=json&jsoncallback=?", function(datos) {
	$.each(datos.items, function(i, item) {
		texto += "<div class='cuadro'>";
		texto += "<<img src='" + item.media.m +"'/>";
		texto += "</div>";
	});
$("#imagenes").html(texto);

});
});
}