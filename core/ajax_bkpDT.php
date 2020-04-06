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
	Title: Modulo ajax
	Ubicacion *[/core/ajax.php]*.  Archivo de funciones utilizadas para el retorno de informacion mediante peticiones asincronas

	Section: Controles de datos
	Funciones asociadas a generacion de controles de datos basados en los parametros recibidos
*/


/* ################################################################## */
/* ################################################################## */
/*
	Function: recordset_json
	Hace una consulta a la base de datos determinada por un identificador de informe y retorna los registros formateados en JSON.  Util en DataTables con AJAX

	Variables de entrada:

        IDInforme - ID unico del Informe asociado a la consulta
        
        start - Enviado automaticamente por DataTables 
        length - Enviado automaticamente por DataTables 
        search[value] - Enviado automaticamente por DataTables 

    Ver tambien:
        Para efectos de depuracion F12 pestana Network presentara en Headers todo lo enviado por datatables en la solicitud Ajax

	Salida:
		Lista de elementos < option > usados en el combo

*/
if ($PCO_Accion=="recordset_json" ) 
    {           
        $PCO_ConsultaRegistros="SELECT id,empresa,documento,tipo_identificacion,digito_verificacion,nombre,direccion,genero,departamento,municipio,tel_residencia,tel_movil,tel_trabajo,fecha_nacimiento,correo,correo_empresa,ubicacion_fisica,notas,estado,salario,cuenta_numero,cuenta_entidad,cuenta_tipo,cargo,entidad_eps,codigo_eps,entidad_afp,codigo_afp,tipo_vinculacion,fecha_primer_ingreso,fecha_ultimo_retiro,extension,area,sede,id_sede,usuario,jefe_inmediato,estrato,grupo_etnico,condicion_discapacidad,escolaridad,rh,nro_hijos,estado_civil,turno,perfil_cargo,cumple_sgsst,talla_camisa,talla_pantalon,talla_zapatos,es_responsable_sgsst FROM app_empleado 

        ";

        ##Obtiene algunos de los valores recibidos en la solicitud desde el DataTable
        $PCO_IteracionLlamadosDataTable = $_POST['draw'];                                       //Uso interno de DT
        $PCO_FilaInicial = $_POST['start'];                                                     //Registro inicial 
        $PCO_CantidadFilas = $_POST['length'];                                                  //Cantidad deseada de registros usado en LIMIT
        $ColumnaOrdenamientoRecibidaDT = $_POST['order'][0]['column'];                          //Obtiene la columna de indexado / ordenamiento
        $PCO_ColumnaOrdenamiento = $_POST['columns'][$ColumnaOrdenamientoRecibidaDT]['data'];   //Columna usada en el ORDER BY
        $PCO_DireccionOrdenamiento = $_POST['order'][0]['dir'];                                 //Direccion usada en el ordenamiento: asc or desc
        $PCO_ValorFiltro = $_POST['search']['value'];                                           //Valor ingresado en la caja de filtro por el usuario

        $PCOVAR_VariablesFiltroQueryDT="";
        
        
        //OBTENER LOS CAMPOS DEL Informe
        //POR CADA CAMPO AGREGAR LA CONDICION OR LIKE DEL CAMPO Y EL FILTRO (SOLO SI EL FILTRO ES DIFERENTE DE VACIO)




					$EtiquetasConsulta=PCO_GenerarEtiquetasConsulta("",108); //Enviar el informe para que se determinen tambien sus columnas ocultas

					//Genera HTML con las columnas
                    //Busca los campos definidos en el informe como visibles y luego determina si el campo tiene o no titulo arbitrario
        			$ListaCampos_TitutloArbitrario=array();
        			$consulta_titulosarbitrarios=PCO_EjecutarSQL("SELECT id,".$ListaCamposSinID_informe_campos." FROM ".$TablasCore."informe_campos WHERE informe=? AND visible=1 ORDER BY peso,id","$informe");
        			while ($registro_titulosarbitrarios = $consulta_titulosarbitrarios->fetch())
        					$ListaCampos_TitutloArbitrario[]=$registro_titulosarbitrarios["titulo_arbitrario"];
				    $ConteoPosicionColumna=0;   //Utilizado para conocer la columna actual y luego buscar si tiene titulo arbitrario
					foreach($EtiquetasConsulta[0]["ColumnasVisibles"] as $EtiquetaColumna)
					    {
					        $TituloFinalColumna=$EtiquetaColumna;
					        //Si la columna actual tiene un titulo arbitrario definido entonces lo agrega
					        if ($ListaCampos_TitutloArbitrario[$ConteoPosicionColumna]!="")
                                $TituloFinalColumna=PCO_ReemplazarVariablesPHPEnCadena($ListaCampos_TitutloArbitrario[$ConteoPosicionColumna]);
						    $SalidaFinalInforme.= '<th>'.$TituloFinalColumna.'</th>';
						    $ConteoPosicionColumna++;
					    }




        die();
        
        
        
$searchArray = array();
## Recorre todos los campos del datatable y construye adicion al query para filtrar por el valor digitado por el usuario 
$searchQuery = " ";
if($PCO_ValorFiltro != ''){
   $searchQuery = " AND (emp_name LIKE :emp_name or 
        email LIKE :email OR 
        city LIKE :city ) ";
   $searchArray = array( 
        'emp_name'=>"%$PCO_ValorFiltro%", 
        'email'=>"%$PCO_ValorFiltro%",
        'city'=>"%$PCO_ValorFiltro%"
   );
}

        //Obitene el Total de registros en la consulta de base SIN filtros
        $PCO_TotalRegistrosConsulta = PCO_EjecutarSQL("SELECT COUNT(*) AS allcount FROM app_empleado ")->fetchColumn();

        //TODO TODO TODO:  Agregar la condicion de filtrado
        //Obtiene el total de registros en la consulta CON filtros aplicados
        $PCO_TotalRegistrosConsultaCONFiltro = PCO_EjecutarSQL("SELECT COUNT(*) AS allcount FROM app_empleado WHERE 1 $PCOVAR_VariablesFiltroQueryDT                   ".$searchQuery)->fetchColumn();

        //TODO TODO TODO:  Agregar la condicion de filtrado
        $RegistrosRecuperados = PCO_EjecutarSQL("SELECT * FROM app_empleado WHERE 1 $PCOVAR_VariablesFiltroQueryDT                    ORDER BY $PCO_ColumnaOrdenamiento $PCO_DireccionOrdenamiento LIMIT $PCO_FilaInicial,$PCO_CantidadFilas")->fetchAll();

        //Define el arreglo con los datos y lo llena desde cada fila del registro
        $PCO_ArregloDatosRegistros = array();
            foreach($RegistrosRecuperados as $row)
                {
                    //Agrega el registro al arreglo de retorno
                    $PCO_ArregloDatosRegistros[] = array(
                        "id"=>$row['id'],
                        "empresa"=>$row['empresa'],
                        "documento"=>$row['documento'],
                        "tipo_identificacion"=>$row['tipo_identificacion'],
                        "digito_verificacion"=>$row['digito_verificacion'],
                        "nombre"=>$row['nombre'],
                        "direccion"=>$row['direccion'],
                        "genero"=>$row['genero'],
                        "departamento"=>$row['departamento'],
                        "municipio"=>$row['municipio'],
                        "tel_residencia"=>$row['tel_residencia'],
                        "tel_movil"=>$row['tel_movil'],
                        "tel_trabajo"=>$row['tel_trabajo'],
                        "fecha_nacimiento"=>$row['fecha_nacimiento'],
                        "correo"=>$row['correo'],
                        "correo_empresa"=>$row['correo_empresa'],
                        "ubicacion_fisica"=>$row['ubicacion_fisica'],
                        "notas"=>$row['notas'],
                        "estado"=>$row['estado'],
                        "salario"=>$row['salario'],
                        "cuenta_numero"=>$row['cuenta_numero'],
                        "cuenta_entidad"=>$row['cuenta_entidad'],
                        "cuenta_tipo"=>$row['cuenta_tipo'],
                        "cargo"=>$row['cargo'],
                        "entidad_eps"=>$row['entidad_eps'],
                        "codigo_eps"=>$row['codigo_eps'],
                        "entidad_afp"=>$row['entidad_afp'],
                        "codigo_afp"=>$row['codigo_afp'],
                        "tipo_vinculacion"=>$row['tipo_vinculacion'],
                        "fecha_primer_ingreso"=>$row['fecha_primer_ingreso'],
                        "fecha_ultimo_retiro"=>$row['fecha_ultimo_retiro'],
                        "extension"=>$row['extension'],
                        "area"=>$row['area'],
                        "sede"=>$row['sede'],
                        "id_sede"=>$row['id_sede'],
                        "usuario"=>$row['usuario'],
                        "jefe_inmediato"=>$row['jefe_inmediato'],
                        "estrato"=>$row['estrato'],
                        "grupo_etnico"=>$row['grupo_etnico'],
                        "condicion_discapacidad"=>$row['condicion_discapacidad'],
                        "escolaridad"=>$row['escolaridad'],
                        "rh"=>$row['rh'],
                        "nro_hijos"=>$row['nro_hijos'],
                        "estado_civil"=>$row['estado_civil'],
                        "turno"=>$row['turno'],
                        "perfil_cargo"=>$row['perfil_cargo'],
                        "cumple_sgsst"=>$row['cumple_sgsst'],
                        "talla_camisa"=>$row['talla_camisa'],
                        "talla_pantalon"=>$row['talla_pantalon'],
                        "talla_zapatos"=>$row['talla_zapatos'],
                        "es_responsable_sgsst"=>$row['es_responsable_sgsst'],   );
                }

        //Define la respuesta con los datos obtenidos
        $RespuestaFormatoJSON = array(
           "draw" => intval($PCO_IteracionLlamadosDataTable),
           "iTotalRecords" => $PCO_TotalRegistrosConsulta,
           "iTotalDisplayRecords" => $PCO_TotalRegistrosConsultaCONFiltro,
           "aaData" => $PCO_ArregloDatosRegistros
        );
        echo json_encode($RespuestaFormatoJSON);

        //Finaliza ejecucion
        die();
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: opciones_combo_box
	Hace una consulta a la base de datos y retorna las opciones a desplegar en una lista de seleccion o combobox

	Variables de entrada:

        origen_lista_tablas - Lista de tablas separadas por coma
        origen_lista_opciones - Campo que sera agregado al select para obtener la lista de opciones
        origen_lista_valores -  Campo que sera agregado al select para obtener la lista de valores
        condicion_filtrado_listas - Condiones a ser agregadas en el where para filtrar los registros
        PCO_Prefijo - Cadena para anteponer a las opciones.  Podria recibir algo como un  <option value="  para inciar opciones de un combo o un | para otros usos (por ejemplo)
        PCO_Infijo - Cadena para agregar entre el valor y la opcion visual.  Podria recibir algo como un  ">  para cerrar opciones de un combo o un | para otros usos (por ejemplo)
        PCO_Posfijo - Cadena para agregar al final de cada opcion.  Podria recibir algo como un  </option>  para inciar opciones de un combo o un | para otros usos (por ejemplo)

	Salida:
		Lista de elementos < option > usados en el combo

*/
if ($PCO_Accion=="opciones_combo_box") 
    {           
        $PCO_MensajeError="";
        $PCO_SalidaCombos="";
        //Valida variables minimas para la consulta
        if (@$origen_lista_tablas=="" || @$origen_lista_opciones=="" || @$origen_lista_valores=="")
            {
                $PCO_MensajeError.='<option>[Error] Parametros de seleccion</option>';
                if (@$origen_lista_tablas=="") $PCO_MensajeError.='<option>[Causa] Falta origen_lista_tablas</option>';
                if (@$origen_lista_opciones=="") $PCO_MensajeError.='<option>[Causa] Falta origen_lista_opciones</option>';
                if (@$origen_lista_valores=="") $PCO_MensajeError.='<option>[Causa] Falta origen_lista_valores</option>';
            }

        //Pendiente proteger tablas o campos CORE
        // ******************** //

        //Si no ha obtenido mensajes de error inicia la consulta
        if ($PCO_MensajeError=="")
            {
                // Se buscan los registros para el combo
                $complemento_condicion_filtrado="";
                if (@$condicion_filtrado_listas!="") $complemento_condicion_filtrado=" AND ($condicion_filtrado_listas) ";
                $consulta_registros_combo=PCO_EjecutarSQL("SELECT $origen_lista_opciones as opcion, $origen_lista_valores as valor FROM $origen_lista_tablas WHERE 1 $complemento_condicion_filtrado ");
                while ($registro_opciones_combo = $consulta_registros_combo->fetch())
					$PCO_SalidaCombos.=$PCO_Prefijo.$registro_opciones_combo['valor'].$PCO_Infijo.$registro_opciones_combo['opcion'].$PCO_Posfijo;
            }

        //echo '<select class="selectpicker show-tick">';
        //Retorna el resultado final
        if ($PCO_MensajeError!="")
            echo $PCO_MensajeError;
        else
            echo $PCO_SalidaCombos;
        //echo "</select>";
    }


/* ################################################################## */
/* ################################################################## */
/*
	Function: valor_campo_tabla
	Hace una consulta a la base de datos sobre un campo y tabla especificos y retorna su valor.  Acepta condiciones de filtrado

	Variables de entrada:

        campo - Campo que se desea retornar
        tabla - En donde se busca el valor
        condicion - condicion de filtrado que debe cumplir el registro

	Salida:
		Valor del campo o vacio si no se encuentra nada
    
    Ejemplo de llamado:
    index.php?PCO_Accion=valor_campo_tabla&campo=login&tabla=core_usuario&condicion=login%3d'pepito.perez'&Presentar_FullScreen=1

*/
if ($PCO_Accion=="valor_campo_tabla") 
    {
        if($condicion=="") $condicion="1=1";
        $registro=PCO_EjecutarSQL("SELECT $campo FROM $tabla WHERE $condicion ")->fetch();
        @ob_clean();
        if ($registro[0]!="")
            echo trim($registro[0]);
        else
            echo "";
    }


/* ################################################################## */
/* ################################################################## */
/*
	Section: Acciones a ser ejecutadas (si aplica) en cada cargue de la herramienta
*/

/* ################################################################## */
/* ################################################################## */
/*
	Function: cambiar_estado_campo
	Abre los espacios de trabajo dinamicos sobre el contenedor principal donde se despliega informacion

	Variables de entrada:

		tabla - Nombre de la tabla que contiene el registro a actualizar.
		campo - Nombre del campo que sera actualizado.
		id - Valor Identificador unico del campo a ser actualizado.
		PCO_CambioEstado_CampoLlave - Nombre del campo que sera utulizado para comparar.  Si no se recibe se asume id
		valor - Valor a ser asignado en el campo del registro cuyo identificador coincida con el recibido.
		PCO_CambioEstado_NegarRetorno - Determina si se debe o no retornar despues de un cambio.  Valor vacio hace que se ejecute la operacion por defecto y retorne.
		PCO_CambioEstado_NoUsarCore - Determina si anular o no el prefijo de tablas Core de la operacion. 1=anula, otros valores dejaran el prefijo core

	Salida:

		Valor actualizado en el campo y retorno al escritorio de la aplicacion.  En caso de error se retorna al escritorio sin realizar cambios ante el fallo del query.
*/
if (@$PCO_Accion=="cambiar_estado_campo")
	{		
		$mensaje_error="";
		if ($mensaje_error=="")
			{
				//Determina el tipo de objeto sobre el que se hace el cambio
				$TipoCampo="";
				if (@$formulario!="") $TipoCampo.="Frm:".$formulario;
				if (@$informe!="") $TipoCampo.="Inf:".$informe;
				
				//Define el campo sobre el cual se hace la operacion
				if (@$PCO_CambioEstado_CampoLlave=="")	$PCO_CambioEstado_CampoLlave="id";
				
				//Algunas operaciones requieren por defecto usar los prefijos Core.  Si se desea pueden anularse con el parametro en 1
				$PrefijoTablas=$TablasCore;
				if ($PCO_CambioEstado_NoUsarCore==1) $PrefijoTablas="";
				
				PCO_EjecutarSQLUnaria("UPDATE ".$PrefijoTablas."$tabla SET $campo = '$valor' WHERE $PCO_CambioEstado_CampoLlave = ? ","$id");
				@PCO_Auditar("Cambia estado del campo $campo en objetoID $TipoCampo");
				
				if (@$PCO_CambioEstado_NegarRetorno=="")
					echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
							<input type="Hidden" name="PCO_Accion" value="'.$accion_retorno.'">
							<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
							<input type="Hidden" name="formulario" value="'.@$formulario.'">
							<input type="Hidden" name="informe" value="'.@$informe.'">
							<input type="Hidden" name="popup_activo" value="'.$popup_activo.'">
						</form>
						<script type="" language="JavaScript">
						//setTimeout ("document.cancelar.submit();", 10); 
						document.cancelar.submit();
						</script>';
			}
		else
			echo '<form name="cancelar" action="'.$ArchivoCORE.'" method="POST">
					<input type="Hidden" name="PCO_Accion" value="PCO_EditarFormulario">
					<input type="Hidden" name="nombre_tabla" value="'.$nombre_tabla.'">
					<input type="Hidden" name="formulario" value="'.$formulario.'">
					<input type="Hidden" name="informe" value="'.$informe.'">
					<input type="Hidden" name="PCO_ErrorTitulo" value="'.$MULTILANG_ErrorDatos.'">
					<input type="Hidden" name="PCO_ErrorDescripcion" value="'.$mensaje_error.'">
				</form>
				<script type="" language="JavaScript"> document.cancelar.submit();  </script>';
	}
	


/* ################################################################## */
/* ################################################################## */
/*
	Function: PCO_ObtenerOpcionesAjaxSelect
	Consulta de manera dinamica los elementos requeridos para una lista de seleccion

	Variables de entrada:

		PCO_TablaConsulta - Nombre de la tabla que contiene los datos.  Puede ser combinacion de tablas separadas por coma sin olvidar agregar la condicion de llaves foraneas
		PCO_ListaCamposRetorno - Lista de campos separados por coma que seran devueltos por el query
		PCO_ListaCamposBusqueda - Lista de campos separados unicamente por coma y que son utilizados para la consulta tipo LIKE con el valor recibido
		PCO_CondicionFiltrado - OPCIONAL Condicion a ser agregada a la clausula WHERE de la consulta que filtra resultados

	Salida:

		Objeto JSON con los resultados o registros coincidentes o un mensaje de error formateado como JSON ante cualquier eventualidad
*/
if (@$PCO_Accion=="PCO_ObtenerOpcionesAjaxSelect")
	{		
        //Construye la cadena de filtrado para la consulta
        $ListaCamposArray=explode ("," , $PCO_ListaCamposBusqueda );
        foreach ($ListaCamposArray as $CampoBusqueda)
            $CadenaCondicionCamposFiltro.=" $CampoBusqueda LIKE '%$q%' OR ";
        $CadenaCondicionCamposFiltro = substr($CadenaCondicionCamposFiltro, 0, -3);
        
        $HayResultados=0;
        //Valida que se reciban todos los parametros requeridos
        if ($PCO_ListaCamposRetorno!="" && $PCO_ListaCamposBusqueda!="" && $PCO_TablaConsulta!="")
            {
                $Resultados='[';
                $Consulta=PCO_EjecutarSQL("SELECT $PCO_ListaCamposRetorno FROM $PCO_TablaConsulta WHERE  ($CadenaCondicionCamposFiltro) $PCO_CondicionFiltrado ");
                while ($Registro=$Consulta->fetch())
                    {
                        $Resultados.='
                            {
                                "V": "'.$Registro[0].'",
                                "T": "'.$Registro[1].'",
                                "S": "'.$Registro[2].'",
                                "I": "'.$Registro[3].'"
                            },';
                        $HayResultados=1;
                    }
                $Resultados = substr($Resultados, 0, -1);
                $Resultados.=']';
            }

        if (!$HayResultados)
            $Resultados='
                [
                ]';

        //Devuelve el JSON generado con los resultados
        echo $Resultados;
        die();
	}