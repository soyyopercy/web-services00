<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: axio prueba 2
* @type: js
* @status: draft
* @created_by: 
* @created_at: 
* @updated_at: 2024-06-17 23:13:13
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_footer
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
var boton = document.getElementById('json_get');
boton.addEventListener('click', function() {
  loading.style.display = 'block';
  axios.get('https://jsonplaceholder.typicode.com/todos/1', {
    responseType: 'json'
  })
    .then(function(res) {
      if(res.status==200) {
        console.log(res.data);
        mensaje.innerHTML = res.data.title;
      }
      console.log(res);
    })
    .catch(function(err) {
      console.log(err);
    })
    .then(function() {
      loading.style.display = 'none';
    });
});