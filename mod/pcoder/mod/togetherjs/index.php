<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
</head>
<body>


<script>
  // TogetherJS configuration would go here, but we'll talk about that
  // later
  TogetherJSConfig_siteName="PRACTICO FRAMEWORK";
  TogetherJSConfig_toolName="Practico-Meetings";
  //TogetherJSConfig_hubBase=""; //Servidor de conferencia
  TogetherJSConfig_dontShowClicks = false; //Deshabilitar la vista de clics de participantes
  //TogetherJSConfig_findRoom = "Cuarto_de_Desarrolladores";  //Crea un cuarto especifico y loguea en el a todos los participantes
  //TogetherJSConfig_findRoom = {prefix: "Cuarto_de_Desarrolladores", max: 5} //Crea un cuarto y ademas asigna un maximo de participantes
  TogetherJSConfig_autoStart = true; //Reinicia la sesion de un usuario
  TogetherJSConfig_suppressJoinConfirmation=true; //Evita la confirmacion de ingreso a un cuarto para los invitados
  TogetherJSConfig_suppressInvite=true;
  TogetherJSConfig_inviteFromRoom=false;
  TogetherJSConfig_includeHashInUrl=false; //Util en aplicaciones de una sola pagina para indicar que una misma URL no quiere decir que cada persona ve lo mismo
  TogetherJSConfig_disableWebRTC=false; //Deshabilita boton de llamada de audio
  TogetherJSConfig_ignoreForms=false; //Define si ignora los formularios
  
  TogetherJSConfig_getUserName = function () {return 'User JJ';};   //Funcion que establece el nombre de usuario, debe retornar null en caso que no lo pueda establecer
  //TogetherJSConfig_getUserAvatar = function () {return avatarUrl;}; //Establece la URL utilizada para el avatar del usuario
  //TogetherJSConfig_getUserColor = function () {return '#ff00ff';}; Retorna el color que diferencia al usuario
</script>
<script src="https://togetherjs.com/togetherjs-min.js"></script>


<button id="Iniciar" onclick="TogetherJS(this); return false;">IniciarPracticoMeetings</button>

<script>
$(function () {
    //Autoinicia el cuarto y oculta el boton
  $("#Iniciar").click(TogetherJS);
  //$("#Iniciar").hide(); //Jquery
});



/*
http://www.williammalone.com/articles/create-html5-canvas-javascript-drawing-app/
https://developer.mozilla.org/en-US/docs/Web/Demos_of_open_web_technologies
http://bomomo.com/
https://www.webfx.com/blog/web-design/examples-html5-canvas/


*/



</script>

</body>
</html>