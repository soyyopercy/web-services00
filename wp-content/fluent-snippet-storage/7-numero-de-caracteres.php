<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: numero-de-caracteres
* @type: js
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-06-18 05:16:16
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_footer
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>


$(document).ready(function () {
  $('input#wpforms-16-field_1')
    .keypress(function (event) {
      if (event.which < 48 || event.which > 57 || this.value.length === 3) {
        return false;

      }
    });
});
$(document).ready(function () {
  $('input#wpforms-16-field_1')
    .keypress(function (event) {
      if (this.value.length === 3) {
         
       // $('button#json_get').trigger('click');
            

      
  const dni = $('input#wpforms-16-field_1').val();
        // PresTab(e);  
     getDni(dni); 
          
      }
    });
});
 


  
 function getDni(dni){
      loading.style.display = 'block';
      axios.get(`https://jsonplaceholder.typicode.com/todos/${dni}`, {
        responseType: 'json'
      })
        .then(function(res) {
          if(res.status==200) {
            console.log(res.data);
           
              if( res.data.userId === 10 ){
                   mensaje.innerHTML = res.data.userId+res.data.title;
                                $(document).ready(function () {
   if ($('button').hasClass('wpforms-submit')) {
        $('button').removeClass('c_5');
    
   } else {}
});
              }  else {
                  $(document).ready(function () {
   if ($('button').hasClass('wpforms-submit')) {
      $('button').addClass('c_5')
   } else {}
});
                  alert("El dni ingresado no existe");
              }
              
          }
          console.log(res);
        })
        .catch(function(err) {
          console.log(err);
        })
        .then(function() {
          loading.style.display = 'none';
        });

     }
      

document.onkeyup = PresTab;

       function PresTab(e)
       {
           var keycode = (window.event) ? event.keyCode : e.keyCode;
           if (keycode == 9)
           alert('tab key pressed');
       }



