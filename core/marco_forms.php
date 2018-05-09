<?php
	/*
	Copyright (C) 2013  John F. Arroyave Gutiérrez
						unix4you2@gmail.com

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
	*/

	/*
		Title: Seccion con formularios comunes
		Ubicacion *[/core/marco_forms.php]*.  Presenta formularios de cabecera usados generalmente para transportar informacion

	Ver tambien:
		<Seccion superior> | <Articulador>
	*/
?>



<form method="POST" name="core_ver_menu" action="<?php echo $ArchivoCORE; ?>" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="Ver_menu">
    <input type="Hidden" name="Presentar_FullScreen" value="<?php echo $Presentar_FullScreen; ?>">
    <input type="Hidden" name="Precarga_EstilosBS" value="<?php echo $Precarga_EstilosBS; ?>">
</form>
<form method="POST" name="cerrar_sesion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="Terminar_sesion">
</form>
<form method="POST" name="PCO_EditarConfiguracionOAuth" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="PCO_EditarConfiguracionOAuth">
</form>
<form method="POST" name="actualizar_perfil" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="actualizar_perfil_usuario">
</form>
<form method="POST" name="reseteo_clave" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="cambiar_clave">
</form>
<form method="POST" name="mis_informes" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="mis_informes">
</form>
<form method="POST" name="fileman_admin_embebido" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <input type="Hidden" name="PCO_Accion" value="fileman_admin_embebido">
</form>
<form method="POST" id="PCO_ReportarBugs" name="PCO_ReportarBugs" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
    <div id="PCO_ReportarBugsCapturaOculta" class="oculto_impresion" style="visibility: hidden; display:none;">
    </div>
    <input type="Hidden" name="PCO_Accion" value="PCO_ReportarBugs">
    <input type="Hidden" name="PCO_CapturaPantalla" id="PCO_CapturaPantalla" value="">
    <input type="Hidden" name="PCO_CapturaTrazas" id="PCO_CapturaTrazas" value="">
</form>

<form name="FRMBASEINFORME" id="FRMBASEINFORME" action="<?php echo $ArchivoCORE; ?>" method="POST" target="_self">
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


<form name="administrar_tablas" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="administrar_tablas">
</form>
<form name="administrar_formularios" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="administrar_formularios">
</form>
<form name="administrar_menu" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="administrar_menu">
</form>
<form name="administrar_informes" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="administrar_informes">
</form>
<form name="listar_usuarios" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="listar_usuarios">
</form>
<form name="PCO_PanelAuditoriaMovimientos" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_PanelAuditoriaMovimientos">
</form>
<form name="PCO_ExplorarTablerosKanban" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="PCO_ExplorarTablerosKanban">
</form>
<form name="PCO_BugTrackingForm" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="cargar_objeto">
	<input type="Hidden" name="objeto" value="frm:-4:1">
</form>
<form name="PCO_VerReplicaciones" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="cargar_objeto">
	<input type="Hidden" name="objeto" value="frm:-10:1">
</form>
<form name="PCO_VerMonitoreo" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
	<input type="Hidden" name="PCO_Accion" value="cargar_objeto">
	<input type="Hidden" name="objeto" value="frm:-11:1">
</form>