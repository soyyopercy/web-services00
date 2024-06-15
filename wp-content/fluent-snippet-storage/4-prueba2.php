<?php
// <Internal Doc Start>
/*
*
* @description: 
* @tags: 
* @group: 
* @name: prueba2
* @type: js
* @status: published
* @created_by: 
* @created_at: 
* @updated_at: 2024-06-14 23:29:16
* @is_valid: 
* @updated_by: 
* @priority: 10
* @run_at: wp_footer
* @load_as_file: 
* @condition: {"status":"no","run_if":"assertive","items":[[]]}
*/
?>
<?php if (!defined("ABSPATH")) { return;} // <Internal Doc End> ?>
const form = document.querySelector("form")
const input = document.querySelector("input")


const submitUser = () => {
  axios.post('https://us-central1-selexin-website.cloudfunctions.net/app/sendemail', {
    firstName: input.value,
  })
  .then(response => {
    console.log(response);
  })
  .catch(error => {
    console.log(error);
  });
}

form.addEventListener("submit", (e) => {
  submitUser()
  e.preventDefault()
})