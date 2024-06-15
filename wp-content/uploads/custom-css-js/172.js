<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
var reloj = document.getElementById('reloj');



var mostrarReloj = function(){
  
  var miReloj = new Date();
var hora = miReloj.getHours();
var minuto = miReloj.getMinutes();
var segundo = miReloj.getSeconds();
  if(hora < 10){
    hora = "0" + hora;
  }
  if(minuto < 10){
    minuto = "0" + minuto;
  }
  if(segundo < 10){
    segundo = "0" + segundo;
  }
  
  reloj.textContent = hora + ":" + minuto + ":" + segundo;
}

setInterval(mostrarReloj, 1000);</script>
<!-- end Simple Custom CSS and JS -->
