<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: prueba4
* @type: js
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2024-06-14 23:58:38
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_footer
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
var ulTag = document.getElementById('idUlTag')

axios.get('http://172.16.20.11:2080/dev/api/registroweb/asistencia?dni=71261366').then(function(response) {
	const data = response.data
	if(data) {    
		data.forEach(function(item) {
				ulTag.innerHTML += `<li>
										<b>Name:</b> ${data} <br>
									                                                                   		 })                                                          
	}
})