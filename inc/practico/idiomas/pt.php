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
		Title: Idioma portugues
		Ubicacion *[/inc/idioma/pt.php]*.  Incluye la definicion de variables utilizadas para presentar mensajes en el idioma correspondiente
		NOTAS IMPORTANTES:
			* Por cuestiones de rendimiento se recomienda la definicion usando comillas simples.
			* Usar las dobles solo cuando se requieran variables o caracteres especiales.
			* Se pueden definir cadenas en funcion de otras definidas con anterioridad
			* Se puede hacer uso de notacion HTML dentro de las cadenas para dar formato
	*/

	// Cadena que describe el archivo de idioma para su escogencia
	$MULTILANG_DescripcionIdioma='Português - Portuguese (by GoogleTranslator)';

	//Lexico general (palabras y frases comunes a varios modulos)
	$MULTILANG_Accion='Açao';
	$MULTILANG_Actualizacion='Atualizar';
	$MULTILANG_Actualizar='Atualização';
	$MULTILANG_Administre='gerir Os';
	$MULTILANG_Agregar='Adicionar';
	$MULTILANG_Ambiente='Ambiente';
	$MULTILANG_Ambos='Ambos';
	$MULTILANG_Anonimo='Anônimo';
	$MULTILANG_Anterior='Anterior';
	$MULTILANG_Apagado='Fora';
	$MULTILANG_Apariencia='Appearance';
	$MULTILANG_Aplicacion='Aplicação';
    $MULTILANG_Aplicando='Aplicando';
    $MULTILANG_Archivo='Arquivo';
	$MULTILANG_Asistente='Assistente';
	$MULTILANG_Atencion='Atenção';
	$MULTILANG_Avanzado='Avançado';
	$MULTILANG_Ayuda='Ajuda';
	$MULTILANG_Basedatos='Base de dados';
	$MULTILANG_Basicos='B&aacute;sico';
    $MULTILANG_BarraHtas='Barra de ferramentas';
    $MULTILANG_Bienvenido='Bem vindo';
    $MULTILANG_Buscar='Pesquisa';
	$MULTILANG_Campo='Campo';
	$MULTILANG_Cancelar='Cancelar';
	$MULTILANG_Capturar='Captura';
    $MULTILANG_Cargando='Carregando';
    $MULTILANG_Cargar='Envio';
	$MULTILANG_Cerrar='Fechar';
	$MULTILANG_CerrarSesion='Sair';
	$MULTILANG_Cliente='Cliente';
	$MULTILANG_CodigoBarras='C&oacute;digo de barras';
	$MULTILANG_Columna='Coluna';
	$MULTILANG_Comando='Comando';
	$MULTILANG_ConfiguracionGeneral='Configurações Gerais';
	$MULTILANG_Configuracion='Configuração';
	$MULTILANG_ConfiguracionVarias='Configurando m&uacute;ltiplas opções';
	$MULTILANG_Confirma='Você tem certeza que quer continuar?';
	$MULTILANG_Continuar='Continuar';
	$MULTILANG_Contrasena='Senha';
	$MULTILANG_Controlador='Driver';
    $MULTILANG_Copias='Backups';
	$MULTILANG_Correcto='Direito';
	$MULTILANG_Correo='O Email';
	$MULTILANG_Creditos='Sobre';
	$MULTILANG_Cualquiera='Qualquer';
	$MULTILANG_Defina='Defina';
	$MULTILANG_Descargar='Baixar';
    $MULTILANG_Deshabilitado='Desativado';
	$MULTILANG_Desplazar='Deslocar';
    $MULTILANG_Detalles='Detalhes';
	$MULTILANG_Disene='Projeto';
	$MULTILANG_Editar='Editar';
	$MULTILANG_Ejecutar='Executar';
	$MULTILANG_Elementos='Elementos';
	$MULTILANG_Eliminar='Excluir';
	$MULTILANG_Embebido='Embutir';
	$MULTILANG_Encabezados='Cabeçalhos';
	$MULTILANG_Encendido='Em';
	$MULTILANG_Error='Erro';
    $MULTILANG_Escritorio='&Aacute;rea de Trabalho';
	$MULTILANG_Estado='Estado';
	$MULTILANG_Etiqueta='Etiqueta';
    $MULTILANG_Evento='Evento';
    $MULTILANG_Existentes='Existing';
    $MULTILANG_Explorar='Explorar';
	$MULTILANG_Exportar='Exportação';
	$MULTILANG_Fecha='Encontro';
	$MULTILANG_Finalizado='Terminado';
    $MULTILANG_Filtro='Filtro';
	$MULTILANG_Formularios='Formul&aacute;rios';
	$MULTILANG_Funciones='Funções preauthorized';
	$MULTILANG_FuncionesDes='Por razões de segurança, as funções personalizadas ou m&oacute;dulos devem ser pr&eacute;-autorizadas neste campo. Adicione as funções ou ações separadas por qualquer caractere.';
	$MULTILANG_GeneradoPor='Distribu&iacute;do por';
	$MULTILANG_General='Geral';
	$MULTILANG_Grande='Grande';
	$MULTILANG_Grafico='Gr&aacute;fico';
	$MULTILANG_Guardar='Salvar';
    $MULTILANG_Guardando='Guardando';
	$MULTILANG_Habilitado='Ativado';
	$MULTILANG_Habilitar='Ativar';
    $MULTILANG_Historico='hist&oacute;ria';
	$MULTILANG_Hora='Tempo';
	$MULTILANG_Horizontal='Paisagem';
	$MULTILANG_IdiomaPredeterminado='Idioma Padrão';
	$MULTILANG_Imagen='Fotografia';
	$MULTILANG_Importando='Importador';
	$MULTILANG_Importante='Importante';
	$MULTILANG_Importar='Importação';
	$MULTILANG_InfoAdicional='Informações adicionais';
	$MULTILANG_Informes='Relat&oacute;rios';
	$MULTILANG_Ingresar='Assinar em';
	$MULTILANG_Instante='Instante';
    $MULTILANG_Ir='Vai';
	$MULTILANG_IrEscritorio='Ir para a minha mesa';
	$MULTILANG_Licencia='Licença';
	$MULTILANG_LlavePaso='Registe-chave';
	$MULTILANG_Maquina='Hospedeiro';
	$MULTILANG_Matriz='Matriz';
	$MULTILANG_Mediano='M&eacute;dio';
    $MULTILANG_Modulos='M&oacute;dulos';
    $MULTILANG_Mostrando='Mostrando';
	$MULTILANG_MotorBD='Motor de banco de dados';
	$MULTILANG_Ninguno='Nenhum';
	$MULTILANG_No='Não';
	$MULTILANG_Nombre='Nome';
	$MULTILANG_NombreRAD='RAD Nome';
    $MULTILANG_Objeto='Objeto';
    $MULTILANG_OlvideClave='Esqueci minha senha';
	$MULTILANG_Opcional='Opcional';
    $MULTILANG_Opcion='Opção';
	$MULTILANG_OpcionesMenu='As opções de menu';
	$MULTILANG_Otros='Outros';
	$MULTILANG_Pagina='P&aacute;gina';
	$MULTILANG_ParamApp='Parâmetros de Aplicação';
	$MULTILANG_Paso='Passo';
	$MULTILANG_Pausar='Pause';
	$MULTILANG_Peso='Peso';
	$MULTILANG_Pequeno='Pequeno';
	$MULTILANG_Personalizado='Personalizadas';
    $MULTILANG_Pestana='Aba';
    $MULTILANG_Plantilla='Template';
	$MULTILANG_Predeterminado='Padrão';
    $MULTILANG_Previo='Anterior';
	$MULTILANG_Primero='Primeiro';
    $MULTILANG_Prioridad='Prioridade';
    $MULTILANG_Procesando='Processamento';
    $MULTILANG_ProcesoFin='Processo conclu&iacute;do';
    $MULTILANG_Proveedores='Providers';
	$MULTILANG_Puerto='Porto';
    $MULTILANG_Recurrente='Recurrent';
    $MULTILANG_Registrarme='Em assinar';
    $MULTILANG_Regresar='Retorna';
    $MULTILANG_Resultados='Resultados';
	$MULTILANG_SaltarLinea='Ir para linha';
    $MULTILANG_Si='Sim';
    $MULTILANG_Siguiente='Pr&oacute;ximo';
	$MULTILANG_Seleccionar='Seleccionar';
    $MULTILANG_SeleccioneUno='Escolha um';
    $MULTILANG_Servidor='Servidor';
	$MULTILANG_Suspender='Suspender';
	$MULTILANG_Tablas='Tabelas';
	$MULTILANG_TablaDatos='Tabela de dados';
	$MULTILANG_Tamano='Tamanho';
	$MULTILANG_Tareas='Tarefas';
	$MULTILANG_TiempoCarga='O tempo de carregamento';
	$MULTILANG_Tipo='Tipo';
	$MULTILANG_TipoMotor='Tipo de motor';
	$MULTILANG_Titulo='T&iacute;tulo';
	$MULTILANG_TotalRegistros='Total de registros gravados';
	$MULTILANG_Trazabilidad='Traceability';
	$MULTILANG_Truncar='Truncar';
	$MULTILANG_Ultimo='Ultimo';
    $MULTILANG_Usuario='Do Utilizador';
	$MULTILANG_Vacio='Vazio';
	$MULTILANG_Variables='Vari&aacute;veis';
	$MULTILANG_Version='Versão';
	$MULTILANG_Vertical='Retrato';
	$MULTILANG_ZonaHoraria='Fuso hor&aacute;rio';
	$MULTILANG_ZonaPeligro='Zona de perigo';
	$MULTILANG_VistaImpresion='Vista Printer';
	$MULTILANG_IDGABeacon='Google Analytics ID';
	$MULTILANG_AyudaGABeacon='Os desenvolvedores que querem ter um registro completo ou estat&iacute;sticas em tempo real sobre o seu software usando o Google Analytics pode colocar aqui a identificação &uacute;nica do seu Painel do Google Analytics. Practico ir&aacute; enviar todas as estat&iacute;sticas de tu seu Painel de Analytics em tempo real';

	//Ventana de login
	$MULTILANG_TituloLogin='Sistema de Acesso';
	$MULTILANG_CodigoSeguridad='C&oacute;digo de segurança';
	$MULTILANG_IngreseCodigoSeguridad='Digite o c&oacute;digo';
	$MULTILANG_AccesoExclusivo='O acesso a este software &eacute; apenas para usu&aacute;rios registrados. Para sua segurança, nunca compartilhe seu nome de usu&aacute;rio e senha.';
	$MULTILANG_LoginNoWSTit='Erro ao tentar carregar o webservice autenticação';
	$MULTILANG_LoginNoWSDes='Os file_get_contents () função não pode carregar o arquivo XML de sa&iacute;da constru&iacute;do pelo processo de autenticação Practico.<br>  Verifique se o seu servidor web de configuração / instalação para ver que este funtion pode funciona corretamente e sem restrições.<br>  Uma maneira de verificar que processo Practicos &eacute; bom, mas o servidor não permite que para carregar o arquivo XML<br>est&aacute; abrindo o seguinte link e verificar se o seu navegador carrega o XML corretamente. Ativando o modo de depuração em seus Practicos config você pode ver mais detalhes: ';
	$MULTILANG_OauthLogin='Entre usando minha rede social';
	$MULTILANG_LoginClasico='Entrar com conta';
	$MULTILANG_LoginOauthDes='<b>Redes sociais e outros provedores de autenticação dispon&iacute;veis</b><br>Clique sobre o logotipo de login usando o nome de usu&aacute;rio ea senha de seu site favorito.';
	$MULTILANG_CaracteresCaptcha='N&uacute;mero de caracteres para captcha?';
	$MULTILANG_TipoCaptcha='Tipo de captcha usado para tela de acesso';
	$MULTILANG_TipoCaptchaTradicional='Tradicional (números e letras) requer o PHP GD habilitado.';
	$MULTILANG_TipoCaptchaVisual='Seleção visual de imagens. Não foi necessária nenhuma biblioteca GD';
	$MULTILANG_TipoCaptchaPrefijo='Haga clic o toque el icono de';
	$MULTILANG_TipoCaptchaPosfijo='para validar';
    $MULTILANG_SimboloCaptchaCarro='CARRO';
    $MULTILANG_SimboloCaptchaTijeras='TIJERAS';
    $MULTILANG_SimboloCaptchaCalculadora='CALCULADORA';
    $MULTILANG_SimboloCaptchaBomba='BOMBA';
    $MULTILANG_SimboloCaptchaLibro='LIBRO';
    $MULTILANG_SimboloCaptchaPastel='PASTEL';
    $MULTILANG_SimboloCaptchaCafe='CAFE';
    $MULTILANG_SimboloCaptchaNube='NUBE';
    $MULTILANG_SimboloCaptchaDiamante='DIAMANTE';
    $MULTILANG_SimboloCaptchaMujer='MUJER';
    $MULTILANG_SimboloCaptchaHombre='HOMBRE';
    $MULTILANG_SimboloCaptchaBalon='BALON';
    $MULTILANG_SimboloCaptchaControl='CONTROL';
    $MULTILANG_SimboloCaptchaCasa='CASA';
    $MULTILANG_SimboloCaptchaCelular='CELULAR';
    $MULTILANG_SimboloCaptchaArbol='ARBOL';
    $MULTILANG_SimboloCaptchaTrofeo='TROFEO';
    $MULTILANG_SimboloCaptchaSombrilla='SOMBRILLA';
    $MULTILANG_SimboloCaptchaUniversidad='UNIVERSIDAD';
    $MULTILANG_SimboloCaptchaCamara='CAMARA';
    $MULTILANG_SimboloCaptchaAmbulancia='AMBULANCIA';
    $MULTILANG_SimboloCaptchaAvion='AVION';
    $MULTILANG_SimboloCaptchaTren='TREN';
    $MULTILANG_SimboloCaptchaBicicleta='BICICLETA';
    $MULTILANG_SimboloCaptchaCamion='CAMION';
    $MULTILANG_SimboloCaptchaCorazon='CORAZON';
	$MULTILANG_LogoParteSuperior='Logotipo no canto superior esquerdo do seu aplicativo';
	$MULTILANG_LogoDuranteLogin='Logo no momento do login da sua aplicação';
	$MULTILANG_ResolucionLogos='Se a imagem carregada não tiver a resolução indicada, ela será redimensionada toda vez que ela for apresentada ao usuário.';

	//Banderas de campos en formularios
	$MULTILANG_TitValorUnico='O valor digitado não aceita duplicado';
	$MULTILANG_DesValorUnico='O sistema ir&aacute; validar as informações inseridas neste campo, se j&aacute; existe um registro com esse valor no banco de dados não ser&aacute; permitida a entrada.';
	$MULTILANG_TitObligatorio='Campo requerido';
	$MULTILANG_DesObligatorio='Este campo tem sido marcada como obrigat&oacute;ria. Se você não inserir um valor para este sistema não armazena o registro de entrada do usu&aacute;rio.';

	//Errores y avisos varios
	$MULTILANG_VistaPrev='visualização';
	$MULTILANG_TituloInsExiste='ATENÇÃO: A pasta de instalação existe no servidor';
	$MULTILANG_TextoInsExiste='Esta mensagem &eacute; exibida permanentemente para todos os usu&aacute;rios que você não exclua o diret&oacute;rio usado para a instalação de Practico. &eacute; essencial que a pasta &eacute; exclu&iacute;do ap&oacute;s o final de uma instalação para evitar qualquer usu&aacute;rio anônimo iniciar o processo novamente overwritting arquivos de configuração ou bancos de dados com informações de importância para você<br><br>Se você j&aacute; tiver conclu&iacute;do uma instalação do Practico para utilização na produção &eacute; importante para remover essa pasta antes de prosseguir. Se você deseja excluir esta pasta, você pode escolher para renomear em tempor&aacute;rio ou julgamento. <br> <br> Se você est&aacute; vendo esta mensagem ao executar esse script pela primeira vez e quer fazer uma nova instalação, você pode iniciar o assistente  <a class="btn btn-primary btn-xs" href="javascript:document.location=\'ins\';"><i class="fa fa-rocket"></i> Clique AQUI</a> ';
	$MULTILANG_ErrorTiempoEjecucion='Erro de tempo';
	$MULTILANG_ErrorModulo='M&oacute;dulo principal est&aacute; a tentar incluem um m&oacute;dulo situado na <b>mod/</b> Practico mas não consegue encontrar o seu ponto de acesso. <br> Verifique o estado do m&oacute;dulo, consulte o administrador ou excluir o m&oacute;dulo conflitante para evitar esta mensagem.';
	$MULTILANG_ContacteAdmin='Contacte o seu administrador do sistema e relatar este post.';
	$MULTILANG_ReinicieWeb='Por favor, faça os ajustes necess&aacute;rios e reiniciar o serviço web.';
	$MULTILANG_PHPSinSoporte='Sua instalação do PHP parece não ter apoio';
	$MULTILANG_ErrExtension='Extensão PHP faltando, deficientes ou um m&oacute;dulo &eacute; necess&aacute;ria';
	$MULTILANG_ErrLDAP=$MULTILANG_PHPSinSoporte.' &eacute; necess&aacute;rio suporte LDAP para uso como m&eacute;todo de autenticação externa.<br>'.$MULTILANG_ReinicieWeb.'.<br>A autenticação do usu&aacute;rio administrador permanecer&aacute; independente para evitar a perda de acesso.';
	$MULTILANG_ErrHASH=$MULTILANG_PHPSinSoporte.' &eacute; necess&aacute;rio um apoio HAS.<br>Esta extensão &eacute; necess&aacute;ria se você tiver selecionado um tipo de criptografia diferente para as senhas em motores de at&eacute; autenticação externa.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSESS=$MULTILANG_PHPSinSoporte.' &eacute; necess&aacute;rio um apoio sessões. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrGD=$MULTILANG_PHPSinSoporte.' GD Graphics Library &eacute; necess&aacute;ria.<br>Aqueles que estão usando o debian, ubuntu ou seus derivados pode tentar um <b> apt-get install php5-gd </ b> adicion&aacute;-lo. Usu&aacute;rios RedHat ou CentOS <b> yum install php-gd </ b>. Usu&aacute;rios de outros platfroms deve chech sua documentação.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrCURL=$MULTILANG_PHPSinSoporte.' cURL Biblioteca &eacute; necess&aacute;rio.<br>Aqueles que estão usando o debian, ubuntu ou seus derivados pode tentar um <b> apt-get install php5-gd </ b> adicion&aacute;-lo.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrSimpleXML=$MULTILANG_PHPSinSoporte.' SimpleXML Biblioteca &eacute; necess&aacute;rio.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrExtensionGenerica=$MULTILANG_PHPSinSoporte.' activated for this library or extension.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrPDO=$MULTILANG_PHPSinSoporte.' PDO &eacute; necess&aacute;rio apoio.<br>'.$MULTILANG_ReinicieWeb;
	$MULTILANG_ErrDriverPDO=$MULTILANG_PHPSinSoporte.' para PDO. '.$MULTILANG_ReinicieWeb;
	$MULTILANG_ObjetoNoExiste='O objeto associado a este pedido não existe.';
	$MULTILANG_ErrorDatos='Problema nos dados de entrada';
	$MULTILANG_ErrorTitAuth='<blink>ACESSO NEGADO!</blink>';
	$MULTILANG_ErrorDesAuth='<div align=left>As credenciais fornecidas para o acesso ao sistema não foram aceites. Algumas causas comuns são:<br><li> O nome de usu&aacute;rio ou senha est&aacute; incorreta. <br> <li> C&oacute;digo de segurança digitado incorretamente. <br> <li> Seu login &eacute; desativado. <br> <li> Conta bloqueada por m&uacute;ltiplas tentativas de acesso com senha incorreta.</div>';
	$MULTILANG_ErrorSoloAdmin='Apenas usu&aacute;rio admin pode ver os detalhes da transação com modo de depuração Ligado';
	$MULTILANG_ErrGoogleAPIMod='OAuth2 para o Google foi configurado como m&eacute;todo de autenticação padrão.<br>De qualquer forma o m&oacute;dulo Practicos para google-api ainda não estiver instalado.<br>Faça o download do m&oacute;dulo google-api do site Practicos e recarregar novamente.';
	$MULTILANG_ErrFuncion='<br>PHP does not Função existe ou est&aacute; desabilitado no seu servidor: ';
	$MULTILANG_ErrDirectiva='O ambiente var deve ser ativado na configuração do PHP ou servidor web';
    $MULTILANG_AdminArchivos='Gerenciador de arquivos';
    $MULTILANG_ErrorConnLDAP='Ocorreu um erro durante a conexão com o servidor LDAP. Por favor, verifique suas configurações e tente novamente. detalhes:<br>';
    $MULTILANG_ErrorRW='Não h&aacute; direitos para gravar o arquivo! Qualquer alteração do seu conte&uacute;do poderia ser perdido';
    $MULTILANG_ErrorExistencia='O nome do arquivo que você pediu edittion esquentar existe!';
    $MULTILANG_ErrorNoACE='ACE m&oacute;dulo não foi achado tentando editar arquivo';
    $MULTILANG_AyudaExplorador='Importante: Algumas pastas são mostrados como informações sobre ele s&oacute; existe. Talvez, pastas expandir se eles têm apenas arquivos edit&aacute;veis.';
    $MULTILANG_EnlacePcoder='{PCoder}: Editor de C&oacute;digo';
    $MULTILANG_AtajosTitPcoder='Atalho de teclado';
    $MULTILANG_AvisoSistema='Mensagem do sistema';
    $MULTILANG_PcoderAjuste='Ajuste janela';
    $MULTILANG_PcoderAjusteConfirma='Você est&aacute; indo para recarregar esta janela para redimensionar a janela como sua resolução m&aacute;xima. Quando você recarregue esta janela, você pode perder qualquer mudança que você j&aacute; dont salvo. Você quer continuar?';
    $MULTILANG_BuscaCriterios='Você deve digitar uma palavra-chave para pesquisa';
    $MULTILANG_EstadoPHP='PHP Informações';
    $MULTILANG_ArchivosLimpiados='Limpos / arquivos purgados';
    $MULTILANG_EspacioLiberado='O espaço em disco liberado';
    $MULTILANG_TitDemo='A função não est&aacute; dispon&iacute;vel Apelou';
    $MULTILANG_MsjDemo='Você est&aacute; em uma instalação em modo DEMO (ou demonstração). Essas instalações não permitem que você interaja livremente com todos os controles de segurança. Isso ajuda a garantir que você estar&aacute; sempre dispon&iacute;vel para todos os usu&aacute;rios que querem experimentar a plataforma.';
    $MULTILANG_SeparadorCampos='Valor de string para separador de campo';
    $MULTILANG_SeparadorCamposDes='Usado para separar valores em consultas sobre o motor de base de dados. Este deve ser um valor incomum para manter qualquer correspondência com os dados inseridos por usu&aacute;rios';
    $MULTILANG_SelectorIdioma='Os usuários podem alterar o idioma na hora de login';
    $MULTILANG_SelectorIdiomaAyuda='Mostra uma lista de seleção durante o login com todas as linguagens disponíveis na plataforma.';
    $MULTILANG_ErrorConexionInternet='Parece que você está sem conexão com a internet, a conexão com o sistema será restaurado quando sua conexão com a Internet ser comum.<br><br>Verifique sua conexão de rede ou sinal de dados estão ativos.';
    $MULTILANG_NombreRADDes='Nome usado para o gerador de aplicativos. Isso também é usado para títulos de janelas';
    $MULTILANG_SaltoEdicion='Você está prestes a fechar a edição do elemento atual e pular para a janela de edição do elemento selecionado. Você deseja continuar?';
    $MULTILANG_ExportacionMasiva='Exportação maciça';
    $MULTILANG_AgregarAExportacion='Adicionar item à lista de exportação em massa';
    $MULTILANG_ImagenFondo='Background image';
    $MULTILANG_ImagenFondoDes='Define a background image to customize your application. It is recommended wide but light. Recommendation: You should combine theme colors and controls with the image palette to harmonize your design. By default the value is img/fondo.jpg but you can change it to any relative path from the root of the system, even to animated files.';
    $MULTILANG_ImagenDefecto='Empty for nothing or relative path';
    
	//Asistente disenador aplicaciones
	$MULTILANG_DesAppBoton='Design do aplicativo';
	$MULTILANG_TitDisenador='Projetando a aplicação<b>&eacute; simples e r&aacute;pido:</b>';
	$MULTILANG_DefTablas='Definição de tabela';
	$MULTILANG_DesTablas='As mesas são aquelas estruturas em que a informação &eacute; armazenada usando formul&aacute;rios que lhes estão associados.';
	$MULTILANG_DefForms='para entrada de dados e informações consultando';
	$MULTILANG_DesForms='Eles permitem que o usu&aacute;rio insira informações de acordo com certas validações ou formatos, consultar ou mesmo excluir registros. Display tamb&eacute;m permitir que outros elementos, tais como p&aacute;ginas ou relat&oacute;rios pr&eacute;-definidos.';
	$MULTILANG_DefInformes='(gr&aacute;ficos ou tabelas)';
	$MULTILANG_DesInformes='Eles apresentam as informações existentes, dentro de tabelas para usu&aacute;rios em diferentes formatos e filtros definidos. Você pode criar tabular ou tipo de gr&aacute;fico e, posteriormente, tamb&eacute;m ser incorporado em outros espaços';
	$MULTILANG_DefMenus='para os utilizadores';
	$MULTILANG_DesMenus='Objetos de links projetados como formul&aacute;rios ou relat&oacute;rios com &iacute;cones gr&aacute;ficos e descrições de texto que podem ser selecionadas por um usu&aacute;rio com essa permissão. Ele tamb&eacute;m permite que você ligue funções externas ou a execução de comandos personalizada.';
	$MULTILANG_UsuariosPermisos='Usu&aacute;rios e Permissões';
	$MULTILANG_DefUsuarios='para acessar o aplicativo';
	$MULTILANG_DesUsuarios='Define as credenciais de acesso para cada usu&aacute;rio e as permissões dispon&iacute;veis para cada um a formas de acesso, relat&oacute;rios ou quaisquer opções de menu previamente definidos.';
	$MULTILANG_DefAvanzadas='Ferramentas avançadas';
	$MULTILANG_DefMantenimientos='Manutenção';
	$MULTILANG_DefPcoder='Editor de c&oacute;digo on-line';
	$MULTILANG_DefLimpiarTemp='Pasta tempor&aacute;ria limpo /tmp';
	$MULTILANG_DefLimpiarBackups='Backups limpas existentes sobre / bkp';
	$MULTILANG_DefPMyDB='Administrador de banco de dados avançada';
	$MULTILANG_ConfirmaPMyDB='IMPORTANTE: O manuseio inadequado das mesas e informações por meio de banco de dados administrador avançado pode causar perda parcial ou total de informações, bem como performances imprevisíveis na sua aplicação. Recomendamos a utilização deste gerenciador de banco com o cuidado envolvido.';

	//Cierre de sesion
	$MULTILANG_SesionCerrada='Sua sessão foi encerrada';
	$MULTILANG_TituloCierre='Isso pode resultar de ações tomadas pelo usu&aacute;rio como';
	$MULTILANG_ExplicacionCierre='<li>Feche a sessão voluntariamente</li>
			<li>Pare de usar o sistema por um longo tempo</li>
			<li>Tendo v&aacute;rias janelas abertas ao mesmo tempo em sistema de seções restritas by admin</li>
			<li>O seu nome de usu&aacute;rio ou senha &eacute; inv&aacute;lida para operação adicional</li>
			<li>Navegar usando links ou outros botões do que as permitidas</li>
			<br><strong>Tamb&eacute;m para configurações ou ações em seu computador, como:</strong><br>
			<li>O seu navegador não est&aacute; apoiando os cookies</li>
			<li>Esconderijo limpo de cookies do navegador ou sessões durante a utilização do sistema</li>
			<br><strong>As configurações do sistema tamb&eacute;m gosta:</strong><br>
			<li>Você concluiu um processo da plataforma de instalação requer a reinicialização de sessão</li>
			<li>O SignKey do usu&aacute;rio não corresponde à chave exigido por este sistema</li>
			<li>As credenciais para assinar uma operação não são v&aacute;lidos</li>';

	//Actualizacion de plataforma
	$MULTILANG_ActMsj1='ATENÇÃO: Leia estas informações antes de continuar';
	$MULTILANG_ActMsj2='Pr&aacute;ctico fornece este mecanismo para implementar atualizações autom&aacute;ticas para o seu sistema com os patches incrementais baixado a partir do site oficial ou pelo assistente de projeto para atualizações, no entanto, antes de aplicar qualquer patch &eacute; essencial que:<br><br>
			<li>Faça um backup de seus bancos de dados. Algumas alterações podem necessitar de modificação de estruturas com base na informação de dados que podem afectar.
			<li>Faça backup de seus arquivos ou pasta Practico.
			<li>Limpe a pasta de trabalho Practico (caminho tmp /) ele ser&aacute; usado pelo assistente para descomprimir e digitalizar arquivos.';
	$MULTILANG_ActUsando='Atualmente você estiver usando a versão';
	$MULTILANG_ActPaquete='Caixa / patch de atualização manual';
	$MULTILANG_ActSobreescritos='Arquivos anteriores serão substitu&iacute;dos';
	$MULTILANG_CargarArchivo='Subir arquivo';
	$MULTILANG_Adjuntando='Colocar um novo arquivo para o sistema';
	$MULTILANG_ErrorTamano='<b> ATENÇÃO: </b> processo interrompido. O arquivo excede o limite de tamanho';
	$MULTILANG_ErrorFormato='<b> ATENÇÃO: </b> processo interrompido. O formato do arquivo enviado não &eacute; v&aacute;lido';
	$MULTILANG_CargaCorrecta='O arquivo foi carregado corretamente';
	$MULTILANG_ErrorDesconocido='<b> ATENÇÃO: </b> Ocorreu um erro desconhecido ao fazer o upload do arquivo';
	$MULTILANG_ErrorDescomprimiendo='arquivo Desembalagem';
	$MULTILANG_ContenidoParche='O conte&uacute;do dos arquivos';
	$MULTILANG_ErrorVerAct='Erro ao carregar a versão atual do Practico. Arquivo não encontrado';
	$MULTILANG_ErrorActualiza='O arquivo enviado não parece ser um pacote de atualização v&aacute;lido. Arquivo não encontrado';
	$MULTILANG_ErrorAntigua='O arquivo de correção carregou faz referência a uma atualização mais antiga que a versão atual';
	$MULTILANG_ErrorVersion='O arquivo de patch carregado requer a seguinte versão';
	$MULTILANG_AvisoIncremental='Primeiro, você deve aplicar patches incrementais necess&aacute;rios para aumentar a sua versão m&iacute;nima do sistema que requer a correção.';
	$MULTILANG_Integridad='Integridade';
	$MULTILANG_ResumenParche='Resumo das alterações e funcionalidades fornecidas pelo patch';
	$MULTILANG_ResumenInstrucciones='Instruções a serem executadas em tabelas de sistema';
	$MULTILANG_FinRevision='PROCESSO DE REVISÃO TERMINADO';
	$MULTILANG_ActMsj3='Ao aplicar os arquivos listados acima ir&aacute; atualizar seu sistema para a pr&oacute;xima versão';
	$MULTILANG_ActErrGral='Arquivo de estrutura, tipo ou versão não suportada';
	$MULTILANG_ActDesde='Atualizando da versão';
	$MULTILANG_ErrLista='Erro lista de carga de arquivos para fazer backup';
	$MULTILANG_HaciendoBkp='Fazer c&oacute;pia de segurança';
	$MULTILANG_ErrBkpBD='Ocorreu um erro durante o backup do banco de dados';
	$MULTILANG_ActMsj4='Se qualquer um dos arquivos não poderia ser escrito por este assistente por problemas de permissões, o patch tamb&eacute;m pode ser aplicada manualmente pelo administrador ou copiando apenas os arquivos que faltam';
	$MULTILANG_ActMsj5='Estrutura de arquivo ou tipo sem suporte';
	$MULTILANG_ActAlertaVersion='H&aacute; uma nova versão do Practico dispon&iacute;vel para download.<br>N&oacute;s recomendamos que você baixar a nova versão ou pacote de atualização a partir do site oficial e atualizar o seu sistema para que os novos recursos.';
	$MULTILANG_ActBuscarVersion='Procure por novas versões automaticamente';
    $MULTILANG_ActErrEscritura='Erro de gravação';
    $MULTILANG_ActDesEscritura='ATENÇÃO: H&aacute; erros de gravação nos arquivos que vão ser atualizado.
        <br><br>Para manter a integridade do software que você não pode atualizar at&eacute; que você corrigir as permissões de arquivo para ser grav&aacute;vel por Practico. Os arquivos são marcados na lista na cor vermelha eo texto "'.$MULTILANG_ActErrEscritura.'".  
        <br><br>Corrija o problema e tente novamente.';
    $MULTILANG_ActBackupTipo='Modo de backup';
    $MULTILANG_ActBackup1='Scripts substitu&iacute;da durante este processo apenas';
    $MULTILANG_ActBackup3='Scripts substitu&iacute;do e todo o meu banco de dados';
    $MULTILANG_ActBackupDes='Fazer um backup completo pode ser uma tarefa pesada para o sistema. Em sistemas amplamente utilizado um processo de backup completo deve ser feito por uma outra ferramenta que permitir&aacute; que você tenha arquivos consistentes, mesmo com usu&aacute;rios trabalhando em tempo real.';

	//Formularios
	$MULTILANG_ErrFrmDuplicado='Falha valor duplicado no campo. O valor que introduziu j&aacute; existe no banco de dados. campo: ';
	$MULTILANG_ErrFrmObligatorio='Você esqueceu-se de entrar no campo de preenchimento obrigat&oacute;rio: ';
	$MULTILANG_ErrFrmDatos='H&aacute; um problema em que os dados de entrada';
	$MULTILANG_ErrFrmCampo1='Você deve digitar um t&iacute;tulo v&aacute;lido ou r&oacute;tulo para o campo.';
	$MULTILANG_ErrFrmCampo2='Você deve inserir um campo v&aacute;lido para conectar-se a tabela de dados associado com o formul&aacute;rio.';
	$MULTILANG_ErrFrmCampo3='Você deve digitar um t&iacute;tulo v&aacute;lido ou r&oacute;tulo para o botão.';
	$MULTILANG_ErrFrmCampo4='Você deve digitar uma ação v&aacute;lida a ser executado quando o controle &eacute; ativado.';
	$MULTILANG_FrmMsj1='Adicionar um item ao formul&aacute;rio';
	$MULTILANG_FrmTipoObjeto='Tipo de objeto para adicionar';
	$MULTILANG_FrmTipoTit1='Controles de Dados';
	$MULTILANG_FrmTipo1='Campo de texto curto';
	$MULTILANG_FrmTipo2='Texto campo livre / Ilimitado';
	$MULTILANG_FrmTipo3='Campo de texto ricamente formatado (CKEditor)';
	$MULTILANG_FrmTipo4='Campo de seleção (ComboBox dropdown list)';
	$MULTILANG_FrmTipo5='Campo de seleção (RadioButton)';
	$MULTILANG_FrmTipoTit2='Apresentação e outros conte&uacute;dos';
	$MULTILANG_FrmTipo6='O texto formatado (as a label)';
	$MULTILANG_FrmTipo7='Inv&oacute;lucro (iFrame)';
	$MULTILANG_FrmTipoTit3='Objetos internos';
	$MULTILANG_FrmTipo8='Relat&oacute;rio predesigned (Data Table or Graph)';
	$MULTILANG_FrmTipo9='Slider (numeric range selector - HTML5)';
	$MULTILANG_FrmTipo10='Campo de senha';
	$MULTILANG_FrmTipo11='Valor do campo como r&oacute;tulo';
	$MULTILANG_FrmTipoTit4='Controles de dados especial';
	$MULTILANG_FrmTipo12='Arquivo anexo';
	$MULTILANG_FrmTipo13='Canvas (&aacute;rea de desenho - HTML5)';
	$MULTILANG_FrmTipo14='Canvas (captura de Webcam - HTML5)';
	$MULTILANG_FrmTipo15='SubForm (To query and ReadOnly)';
    $MULTILANG_FrmTipo16='Botão de comando';
    $MULTILANG_FrmTipo17='Campo de texto ricamente formatado (Responsive)';
	$MULTILANG_FrmTipo18='Campo Verificar (CheckBox)';
	$MULTILANG_FrmTipoPincel='Tamanho de escova';
	$MULTILANG_FrmTipoColor='Cor da linha';
	$MULTILANG_FrmTipoAdvertencia='Este tipo de controles de dados deve ser armazenado em sua mesa em um longo texto ou campo ilimitado';
	$MULTILANG_FrmValorMinimo='Valor m&iacute;nimo';
	$MULTILANG_FrmValorMaximo='O valor m&aacute;ximo';
	$MULTILANG_FrmValorSalto='Valor do passo';
	$MULTILANG_FrmTitValorSalto='Quantas unidades saltar o cursor sobre cada movimento?';
	$MULTILANG_FrmTitulo='T&iacute;tulo ou Tag';
	$MULTILANG_FrmDesTitulo='O texto que aparece ao lado do campo informando ao usu&aacute;rio a informação que deve ser inserido. Você pode usar HTML b&aacute;sico para o formato adicional.';
	$MULTILANG_FrmCampo='Campo vinculado';
	$MULTILANG_FrmFiltroLista='Condição do filtro lista';
	$MULTILANG_FrmDesFiltroLista='Condição especial que os registros devem ter para ser exibido. Esta condição pode usar qualquer campo na tabela de origem que não são seleccionados como valores tamb&eacute;m. Valores fixos deve ser fechado em cuotes duplos e você pode usar outro expresions como ORDER BY, GROUP BY, LIMIT, Etc. Este campo ser&aacute; adicionado depois de um WHERE clausule na consulta.  LEMBRE-SE: Se você não tem uma condição, mas você quer um ORDER BY OR GROUP BY em seguida, adicionar, pelo menos, uma 1=1 antes de a aplicar à condittion. Você poderia usar {$Variable} para se referir uma vari&aacute;vel PHP tamb&eacute;m';
	$MULTILANG_FrmCampoOb1='Campo obrigat&oacute;rio para controles de ligação de dados';
	$MULTILANG_FrmDesCampo='Tabela de dados de campo que ligar&aacute; informações. Em campos de arquivo isto pode conter o caminho relativo para o arquivo carregado no servidor. Cada arquivo deve ter pelo menos um campo para armazenar seu caminho';
	$MULTILANG_FrmValUnico='Campo de valor &uacute;nico';
	$MULTILANG_FrmTitUnico='Exclusividade para valores de entrada';
	$MULTILANG_FrmDesUnico='Indica se o campo pode armazenar valores ou repetida no banco de dados. Deve estar habilitado para campos que representam chaves prim&aacute;rias na sua concepção e deficientes para o resto. Você deve tomar cuidado em que se forma o que você precisa neste campo para fazer upgrades e sua mensagem de erro duplicada.';
	$MULTILANG_FrmPredeterminado='Valor padrão';
	$MULTILANG_FrmDesPredeterminado='Define o valor que aparece automaticamente preenchido no campo para abrir a vista formul&aacute;rio. Esse valor pode estar fora de validação de dados. Se uma vari&aacute;vel de sessão PHP &eacute; introduzido então Practico ter&aacute; seu valor.';
	$MULTILANG_FrmValida='Data de validade';
	$MULTILANG_FrmValida1='Somente numeros 0-9';
	$MULTILANG_FrmValida2='Somente letras A-Z';
	$MULTILANG_FrmValida3='Letras e n&uacute;meros';
	$MULTILANG_FrmValida4='Campo de data usando calend&aacute;rio unificado';
	$MULTILANG_FrmValida7='Campo de data usando catadores separados (year, month and day)';
	$MULTILANG_FrmValida5='Campo tempo';
	$MULTILANG_FrmValida6='Data e hora campo';
	$MULTILANG_FrmValida8='Data e Hor&aacute;rio de campo usando seletor unificada';
	$MULTILANG_FrmValidaDes='Tipo de filtro a ser aplicado quando o usu&aacute;rio insere informações pelo teclado';
	$MULTILANG_FrmLectura='Leia &uacute;nico campo';
	$MULTILANG_FrmTitLectura='Define se você pode alterar seu valor ou não';
	$MULTILANG_FrmDesLectura='Propriedade &uacute;til para campos ou formas de a consulta do usu&aacute;rio que &eacute; necess&aacute;rio para exibir o valor, mas não permitir a modificação';
	$MULTILANG_FrmAyuda='T&iacute;tulo de ajuda';
	$MULTILANG_FrmDesAyuda='O texto que aparece como um cabeçalho para o campo de texto de ajuda que explica ao usu&aacute;rio o que inserir';
	$MULTILANG_FrmTxtAyuda='Texto de ajuda';
	$MULTILANG_FrmDesTxtAyuda='Texto completo com descrição função de resumo para o campo. Você pode incluir instruções de formatação, avisos ou qualquer outra mensagem para o usu&aacute;rio';
	$MULTILANG_FrmDesPeso='Posição em que o campo &eacute; apresentado no formul&aacute;rio quando ele &eacute; exibido na tela. ordem.';
	$MULTILANG_FrmDesColumna='Coluna para localizar o campo quando a vista formul&aacute;rio tem v&aacute;rias colunas. Esses campos maiores do que as colunas definidas no formul&aacute;rio não ser&aacute; desenhada';
	$MULTILANG_FrmObligatorio='Obrigat&oacute;rio';
	$MULTILANG_FrmVisible='Vis&iacute;vel';
	$MULTILANG_FrmDesVisible='Determina se o controle &eacute; vis&iacute;vel ou não para o usu&aacute;rio. Se o controle para a esquerda não &eacute; usado, mas como um oculto';
	$MULTILANG_FrmLblBusqueda='O uso para pesquisa de registro? etiqueta';
	$MULTILANG_FrmTitBusqueda='Indica se o campo &eacute; usado para procurar por registros';
	$MULTILANG_FrmDesBusqueda='Deixe em branco para indicar que &eacute; um campo normal ou digite o r&oacute;tulo que deve ir para o botão de comando localizado no lado direito para fazer a busca por registros';
	$MULTILANG_FrmAjax='Use AJAX para pesquisa (all items)';
	$MULTILANG_FrmAjaxDinamico='Use AJAX to retrieve items dinamically when you type';
	$MULTILANG_FrmTitAjax='Modo de Recuperação registro';
	$MULTILANG_FrmDesAjax='Quando a caixa estiver ligada, Practico tenta recuperar as informações de log para o formul&aacute;rio usando AJAX. Em uma caixa de combinação que leva seus valores de uma tabela que você pode us&aacute;-lo para adicionar um botão para atualizar o seu conte&uacute;do on-line.';
	$MULTILANG_FrmTeclado='Adicionar teclado virtual';
	$MULTILANG_FrmTitTeclado='Permitir a entrada de dados por teclado na tela';
	$MULTILANG_FrmDesTeclado='Quando habilitado no formul&aacute;rio exibe um teclado virtual para inserir informações,. Por enquanto o uso do teclado pode violar validações';
	$MULTILANG_FrmAncho='Largura';
	$MULTILANG_FrmTitAncho='Qual a largura deve ocupar controle do espaço';
	$MULTILANG_FrmDesAncho='IMPORTANT: in characters number for simple text fields and pixels rich-text fields. Enter a number of columns, however, note that the width in pixels will vary according to the type of font used by the current theme.  For image or bar code fields this value is for the size of the picture.  For canvas objects you can specify the width and the final scale percent using a pipe character. IE: 400|0.3 will create a 400 pixels object but it will save it as 30% of scale.';
	$MULTILANG_FrmDesAncho2='M&iacute;nimo recomendado para campos de formato rich-text: 350';
	$MULTILANG_FrmAlto='Altura (linhas)';
	$MULTILANG_FrmTitAlto='Quantas linhas deve ser vis&iacute;vel no controle?';
	$MULTILANG_FrmDesAlto='IMPORTANTE: o n&uacute;mero de linhas para texto simples ou em pixels para a formatação rich-text. Se o texto exceder o n&uacute;mero de linhas de rolagem são automaticamente adicionados. Para os campos de imagem de c&oacute;digo de barras ou esse valor &eacute; que o tamanho da imagem.';
	$MULTILANG_FrmDesAlto2='Campos de formato m&iacute;nimo recomendado: 100';
	$MULTILANG_FrmBarra='Barra de formatação';
	$MULTILANG_FrmBarraCKEditor='Dispon&iacute;vel para CKEditor';
	$MULTILANG_FrmBarraSummer='Dispon&iacute;vel para SummerNote (Responsive)';
	$MULTILANG_FrmBarraTipo1='Basic: Documento, car&aacute;ter e formatação de par&aacute;grafos';
	$MULTILANG_FrmBarraTipo2='Standard: Basic + links e estilos de fonte';
	$MULTILANG_FrmBarraTipo3='Extended: Standard + prancheta, procurar-substituir e ortografia';
	$MULTILANG_FrmBarraTipo4='Advanced: Extended + Insira objetos e cores';
	$MULTILANG_FrmBarraTipo5='Full: Advanced + Formul&aacute;rios e tela cheia';
	$MULTILANG_FrmBarraTipo1Summer='Basic: Caractere e par&aacute;grafo formatação';
	$MULTILANG_FrmBarraTipo2Summer='Standard: Basic + estilos de fonte';
	$MULTILANG_FrmBarraTipo3Summer='Extended: Standard + Tabelas, links e linhas';
	$MULTILANG_FrmBarraTipo4Summer='Advanced: Extended + FullScreen e Fonte HTML';
	$MULTILANG_FrmBarraTipo5Summer='Full: Advanced + Inserir imagens e v&iacute;deos';
	$MULTILANG_FrmTitBarra='Tipo de editor usado';
	$MULTILANG_FrmDesBarra='Indica o tipo de barra de ferramentas que aparece na parte superior do controle eo usu&aacute;rio para executar diferentes tarefas de edição. IMPORTANTE: Cada tipo de editor exige um espaço diferente na forma como ele deve implantar uma s&eacute;rie de &iacute;cones e opções diferentes';
	$MULTILANG_FrmFila='&uacute;nica linha para este objeto?';
	$MULTILANG_FrmTitFila='Practico deve usar uma linha completa para o objeto?';
	$MULTILANG_FrmDesFila='Permite visualizar o objecto numa &uacute;nica linha da tabela utilizada sob a forma';
	$MULTILANG_FrmLista='Lista de opções';
	$MULTILANG_FrmTitLista='Quais são as opções a serem escolhidas. Digite um caractere v&iacute;rgula s&oacute; para dizer Practico que colocar um valor vazio no in&iacute;cio. Deixe em branco para usar como padrão o primeiro registro fundada.      Enter _OPTGROUP_|Label to group some options and _OPTGROUP_ only to close groups of options.';
	$MULTILANG_FrmDesLista='Digite uma lista de opções separadas por v&iacute;rgulas. Se você precisa tomar a tabela de opções dinamicamente a partir de outra aplicação para utilizar os campos de fonte de dados para opções. Deve preencher as duas opções (lista fixa e fonte de dados), o resultado ser&aacute; a combinação';
	$MULTILANG_FrmDesLista2='V&iacute;rgulas separados';
	$MULTILANG_FrmOrigen='Origem da lista de opções';
	$MULTILANG_FrmTitOrigen='Você deve especificar a mesma fonte (tabela) a partir da lista de valores';
	$MULTILANG_FrmDesOrigen='De que são feitos campo das escolhas que exibe a lista';
	$MULTILANG_FrmTitOrigen2='O que &eacute; isto?';
	$MULTILANG_FrmOrigenVal='Lista de fonte de valores';
	$MULTILANG_FrmTitOrigenVal='Você deve especificar a mesma fonte (tabela) a partir da lista de opções';
	$MULTILANG_FrmDesOrigenVal='O campo a partir do qual os valores são tomadas internamente (a ser processada) para cada opção na lista.     If the field value contains _OPTGROUP_|Label this will create a group of options and if the value is  _OPTGROUP_ only then this will close the group of options.';
	$MULTILANG_FrmEtiqueta='Valor da etiqueta (ser&aacute; impressa no formul&aacute;rio em formato HTML)';
	$MULTILANG_FrmURL='IFrame URL';
	$MULTILANG_FrmDesURL='Digite o endereço da p&aacute;gina que ser&aacute; incorporado no IFrame';
	$MULTILANG_FrmInforme='Relat&oacute;rio vinculado';
	$MULTILANG_FrmFormulario='Subformul&aacute;rio ligado';
	$MULTILANG_FrmDesCampoVinculo='Coloque aqui o nome local campos (campo de formul&aacute;rio pai) a ser usado para dados de pesquisa na sub-param';
	$MULTILANG_FrmDesCampoForaneo='Coloque aqui o Foreign arquivado a partir do subformul&aacute;rio para ser usado para comparar ou dados de pesquisa no campo local para mostrar os dados.';
	$MULTILANG_FrmVentana='Criar uma janela para o objeto?';
	$MULTILANG_FrmDesVentana='NÃO &eacute; recomendado para ativar esse campo quando você deseja incorporar relat&oacute;rios do tipo GR&aacute;FICO';
	$MULTILANG_FrmLongMaxima='Comprimento m&aacute;ximo';
	$MULTILANG_FrmTit1LongMaxima='Quantos caracteres posso campo a loja?';
	$MULTILANG_FrmTit2LongMaxima='Valor entre 1 e N, 0 para desabilitar limites';
	$MULTILANG_FrmBtnGuardar='Adicionar ou atualizar o objeto / campo';
	$MULTILANG_FrmAgregaBot='Adicione botões e ações para formar';
	$MULTILANG_FrmTituloBot='T&iacute;tulo ou Tag';
	$MULTILANG_FrmDesBot='Texto para aparecer no botão';
	$MULTILANG_FrmEstilo='Estilo';
	$MULTILANG_FrmDesEstilo='Aparência gr&aacute;fica para o controle';
	$MULTILANG_FrmTipoAccion='Tipo de ação';
	$MULTILANG_FrmAccionT1='Ações internas';
	$MULTILANG_FrmAccionGuardar='Guardar dados';
	$MULTILANG_FrmAccionLimpiar='Dados limpo';
	$MULTILANG_FrmAccionEliminar='Apagar dados (requer um campo de valor &uacute;nico, mesmo escondido)';
	$MULTILANG_FrmAccionActualizar='Atualizar dados';
	$MULTILANG_FrmAccionRegresar='Volte para a &aacute;rea de trabalho';
	$MULTILANG_FrmAccionCargar='Carregar objetos';
	$MULTILANG_FrmAccionT2='Usu&aacute;rio definido';
	$MULTILANG_FrmAccionExterna='Em personalizadas.php ou qualquer outro m&oacute;dulo instalado';
	$MULTILANG_FrmAccionJS='JavaScript comando';
	$MULTILANG_FrmDesAccion='Comando a ser executado quando clicado controle. Para ações definidas &eacute; personalizadas.php dados do formul&aacute;rio ser&aacute; enviado para essa rotina para o processamento';
	$MULTILANG_FrmAccionCMD='Comando do usu&aacute;rio';
	$MULTILANG_FrmAccionDesCMD='Nome da ação que deve existir em personalizadas.php ou qualquer outro m&oacute;dulo que ir&aacute; processar as informações ou um comando JavaScript para ser executado de forma imediata para a App (se você precisar enviar algum parâmetro você poderia usar sigle cita em torno deles). Se você precisa carregar objetos Practicos como se forma um ou relat&oacute;rio que você poderia usar a mesma sintaxe usada para ementa itens: frm:XX:Par1:Par2:ParN o inf:XX...  H&aacute; um comando javascript dispon&iacute;vel chamado ImprimirMarco(\'PCO_MarcoImpresionXX\') que lhe permitem imprimir o conte&uacute;do da forma activa. Você pode usar comandos como PCO_VentanaPopup(\'http://www.google.com\',\'YourTitle\',\'toolbar=no, location=no, directories=no, status=no, menubar=no ,scrollbars=no, resizable=yes, fullscreen=no, width=640, height=480\'); . Verifique docs para um guia completo.';
	$MULTILANG_FrmDesPeso='Posição em que o campo &eacute; exibido na barra de status do formul&aacute;rio quando ele &eacute; exibido na tela. Ordem da esquerda para a direita';
	$MULTILANG_FrmBotDesVisible='Determina se o controle &eacute; vis&iacute;vel ou não para o usu&aacute;rio';
	$MULTILANG_FrmRetorno='T&iacute;tulo de retorno';
	$MULTILANG_FrmDesRetorno='O texto que aparece como um cabeçalho na &aacute;rea de trabalho depois de executar a ação indicada pelo usu&aacute;rio';
	$MULTILANG_FrmTxtRetorno='Texto retorno';
	$MULTILANG_FrmTxtDesRetorno='Texto completo com a descrição das medidas tomadas ou entregues à mensagem do usu&aacute;rio ap&oacute;s a execução de controle';
	$MULTILANG_FrmTxtRetornoIcono='&iacute;cone para o retorno';
	$MULTILANG_FrmTxtDesRetornoIcono='Definir um &iacute;cone para colocar na mensagem. Use AwesomeFonts notação.  I.E.:  fa-info-circle para mostrar um &iacute;cone de informações.';
	$MULTILANG_FrmTxtRetornoEstilo='Estilo CSS para a mensagem de retorno (se aplic&aacute;vel)';
	$MULTILANG_FrmConfirma='Confirmação Texto';
	$MULTILANG_FrmDesConfirma='Se o seu preenchimento, texto que aparecer&aacute; como uma execução de controle de alerta pop-up e esperando a confirmação do usu&aacute;rio para proceder';
	$MULTILANG_FrmBtnGuardarBut='Adicionar Ação / Botão';
	$MULTILANG_FrmDisCampos='Design Campos Gerais';
	$MULTILANG_FrmDesObliga='Note-se que os campos obrigat&oacute;rios devem ser vis&iacute;veis';
	$MULTILANG_FrmGuardaCol='Salvar coluna';
	$MULTILANG_FrmAumentaPeso='Aumento de peso (para baixo)';
	$MULTILANG_FrmDisminuyePeso='Diminuição de peso (para cima)';
	$MULTILANG_FrmHlpCambiaEstado='Alterar o estado';
	$MULTILANG_FrmAdvDelCampo='IMPORTANTE: Eliminar este campo os usu&aacute;rios não podem vê-lo e você não pode desfazer esta operação.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmTitComandos='Definição geral de ações e comandos';
	$MULTILANG_FrmTipoAcc='Tipo de ação';
	$MULTILANG_FrmAccUsuario='Ação do usu&aacute;rio';
	$MULTILANG_FrmOrden='Comando';
	$MULTILANG_FrmAdvDelBoton='IMPORTANTE: Ao remover o botão / usu&aacute;rios de ação não pode ver ou executar o comando associado a este e você não pode desfazer esta operação mais tarde.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmObjetos='Objetos e campos de dados';
	$MULTILANG_FrmDesObjetos='Adicionar um campo de objeto ou de dados';
	$MULTILANG_FrmDesCampos='Campos concepção geral';
	$MULTILANG_FrmAcciones='Ações, botões e comandos';
	$MULTILANG_FrmDesBoton='Adicionar botão ou ação';
	$MULTILANG_FrmDesAcciones='Definição geral de ações';
	$MULTILANG_FrmVolverLista='Voltar à lista de formul&aacute;rios';
	$MULTILANG_FrmErr1='Você deve digitar um t&iacute;tulo v&aacute;lido para o formul&aacute;rio.';
	$MULTILANG_FrmErr2='Por favor, indique um nome v&aacute;lido para a tabela de dados associado com o formul&aacute;rio.';
	$MULTILANG_FrmAgregar='Adicionar novo formul&aacute;rio';
	$MULTILANG_FrmActualizar='Atualizar as configurações iniciais';
	$MULTILANG_FrmDetalles='Defina os detalhes do formul&aacute;rio';
	$MULTILANG_FrmTitVen='T&iacute;tulo da janela';
	$MULTILANG_FrmDesTit='O texto que aparece na parte superior da janela';
	$MULTILANG_FrmHlp='Ajuda T&iacute;tulo';
	$MULTILANG_FrmDesHlp='O texto que aparece como uma legenda para o apoio dos';
	$MULTILANG_FrmTxt='Texto de Ajuda';
	$MULTILANG_FrmDesTxt='Texto completo com descrição função de resumo para o formul&aacute;rio. Texto introdut&oacute;rio para qualquer usu&aacute;rio';
	$MULTILANG_FrmImagen='Cor de fundo';
	$MULTILANG_FrmImagenDes='Se o seu navegador tem suporte HTML5 você pode escolher a cor de fundo. Se não você pode digitar um c&oacute;digo de cor hexadecimal i.e. #F2F2F2 ou seu nome como notação HTML i.e. LightGray';
	$MULTILANG_FrmNumeroCols='N&uacute;mero de colunas';
	$MULTILANG_FrmDesNumeroCols='Indica quantas colunas a serem implantados em campos quando o formul&aacute;rio &eacute; carregado';
	$MULTILANG_FrmCreaDisena='Criar e design';
	$MULTILANG_FrmTitForms='Formas definidos no sistema';
	$MULTILANG_FrmCamposAcciones='Campos e ações';
	$MULTILANG_FrmAdvDelForm='IMPORTANTE: Eliminar os usu&aacute;rios de formul&aacute;rio não pode acess&aacute;-lo novamente para operações de consulta ou de entrada de dados definidos. Você não pode desfazer esta operação. Isso tamb&eacute;m elimina alterações de design interno do formul&aacute;rio.\n'.$MULTILANG_Confirma;
	$MULTILANG_FrmAdvScriptForm='Editar scripts (Avançado)';
	$MULTILANG_FrmHlpFunciones='Todas as funções de JavaScript aqui definidos ser&aacute; inclu&iacute;do no formul&aacute;rio.<br>FrmAutoRun função deve ser existe (ainda vazio) porque ele ser&aacute; executado automaticamente em cada carregamento de formul&aacute;rio.';
	$MULTILANG_FrmCopiar='Faça uma c&oacute;pia';
	$MULTILANG_FrmAdvCopiar='Uma nova c&oacute;pia deste objeto ser&aacute; criado. Você tem certeza?';
	$MULTILANG_FrmMsjCopia='Agora você pode ir para editar o seu novo objeto. Uma c&oacute;pia foi maded como: ';
	$MULTILANG_FrmBordesVisibles='São os limites da tabela vis&iacute;vel?';
	$MULTILANG_FrmFormatoSalida='formato de sa&iacute;da';
	$MULTILANG_FrmFormatoEntrada='Formato de entrada';
	$MULTILANG_FrmPlantillaArchivo='Template nome para o arquivo';
	$MULTILANG_FrmDesPlantillaArchivo='O molde &eacute; a forma ou padrão que ser&aacute; renomeado o arquivo depois que o usu&aacute;rio enviado para o servidor. Isto pode incluir diferentes vari&aacute;veis a alterar o nome e a sua extensão como exemplos. Você tamb&eacute;m pode deix&aacute;-lo em branco para que os arquivos são carregados com o nome original das cargas do sistema pasta (não recomendado para segurança).';
	$MULTILANG_FrmErrorCargaGeneral='Ocorreu um erro durante o carregamento';
	$MULTILANG_FrmErrorCargaTamano='O tamanho do ficheiro &eacute; maior do que o tamanho permitido';
	$MULTILANG_FrmPlantillaEjemplos='<i>Alguns modificadores de formato:<li>_ORIGINAL_ : Nome do arquivo original</li><li>_CAMPOTABLA_ : Nome do campo vinculado sobre a mesa</li><li>_FECHA_ : Data real em formato AAAAMMDD</li><li>_HORA_ : Tempo real do servidor no formato HHMMSS</li><li>_MICRO_ : Microssegundos tempo</li><li>_HORAINTERNET_ : Internet tempo entre 000 e 999</li><li>_USUARIO_ : Nome de login do usu&aacute;rio</li><li>_EXTENSION_ : Extension de archivo cargado</li></i><b>Exemplos:</b><li>_USUARIO__ORIGINAL_: Muda o nome do arquivo original com o nome de login do usu&aacute;rio</li><li>formatos/_ORIGINAL_: Vai fazer o upload do arquivo em um Formatos / pasta usando o nome original. Esta pasta tem que ser criado por usu&aacute;rio administrador antes de usar o gerenciador de arquivos na pasta de cargas.</li><li>_FECHA__HORA__USUARIO_.pdf: Renomeia todo o arquivo original para algo como 20140502_135400_admin.pdf</li><li>reportes/_FECHA_.xls: Vai fazer o upload do arquivo para a pasta Reportes e ir&aacute; forçar a extensão final a .xls too.</li><li>foto__USUARIO_.jpg: Este arquivo ter&aacute; duas cordas fixas (foto_ at beginning and .jpg at the end) mas dentro deles Practico acrescentar&aacute; o nome de usu&aacute;rio. Preste atenção para o car&aacute;ter duplo sublinhado, um deles vai separar o nome eo outro &eacute; para o modificador formato. Você vai obter algo como foto_avelez.jpg</li>Uma regra geral: qualquer seqüência dentro do padrão que não corresponde a nenhum modificador formato ser&aacute; uma seqüência fixa no nome do arquivo.';
	$MULTILANG_FrmArchivoLink='[Abrir arquivo j&aacute; carregado]';
	$MULTILANG_FrmCanvasLink='[Abrir desenho j&aacute; adicionado]';
	$MULTILANG_FrmErrorCam='H&aacute; um erro com o dispositivo de v&iacute;deo. Por favor, verifique se você tem um dispositivo de v&iacute;deo ou webcam instalada ea sua resposta afirmativa ou Aceitar no seu browser para permitir Practico para usar o dispositivo.';
    $MULTILANG_FrmPestana='Formul&aacute;rios t&iacute;tulo da aba no qual o controle ser&aacute; publicado';
    $MULTILANG_FrmDesPestana='Atribuir a guia para este objeto no formul&aacute;rio. Practico automaticamente cria guias de acordo com os valores inseridos em cada objeto.  Se você especificar uma guia PCO_NoVisible, o eyelash não aparecerá para usuários padrão (será oculto), mas seus elementos serão normalmente adicionados ao formulário para processá-los.';
    $MULTILANG_FrmTagPersonalizado='Tag HTML personalizada';
    $MULTILANG_FrmDesTagPersonalizado='Permitir para adicionar parâmetros para o Tag HTML criado atrav&eacute;s do formul&aacute;rio por Practico. 
            <br><b>Seleccione listas (combo-box):</b>
                <li><u>data-live-search=true</u> Ativar campo de pesquisa em uma lista.</li>
                <li><u>multiple</u> Ativar m&uacute;ltipla escolha.</li>
                <li><u>data-selected-text-format=count</u> Contagem de itens selecionados em vez valores.</li>
                <li><u>data-max-options=#</u> M&aacute;ximo de elementos selecionados.
                <li><u>data-size=auto|#</u> Quantas linhas são mostrados na lista de itens.</li>
                <li><u>data-style=btn-primary|btn-info|btn-success|btn-warning|btn-danger|btn-inverse</u> estilo gr&aacute;fico
                <li><u>disabled</u> Desabilita o controle</li>
                <li><u>PCO_Delayed</u> If this keyword is found the load of the value is charged at onready time by javascript. Usefull when you have manual items in your combobox and you need to recover its value from the database on form load.</li>
                <BR>
                <b>Botones (command button):</b>
                <li><u>btn-group btn-group-justified</u> Expande control al ancho del contenedor.</li>
                <BR>
                <b>Checkboxes (checkbox):</b>
                <li><u>data-toggle=toggle</u> Convert this control to toggle button</li>
                <li><u>data-on=Text</u> Set text when the control is on. It could have HTML code and even icon declarations.</li>
                <li><u>data-off=Text</u> Same that previous property when control is off</li>
                <li><u>data-onstyle=Style</u> Set the style for the button: primary|info|warning|danger|success|default</li>
                <li><u>data-offstyle=Style</u> Same that previous property when control is off</li>
                <li><u>data-style=ControlType</u> Visual appearance:  ninguno|ios|android</li>
                <li><u>data-size=Size</u> Size of the control: large|normal|small|mini</li>
                <li><u>data-width=Width</u> Width of the control in pixels</li>
                <li><u>data-height=Height</u> Height of the control in pixels</li>';
    $MULTILANG_FrmBtnFull='Carga em FullScreen';
    $MULTILANG_FrmBtnObjetivo='HTML alvo';
    $MULTILANG_FrmActualizaAjax='recarregamento dinâmico';
    $MULTILANG_FrmActivarInline='<i>Na Linha</i> vista: Trabalho em conjunto com os elementos seguintes e anteriores';
    $MULTILANG_FrmActivarInlineDes='Permitir para colocar o controle usando um estilo interno para manter uma nova linha antes de publicar o controle sobre a forma. Monitores segundo o efeito desejado, elemento anterior ou seguinte deve ativar esta propriedade tamb&eacute;m';
    $MULTILANG_FrmTipoCopia='Selecione o tipo de c&oacute;pia que você quer';
    $MULTILANG_FrmTipoCopia1='Conectados';
    $MULTILANG_FrmTipoCopia2='XML com actual ID';
    $MULTILANG_FrmTipoCopia3='XML com dinâmica ID';
    $MULTILANG_FrmTipoCopiaDes1='On-line: Cria um novo objeto com um novo ID.  Isso inclui todos os componentes ligados para permitir que você criar novos formul&aacute;rios ou relat&oacute;rios a partir de um objeto existente. Isso funciona imediatamente sobre o sistema em execução, a clonagem do objeto selecionado.';
    $MULTILANG_FrmTipoCopiaDes2='XML com corrente ID: Exportações / Importações o objeto usando a sintaxe XML para permitir que você import&aacute;-lo sobre outro sistema usando o atual ID. &uacute;til se você deseja substituir os formul&aacute;rios ou relat&oacute;rios com aprimoramentos de outros sistemas.';
    $MULTILANG_FrmTipoCopiaDes3='XML com dinâmica ID: Exportações / Importações a sintaxe XML objeto usando, mas o novo ID para o objeto &eacute; gerado dinamicamente cada vez que você importar o arquivo, com um ID diferente. &uacute;til para replicar a funcionalidade de opção "Online", mas em relação aos sistemas diferentes.';
	$MULTILANG_FrmTipoCopiaExporta='Copiar / Exportação';
	$MULTILANG_FrmCopiaFinalizada='O processo de c&oacute;pia j&aacute; terminou. Você pode clicar no botão de download para obter o arquivo XML.';
	$MULTILANG_FrmImportar='Importar um projeto a partir de um arquivo';
	$MULTILANG_FrmImportarConflicto='H&aacute; conflitos que você precisa para resolver antes de continuar com o processo de importação';
	$MULTILANG_FrmImportarGenerado='Novo objeto foi criado';
	$MULTILANG_FrmImportarAlerta='Um elemento com a mesma identificação interna e tipo que você deseja importar foi fundada no sistema. O arquivo que você deseja importar ir&aacute; excluir o objeto real e ir&aacute; preenchê-lo com os elementos constantes dos autos. Recomendamos que você verifique previamente se você realmente deseja substituir o elemento antes de continuar.';
	$MULTILANG_FrmValOnCheck= 'Valor quando &eacute; activado';
	$MULTILANG_FrmValOffCheck='Valor quando não est&aacute; activada';
	$MULTILANG_FrmValCheckDes='Definir o valor a ser atribu&iacute;do ao campo que vai ser armazenado na base de dados de acordo com o estado de controlo';
	$MULTILANG_FrmEstiloPestanas='Estilo Tabs (se aplicável)';
	$MULTILANG_FrmEstiloTabs='Tabs (nav-tab)';
	$MULTILANG_FrmEstiloPills='Botões (nav-pills)';
	$MULTILANG_FrmEstiloOculto='Escondido';
	$MULTILANG_FrmTextoPlaceHolder='Eexto do espaço reservado';
	$MULTILANG_FrmDesPlaceHolder='Um texto para mostrar no campo quando este não tem um valor que ajudar os usuários para saber o que deve entrar lá';
	$MULTILANG_FrmOcultarEtiqueta='Ocultar o rótulo de campo na forma';
	$MULTILANG_FrmIdHTML='Identificador único do objeto em HTML';
	$MULTILANG_FrmValidaExtra='Caracteres adicionais permitidos';
	$MULTILANG_FrmValidaAyuda='Qualquer personagem aqui será permitido para o validador';
	$MULTILANG_FrmValida9='Números apenas 0-9 (inteiro)';
	$MULTILANG_FrmValida10='Somente charset no campo de validação extra';
	$MULTILANG_FrmNombreHTML='Aviso: este valor é usado para gerar o identificador exclusivo do elemento em HTML e gerar automaticamente todos os eventos dos controles e ferramentas vinculados ao seu formulário. Se você alterar esse valor, poderá perder a programação de eventos específicos e o JavaScript em geral que você fez antes da sua alteração.';
    $MULTILANG_FrmClaseContenedor='Classe CSS de Recipiente';
    $MULTILANG_FrmClaseContenedorDes='Indica se o contêiner do objeto tem algum CSS nativo ou bootstrap especifica para ser aplicado no momento do controle de exibição de diagrama.';
    $MULTILANG_FrmHuerfanos='Foram encontrados campos órfãos (fora do design visível do formulário).';
    $MULTILANG_FrmIDHTMDuplicado='Campos com ID HTML ou nome de campo no banco de dados duplicado foram encontrados.';
    $MULTILANG_FrmCamposAProposito='Esses campos estão lá e podem afetar a funcionalidade do formulário em JS ou ao processar seus dados. Se você tiver gerado campos desse tipo de campo de propósito, ignore essa mensagem. Os campos encontrados são:';
    $MULTILANG_FrmTipoMaquetacion='Type of layout';
    $MULTILANG_FrmTipoMaquetacionDes='Determine how Practico will make multi-column forms. Traditional: use tables and standard columns in HTML. Responsive: use columns based on bootstrap col classes, for which you must specify the class of each in the corresponding fields.';
    $MULTILANG_FrmTradicional='Traditional';
    $MULTILANG_FrmCampoHuerfano='This fields exists in the table linked to the form and doesnt have any field or object linked to them in the form or embeded forms';
    $MULTILANG_FrmDesplazarObjetos='Move down one position all the objects in the column below this element';
    $MULTILANG_FrmEstaSeguro='Are you sure?';


	//Informes
	$MULTILANG_InfErr1='Você deve especificar valores para os campos correspondentes a, pelo menos, uma s&eacute;rie de dados. <br> Se você não quer gerar um gr&aacute;fico, em seguida, você deve alterar o tipo de relat&oacute;rio a tabela de dados';
	$MULTILANG_InfErr2='Você deve digitar um t&iacute;tulo v&aacute;lido para o relat&oacute;rio.';
	$MULTILANG_InfErr3='Por favor, indique um nome v&aacute;lido para a categoria associada com o relat&oacute;rio.';
	$MULTILANG_InfErrCondicion='A condição especificada &eacute; inv&aacute;lido ou não tem pelo menos um lado para comparação.';
	$MULTILANG_InfErrCampo='Você deve digitar um nome de campo v&aacute;lido para a fonte de dados do relat&oacute;rio.';
	$MULTILANG_InfErrTabla='Você deve digitar um nome de tabela v&aacute;lido para a fonte de dados do relat&oacute;rio.';
	$MULTILANG_InfErr4='Você deve digitar um t&iacute;tulo v&aacute;lido ou r&oacute;tulo ou imagen para o botão.';
	$MULTILANG_InfErr5='Você deve digitar uma ação v&aacute;lida a ser executado quando o controle &eacute; ativado.';
	$MULTILANG_InfAgregaTabla='Adicionar uma nova tabela para o relat&oacute;rio';
	$MULTILANG_InfTablaManual='Digite uma tabela manualmente';
	$MULTILANG_InfDesTablaManual='Se você não quer selecionar uma tabela da lista top, você pode digitar aqui um nome de tabela. Essa opção &eacute; &uacute;til quando você precisa acessar informações em tabelas internas de Practico ou tabelas criadas por outros aplicativos';
	$MULTILANG_InfAliasManual='Especifique um alias manualmente';
	$MULTILANG_InfDesAliasManual='&uacute;til para definir o nome de uma tabela de consulta gerada a partir de um sub ou especificada manualmente';
	$MULTILANG_InfBtnAgregaTabla='Adicionar tabela';
	$MULTILANG_InfTablasDef='Tabelas definidas no presente relat&oacute;rio';
	$MULTILANG_InfAlias='Ali&aacute;s';
	$MULTILANG_InfAdvBorrado='IMPORTANTE: Se você excluir o objeto selecionado a consulta ou relat&oacute;rio poderia ser inconsistente.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfAgregaCampo='Adicionar um novo campo para o relat&oacute;rio';
	$MULTILANG_InfCampoDatos='Campo de dados';
	$MULTILANG_InfCampoManual='Especificar manualmente um campo';
	$MULTILANG_InfDesCampoManual='Se você não quer para selecionar um campo da lista top você pode digitar aqui um nome de campo. Essa opção &eacute; &uacute;til quando você precisa acessar informações em Practico campos internos ou campos criados por outros aplicativos';
	$MULTILANG_InfDesAliasManual2='&uacute;til para definir o nome de um campo gerado manualmente ou uma sub consulta agrupados';
	$MULTILANG_InfBtnAgregaCampo='Adicionar campo';
	$MULTILANG_InfCamposDef='Campos definidos neste relat&oacute;rio';
	$MULTILANG_InfAddCondicion='Adicionar uma nova condição para o relat&oacute;rio';
	$MULTILANG_InfPrimer='Primeiro campo ou valor';
	$MULTILANG_InfOperador='Operador de comparação';
	$MULTILANG_InfSegundo='Segundo campo ou valor';
	$MULTILANG_InfMayorQue='Maior que ';
	$MULTILANG_InfMenorQue='Menor que';
	$MULTILANG_InfMayorIgualQue='Maior ou igual';
	$MULTILANG_InfMenorIgualQue='Menor ou igual';
	$MULTILANG_InfDiferenteDe='Diferente';
	$MULTILANG_InfIgualA='Igual';
    $MULTILANG_InfPatron='Padrão de jogo (Usa% como coringa)';
	$MULTILANG_InfDesManual='Em todos os campos manuais você pode colocar expressões ou valores de cadeia de caracteres usando aspas duplas. Você pode comparar com vars de sessão colocar a vari&aacute;vel PHP.  i.e.: $PCOSESS_LoginUsuario, $Nombre_usuario, $Descripcion_usuario, $Nivel_usuario, $Correo_usuario, $LlaveDePasoUsuario.  Se você quiser usar vari&aacute;veis PHP no meio de uma seqüência de caracteres que você pode coloc&aacute;-lo entre chaves Ie: {$Variable} e eles serão substitu&iacute;dos pelo seu valor global.';
	$MULTILANG_InfOperador='Adicionar um agregador de expressões ou um operador l&oacute;gico ';
	$MULTILANG_InfOpParentesisA='Parêntese aberto';
	$MULTILANG_InfOpParentesisC='Parêntese perto';
	$MULTILANG_InfOpAND='E l&oacute;gico';
	$MULTILANG_InfOpOR='Ou l&oacute;gico';
	$MULTILANG_InfOpNOT='NOT';
	$MULTILANG_InfOpXOR='XOR';
	$MULTILANG_InfTitOp='Quando usar esta opção?';
	$MULTILANG_InfDesOp='Se você precisar de mais do que uma frase para adicionar aos seus resultados do grupo de filtragem status ou exigir v&aacute;rias condições de ter precedência sobre algumas operações, então você pode usar esta opção. Funciona de forma independente e deve ser adicionado como um registro separado da consulta';
	$MULTILANG_InfReco1='Conselho';
	$MULTILANG_InfReco2='Não se esqueça de adicionar ANDs seguido cada condição ligando chaves estrangeiras entre as diferentes tabelas do relat&oacute;rio, onde aplic&aacute;vel (normalmente quando você usa mais de uma tabela).';
	$MULTILANG_InfBtnAddCondic='Adicionar condição / operador';
	$MULTILANG_InfDefCond='Filtro e condições definidas no presente relat&oacute;rio';
	$MULTILANG_InfTitGrafico='Especifica tipos de tabelas a serem gerados pelo relat&oacute;rio';
	$MULTILANG_InfSeriesGrafico1='SERIES para o gr&aacute;fico';
	$MULTILANG_InfSeriesGrafico2='V&aacute;rios gr&aacute;ficos da s&eacute;rie deve devolver o mesmo n&uacute;mero de r&oacute;tulos';
	$MULTILANG_InfNomSerie='Nome da s&eacute;rie';
	$MULTILANG_InfCampoEtiqSerie='Campo etiqueta (eje X)';
	$MULTILANG_InfCampoValor='Campo de valor (deve ser num&eacute;rico)';
	$MULTILANG_InfVistaGrafico1='APARÊNCIA e distribuição';
	$MULTILANG_InfVistaGrafico2='Escolha de acordo com o n&uacute;mero de s&eacute;rie desejada';
	$MULTILANG_InfTipoGrafico='Tipo de gr&aacute;fico';
	$MULTILANG_InfGrafico1='Area';
	$MULTILANG_InfGrafico3='Barra';
	$MULTILANG_InfGrafico5='Linha';
	$MULTILANG_InfGrafico7='Dona (apenas uma s&eacute;rie)';
	$MULTILANG_InfActGraf='Formato de gr&aacute;fico atualização';
	$MULTILANG_InfAgrupa='Classificação e agrupamento';
	$MULTILANG_InfReco3='Utilize apenas os campos definidos na consulta.';
	$MULTILANG_InfCriterioAgrupa='Agrupamento de crit&eacute;rios';
	$MULTILANG_InfCriterioOrdena='Crit&eacute;rios de ordenação';
	$MULTILANG_InfTitAgrupa='Como os resultados serão agrupados?';
	$MULTILANG_InfDesAgrupa='Use esta opção somente se o relat&oacute;rio lida com operações tais como soma, m&eacute;dia ou contagem dentro dos campos exibidos. Eg SUM (field), AVG (field), COUNT (*). Em que casos inserir os campos (separados por v&iacute;rgula) deve agrupar os resultados';
	$MULTILANG_InfTitOrdena='Como os resultados serão classificados?';
	$MULTILANG_InfDesOrdena='Para classificar os resultados usando qualquer um dos campos adicionados. Os campos devem ser separados por v&iacute;rgulas para classificar os resultados, se você deseja depois de cada campo pode usar o modificador ASC ou DESC para indicar se ascendente ou descendente';
	$MULTILANG_InfActCriterios='Atualizar ordenação e agrupamento crit&eacute;rios';
	$MULTILANG_InfTitBotones='Adicione botões ou ações para cada registro';
	$MULTILANG_InfDelReg='Excluir registro';
	$MULTILANG_InfCargaForm='Carregar um formul&aacute;rio ID';
	$MULTILANG_InfHlpAccion='Se você deseja carregar um formul&aacute;rio usar essa sintaxe  ID:1:FieldForSearch<br>Para eliminar o tipo de registro associados a table.field usado para comparar-lo.';
	$MULTILANG_InfVinculo='Campo vinculado';
	$MULTILANG_InfDesVinculo='IMPORTANTE: N&oacute;s assumimos o primeiro campo ou coluna como um valor de chave &uacute;nica e prim&aacute;rio<br>
				para fazer a remoção ou formar operações de abertura.<br>
				Recomenda-se usar campos que tem realmente um valor &uacute;nico<br>
				a menos que você est&aacute; desejando operações do grupo.';
	$MULTILANG_InfDesPeso='Posição no botão que aparece dentro do conjunto no lado direito de cada registro. Ordem da esquerda para a direita.';
	$MULTILANG_InfFiltrar='Filtrar os resultados por condições espec&iacute;ficas';
	$MULTILANG_InfCampoAgrupa='Deixe você conjuntos de agrupamentos campos para operações de reporte soma, m&eacute;dia ou contagem e campos para a ordenação dos resultados';
	$MULTILANG_InfTablasOrigen='Tabelas de dados Fonte';
	$MULTILANG_InfCamposOrigen='Campos de Dados';
	$MULTILANG_InfCondiciones='Condições';
	$MULTILANG_InfPropGraf='Propriedades do Gr&aacute;fico';
	$MULTILANG_InfDesGraf='Define as propriedades e aparência do gr&aacute;fico exibido pelo relat&oacute;rio';
	$MULTILANG_InfDesAccion='Define as ações que podem ser executadas em cada registro exibido pelo relat&oacute;rio como excluir, abrir um formul&aacute;rio, funções de usu&aacute;rio, etc...';
	$MULTILANG_InfVolver='Voltar à lista de relat&oacute;rios';
	$MULTILANG_InfTitulo='T&iacute;tulo do relat&oacute;rio ou gr&aacute;fico';
	$MULTILANG_InfDesTitulo='O texto que aparece na parte superior do relat&oacute;rio gerado';
	$MULTILANG_InfDescripcion='Descrição';
	$MULTILANG_InfDesDescrip='Texto descritivo do relat&oacute;rio. Não em sua geração, mas &eacute; usado para orientar o usu&aacute;rio em sua seleção';
	$MULTILANG_InfCategoria='Categoria';
	$MULTILANG_InfDesCateg='Quando o usu&aacute;rio acessa o painel de sistema relata estes são classificados por categorias. Digite aqui um nome de categoria na qual pretende publicar este relat&oacute;rio para os usu&aacute;rios.';
	$MULTILANG_InfNivelUsuario='N&iacute;vel de Usu&aacute;rio';
	$MULTILANG_InfTodoUsuario='Todos os usu&aacute;rios';
	$MULTILANG_InfParam='Editar as configurações gerais do relat&oacute;rio';
	$MULTILANG_InfTitNivel='Quem pode ver este relat&oacute;rio?';
	$MULTILANG_InfDesNivel='Especifique o perfil de usu&aacute;rio deve ser para ver este relat&oacute;rio como dispon&iacute;veis.';
	$MULTILANG_InfAlto='Altura';
	$MULTILANG_InfTitAncho='Largura fixa Set?';
	$MULTILANG_InfDesAncho='Este valor tamb&eacute;m se aplica se você tiver especificado um valor Altura. Se você exigir que o relat&oacute;rio a aparecer dentro de um tamanho de largura fixa especificada em pixels, deixe em branco a ser implantado dados sem restrições de tamanho. No caso da imagem do gr&aacute;fico especifica seu tamanho.';
	$MULTILANG_InfTitAlto='Altura fixa Set?';
	$MULTILANG_InfDesAlto='Este valor tamb&eacute;m se aplica se você tiver especificado um valor de largura. Se você exigir que o relat&oacute;rio a aparecer dentro de um tamanho de largura fixa especificada em pixels, deixe em branco a ser implantado dados sem restrições de tamanho. No caso da imagem do gr&aacute;fico especifica seu tamanho.';
	$MULTILANG_InfHlpAnchoalto='Adicionar um <b>px</b> or <b>%</b> como você precisa';
	$MULTILANG_InfFormato='Formato final';
	$MULTILANG_InfTitFormato='Como este relat&oacute;rio &eacute; exibido?';
	$MULTILANG_InfDesFormato='Indica se o produto final ser&aacute; um relat&oacute;rio de tabela de dados ou um gr&aacute;fico.';
	$MULTILANG_InfActualizar='Atualizar relat&oacute;rio';
	$MULTILANG_InfVistaPrev='Antevisão';
	$MULTILANG_InfCargaPrev='Carga de pr&eacute;-visualização';
	$MULTILANG_InfHlpCarga='Esta opção ir&aacute; fechar o modo de design e ir&aacute; mostrar-lhe o relat&oacute;rio como ele ser&aacute; exibido a um utilizador da aplicação';
	$MULTILANG_InfErrInforme1='Você deve digitar um t&iacute;tulo v&aacute;lido para o relat&oacute;rio.';
	$MULTILANG_InfErrInforme2='Por favor, indique um nome v&aacute;lido para a categoria associada com o relat&oacute;rio.';
	$MULTILANG_InfTituloAgr='Adicionar um novo relat&oacute;rio ou gr&aacute;fico';
	$MULTILANG_InfDetalles='Defina os detalhes do relat&oacute;rio / gr&aacute;fico';
	$MULTILANG_InfDefinidos='Relat&oacute;rios / Gr&aacute;ficos j&aacute; definidas no sistema';
	$MULTILANG_InfcamTabCond='Campos, tabelas e Condições';
	$MULTILANG_InfAdvEliminar='IMPORTANTE: Eliminar este usu&aacute;rios de relat&oacute;rios não pode acess&aacute;-lo novamente. Você não pode desfazer esta operação. Isso tamb&eacute;m elimina alterações de design interno do relat&oacute;rio.\n'.$MULTILANG_Confirma;
	$MULTILANG_InfErrTamano='O relat&oacute;rio que você est&aacute; tentando gerar um relat&oacute;rio tipo de gr&aacute;fico, mas o designer não especificar a altura ea largura do gr&aacute;fico resultante.<br>Deve fornecer um tamanho v&aacute;lido de gr&aacute;fico para gerar uma imagem.';
	$MULTILANG_InfGeneraPDF='Permitir para exportar este relat&oacute;rio?';
	$MULTILANG_InfGeneraPDFInfoTit='Dispon&iacute;vel somente para relat&oacute;rios tabulares';
	$MULTILANG_InfGeneraPDFInfoDesc='Esta opção requer php_xml e php_zip extensões se você deseja exportar LibreOffice, OpenOffice ou arquivos do Office 2007. Se você ativar esta opção, o tempo de relat&oacute;rio poderia ser mais do que um relat&oacute;rio normal quando você tem um monte de registros em seus resultados, pois o usu&aacute;rio vai lançar a consulta para ver os registros na tela, e em seguida, lançar a mesma consulta, se ele quer export&aacute;-los.    OTHER WAYS TO EXPORT ARE AVAILABLE ACTIVATING THE DATATABLE SUPPORT FOR THIS REPORT.';
    $MULTILANG_InfVblesFiltro='As vari&aacute;veis globais necess&aacute;rias para filtro';
    $MULTILANG_InfVblesDesFiltro='Vari&aacute;veis PHP (sem car&aacute;ter d&oacute;lar $ e apenas separados por v&iacute;rgula) que devem ser taked do ambiente global para estar dispon&iacute;vel para o filtro na opção condittions enquanto você construir uma consulta';
    $MULTILANG_InfDataTableResXPag='registros por p&aacute;gina';
    $MULTILANG_InfDataTableViendoP='A p&aacute;gina de visualização';
    $MULTILANG_InfDataTableDe='de';
    $MULTILANG_InfDataTableFiltradoDe='filtrou-';
    $MULTILANG_InfDataTableRegTotal='total de registros';
    $MULTILANG_InfDataTableNoDatos='Sem dados dispon&iacute;veis na tabela';
    $MULTILANG_InfDataTableNoRegistros='Não h&aacute; registros que correspondam aos crit&eacute;rios de pesquisa';
    $MULTILANG_InfDataTableNoRegistrosDisponibles='Não h&aacute; registros dispon&iacute;veis';
    $MULTILANG_InfDataTableTit='apoio DataTables?';
    $MULTILANG_InfDataTableDes='Permitir a transformar o relat&oacute;rio em um DataTable para filtrar, pesquisar, ordenar e obter p&aacute;ginas de resultados de forma dinâmica';
    $MULTILANG_InfFormFiltrado='Formul&aacute;rio com vari&aacute;veis de filtro';
    $MULTILANG_InfFormFiltradoDes='Selecione uma forma projetados para entrar nas vari&aacute;veis de filtro para o relat&oacute;rio. Isso ajuda você a vincular um formul&aacute;rio que pedir aos utilizadores para alguns dados antes de carregar o relat&oacute;rio.';
    $MULTILANG_InfRetornoFormFiltrado='Ver o relat&oacute;rio filtrada';
    $MULTILANG_InfAutoajusteAncho='Auto-width para c&eacute;lulas geradas';
    $MULTILANG_InfBordesCelda='Desenhar borda de c&eacute;lula';
    $MULTILANG_InfBordesTodos='Todos os lados';
    $MULTILANG_InfBordesArriba='Top &uacute;nica';
    $MULTILANG_InfBordesAbajo='fundo, apenas';
    $MULTILANG_InfBordesArrAba='Cabeçalho e rodap&eacute;';
    $MULTILANG_InfBordesIzq='Apenas o lado esquerdo';
    $MULTILANG_InfBordesDer='Apenas o lado direito';
    $MULTILANG_InfBordesIzqDer='Lados esquerdo e direito';
	$MULTILANG_OrientacionPagina='Layout da p&aacute;gina';
	$MULTILANG_InfTamanoPapel='Tamanho do papel';
	$MULTILANG_InfReducir='Conte&uacute;do-size Auto';
	$MULTILANG_InfTitPersonalizar='Apresentação personalizada e layout (opcional)';
	$MULTILANG_InfEjecutarAccionEn='Executar esta ação em';
	$MULTILANG_InfPrecargarEstilos='Folhas de estilo CSS Preload Bootstrap';
	$MULTILANG_BtnEstiloSimple='Botão simples, estilo simples';
	$MULTILANG_BtnEstiloPredeterminado='Estilo padrão';
	$MULTILANG_BtnEstiloPrimario='Estilo primário';
	$MULTILANG_BtnEstiloFinalizado='Estilo de sucesso';
	$MULTILANG_BtnEstiloInformacion='Estilo de Informação';
	$MULTILANG_BtnEstiloAdvertencia='Aviso estilo';
	$MULTILANG_BtnEstiloPeligro='Estilo de perigo';
	$MULTILANG_InfEditableLinea='edit&aacute;vel on-line';
	$MULTILANG_InfPaginacionDatatable='Page size for DataTables';
	$MULTILANG_InfPaginacionDatatableDes='Tells Practico how many records should it show in default view of a datatable';
	$MULTILANG_InfCargaInforme='Load a report by ID';
	$MULTILANG_InfSubtotalesColumna='AutoSum column';
	$MULTILANG_InfSubtotalesColumnaDes='Tells Practico which is the column number to be used for the autosum in each page.  LEAVE IT IN BLANK TO AVOID ANY CALCULATION.';
	$MULTILANG_InfSubtotalesFormato='AutoSum format';
	$MULTILANG_InfSubtotalesFormatoDes='Tells Practico what is the output format for the autosum results.  <b>This allow basic HTML and templates</b> Example: _TOTAL_PAGINA_ show the total for the actual page, _TOTAL_INFORME_ shows the total of all report, _COLUMNA_ show the column number used for totalize values.  For example this HTML code shows the results centered and in bold: < div align=center>< b>Total page < i>(column: _COLUMNA_)< /i> _TOTAL_PAGINA_ Total report: _TOTAL_INFORME_< /b>< /div>';
	$MULTILANG_InfTituloArbitrario='Título arbitrário';
	$MULTILANG_InfTituloArbitrarioDes='Permite ignorar o título da coluna fornecido pelo mecanismo do banco de dados e, em vez disso, use esse valor como título no relatório enviado. <b> Permite variáveis básicas de HTML e PHP </b>';
	$MULTILANG_InfSQL='Se você adicionar qualquer conteúdo maior que 5 caracteres a este campo de script SQL, o gerador de relatórios omitirá qualquer configuração de tabelas, campos, condições ou qualquer outra definição de consulta que você tenha definido e tentará executar diretamente este Script e, a partir dele, gerar tabela de resultados. Você pode usar variáveis PHP na notação {$ Variable} para incluir variáveis de ambiente.';
	$MULTILANG_InfFormsUsan='Formulários detectados que usam esse relatório de maneira incorporada';
	$MULTILANG_InfTootipTitulo='Create a tooltip for graphic reports using the reports title';
    $MULTILANG_InfBotonPpio='Put in the first column';
    $MULTILANG_ExportaDT=' client side export tools?';
    $MULTILANG_ExportaDTDes='Allow to enable some options to this report to export its data in different formats.  The process will take only the data filtered by the user in the data table.';
    $MULTILANG_InfEncabezado='Rich text for the header';
    $MULTILANG_InfEncabezadoDes='In this field you can enter any rich text, links, images or another elements that will be used in the top of the report as a header or title';
    $MULTILANG_InfSinDatos='There is no data for this graph';
    $MULTILANG_InfTablaResponsive='Use a responsive layout';
    $MULTILANG_InfTablaResponsiveDes='Allow to draw a table in a 100% responsive format hidding the columns that overflow the content and converting them to a new child row.  Important: This mode disable any footer section for the table.';
    $MULTILANG_InfEnHome='Direct publishing for authorized users';
    $MULTILANG_InfBarraSuperior='Over the navigation bar alerts';


	//Menus
	$MULTILANG_MnuTitEditar='Editar item de menu';
	$MULTILANG_MnuSelImagen='Clique na imagem para selecionar';
	$MULTILANG_MnuPropiedad='Propriedades do item';
	$MULTILANG_MnuApariencia='APARÊNCIA E LOCAL DE CONFIGURAÇÃO';
	$MULTILANG_MnuTexto='Texto';
	$MULTILANG_MnuPadre='Pai';
	$MULTILANG_MnuSiAplica='Se aplica';
	$MULTILANG_MnuUbicacion='Localização desta opção';
	$MULTILANG_MnuArriba='Topmenu Poss&iacute;vel?';
	$MULTILANG_MnuEscritorio='&aacute;rea de Trabalho Poss&iacute;vel?';
	$MULTILANG_MnuCentro='M&eacute;dio Poss&iacute;vel?';
    $MULTILANG_MnuIzquierda='Sidebar Poss&iacute;vel?';
	$MULTILANG_MnuSeccion='Seção';
	$MULTILANG_MnuDesArriba='Você deve habilitar essa opção a ser exibido no menu superior-bar horizontalmente?';
	$MULTILANG_MnuDesEscritorio='Você deve habilitar essa opção para ser exibido como um &iacute;cone na &aacute;rea de trabalho usu&aacute;rios?';
	$MULTILANG_MnuDesCentro='Você deve habilitar essa opção para ser implantado na parte central do pedido, no prazo de janelas classificados / agrupados pelo valor definido no campo Seção?';
	$MULTILANG_MnuDesIzquierdo='Você deve habilitar essa opção para ser implantado na barra lateral do aplicativo';
    $MULTILANG_MnuDesImagen='Exibir uma lista de imagens dispon&iacute;vel no sistema';
	$MULTILANG_MnuComandos='Comandos e ações de configuração';
	$MULTILANG_MnuClic='Poss&iacute;vel clicar?';
	$MULTILANG_MnuURL='Est&aacute;tico URL';
	$MULTILANG_MnuTitURL='Traga a uma URL ou executar um javascript?';
	$MULTILANG_MnuDesURL='Digite o URL completo ou um comando definido javascript javascript: comando para ser substitu&iacute;do dentro de uma âncora HREF gerado em torno do objeto. Se você precisar passar parâmetros de cadeia para javascript comandos que você pode usar cuotes individuais';
	$MULTILANG_MnuTipo='Tipo de comando';
	$MULTILANG_MnuInterno='Interno';
	$MULTILANG_MnuPersonal='Pessoal';
	$MULTILANG_MnuObjeto='Objeto';
	$MULTILANG_MnuAccion='Interno ação / comando / object';
	$MULTILANG_MnuTitAccion='Digite um dos três poss&iacute;veis valores como se segue:';
	$MULTILANG_MnuDesAccion='1) Um objeto em Practico que você deseja conectar-se a esta opção do menu usando esta sintaxe frm:XXX  or  inf:XXX  onde você deve substituir XXX com o ID do objeto (formul&aacute;rio ID ou ID para o relat&oacute;rio),  2) AÇÃO internas no Practico onde você quer redirecionar o usu&aacute;rio (você pode ver na Practicos rodap&eacute; como admin), ou 3) CUSTOM comando: a secuence comando definido pelo usu&aacute;rio, este secuence deve existir no arquivo personalizadas.php ou qualquer outro m&oacute;dulo instalado.';
	$MULTILANG_MnuTitNivel='Quem pode ver esta opção?';
	$MULTILANG_MnuDesNivel='Especifique o perfil de usu&aacute;rio deve ser para ver esta opção dispon&iacute;vel.';
	$MULTILANG_MnuActualiza='Menu Reload';
	$MULTILANG_MnuErr='Ela exige, pelo menos, o campo de texto.';
	$MULTILANG_MnuAdmin='Administração menu principal';
	$MULTILANG_MnuAgregar='Adicionar opção de menu';
	$MULTILANG_MnuDefinidos='Secções e comandos de menu definido';
	$MULTILANG_MnuNivel='N&iacute;vel';
	$MULTILANG_MnuComando='Comando';
	$MULTILANG_MnuAdvElimina='IMPORTANTE: Eliminar este registro você poderia desvincular algumas opções do sistema.\n'.$MULTILANG_Confirma;
	$MULTILANG_MnuHlpComandoInf='Talvez você deseja adicionar ao comando deste srtring <b>:htm:Informes</b>  dizer Practico<br>que coloca todos os dados em formato HTML e com essa folha de estilo CSS';
	$MULTILANG_MnuHlpAwesome='Você pode usar a mesma sintaxe usada para os &iacute;cones do menu';
    $MULTILANG_MnuTgtBlank='Nova janela ou aba';
    $MULTILANG_MnuTgtSelf='Mesma janela ou o quadro que foi clicado';
    $MULTILANG_MnuTgtParent='Quadro pai ou janela';
    $MULTILANG_MnuTgtTop='Corpo cheio da janela';
    $MULTILANG_MnuTgt='Alvo (S&oacute; opções usando uma URL ou JavaScript comando)';
    $MULTILANG_ImagenMenu='Image: Selecione um &iacute;cone ou digite um caminho relativo';

	//Objetos, seguridad y otros
	$MULTILANG_ObjError='O tipo de objeto recebidas neste comando &eacute; desconhecido';
	$MULTILANG_SecErrorTit='Comandos e relat&oacute;rios de controle de segurança';
	$MULTILANG_SecErrorDes='Você tentou executar uma função, comando ou relat&oacute;rio para o qual você est&aacute; não autorizado.<br>Sistema estar&aacute; tomando um log de auditoria:';
	
	//Tablas
	$MULTILANG_TblError1='Problema de integridade de design';
	$MULTILANG_TblError2='DATABASE ERROR';
	$MULTILANG_TblError3='Durante o mecanismo de execução voltou a seguinte mensagem';
	$MULTILANG_TblAgrCampo='Adicionar campos na tabela de dados';
	$MULTILANG_TblAgrCampoTabla='Adicionar um campo para a mesa';
	$MULTILANG_TblEntero='N&uacute;mero inteiro';
	$MULTILANG_TblCadena='String (comprimento Max 255)';
	$MULTILANG_TblTexto='Text (Unlimited)';
	$MULTILANG_TblFecha='Date (without time)';
	$MULTILANG_TblTitNombre='Formato ajuda para nome de campo';
	$MULTILANG_TblDesNombre='Nome do campo sem traços, pontos, espaços ou caracteres especiais';
	$MULTILANG_TblLongitud='Comprimento';
	$MULTILANG_TblAutoinc='Autoincrement';
	$MULTILANG_TblDesLongitud='Este campo pode ser obrigat&oacute;ria, dependendo do tipo de dados a serem armazenados, tais como campos de corda tipo';
	$MULTILANG_TblDesLongitud2='Formato: Se você sempre precisa colocar uma barra invertida (barra invertida) ou um ap&oacute;strofo entre esses valores, coloque uma barra adicional (barra invertida). Para campos de enumeração ou conjunto, utilize o formato: \'a\',\'b\',\'c\'...';
	$MULTILANG_TblTitAutoinc='Alerta de chave prim&aacute;ria';
	$MULTILANG_TblDesAutoinc='Este valor pode ser definido apenas por administradores avançados que foram removidos por algum motivo o campo ID autoincrement padrão';
	$MULTILANG_TblNulos='Permitir valor nulo?';
	$MULTILANG_TblDefUsuario='Usu&aacute;rio definido';
	$MULTILANG_TblNulo='Nulo';
	$MULTILANG_TblFechaHora='Data atual';
	$MULTILANG_TblDesPredet='Formato: Apenas um valor, sem escape. Para strings usar aspas simples no in&iacute;cio e final';
	$MULTILANG_TblAgregando='Adicionar o campo';
	$MULTILANG_TblCamposDef='Os campos j&aacute; definido na tabela';
	$MULTILANG_TblTipoClave='Tipo de chave';
	$MULTILANG_TblNoElim='Não pode ser eliminado';
	$MULTILANG_TblAdvDelCampo='IMPORTANTE: Apagar a coluna selecionada da tabela tamb&eacute;m são apagados todos os dados armazenados nele, então você não pode desfazer esta operação.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrDel1='Erro remoção da mesa!';
	$MULTILANG_TblErrDel2='A tabela especificada não pode ser exclu&iacute;do. Algumas causas comuns são: <br> <li> &eacute; usado por qualquer um dos formul&aacute;rios ou relat&oacute;rios automatizados, nesse caso, você pode tentar a edição. <br> <li> A tabela tem relações definido pelo designer para outras tabelas de dados. <br> <li> papel definido pelo usu&aacute;rio para a sessão ativa não pode excluir objetos em Practico';
	$MULTILANG_TblErrCrear='Por favor, indique um nome v&aacute;lido para a tabela. Este não deve conter traços, pontos, espaços ou caracteres especiais';
	$MULTILANG_TblCrearListar='Criar tabelas de dados / Lista definidos no sistema';
	$MULTILANG_TblCreaTabla='Criar uma nova tabela no banco de dados';
	$MULTILANG_TblDesTabla='Uma tabela de dados &eacute; uma estrutura que permite que você armazene informações. Digite neste campo o nome da tabela sem traços, pontos, espaços ou caracteres especiais. CAPS SENS&iacute;VEIS';
	$MULTILANG_TblCreaTabCampos='Criar a tabela e definir campos';
	$MULTILANG_TblTitAsis='Usar assistente?';
	$MULTILANG_TblDesAsis='Permite seleccionar algumas tabelas comuns predefinidos';
	$MULTILANG_TblTablasBD='Tabelas definidos no banco de dados';
	$MULTILANG_TblRegistros='Registros';
	$MULTILANG_TblAdvDelTabla='IMPORTANTE: Apagar a tabela de dados tamb&eacute;m são apagados todos os registros armazenados nele, então você não pode desfazer esta operação.\n'.$MULTILANG_Confirma;
	$MULTILANG_TblErrPlantilla='Você deve selecionar um modelo a partir do qual você deseja criar sua nova tabela';
	$MULTILANG_TblAsistente='Assistente de geração de tabela';
	$MULTILANG_TblAsistNombre='Nome para a nova tabela';
	$MULTILANG_TblAsistPlant='Modelo selecionado';
	$MULTILANG_TblAsCampos='Os campos que contêm';
	$MULTILANG_TblTotCampos='Total de dom&iacute;nios';
	$MULTILANG_TblHlpAsist='Todas as tabelas e os campos podem ser personalizado no passo seguinte, <br> adicionar, remover ou alterar as propriedades daqueles que você deseja.';
    $MULTILANG_TblTipoCopia1='Estrutura &uacute;nica (CREATE Sentença)';
    $MULTILANG_TblTipoCopia2='Sentenças de dados (INSERT)';
    $MULTILANG_TblTipoCopia3='Estrutura e Dados (CREATE - INSERT Sentença)';
    $MULTILANG_TblImportar='Importar do arquivo';
    $MULTILANG_TblImportarSQL='Fazer upload de um SQL comprimido';
    $MULTILANG_TblSQLConsejo='Se você executar as sentenças SQL deste arquivo você poderia estar apagando, criando ou substituindo mesas e muitas outras informações, at&eacute; mesmo desenhos e outras coisas do que exportou em que os registros. <br><br><b>Recomendamos que você faça um backup antes de continuar.</b>';
    $MULTILANG_TblEjecutarSQL='Sentenças SQL executados neste arquivo (pode levar algum tempo)';
    $MULTILANG_TblDecodificarActual='Agrupamento ou charset para os registros reais ou tabela de dados';
    $MULTILANG_TblCodificar='Registros ENCODE antes de guard&aacute;-las para o arquivo de backup usando';
    $MULTILANG_TblCodificacionNINGUNO='NONE, usam o agrupamento tabela original ou charset';
    $MULTILANG_TblTransliteracion='Use car&aacute;ter transliteração';
    $MULTILANG_TblTransliteracionHlp='Se transliteração &eacute; ativado quando um personagem não pode ser representado no charset de destino, ele pode ser aproximado atrav&eacute;s de um ou v&aacute;rios personagens que procuram de forma semelhante. Se você decidir ignorar caracteres inv&aacute;lidos em seguida, ser&aacute; omitido, Caso contr&aacute;rio, a cadeia &eacute; truncada e, E_NOTICE &eacute; gerado e a função ir&aacute; retornar FALSE.';
    $MULTILANG_TblTranslit='Translitering';
    $MULTILANG_TblIgnora='Ignorando';
    $MULTILANG_TblAnaliza='Analisar tabelas';
    $MULTILANG_TblReparar='Reparação tabelas';
    $MULTILANG_TblOptimizar='Otimizar tabelas';
    $MULTILANG_TblVaciar='Vazio';
    $MULTILANG_TblVaciarAdv='Esta ação ir&aacute; excluir todos os registros nesta tabela, você tem certeza?';
    $MULTILANG_TblImportarXLS='Carregar a partir de planilha';
    $MULTILANG_TblXLSConsejo='Carregando e combinar campos em um arquivo de planilha com o seu banco de dados atual que você pode ser a exclusão, criando ou substituindo tabelas, registros e outras informações relacionadas, bem como projetos e outros elementos contidos nos registros associados. <br><br><b>&eacute; recomendado que você faça um backup antes de este processo antes de continuar.</b><br><br>A primeira linha da planilha deve conter como t&iacute;tulos o nome exato do campo na tabela da qual você deseja importar valores.';
    $MULTILANG_TblTablaImportacion='Por favor, selecione a tabela na qual você deseja importar os dados';
    $MULTILANG_TblCorrespondencia='A correspondência entre os campos e colunas de arquivo da tabela';
    $MULTILANG_TblApareaMsg='Confira os campos no lado esquerdo da tabela e acompanhado por seu nome da lista de seleção de coluna. Se for necess&aacute;rio fazer manuais os emparelhamentos visualizar acordo com as colunas existentes no arquivo na parte superior. <br> não pareado Campos ser&aacute; ignorado e preenchido com o valor padrão &eacute; levado para dentro do motor';
	$MULTILANG_TblPoliticaImportacion='<b>O que fazer se um registro que está sendo importado já existe?:</b><br>Especifique como você deseja que ele seja processado cada registro duplicado no sistema em caso Ao tentar importar Já no banco de dados.';
	$MULTILANG_TblIgnorarRegistro='Ignorar o registro';
	
	//Usuarios
	$MULTILANG_UsrCopia='Permissões de c&oacute;pia conclu&iacute;da. Por favor, verifique abaixo.';
	$MULTILANG_UsrDesPW='Senhas com condições m&iacute;nimas de segurança deve ter um comprimento de <b>pelo menos 8 caracteres</b>, n&uacute;meros, letras mai&uacute;sculas e min&uacute;sculas, como s&iacute;mbolos <font color=blue>$ * </font>. Para ter sua senha &eacute; considerado seguro por este sistema <b> deve cumprir pelo menos um n&iacute;vel de segurança 81%</b>';
	$MULTILANG_UsrCambioPW='Alterar A Senha';
	$MULTILANG_UsrAnteriorPW='Senha Antiga';
	$MULTILANG_UsrNuevoPW='Nova senha';
	$MULTILANG_UsrNivelPW='N&iacute;vel de segurança';
	$MULTILANG_UsrVerificaPW='Verifique A Senha';
	$MULTILANG_UsrHlpNoPW='O motor de autenticação est&aacute; definido para a ferramenta de texto externo.<br>
				A alteração de senha e atualizações de perfil de usu&aacute;rio são desabilitadas como deve ser gerenciado centralmente para você na ferramenta definida pelo administrador do sistema';
	$MULTILANG_UsrErrPW1='Você esqueceu de digitar qualquer um dos dados solicitados';
	$MULTILANG_UsrErrPW2='Você digitou duas senhas diferentes';
	$MULTILANG_UsrErrPW3='A chave para que você inseriu não atende as recomendações m&iacute;nimas de segurança';
	$MULTILANG_UsrErrPW4='The actual password doesnt match with the password registered in the system.  For security reasons your password wont change until you enter your actual password as verification.';
	$MULTILANG_UsrErrInf='O usu&aacute;rio j&aacute; tem a permissão selecionada';
	$MULTILANG_UsrAdmInf='Relat&oacute;rios de usu&aacute;rios Administração';
	$MULTILANG_UsrAgreInf='Adicionar um relat&oacute;rio ao menu do usu&aacute;rio';
	$MULTILANG_UsrInfDisp='Relat&oacute;rios dispon&iacute;veis';
	$MULTILANG_UsrAdvDel='IMPORTANTE: A exclusão do registro pode haver nenhuma ligação algumas opções do sistema para este usu&aacute;rio.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAdmPer='Gerenciamento de Direitos de Usu&aacute;rio';
	$MULTILANG_UsrCopiaPer='Inicialmente fazer um copiar permissões do usu&aacute;rio';
	$MULTILANG_UsrDelPer='Apenas eliminar permissões';
	$MULTILANG_UsrAgreOpc='Adicionar opção de menu do usu&aacute;rio';
	$MULTILANG_UsrSecc='Seções j&aacute; dispon&iacute;veis';
	$MULTILANG_UsrErrCrea1='O usu&aacute;rio digitou j&aacute; existe, verifique ou altere o logon entrou para a conta e tente novamente';
	$MULTILANG_UsrErrCrea2='Você esqueceu-se de entrar em qualquer dos dados solicitados, conforme necess&aacute;rio';
	$MULTILANG_UsrErrCrea3='A senha digitada deve ter pelo menos seis caracteres';
	$MULTILANG_UsrAdicion='A adição de usu&aacute;rios';
	$MULTILANG_UsrLogin='NickName / Login';
	$MULTILANG_UsrDesLogin='&uacute;nico login para identificar o usu&aacute;rio no sistema. CAPS SENS&iacute;VEIS';
	$MULTILANG_UsrNombre='Nome completo';
	$MULTILANG_UsrTitCorreo='Endereço de alertas e notificações';
	$MULTILANG_UsrDesCorreo='E-mail de poss&iacute;vel uso para o sistema de notificações autom&aacute;ticas em alguns m&oacute;dulos';
	$MULTILANG_UsrEstado='Estado inicial';
	$MULTILANG_UsrNivel='N&iacute;vel de acesso';
	$MULTILANG_UsrInterno='Usu&aacute;rio interno?';
	$MULTILANG_UsrDesInterno='Um usu&aacute;rio interno &eacute; para pessoas que trabalham dentro da empresa que implantar o ERP ou sistema. Um usu&aacute;rio externo &eacute;, por exemplo, para pessoas que &eacute; de um cliente ou outra empresa que efetuar login no sistema';
	$MULTILANG_UsrTitNivel='Perfil de segurança inicial';
	$MULTILANG_UsrDesNivel='Usu&aacute;rios perfil de segurança. ATENÇÃO: Esta opção &eacute; diferente de permissões de usu&aacute;rio individuais definidas pelo designer para os objetos criados. Esta p&aacute;gina s&oacute; se aplica às operações internas de Practico';
	$MULTILANG_UsrAudit1='Operações de rastreamento';
	$MULTILANG_UsrAudDes='Detalhes da ação';
	$MULTILANG_UsrAudUsrs='Monitoramento de transações para todos os usu&aacute;rios';
	$MULTILANG_UsrAudAccion='Com a ação';
	$MULTILANG_UsrAudUsuario='para o<b>usu&aacute;rio</b>';
	$MULTILANG_UsrAudDesde='De (Day / Month)';
	$MULTILANG_UsrAudHasta='a';
	$MULTILANG_UsrAudAno='Referindo auditoria ano';
	$MULTILANG_UsrAudIniReg='Comece no registro';
	$MULTILANG_UsrAudVisual='Vendo';
	$MULTILANG_UsrAudMonit='Modo de monitoramento';
	$MULTILANG_UsrAudHisto='Hist&oacute;ria de operações do usu&aacute;rio (do mais recente para o mais antigo)';
	$MULTILANG_UsrLista='Lista de usu&aacute;rios no sistema';
	$MULTILANG_UsrLisNombre='Ver somente os usu&aacute;rios cujo nome cont&eacute;m';
	$MULTILANG_UsrLisLogin='Ver somente os usu&aacute;rios cujo LOGIN cont&eacute;m';
	$MULTILANG_UsrFiltro='Devido ao n&uacute;mero de usu&aacute;rios registrados você deve filtrar a sa&iacute;da.<br>
				Digite o tipo de filtro desejado no topo e clique no botão correspondente.';
	$MULTILANG_UsrAcceso='&uacute;ltima acesso';
	$MULTILANG_UsrAdvSupr='IMPORTANTE: Você est&aacute; indo para excluir o usu&aacute;rio e perder links para os registros associados a este, esta ação não pode ser recuperado, a menos que você recriar o usu&aacute;rio com as mesmas credenciais mais tarde.\n'.$MULTILANG_Confirma;
	$MULTILANG_UsrAddMenu='Adicionar Menus';
	$MULTILANG_UsrAddInfo='Adicionar Relat&oacute;rios';
	$MULTILANG_UsrAuditoria='Auditar';
	$MULTILANG_UsrAgregar='Adicionar um usu&aacute;rio';
	$MULTILANG_UsrVerAudit='Vista de auditoria do usu&aacute;rio';
	$MULTILANG_UsrReset='Resetar a senha';
    $MULTILANG_UsrOlvideClave='Esqueci minha senha';
    $MULTILANG_UsrOlvideUsuario='Eu esqueci meu nome de usu&aacute;rio';
    $MULTILANG_UsrIngreseUsuario='Digite seu nome de usu&aacute;rio';
    $MULTILANG_UsrIngreseCorreo='Digite o e-mail cadastrado';
    $MULTILANG_UsrResetAdmin='Se você não tem um acesso bem sucedida para o sistema ap&oacute;s uma senha de restauração, você pode escrever para o administrador do sistema que poderiam redefinir a sua senha para você.';
    $MULTILANG_UsrAsuntoReset='Redefinição de acesso';
    $MULTILANG_UsrMensajeReset='Um e-mail com as informações para a restauração chaves do usu&aacute;rio e foi enviado. Lembre-se de verificar seu e-mail na sua pasta caixa de entrada e spam para ver as instruções.<br><br>Qualquer link para redefinir sua senha ir&aacute; expirar no dia seguinte ou quando esse link &eacute; utilizado com sucesso.<hr>O subjet para o e-mail ser&aacute; algo como : <b>['.$NombreRAD.'] '.$MULTILANG_UsrAsuntoReset.'</b>';
    $MULTILANG_UsrErrorReset='As informações inscritas para o processo de redefinição de senha era inv&aacute;lida, o nome de usu&aacute;rio ou e-mail inserido esquentar existe no sistema. Verifique os dados e tente novamente.';
    $MULTILANG_UsrResetLink='Siga este link para restaurar sua senha';
    $MULTILANG_UsrResetCuenta='Mensagem enviada para';
    $MULTILANG_UsrResetOK='Senha restaurado. Por favor, tente fazer o login novamente';
    $MULTILANG_UsrPerfil='perfil do usu&aacute;rio';
    $MULTILANG_UsrActualizarAdmin='Suas configurações diz que você deve mudar seu perfil para atualizar o endereço de e-mail para o usu&aacute;rio admin.<br>Por favor, v&aacute; ao menu de usu&aacute;rio superior e Clic sobre opção de nome de usu&aacute;rio para mud&aacute;-lo Super usu&aacute;rio ou.';
    $MULTILANG_UsrCreacionOK='O usu&aacute;rio conta foi adicionada. Agora &eacute; filtrada para adicionar qualquer opção de menu ou relat&oacute;rio que você precisa. Você pode cancelar esta operação se não &eacute; necess&aacute;rio atribuir neste exato momento.';
    $MULTILANG_UsrSaltarInformes='Ir para relat&oacute;rio sobre os direitos para este usu&aacute;rio';
    $MULTILANG_UsrSaltarMenues='Ir para direitos MENU para esse usu&aacute;rio';
    $MULTILANG_UsrEsPlantilla='Use isso como um usu&aacute;rio permissões modelo para os outros?';
    $MULTILANG_UsrEsPlantillaDes='Direitos de menu e relat&oacute;rios atribu&iacute;dos a esse usu&aacute;rio ser&aacute; copiado automaticamente durante cada entrada de pessoas a us&aacute;-lo como um modelo. Isto permite-lhe manter atualizados os perfis de usu&aacute;rio de acordo com modelos gerais.  Remember: template users cannot login into the system.';
    $MULTILANG_UsrPlantillaAplicar='Permissões de modelo para aplicar a cada entrada';
    $MULTILANG_UsrPlantillaAplicarDes='As permissões atribu&iacute;das ao usu&aacute;rio selecionado na lista que eles serão transferidos para este novo usu&aacute;rio cada um para fazer uma renda';
    $MULTILANG_UsrPermisoManual='Direitos manuais';
    $MULTILANG_UsrDesClaveACorreo='Por favor verifique se a conta de e-mail está correto. Esta conta será verificada porque nessa conta, vamos enviar uma senha aleatória para acessar o sistema';
    $MULTILANG_UsrFinRegistro='O seu processo de inscrição foi concluída com sucesso. Por favor, verifique sua caixa de entrada de correio onde você encontra uma mensagem de boas-vindas com uma senha aleatória para acessar o sistema <br>. Importante: Lembre-se de verificar a sua pasta de SPAM também, se você não vê nenhuma mensagem em sua caixa de entrada standar.';

	//Proceso de instalacion
	$MULTILANG_Instalacion='Processo de Instalação';
	$MULTILANG_SubtituloPractico1='Gerador de aplicações WEB';
	$MULTILANG_SubtituloPractico2='Livre e cross-plataforma';
	$MULTILANG_InstaladorAplicacion='Instalador do aplicativo';
	$MULTILANG_BienvenidaInstalacion='Bem-vindo ao processo de instalação';
	$MULTILANG_BienvenidaDescripcion='Este assistente ir&aacute; gui&aacute;-lo em cada passo das configurações iniciais para usar Practico como um ambiente visual para desenvolvimento de aplicações web';
	$MULTILANG_ResumenLicencia='Esta ferramenta &eacute; liberado sob GNU-GPL v2';
	$MULTILANG_AmpliacionLicencia='Uma c&oacute;pia online desta licença pode ser encontrada em diferentes formatos e idiomas no <a href="http://www.gnu.org/licenses/gpl-2.0.html">GNU site</a>';
	$MULTILANG_ChequeoPreprocesador='Verificar as definições de pr&eacute;-processador';
	$MULTILANG_VistaPreprocesador='Uma vista de sua configuração do PHP est&aacute; dispon&iacute;vel em <b> <a target="_blank" href="paso_i.php">[esta ligação]</a>';
	$MULTILANG_CumplirRequisitos='Deve atender aos seguintes';
	$MULTILANG_CumplirPDO='Extensão PDO ativado';
	$MULTILANG_CumplirDrivers='PDO Driver para o tipo de motor de seu banco de dados de destino';
	$MULTILANG_CumplirGD='GD Extensão 2 + manipulação de gr&aacute;ficos e suporte para FreeType 2 +.<li>SimpleXML extension.<li>POSIX extension';
	$MULTILANG_ChequeoDirectorios1='Verificando diret&oacute;rios';
	$MULTILANG_ChequeoDirectorios2='Os seguintes arquivos e diret&oacute;rios devem ter permissões de gravação para o aplicativo para funcionar corretamente';
	$MULTILANG_ErrorEscritura='<b> erros encontrados quando se tenta escrever para os diret&oacute;rios de instalação! </b>: <br> caminho regra deve pertencer ao usu&aacute;rio a execução de scripts de webserver pr&aacute;ticos (normalmente apache <br> www, www-data ou semelhante) e tem 755 permissões para pastas e 644 casos para. <br> Uma maneira r&aacute;pida de atualizar essas permissões podem ser executados a partir da raiz dos comandos Practico: <li> find. -type d-exec chmod 755 {} \; (alterar todas as permissões de pasta) <li> find. -type f-exec chmod 644 {} \; (alterar todas as permissões de arquivo) <li> chown-R www-data * (assumindo que www-data &eacute; o usu&aacute;rio que executa o serviço de web)';
	$MULTILANG_ProbarNuevamente='Teste novamente';
	$MULTILANG_ConfiguracionDescripcion='Especifique as definições pretendidas para aplicativos de usu&aacute;rio armazenar e informações gerados por pr&aacute;ticas, bem como outras opções importantes da ferramenta. Esta janela ser&aacute; apresentada apenas uma vez por isso não deixe de preencher e confirmar todas as informações necess&aacute;rias';
	$MULTILANG_PuertoNoPredeterminado='(se não o padrão)';
	$MULTILANG_AyudaTitMotor='MySQL eu MariaDB';
	$MULTILANG_AyudaDesMotor='Motores são oficiais. Acima deles &eacute; o desenvolvimento e teste da ferramenta, mas graças a PDO você pode usar a ferramenta em outros motores pode ser necess&aacute;rio fazer ajustes para essas operações espec&iacute;ficas.';
	$MULTILANG_AyudaTitBD='O banco de dados j&aacute; deve existir';
	$MULTILANG_AyudaDesBD='Para motores diferentes que você deve ter criado primeiro banco de dados SQLite. Por apenas SQLite necess&aacute;ria para especificar o nome do arquivo associado BD (por exemplo practico.sqlite3) e Practico tentar&aacute; criar para você o arquivo se você tiver as permissões apropriadas no seu servidor web.';
	$MULTILANG_PrefijoCore='Tabelas internas prefixo';
	$MULTILANG_PrefijoApp='Tabelas de aplicativos prefixo';
	$MULTILANG_AyudaTitPreCore='A sua não &eacute; recomendado um valor vazio ou casos superiores';
	$MULTILANG_AyudaDesPreCore='';
	$MULTILANG_AyudaTitPreApp='Importante';
	$MULTILANG_AyudaDesPreApp='O prefixo usado para tabelas do aplicativo pode ser usado para separar diferentes instalações pr&aacute;ticas no mesmo banco de dados ou pode ser deixado vazio para conectar-se / se integrar com outras aplicações pr&aacute;ticas pr&eacute;-existente. Não recomendado mai&uacute;scula para a compatibilidade entre os motores.';
	$MULTILANG_AyudaLlave='Valor Entrar para contas de usu&aacute;rio';
	$MULTILANG_NotasImportantesInst1=' <u>IMPORTANTE 1 </u>: O banco de dados utilizado para Practico j&aacute; deve existir para se conectar a ele e gerar as estruturas necess&aacute;rias. Verifique com o seu provedor de hospedagem ou administrador do sistema como criar um banco de dados com privil&eacute;gios suficientes para trabalhar com Practico. <br> <br> <u> IMPORTANTE 2 </u>: O instalador ir&aacute; remover todas as tabelas existentes na base de dados indicada e que correspondem aos nomes de tabelas que Practico usa. Se você acha que pode ter informações importantes neles &eacute; recomendado fazer um backup antes de prosseguir. Para compartilhar um &uacute;nico banco de dados entre diferentes instalações Practico você pode alterar os prefixos das tabelas utilizadas por cada.';
	$MULTILANG_ParametrosApp='Parâmetros para a sua aplicação';
	$MULTILANG_ParamNombreEmpresaLargo='Nome completo da sua organização ou empresa';
	$MULTILANG_ParamNombreEmpresa='Nome curto da sua organização ou empresa';
	$MULTILANG_ParamFechaLanzamiento='Data de implantação';
	$MULTILANG_ParamNombreApp='Nome do aplicativo';
	$MULTILANG_ParamVersionApp='Versão de lançamento inicial de sua aplicação';
	$MULTILANG_AyudaTitNomEmp='Nome para exibir no topo';
	$MULTILANG_AyudaDesNomEmp='Este texto ser&aacute; usado nos relat&oacute;rios e &aacute;reas de aplicação que requerem um nome para identificar sua organização.';
	$MULTILANG_AyudaTitNomApp='Nome descritivo';
	$MULTILANG_AyudaDesNomApp='O nome especificado sempre aparece na parte superior de sua aplicação.';
	$MULTILANG_NotasImportantesInst2='<u>IMPORTANTE</u>: Outros parâmetros, como nome longo e curto de sua empresa, data de lançamento, textos de licença e os cr&eacute;ditos poderão ser modificados posteriormente nas opções dispon&iacute;veis para o usu&aacute;rio administrador.';
	$MULTILANG_AyudaTitCaptcha='Palavra Comprimento';
	$MULTILANG_AyudaDesCaptcha='Indica o n&uacute;mero de s&iacute;mbolos usados na palavra de segurança que os usu&aacute;rios devem digitar para acessar o sistema cada.';
	$MULTILANG_ModoDepuracion='Modo de depuração';
	$MULTILANG_AyudaTitDebug='Mostrar erros e avisos';
	$MULTILANG_AyudaDesDebug='Para zonas de produção, esta opção deve estar desligado. Quando você ativar esse valor, Practico ir&aacute; mostrar-lhe durante a execução do aplicativo todos os erros e mensagens que podem ser gerados pelo pr&eacute;-processador de hipertexto - PHP';
	$MULTILANG_AyudaTitDebugBD='Salvar registro de consulta';
	$MULTILANG_AyudaDesDebugBD='Para locais de produção, esta opção deve estar desativada. Ao ativar esse valor, o Practico salva uma cópia de todas as consultas e transações enviadas ao banco de dados por meio do módulo de auditoria.';
	$MULTILANG_MotorAuth='Mecanismo de autenticao';
	$MULTILANG_AuthPractico='Internos (Tabelas Practico usando MD5)';
	$MULTILANG_AuthLDAP='LDAP (servidor de diret&oacute;rio)';
	$MULTILANG_AuthFederado='Federated (Veja configuração sob parâmetros de aplicação)';
	$MULTILANG_AyudaDesAuth='Usando um mecanismo de autenticação diferente Practico não impede a criação de usu&aacute;rios da ferramenta. O motor de popa vai servir como um m&eacute;todo para validar o login ea senha correspondente como um m&eacute;todo de autenticação centralizada, mas as outras caracter&iacute;sticas do perfil são retirados do usu&aacute;rio Practico. A alteração de senha Practico ser&aacute; desativado apenas para ser controlado pelo motor externo. O usu&aacute;rio administrador permanecer&aacute; sempre autônoma para manter os erros de configuração de controle de acesso.';
	$MULTILANG_AyudaTitCript='Tipo de criptografia de chave usado pelo motor';
	$MULTILANG_AyudaDesCript='Especifica o tipo de criptografia utilizado por o sistema de autenticação a ser utilizado. Practico ir&aacute; criptografar o valor da chave digitada pelo usu&aacute;rio antes de enviar o motor de verificação.';
	$MULTILANG_AlgoritmoCripto='Algoritmo de encriptação';
	$MULTILANG_Dominio='Dom&iacute;nio';
	$MULTILANG_UO='Unidade organizacional ou contexto';
	$MULTILANG_AyudaDesLdapIP='Digite o endereço IP do servidor ou nome de diret&oacute;rio, onde ele pode ser resolvido.';
	$MULTILANG_AyudaDesLdapDominio='Dom&iacute;nio usado pelo servidor. Exemplo: Este ser&aacute; criado midominio.com.co internal chain dc=midominio,dc=com,dc=co';
	$MULTILANG_AyudaDesLdapUO='Usu&aacute;rio conexão de contexto. Deve existir no servidor LDAP, eg people, sales, marketing, etc.';
	$MULTILANG_TitInsPaso3='Escrevendo de configuração e conexão com banco de dados';
	$MULTILANG_DesInsPaso3='Estou escrevendo arquivo configuracion.php localizado em / core com os parâmetros especificados e est&aacute; sendo testado Conecta-se ao banco de dados especificado.';
	$MULTILANG_ErrorEscribirConfig='<b>Erros encontrados ao tentar escrever o arquivo de configuração! </b>: <br> Se você quiser uma alternativa pode ser para mudar seus pr&oacute;prios valores padrão contido no n&uacute;cleo arquivo / configuracion.php ou ws_llaves.php ou core / ws_oauth.php dependendo de suas mudanças desejadas.<br> <br> Você tamb&eacute;m pode alterar as permissões de arquivo para configuracion.php e tente novamente com este assistente.';
	$MULTILANG_ErrorConexBD='<b> encontrados erros ao se conectar ao banco de dados! </b>: <br> Verifique os valores inseridos na etapa anterior e tente novamente.';
	$MULTILANG_InfoPaso3='<b> Tudo parece bem com a configuração b&aacute;sica PDO. </b> <br> O &uacute;ltimo passo &eacute; dizer ao assistente de instalação como tentar seu banco de dados:<br><br>
				<li><b>1.</b> Adicionar dados iniciar o banco de dados, o que inclui o usu&aacute;rio inicial (admin), menus e outros registros em tabelas Practico Core. Esta &eacute; a melhor escolha para as novas instalações.
				<li><b>2.</b> Deixar o banco de dados, uma vez que &eacute;, indicando que nenhuma operação &eacute; para ser executada na base de dados. Essa opção &eacute; &uacute;til quando se tenta instalar mais de um banco de dados que cont&eacute;m aplicativos projetados e de usu&aacute;rios ativos. Ele tamb&eacute;m pode ser entendido como um banco de dados em branco para novas instalações não vai mesmo os usu&aacute;rios de acesso e opções para selecionar.';
	$MULTILANG_BtnAplicarBD='1. Adicione informações de inicial para o BD';
	$MULTILANG_BtnNoAplicarBD='2. Não modifique o BD conectado';
	$MULTILANG_ExeScripts='Os scripts de banco de dados em execução (se aplic&aacute;vel)';
	$MULTILANG_ErrorScripts='Erro ao executar a consulta no banco de dados';
	$MULTILANG_IrInstalacion='V&aacute; para a sua instalação Practico';
	$MULTILANG_Totalejecutado='Total de consultas executado';
	$MULTILANG_MsjFinal1='Se esta &eacute; uma nova instalação pode entrar no sistema atrav&eacute;s <b> credenciais admin / admin </ b> e, em seguida, mudar como você deseja.';
	$MULTILANG_MsjFinal2='Lembre-se de remover completamente o diret&oacute;rio de instalação (folder / ins) </b> </u> para evitar que outra pessoa executar esses scripts novamente em um sistema de produção pode causar qualquer dano.';
	$MULTILANG_MsjFinal2='Resumo das operações executadas';
	$MULTILANG_AuthLDAPTitulo='Login baseado LDAP';
	$MULTILANG_AuthOauthPlantilla='usu&aacute;rio do modelo';
	$MULTILANG_AuthOauthId='ID Cliente';
	$MULTILANG_AuthOauthSecret='Secreto Cliente';
	$MULTILANG_AuthOauthURI='URI Redireccionar';
	$MULTILANG_OauthTitURI='Antes de continuar, você deve registrar um novo aplicativo com o prestador obter uma ID, Segredo e URI a config do serviço auth. O URI para registrar &eacute; calculado automaticamente pelo Practico em cada campo URI para este formul&aacute;rio.';
	$MULTILANG_OauthDesURI='Importante: O seu retorno URI deve estar sob um dom&iacute;nio ou IP p&uacute;blico porque seu provedor ter&aacute; que ligar com isso. Este URI &eacute; criado automaticamente monitores segundo o caminho durante o tempo de instalação. Clic sobre cada logotipo provedores para ir ao seu site registro API.';
	$MULTILANG_OauthPredeterminado='Uma vez registrado qualquer provedor de OAuth, você pode configurar o sistema para que as opções OAuth são os apresentados por padrão quando o login do painel de configurações.';
	$MULTILANG_BuscarActual='Procurar por atualizações automaticamente';
	$MULTILANG_DescActual='Pesquisar aleatoriamente em logins de administrador para verificar se h&aacute; novas versões Practicos. Esta opção poderia virar um pouco mais lentos cargas de administração, enquanto verifica se h&aacute; novas versões';
	$MULTILANG_ConfGraficas='Alterar configurações gr&aacute;ficas';
	$MULTILANG_UsuariosAdmin='Super usuários';
	$MULTILANG_UsuariosAdminDes='Uma vírgula lista dos usuários que são os administradores da plataforma e designers de aplicativos separados. Se você deseja remover o usuário admin certifique-se de que você tem um outro super usuário ou você vai perder os direitos de administrador';
	$MULTILANG_PermitirReseteoClave='permitem recuperar senhas';
	$MULTILANG_DesPermitirReseteoClave='Coloca uma opção de recuperação de senha na janela de login que permitem aos usuários abrir um assistente de recuperação de senha. Esta opção está disponível apenas para o motor auth interna Practico.';
	$MULTILANG_PermitirAutoRegistro='Permitir que os usuários auto inscrever-se no sistema';
	$MULTILANG_DesPermitirAutoRegistro='Coloca uma opção de inscrição na janela de login que permitem aos usuários abrir um formulário para auto-registo no sistema. Esta opção está disponível apenas para o motor auth interna Practicos.';
	$MULTILANG_UsuarioAutoRegistro='usuário do modelo de auto-inscrever';
	$MULTILANG_DesUsuarioAutoRegistro='Diz que o usuário será usado para os direitos dos utilizadores de auto-registrados';
	$MULTILANG_NoRecomendado='Não recomendado por motivos de segurança';
	$MULTILANG_UbicacionOauth='Prefered location for Oauth options at login time';
	$MULTILANG_OauthOpcionBoton='As a button that open the OAuth providers';
	$MULTILANG_OauthOpcionDirecta='As extra options directly over standar login window';

	//API-Webservices
	$MULTILANG_WSErrTitulo='Practico WebServices - Erro';
	$MULTILANG_WSErr01='[Cod. 01] chave inv&aacute;lida';
	$MULTILANG_WSErr02='[Cod. 01] Valor secreto não &eacute; v&aacute;lido';
	$MULTILANG_WSErr03='[Cod. 03] Arquivo funções WebServices não encontrado';
	$MULTILANG_WSErr04='[Cod. 04] Chave consumidores Webservice est&aacute; vazio ou nulo. Verifique o valor que você enviou ou o seu processo de instalação Practico.';
	$MULTILANG_WSErr05='[Cod. 05] A identificação de serviço, função ou m&eacute;todo não pôde ser executada, &eacute; uknown ou est&aacute; vazio.';
	$MULTILANG_WSErr06='[Cod. 06] Você não tem permissão para executar o serviço: ';
	$MULTILANG_WSErr07='[Cod. 07] Acesso não autorizado API para o endereço: ';
	$MULTILANG_WSErr08='[Cod. 08] Acesso não autorizado API para o dom&iacute;nio: ';
	$MULTILANG_WSConfigButt='chaves WebServices';
	$MULTILANG_WSLlavesDefinidas='<b>Chaves de consumo WebServices</b> (um para cada linha)';
	$MULTILANG_WSLlavesAyuda='Essas são as chaves webservices que permitem usar Practico Webservices ou serviços personalizados usu&aacute;rio. Não &eacute; necess&aacute;rio adicionar a chave de acesso de configuração porque isso &eacute; permitido por padrão sobre todos os dom&iacute;nios e funções';
	$MULTILANG_WSLlavesNuevo='Adicionar um novo cliente API';
	$MULTILANG_WSLlavesBorrar='Você est&aacute; indo para eliminar as chaves de API selecionados. Qualquer pedido de conexão externa usando o que as chaves serão proibidos por Practico. Esta operação não pode ser desfazer mais tarde, você tem certeza?';
	$MULTILANG_WSLlavesNombre='Nome do cliente';
	$MULTILANG_WSLlavesLlave='Chave';
	$MULTILANG_WSLlavesSecreto='Segredo';
	$MULTILANG_WSLlavesURI='URI Redireccionar';
	$MULTILANG_WSLlavesDominio='dom&iacute;nio(s) autorizado';
	$MULTILANG_WSLlavesIP='IP Autorizado(s)';
	$MULTILANG_WSLlavesFunciones='Serviços permitidos';
	$MULTILANG_WSLlavesAsterisco='(*) asterisco para qualquer';


	//OAuth
	$MULTILANG_OauthButt='OAuth Autentication';
	$MULTILANG_PreferirOauth='OAuth apresentar as opções padrão durante o login';
	$MULTILANG_ProtoTransporte='Protocolo de transporte preferido';
	$MULTILANG_ProtoTransAUTO='Detecção autom&aacute;tica de URL';
	$MULTILANG_ProtoTransHTTP='Padrão HTTP';
	$MULTILANG_ProtoTransHTTPS='HTTP garantido';
	$MULTILANG_ProtoDescripcion='Autodetect ir&aacute; verificar URLs usadas para acessar e ativar ou desativar SSL, padrão HTTP permitir que pessoas com certs auto-assinados para se conectar com o Practicos auth webservice. Este &eacute; um modo inseguro, mas muito eficaz se você precisar acessar. HTTP requieres garantidos um certificado SSL v&aacute;lido por uma CA em seu servidor web.';

	//Login Federado
	$MULTILANG_TitFederado='Login federado';

	//Modulo de monitoreo
	$MULTILANG_MonTitulo='Sistema de monitoramento';
	$MULTILANG_MonPgInicio='P&aacute;gina inicial';
	$MULTILANG_MonConfig='Monitor de configure';
	$MULTILANG_MonNuevo='Adicionar um novo monitor';
	$MULTILANG_MonCommShell='Comando Shell';
	$MULTILANG_MonCommSQL='SQL Query';
	$MULTILANG_MonDesTipo='Este &eacute; o elemento que você deseja adicionar à p&aacute;gina de monitoramento';
	$MULTILANG_MonMetodo='M&eacute;todo utilizado';
	$MULTILANG_MonSaltos='Freios linha';
	$MULTILANG_MonTamano='Font size SQL';
	$MULTILANG_MonOcultaTit='T&iacute;tle hidding';
	$MULTILANG_MonCorreoAlerta='Alertas de e-mail';
	$MULTILANG_MonAlertaSnd='Mais s&oacute;lida alerta';
	$MULTILANG_MonMsLectura='Milissegundos para leitura';
	$MULTILANG_MonDefinidos='P&aacute;ginas e Monitores definido';
	$MULTILANG_MonErr='Campo de nome &eacute; obrigat&oacute;rio';
	$MULTILANG_MonEstado='O estado do sistema';
	$MULTILANG_MonAcerca='&copy; Sistema de monitoramento baseado em <a target="_blank" href="http://www.practico.org" style="color:#FFFFFF"><font color=white><b>Practico.org</b></font></a>';
	$MULTILANG_AplicaPara='Isto aplica-se para: ';
	$MULTILANG_MonLinea='ON LINE';
	$MULTILANG_MonCaido='DOWN';
	$MULTILANG_MonAlertaVibrar='Vibrar em dispositivos móveis';
	$MULTILANG_MonSensorRango='Sensor em uma faixa';
	$MULTILANG_MonModoCompacto='use o modo compacto';

    //Modulo de correos
    $MULTILANG_MailIntro1='Mensagem plataforma autom&aacute;tica';
    $MULTILANG_MailIntro2='Detalhes sobre essa mensagem poderia estar dispon&iacute;vel no sistema <span style="font-weight: bold;">'.$NombreRAD.'</span> usando seu nome de usu&aacute;rio e senha.';
    $MULTILANG_MailIntro3='Esta mensagem foi entregue por um sistema autom&aacute;tico, por favor não responder a ele.';
    $MULTILANG_MailIntro4='Lembre-se que nossos mensagens nunca lhe perguntar sobre informações pessoais, chaves de segurança por e-mail</span>, não responder qualquer mensagem ou preencher qualquer formul&aacute;rio que lhe perguntar sobre esse tipo de informação fora de nosso '.$NombreRAD.' sistema.';
    $MULTILANG_MailIntro5='Todas as informações contidas neste e-mail e todos os seus anexos &eacute; confidencial para o bussiness e poderia ser usado para pessoas que est&aacute; relacionada apenas a ele. Se você receber esta mensagem por engano, por favor apague-o e diga remetente sobre o erro, qualquer outra operação com este e-mail e seu conte&uacute;do estarão sob proteção legal.';
    $MULTILANG_MailIntro6='<br><br>Um sistema alimentado por <a href=http://www.practico.org>www.practico.org</a>';

	//Modulo de chat
	$MULTILANG_UsuariosChat='Usu&aacuterios que estão off-line nesse momento ver&aacute; todas as mensagens quando eles login novamente para o sistema.';
	$MULTILANG_ChatActivar='Ativar módulo de bate-papo?';
	$MULTILANG_ChatTipo1='Somente entre os usuários internos';
	$MULTILANG_ChatTipo2='Somente entre os usuários externos';
	$MULTILANG_ChatTipo3='Para todos os usuários';
	$MULTILANG_ChatTipo4='Somente para administração';
	$MULTILANG_ChatDevel='Developers chat';

	//Modulo de replicas
	$MULTILANG_ReplicaTitulo='Conexões adicionais e Replication';
	$MULTILANG_ReplicaDefinidos='Servidores de replicação automática definida';
	$MULTILANG_AgregarReplica='Adicionar uma nova conexão';
	$MULTILANG_ReplicaTodo='Use-o como um espelho';
	$MULTILANG_AyudaReplica='Definir se todas as operações de banco de dados sobre o sistema principal deve ser replicado através desta ligação. Se este valus é NÃO, Practico vai definir a conexão e torná-lo pronto para ser usado por operações de código ou individual apenas quando quiser.   This applies for data upgrade operations (Insert,Update,Delete) that was maked by the PCO_EjecutarSQLUnaria() internal function';
	$MULTILANG_ConnAdicionales='Conexões de banco de dados extras definidas';
	$MULTILANG_ConnPredeterminada='Padrão (mesma conexão usada pelo Practico)';
	$MULTILANG_ConnOrigenDatos='Fonte de dados';
	$MULTILANG_ConnOrigenDatosDes='Determina onde os dados serão dados para fazer o relatório. Por padrão, ele usa o mecanismo de conexão e banco de dados configurado para funcionar com Prático; mas você também pode selecionar outros motores ou conexões externas e conseguir extrair dados a partir daí. Para adicionar outras fontes de dados, use a opção Conexões extras e Replicação.';
    $MULTILANG_ConnAdvCambioOrigen='CUIDADO: A alteração da conexão ou da fonte de dados usada para um relatório após o projeto pode gerar erros em tempo de execução porque as estruturas de dados, tabelas e campos podem não ser encontrados na conexão recém-selecionada. Tenha cuidado.';

    //Eventos javascript
    $MULTILANG_EventosTit='Eventos e objeto Triggers';
    $MULTILANG_EventosPrevio='Antes que você possa automatizar as operações através de eventos ou aciona um controle de objeto ou em forma deve primeiro criar o controle básico e, em seguida, entrar novamente para ativar as opções de edição.';
    $MULTILANG_EventoClick='Clique sobre um elemento';
    $MULTILANG_EventoDobleClick='Clique duas vezes sobre um elemento';
    $MULTILANG_EventoMouseDown='O botão do mouse é pressionado sobre um elemento';
    $MULTILANG_EventoMouseEnter='Ponteiro do mouse entrar em um elemento';
    $MULTILANG_EventoMouseLeave='Ponteiro do mouse sair de um elemento';
    $MULTILANG_EventoMouseMove='Ponteiro do mouse está se movendo sobre um elemento';
    $MULTILANG_EventoMouseOver='O ponteiro do mouse está sobre um elemento';
    $MULTILANG_EventoMouseOut='Ponteiro do mouse sai de um elemento ou seu childs';
    $MULTILANG_EventoMouseUp='O botão do mouse é liberado sobre um elemento';
    $MULTILANG_EventoContextMenu='Botão direito do mouse pressionado (antes do menu de contexto aparecer)';
    $MULTILANG_EventoKeyDown='O usuário tem uma tecla pressionada (controles de formulário e corpo)';
    $MULTILANG_EventoKeyPress='Usuário pressionar uma tecla (momento em que é pressionado) (elementos de formulário e corpo)';
    $MULTILANG_EventoKeyUp='Liberar usuário uma tecla que foi pressionada (elementos de formulário e corpo)';
    $MULTILANG_EventoFocus='Um elemento de formulário obtém o foco';
    $MULTILANG_EventoBlur='Um elemento de formulário perdeu o foco';
    $MULTILANG_EventoChange='Um elemento do formulário muda';
    $MULTILANG_EventoSelect='O usuário seleciona o texto de uma entrada ou área de texto';
    $MULTILANG_EventoSubmit='O botão enviar formulário é pressionado (antes do envio)';
    $MULTILANG_EventoReset='O botão de reinicialização do formulário é pressionado';
    $MULTILANG_EventoCut='Os dados selecionados em um controle de texto foram cortados';
    $MULTILANG_EventoCopy='Os dados selecionados em um controle de texto foram copiados';
    $MULTILANG_EventoPaste='O conteúdo foi colado em um controle de texto';
    $MULTILANG_EventoLoad='A carga da janela ou do quadro foi concluída';
    $MULTILANG_EventoUnload='Janela ou quadro de fechamento do usuário';
    $MULTILANG_EventoResize='O usuário muda a janela o tamanho do quadro';
    $MULTILANG_EventoClose='O usuário tenta fechar janela ou quadro';
    $MULTILANG_EventoScroll='O usuário faz um rolo sobre janelas ou controle que o suportam';
    $MULTILANG_EventoAnimFin='Uma animação CSS terminou';
    $MULTILANG_EventoAnimInicio='Uma animação CSS foi iniciada';
    $MULTILANG_EventoAnimIteracion='Uma animação CSS foi reiniciada / repetida';
    $MULTILANG_EventoTipoRaton='Mouse Events or Pointing Device';
    $MULTILANG_EventoTipoTeclado='Keyboard Events';
    $MULTILANG_EventoTipoFormulario='Form Control Events';
    $MULTILANG_EventoTipoVentana='Events for windows and frames';
    $MULTILANG_EventoTipoAnima='Events for animations and transitions';
    $MULTILANG_EventoTipoBateria='Events related to battery and its charge';
    $MULTILANG_EventoTipoLlamadas='Events associated with calls and telephony';
    $MULTILANG_EventoTipoDOM='Events on the DOM tree';
    $MULTILANG_EventoTipoArrastrar='Events associated with drag and drop elements';
    $MULTILANG_EventoTipoAudio='Audio and video events';
    $MULTILANG_EventoTipoInternet='Internet Connection Events';

    //ModuloKanban
    $MULTILANG_TablerosKanban='Kanban Board';
    $MULTILANG_AgregarNuevaTarea='Add new task';
    $MULTILANG_DesTarea='Descrição geral da tarefa ou atividade a ser adicionada ao quadro Kanban. Você pode usar outras técnicas de descrição, como histórias de usuários ou qualquer outra metodologia que você deseja documentar a atividade.';
    $MULTILANG_AsignadoA='Assigned to';
    $MULTILANG_AsignadoADes='Utilizador registado no sistema é responsável pelo que a conclusão da tarefa ou atividade ESTA (se aplicável)';
    $MULTILANG_FechaLimite='Fecha de finalizaci&oacute;n';
    $MULTILANG_DelKanban='You are going to delete a task from the board and this action could not be undone later. Are you sure?';
    $MULTILANG_Historia1='Minimal user history: [Rol,Functionality,Purpose]';
    $MULTILANG_Historia1Des='As ________ I need ___________ with the purpose of ________.';
    $MULTILANG_Historia2='Intermediate user history: [Rol,Functionality,Purpose]+[Context/Acceptance requirements,Event]';
    $MULTILANG_Historia2Des='As ________ I need ___________ with the purpose of ________.BRBRIn case _______ it should _______';
    $MULTILANG_Historia3='Detailed user history: [ID,Rol,Functionality,Purpose]+[Stage,Context/Acceptance requirements,Event]';
    $MULTILANG_Historia3Des='ID: ______BRAs ________ I need ___________ with the purpose of ________.BRBRScene: ________. In case _______ it should _______';
    $MULTILANG_ListaColumnas='Columns list';
    $MULTILANG_ListaCategorias='Category list';
    $MULTILANG_ArchivarTarea='Tarefa de arquivo';
    $MULTILANG_ArchivarTareaAdv='A tarefa será arquivada, deixará o quadro e irá para o histórico. Você quer continuar?';
    $MULTILANG_TareasArchivadas='Archived tasks';
    $MULTILANG_CompartidosConmigo='Shared with me';
    $MULTILANG_CrearTablero='Add board';
    $MULTILANG_CompartirCon='Shared with';
    $MULTILANG_NoTablero='There is not a Kanban board created by you or shared with you by another user';
    $MULTILANG_ArrastrarTarea='Mueva tareas rapidamente arrastr&aacute;ndolas sobre este t&iacute;tulo.';
    $MULTILANG_TodosLosTableros='All Kanban boards';

    //ModuloBugTracker
    $MULTILANG_BTReporteBugs='Report errors or improvements';
    $MULTILANG_BTUltimaActualizacion='Last update date';
    $MULTILANG_BTSeveridad='Severity';
    $MULTILANG_BTUsuarioReporte='Reported by';
    $MULTILANG_BTAsignadoA='Assigned to';
    $MULTILANG_BTPasos='Steps to reproduce the problem';
    $MULTILANG_BTOrigen='Origin system';
    $MULTILANG_BTTrazas='Traces associated with the error';
    $MULTILANG_BTVersion='Version of the project or product';
    $MULTILANG_BTDescripcion='Description of the error or improvement';
    $MULTILANG_BTFechaCierre='Deadline';
    $MULTILANG_BTProyectoAsociado='Associated project';
    $MULTILANG_BTFechaApertura='Date of opening of the case';
    $MULTILANG_BTHistorial='Management history';
    $MULTILANG_BTCategoriaDes='Please select if this is an application error, an enhancement or a question about Functionality';
    $MULTILANG_BTComplementoDes='If applies, write the step by step procedure to reproduce the error over the sysmte.';
    $MULTILANG_BTPanel='Panel de gesti&oacute;n de errores o bugs';
    $MULTILANG_BTBugtracking='Bugtracking';
    $MULTILANG_BTPermitirReporte='Allow users to send bug reports';

    //Opciones de Documentacion
    $MULTILANG_Documentar='Documento';
    $MULTILANG_DocumentarDes='Adicione ao início do código um modelo de documentação para funções ou procedimentos na notação NaturalDocs';
    $MULTILANG_DocumentarLink='Abra ajuda adicional de documentação para NaturalDocs';

    //PWA
    $MULTILANG_PWAActivar='Ative o uso de aplicativos da Web Progressivos';
    $MULTILANG_PWAAyuda='Ele permite ativar no aplicativo a tecnologia PWA que permite que seu aplicativo faça uma solicitação de instalação como aplicativo móvel a partir de navegadores em dispositivos que ofereçam suporte a esta tecnologia. Para mais informações, veja os links  https://w3c.github.io/manifest/  y  https://developers.google.com/web/progressive-web-apps/';
    $MULTILANG_PWAIconos='Definição de ícones para a aplicação';
    $MULTILANG_PWADescripcion='Aplicação da Web progressiva gerada automaticamente pelo Practico Framework';
    $MULTILANG_PWADireccionTexto='Direção de texto';
    $MULTILANG_PWADisplayPreferido='Modo de exibição preferido';
    $MULTILANG_PWAOrientacionPantalla='Orientação da tela';
    $MULTILANG_PWAGCM='ID do Firebase Cloud Messaging';
    $MULTILANG_PWAScope='Alcance (Scope)';
    $MULTILANG_PWAScopeDes='Se a sua instalação do Practico reside na raiz do seu servidor web ou subdomínio, você pode deixar este espaço em branco. Se a sua instalação reside em qualquer pasta, indique ./pasta/ para estabelecer o escopo do Operador de Serviço e do manifesto PWA.';
    $MULTILANG_PWAAutorizarGPS='Solicitar autorização para obter localização (GPS)';
    $MULTILANG_PWAAutorizarFCM='Solicitar autorização de envio de notificações (PUSH)';
    $MULTILANG_PWAAutorizarCAM='Request authorization to use video device (CAMERA)';
    $MULTILANG_PWAAutorizarMIC='Request authorization to use audio device (MICROPHONE)';
    $MULTILANG_PWAOcultarBarrasExtra='Hide navigation bars to standard users?';
    $MULTILANG_PWAOcultarBarrasExtraDes='It saves space for the application of writing or mobile. Applies only to standard users (non-designers). The developer should guarantee access to certain hidden functions of the bar by means of its own controls, such as, for example, session closing, among others.';

    //Planificador de tareas
    $MULTILANG_CronTitulo='Task scheduler';
    $MULTILANG_CronComando='Cron command';
    $MULTILANG_CronComando='Absolute URL';
    $MULTILANG_CronPlanificacion='Type of schedule';
    $MULTILANG_CronAyuda='You can schedule the execution of your scheduled task using the cron daemon and the indicated command or the use of free external tools such as GCP CloudScheduler and the indicated absolute URL. Remember not to disclose the safety code or the execution of the task could be done by anyone who knows it.';
    
	//Pcoder
	$MULTILANG_PCODER_Abrir='Aberto';
	$MULTILANG_PCODER_Aceptar='Aceitar';
	$MULTILANG_PCODER_Activar='Habilitar';
	$MULTILANG_PCODER_Archivo='Arquivo';
	$MULTILANG_PCODER_Acercar='Mais Zoom';
	$MULTILANG_PCODER_Alejar='Menos zoom';
	$MULTILANG_PCODER_Ayuda='Socorro';
	$MULTILANG_PCODER_Basicos='B&aacute;sico';
	$MULTILANG_PCODER_Buscar='Encontrar';
	$MULTILANG_PCODER_Cancelar='Cancelar';
	$MULTILANG_PCODER_Caracteres='Caracter';
	$MULTILANG_PCODER_Cargando='Carregando';
	$MULTILANG_PCODER_Carpeta='Pasta';
	$MULTILANG_PCODER_Cerrar='Fechar';
	$MULTILANG_PCODER_Columna='Coluna';
	$MULTILANG_PCODER_Copiar='C&aacute;pia';
	$MULTILANG_PCODER_Cortar='Cortar';
	$MULTILANG_PCODER_Depurar='Depurar';
	$MULTILANG_PCODER_Desactivar='Incapacitar';
	$MULTILANG_PCODER_Deshacer='Desfazer';
	$MULTILANG_PCODER_Desplazar='Passo';
	$MULTILANG_PCODER_Editar='Editar';
	$MULTILANG_PCODER_Eliminado='Suprimido';
	$MULTILANG_PCODER_Error='Erro';
	$MULTILANG_PCODER_Estado='Estatuto';
	$MULTILANG_PCODER_Explorar='Explorar';
	$MULTILANG_PCODER_Finalizado='Terminado';
	$MULTILANG_PCODER_Formato='Formato';
	$MULTILANG_PCODER_Guardando='Guardar';
	$MULTILANG_PCODER_Guardar='Guardar';
	$MULTILANG_PCODER_Herramientas='Ferramentas';
	$MULTILANG_PCODER_Ir='Ir';
	$MULTILANG_PCODER_Linea='Linha';
	$MULTILANG_PCODER_Lineas='Linhas';
	$MULTILANG_PCODER_Modificado='Modificado';
	$MULTILANG_PCODER_No='Não';
	$MULTILANG_PCODER_Nombre='Nome';
	$MULTILANG_PCODER_Nuevo='Novo';
	$MULTILANG_PCODER_Operacion='Operação';
	$MULTILANG_PCODER_Otros='Outros';
	$MULTILANG_PCODER_Pegar='Colar';
	$MULTILANG_PCODER_Permisos='Permissões';
	$MULTILANG_PCODER_Predeterminado='Padrão';
	$MULTILANG_PCODER_Preferencias='Preferências do editor {P}Coder';
	$MULTILANG_PCODER_Propietario='Proprietário';
	$MULTILANG_PCODER_Reemplazar='Substituir';
	$MULTILANG_PCODER_Rehacer='Refazer';
	$MULTILANG_PCODER_Salir='Sair';
	$MULTILANG_PCODER_Seleccionar='Selecionar';
	$MULTILANG_PCODER_Si='Sim';
	$MULTILANG_PCODER_Tamano='Tamanho';
	$MULTILANG_PCODER_Tipo='Tipo';
	$MULTILANG_PCODER_Trabajando='Trabalhando';
	$MULTILANG_PCODER_Ubicacion='Localização';
	$MULTILANG_PCODER_Ver='Visão';

	//Mensajes de error y varios
	$MULTILANG_PCODER_Minimap='Code Minimap';
	$MULTILANG_PCODER_AumSangria='Aumenta o travessão';
	$MULTILANG_PCODER_DisSangria='Diminuir travessão';
	$MULTILANG_PCODER_ConvMay='Converter para mai&uacute;sculas';
	$MULTILANG_PCODER_ConvMin='Converter para min&uacute;sculas';
	$MULTILANG_PCODER_OrdenaSel='Seleção de ordem';
	$MULTILANG_PCODER_CargarArchivo='Carregar arquivo';
    $MULTILANG_PCODER_Ajuste='Ajuste janela';
	$MULTILANG_PCODER_DefPcoder='Editor de c&oacute;digo';
	$MULTILANG_PCODER_EnlacePcoder='Editor de C&oacute;digo {P}Coder';
	$MULTILANG_PCODER_AtajosTitPcoder='Atalhos do teclado';
	$MULTILANG_PCODER_PcoderAjuste='Ajuste janela';
	$MULTILANG_PCODER_ErrorRW='Você não tem direitos para escrever este arquivo! Qualquer alteração ser&aacute; perdida!';
	$MULTILANG_PCODER_SaltarLinea='Ir para linha';
	$MULTILANG_PCODER_Acerca='Cerca de';
	$MULTILANG_PCODER_AparienciaEditor='Tema editor';
	$MULTILANG_PCODER_TamanoFuente='Tamanho da fonte';
	$MULTILANG_PCODER_LenguajeProg='Linguagem de programação';
	$MULTILANG_PCODER_VerCaracteres='Mostrar escondido caracteres';
	$MULTILANG_PCODER_CerrarVentana='As alterações podem perder';
	$MULTILANG_PCODER_PathFull='Raiz do WebServer';
	$MULTILANG_PCODER_PathDisco='Raiz do disco rígido';
	$MULTILANG_PCODER_CaracNoImprimibles='Exposição / Esconder personagens invis&iacute;veis';
	$MULTILANG_PCODER_PantallaCompleta='Tela cheia';
	$MULTILANG_PCODER_PanelIzq='Painel esquerdo';
	$MULTILANG_PCODER_PanelDer='Painel direito';
	$MULTILANG_PCODER_OcultarPanel='Painel cerrar';
	$MULTILANG_PCODER_RevisarSintaxis='Verifique a sintaxe da linguagem, enquanto eu escrevo';
	$MULTILANG_PCODER_SeleccionarTodo='Selecionar tudo';
	$MULTILANG_PCODER_DepuraErrorSiguiente='Ir para o próximo erro';
	$MULTILANG_PCODER_DepuraErrorPrevio='Ir de erro anterior';
	$MULTILANG_PCODER_EnrollarSeleccion='Dobre texto selecionado';
	$MULTILANG_PCODER_DesenrollarTodo='Desdobrar tudo';
	$MULTILANG_PCODER_DuplicarSeleccion='Seleção duplicado';
	$MULTILANG_PCODER_InvertirSeleccion='Seleção invertida';
	$MULTILANG_PCODER_UnirSeleccion='Adira selecionado em uma linha';
	$MULTILANG_PCODER_DividirNO='Nenhum editor de código de divisão';
	$MULTILANG_PCODER_DividirHorizontal='Divisão horizontal';
	$MULTILANG_PCODER_DividirVertical='Divisão vertical';
	$MULTILANG_PCODER_ClicSeleccionar='Clique para selecionar';
	$MULTILANG_PCODER_ExploradorColores='Explorador Cor';
	$MULTILANG_PCODER_TerminalRemota='Terminal remoto';
	$MULTILANG_PCODER_EditorArchivos='Editor de arquivo';
	$MULTILANG_PCODER_NavegadorEmbebido='Navegador web embutido';
	$MULTILANG_PCODER_AdvertenciaCierre='Você está tentando desligar todo o editor {PI} Código. Arquivos editados que você armazenou ainda a não perder. Sua confirmação é necessária para continuar.';
	$MULTILANG_PCODER_ErrGuardarDefecto='Você deve especificar uma arquivo válido para salvar ou abrir um arquivo para editar!';
	$MULTILANG_PCODER_ErrGuardarNoPermiso='Você não tem direitos para escrever este arquivo usando o seu usuário do servidor web !. Verifique as permissões e tente novamente.';
	$MULTILANG_PCODER_CrearArchivo='Novo arquivo';
	$MULTILANG_PCODER_CrearCarpeta='Novo pasta';
	$MULTILANG_PCODER_EditarPermisos='Editar permissões';
	$MULTILANG_PCODER_SubirArchivo='Subir arquivo';
	$MULTILANG_PCODER_RecargarExplorador='Explorador de recarga';
	$MULTILANG_PCODER_EliminarElemento='Excluir o arquivo / pasta';
	$MULTILANG_PCODER_OperacionesFS='Archivos, carpetas y tareas de permisos';
	$MULTILANG_PCODER_ElementoCreado='O elemento foi criado';
	$MULTILANG_PCODER_ElementoExiste='O elemento já existe';
	$MULTILANG_PCODER_ElementoNoCreado='O elemento não pode ser criado, excluído ou modificado ao longo do sistema de arquivos. Por favor verifique as suas permissões';
	$MULTILANG_PCODER_NrosLinea='N&uacute;meros de linha Si / No';
	$MULTILANG_PCODER_CheqSintaxis='Verificação de sintaxe';
	$MULTILANG_PCODER_LenguajeResaltado='Idioma realçado';
	$MULTILANG_PCODER_ExtensionNoSoportada='A extensão do arquivo que você está tentando abrir não é suportado. Você pode adicioná-lo às extensões suportadas se você quiser editar esse arquivo usando PCoder.';
	$MULTILANG_PCODER_HerramientaDiferencias='Ferramenta de diferenças';
	$MULTILANG_PCODER_SensibleMayusculas='Maiúsculas e minúsculas';
	$MULTILANG_PCODER_Autocompletado='Autocomplete enquanto você digita';
	$MULTILANG_PCODER_HistorialVersiones='Version history';
	$MULTILANG_PCODER_ChatDesarrolladores='Developers chat only';
	$MULTILANG_PCODER_ErrorRO='ERROR: This file is locked for open it simultaneously. Only the user or super user (admin) can unlock it.';
	$MULTILANG_PCODER_AdvertenciaCierre='WARNING: This file was opened by you in the past but this was not closed propertly.  We advice you to close your sessions and files correctly to avoid simultaneous file locks for other users.';
	$MULTILANG_PCODER_AdvConcurrencia='<font color=red>WARNING WARNING WARNING !!!</font><br>This may also indicate that even you have this file open from another workstation. The file will be open but be careful not to overwrite changes when loading the same work file from different computers or use the <b> File-> Version History </b> option to verify any changes.';