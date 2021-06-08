<?php
/*
	 _
	|_) _ _  _ _|_. _ _					  	Copyright (C) 2020
	|  | (_|(_  | |(_(_) 				  	John F. Arroyave Gutiérrez
	  www.practico.org					  	unix4you2@gmail.com
                                            All rights reserved.
    
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:
    
    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
    FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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
        <form method="POST" name="fileman_admin_embebido"  class="oculto_impresion" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
            <input type="Hidden" name="PCO_Accion" value="fileman_admin_embebido">
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
        <form name="PCO_PanelAuditoriaMovimientos"  class="oculto_impresion" action="<?php echo $ArchivoCORE; ?>" method="POST" style="display:inline; height: 0px; border-width: 0px; width: 0px; padding: 0; margin: 0;">
        	<input type="Hidden" name="PCO_Accion" value="PCO_PanelAuditoriaMovimientos">
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