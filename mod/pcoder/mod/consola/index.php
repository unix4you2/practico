<?php
	/*
	   PCODER (Editor de Codigo en la Nube)
	   Copyright (C) 2013  John F. Arroyave Gutiérrez
						   unix4you2@gmail.com
						   www.practico.org

	 This program is free software: you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation, either version 3 of the License, or
	 (at your option) any later version.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program.  If not, see <http://www.gnu.org/licenses/>
	*/

    // BLOQUE BASICO DE INCLUSION ######################################
    // Inicio de la sesion
    //ini_set("session.cookie_lifetime","360");
    //ini_set("session.gc_maxlifetime","360");
    @session_start();

	// Agrega las variables de sesion
	if (!empty($_SESSION)) extract($_SESSION);

    //Permite WebServices propios mediante el acceso a este script en solicitudes Cross-Domain
    header('Access-Control-Allow-Origin: *');
    header('access-control-allow-credentials: true');
	header('Content-type: text/html; charset=utf-8');

    //Incluye archivo inicial de configuracion
	include_once("../../inc/configuracion.php");

    //Incluye idioma espanol, o sobreescribe vbles por configuracion de usuario
    include("../../idiomas/es.php");
    include("../../idiomas/".$IdiomaPredeterminado.".php");
    // FIN BLOQUE BASICO DE INCLUSION ##################################

    // Establece la zona horaria por defecto para la aplicacion
    date_default_timezone_set($ZonaHoraria);

    // Datos de fecha, hora y direccion IP para algunas operaciones
    $PCO_PCODER_FechaOperacion=date("Ymd");
    $PCO_PCODER_FechaOperacionGuiones=date("Y-m-d");
    $PCO_PCODER_HoraOperacion=date("His");
    $PCO_PCODER_HoraOperacionPuntos=date("H:i");
    $PCO_PCODER_DireccionAuditoria=$_SERVER ['REMOTE_ADDR'];

/* ################################################################## */
/* ################################################################## */


    //////////////////////////////////////////////////////////////////
    // Globals
    //////////////////////////////////////////////////////////////////
    
    define('ROOT','/var/www');
    define('BLOCKED','ssh,telnet');
    
    //////////////////////////////////////////////////////////////////
    // Terminal Class
    //////////////////////////////////////////////////////////////////
    
    class Terminal{
        
        ////////////////////////////////////////////////////
        // Properties
        ////////////////////////////////////////////////////
        
        public $command          = '';
        public $output           = '';
        public $directory        = '';
        
        // Holder for commands fired by system
        public $command_exec     = '';
        
        ////////////////////////////////////////////////////
        // Constructor
        ////////////////////////////////////////////////////
        
        public function __construct(){
            if(!isset($_SESSION['dir'])){
                if(ROOT==''){
                    $this->command_exec = 'pwd';
                    $this->Execute();
                    $_SESSION['dir'] = $this->output;
                }else{
                    $this->directory = ROOT;
                    $this->ChangeDirectory();
                }
            }else{
                $this->directory = $_SESSION['dir'];
                $this->ChangeDirectory();
            }
        }
        
        ////////////////////////////////////////////////////
        // Primary call
        ////////////////////////////////////////////////////
        
        public function Process(){
            $this->ParseCommand();
            $this->Execute();
            return $this->output;
        }
        
        ////////////////////////////////////////////////////
        // Parse command for special functions, blocks
        ////////////////////////////////////////////////////
        
        public function ParseCommand(){
            
            // Explode command
            $command_parts = explode(" ",$this->command);
            
			// Handle 'clear' command
            if(in_array('clear',$command_parts)){
                $_POST['textarea_salida']="";
            }            
            
            // Handle 'cd' command
            if(in_array('cd',$command_parts)){
                $cd_key = array_search('cd', $command_parts);
                $cd_key++;
                $this->directory = $command_parts[$cd_key];
                $this->ChangeDirectory();
                // Remove from command
                $this->command = str_replace('cd '.$this->directory,'',$this->command);
            }
            
            // Replace text editors with cat
            $editors = array('vi','vim','nano');
            $this->command = str_replace($editors,'cat',$this->command);
            
            // Handle blocked commands
            $blocked = explode(',',BLOCKED);
            if(in_array($command_parts[0],$blocked)){
                $this->command = 'echo ERROR: Comando no permitido / Command not allowed';
            }
            
            // Update exec command
            $this->command_exec = $this->command . ' 2>&1';
        }
        
        ////////////////////////////////////////////////////
        // Chnage Directory
        ////////////////////////////////////////////////////
        
        public function ChangeDirectory(){
            chdir($this->directory);
            // Store new directory
            $_SESSION['dir'] = exec('pwd');
        }
        
        ////////////////////////////////////////////////////
        // Execute commands
        ////////////////////////////////////////////////////
        
        public function Execute(){
            //system
            if(function_exists('system')){
                ob_start();
                system($this->command_exec);
                $this->output = ob_get_contents();
                ob_end_clean();
            }
            //passthru
            else if(function_exists('passthru')){
                ob_start();
                passthru($this->command_exec);
                $this->output = ob_get_contents();
                ob_end_clean();
            }
            //exec
            else if(function_exists('exec')){
                exec($this->command_exec , $this->output);
                $this->output = implode("\n" , $output);
            }
            //shell_exec
            else if(function_exists('shell_exec')){
                $this->output = shell_exec($this->command_exec);
            }
            // no support
            else{
                $this->output = 'El sistema no permite comandos desde PHP / Command execution from PHP not possible on this system';
            }
        }        
        
    }
    
    //////////////////////////////////////////////////////////////////
    // Processing
    //////////////////////////////////////////////////////////////////

	
	$Terminal = new Terminal();
	//Busca otros datos para linea de comandos
	$Terminal->command = "whoami";
	$login_usuario = $Terminal->Process();

    $command = '';
    if(!empty($_POST['command'])){ $command = $_POST['command']; }

	//Valida la llave de sesion generada por {P}Coder
	if ($_SESSION['PCONSOLE_KEY']!="")
		{
			//////////////////////////////////////////////////////////////
			// Execution
			//////////////////////////////////////////////////////////////
			
			// Split &&
			$output = '';
			$command = explode("&&", $command);
			
			foreach($command as $c){
				$Terminal->command = $c;
				$output .= $Terminal->Process();
			}
		}
	else
		{
			$Terminal->command = "echo [ERROR] Usuario no autenticado / Unauthenticated user";
			$output .= $Terminal->Process();
		}



/* ################################################################## */
/* ################################################################## */
/*
	Function: PCONSOLE_Cargar
	Abre la consola y la carga con cualquier posible resultado de comando ejecutado
*/
?>
 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title>{C}</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="generator" content="PConsole" />
 	<meta name="description" content="Consola del lado del servidor" />
    <meta name="author" content="John Arroyave G. - {www.practico.org} - {unix4you2 at gmail.com}">

    <!-- Custom Fonts -->
    <link href="../../../../inc/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
	<script type="text/javascript" src="../../../../inc/jquery/jquery-2.1.0.min.js"></script>
	
	<style>
		body
			{
				overflow:hidden;
				overflow-x:hidden;	/*Horizontal*/
				overflow-y:hidden;	/*Vertical*/
				font-size:12px;
				font-family: monospace;
				font-weight: bold;
				background: #153649;
				color: #ffffff;
				margin: 0px;
			}

		#terminal_output
			{
				overflow-x:hidden;
				overflow-y:hidden;
				padding-top: 2px;
				padding-left: 10px;
				padding-right: 10px;
			}

		#textarea_salida
			{
				padding: 0px;
				background: #153649;
				overflow: auto;
				width:100%;
				border: 0px;
				color: #C6FFB8;
				font-size:12px;
				font-family: monospace;
				font-weight: bold;
			}

		/*Estilos para cursor y linea de comandos*/
			#command_line
				{
					overflow: hidden;
				}
			#command_line span	/*Caja de texto con el comando*/
				{
					margin-right:2px;
					float: left; 
					white-space: pre;
				}
			#cursor
				{
					float: left;
					width: 7px;
					height: 14px;
					background: #FFFFFF;
				}
			input
				{
					width: 0;
					height: 0;
					opacity: 0; 
				}

		/*Personalizacion de barras de desplazamiento*/
			/*Barra de desplazamiento como tal*/
			::-webkit-scrollbar {
				width: 10px;
				height: 10px;
			}
			/*Botones de los extremos de la barra*/
			::-webkit-scrollbar-button:start:decrement,
			::-webkit-scrollbar-button:end:increment  {
				display: none;
			}

			/*Barra sobre la que se mueve el boton flotante*/
			::-webkit-scrollbar-track  {
			}

			/*Espacio libre de la barra de desplazamiento*/
			::-webkit-scrollbar-track-piece  {
				background-color: #3b3b3b;
				-webkit-border-radius: 6px;
			}
			
			/*Boton flotante de la barra de desplazamiento*/
			::-webkit-scrollbar-thumb:vertical {
				-webkit-border-radius: 6px;
				background: #666 no-repeat center;
			}
			::-webkit-scrollbar-thumb:horizontal {
				-webkit-border-radius: 6px;
				background: #666 no-repeat center;
			}

			/*Esquina donde se encuentran las barras*/
			::-webkit-scrollbar-corner {
				display: none;
			}

			/*Esquina donde se encuentran las barras - cuando es redimensionable*/
			::-webkit-resizer {
				display: none;
			}
	</style>


</head>
<body>

	<!-- ################# INICIO DE LA MAQUETACION ################ -->

		<form action="" method="POST">
			<div id="terminal_output">
				<textarea id="textarea_salida" name="textarea_salida" wrap="off" readonly><?php
					//Si encuentra salidas de comandos previos las agrega
					if (isset($_POST['textarea_salida']))
						echo $_POST['textarea_salida'];
					//Agrega siempre la linea de promtp y el comando para simular la terminal real
					if (isset($_POST['command']))
						echo "\n[".trim($login_usuario)."@".gethostname()."]$ ".$_POST['command']."\n";
					//Presenta la salida de los comandos
					echo(htmlentities($output));
				?></textarea>
			</div>
						
			<div id="command_line">
				
				<table border=0 width="100%" cellpadding="3" bgcolor="0f2836"><tr>
					<td nowrap valign="top" style="color:#6c98c6;">[<font color="#74c237"><?php echo trim($login_usuario); ?></font>@<?php echo gethostname(); ?>]$</td>
					<td width="100%"  valign="top">

							<span></span>
							<div id="cursor"></div>
							<input type="text" id="command" name="command" style="position:inline; width:0px; height:0px;" autocomplete="off">			

					</td>
				</tr></table>

			</div>
		</form>

	<!-- ################## FIN DE LA MAQUETACION ################## -->


	<script language="javascript">
		function PCONSOLE_RecalcularMaquetacion()   //RedimensionarEditor();
			{
				//Obtiene las dimensiones actuales de la ventana de edicion y algunos objetos
				var AltoVentana = $(window).height();

				//Obtiene el alto de los diferentes marcos que componen el aplicativo
				var alto_command_line = $("#command_line").height();

				//Modifica el ALTO DEL PANEL CENTRAL MEDIO
				var TamanoConsola = AltoVentana - ( alto_command_line );
				$('#terminal_output').height( TamanoConsola+"px" ).css({ });
				$('#textarea_salida').height( TamanoConsola+"px" ).css({ });
			}
			
		//Ajusta tamano de la consola en cada cambio de tamano de la ventana
		$( window ).resize(function() {
			PCONSOLE_RecalcularMaquetacion();
		});

		//Inicializacion
		PCONSOLE_RecalcularMaquetacion();
		
		//Inicia el parpadeo del cursor
		$(function() {
			var cursor;

			$('#command_line').click(function() {
			   $('#command').focus();
			  
			  cursor = window.setInterval(function() {
			  if ($('#cursor').css('visibility') === 'visible') {
				$('#cursor').css({ visibility: 'hidden' });
			  } else {
				$('#cursor').css({ visibility: 'visible' });  
			  }  
			  }, 500);
			  
			});

			$('input').keyup(function() {
			  $('#command_line span').text($(this).val());
			  
			});
			  
			  $('input').blur(function() {
				 clearInterval(cursor);
				 $('#cursor').css({ visibility: 'visible' });    
			  });
			});
		
		//Cuando encuentra que hay un comando entonces retorna el foco a la linea de comandos
		<?php
			if (isset($_POST['command']))
				echo "$('#command').trigger('click'); $('#command').focus(); ";
		?>
		
		//Si se hace clic sobre la consola de salida igual se pasa el foco a la linea de comandos
		$('#textarea_salida').click(function() {
		   $('#command').trigger('click');
		});
				
		//Desplaza automaticamente el textarea de salida hasta el final
		var textarea_scroll = document.getElementById('textarea_salida');
		textarea_scroll.scrollTop = textarea_scroll.scrollHeight;
	</script>

</body>
</html>
