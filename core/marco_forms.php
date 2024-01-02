<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2012-2022
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
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
	 
	            --- TRADUCCION NO OFICIAL DE LA LICENCIA ---

     Esta es una traducción no oficial de la Licencia Pública General de
     GNU al español. No ha sido publicada por la Free Software Foundation
     y no establece los términos jurídicos de distribución del software 
     publicado bajo la GPL 3 de GNU, solo la GPL de GNU original en inglés
     lo hace. De todos modos, esperamos que esta traducción ayude a los
     hispanohablantes a comprender mejor la GPL de GNU:
	 
     Este programa es software libre: puede redistribuirlo y/o modificarlo
     bajo los términos de la Licencia General Pública de GNU publicada por
     la Free Software Foundation, ya sea la versión 3 de la Licencia, o 
     (a su elección) cualquier versión posterior.

     Este programa se distribuye con la esperanza de que sea útil pero SIN
     NINGUNA GARANTÍA; incluso sin la garantía implícita de MERCANTIBILIDAD
     o CALIFICADA PARA UN PROPÓSITO EN PARTICULAR. Vea la Licencia General
     Pública de GNU para más detalles.

     Usted ha debido de recibir una copia de la Licencia General Pública de
     GNU junto con este programa. Si no, vea <http://www.gnu.org/licenses/>
*/

	/*
		Title: Seccion con formularios comunes
		Ubicacion *[/core/marco_forms.php]*.  Presenta formularios de cabecera usados generalmente para transportar informacion

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/
?>

<form method="POST" name="PCO_FormVerMenu"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_VerMenu">
    <input type="Hidden" name="Presentar_FullScreen" value="<?php echo $Presentar_FullScreen; ?>">
    <input type="Hidden" name="Precarga_EstilosBS" value="<?php echo $Precarga_EstilosBS; ?>">
</form>
<form method="POST" name="cerrar_sesion"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="Terminar_sesion">
</form>
<form method="POST" name="PCOForm_CerrarSesionSAML"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="Terminar_sesion">
    <input type="Hidden" name="PCO_FinalizarSAML" value="1">
</form>
<form method="POST" name="PCO_CargarActualizarPefil"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
    <input type="Hidden" name="PCO_Objeto" value="frm:-22:1:login:<?php echo $PCOSESS_LoginUsuario; ?>">
</form>
<form method="POST" name="reseteo_clave"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="PCO_CambiarContrasena">
</form>
<form method="POST" name="PCO_MisInformes"  class="oculto_impresion"  style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="PCO_MisInformes">
</form>
<form method="POST" id="PCO_ReportarBugs"  class="oculto_impresion" name="PCO_ReportarBugs" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <div id="PCO_ReportarBugsCapturaOculta" class="oculto_impresion" style="visibility: hidden; display:none;">
    </div>
    <input type="Hidden" name="PCO_Accion" value="PCO_ReportarBugs">
    <input type="Hidden" name="PCO_CapturaPantalla" id="PCO_CapturaPantalla" value="">
    <input type="Hidden" name="PCO_CapturaTrazas" id="PCO_CapturaTrazas" value="">
</form>

<form name="FRMBASEINFORME" id="FRMBASEINFORME"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" target="_self" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="">
    <input type="Hidden" name="tabla" value="">  <!-- Compatibilidad hacia atras -->
    <input type="Hidden" name="campo" value="">  <!-- Compatibilidad hacia atras -->
    <input type="Hidden" name="valor" value="">  <!-- Compatibilidad hacia atras -->
    <input type="Hidden" name="objeto" value=""> <!-- Compatibilidad hacia atras -->
    <input type="Hidden" name="PCO_Tabla" value="">
    <input type="Hidden" name="PCO_Campo" value="">
    <input type="Hidden" name="PCO_Valor" value="">
    <input type="Hidden" name="PCO_Objeto" value="">
    <input type="Hidden" name="Presentar_FullScreen" value="<?php echo $Presentar_FullScreen; ?>">
    <input type="Hidden" name="Precarga_EstilosBS" value="<?php echo $Precarga_EstilosBS; ?>">
</form>

<form name="PCO_ExplorarTablerosKanban"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_ExplorarTablerosKanbanResumido">
</form>
<form name="PCO_BugTrackingForm"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
	<input type="Hidden" name="PCO_Objeto" value="frm:-4:1">
</form>

<?php
//Formularios exclusivos para administradores
if (PCO_EsAdministrador(@$PCOSESS_LoginUsuario))
	{
?>
		<form name="actualizarad" class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST">
			<input type="Hidden" name="PCO_Accion" value="actualizar_practico">
		</form>
        <form method="POST" name="PCO_EditarConfiguracionOAuth"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
        	<input type="Hidden" name="PCO_Objeto" value="frm:-5:1">
        </form>
        <form name="PCO_AdministrarTablas"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarTablas">
        </form>
        <form name="PCO_AdministrarFormularios"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarFormularios">
        </form>
        <form name="PCOFUNC_AdministrarMenu"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCOFUNC_AdministrarMenu">
        	<input type="Hidden" name="PCO_FormularioActivoEdicionMenu" value="">
        </form>
        <form name="PCO_AdministrarInformes"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_AdministrarInformes">
        </form>
        <form name="PCO_ListarUsuarios"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto"> <!-- PCO_ListarUsuarios-->
        	<input type="Hidden" name="PCO_Objeto" value="frm:-8:1">
            <input type="Hidden" name="FiltroLoginUsuario" value="_|_">
            <input type="Hidden" name="FiltroNombreUsuario" value="_|_">
        </form>
        <form name="PCO_VerTareasCron"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
        	<input type="Hidden" name="PCO_Objeto" value="frm:-16:1">
        </form>
        <form name="PCO_VerReplicaciones"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
        	<input type="Hidden" name="PCO_Objeto" value="frm:-10:1">
        </form>
        <form name="PCO_VerMonitoreo"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
        	<input type="Hidden" name="PCO_Objeto" value="frm:-11:1">
        </form>
        <form name="PCO_AcortadorDirecciones"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_CargarObjeto">
        	<input type="Hidden" name="PCO_Objeto" value="frm:-19:1">
        </form>
<?php
	}
?>