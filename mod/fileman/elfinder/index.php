<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>elFinder 2.0</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<!-- Actualizado para inclusion desde inc/jquery de Practico -->
		<link rel="stylesheet" type="text/css" media="screen" href="../../../inc/jquery/plugins/ui-1.8.18/jquery-ui.css">
		<script type="text/javascript" src="../../../inc/jquery/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="../../../inc/jquery/plugins/ui-1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="js/i18n/elfinder.es.js"></script>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
					url : 'php/connector.php',  // connector URL (REQUIRED)
					lang: 'es'             // language (OPTIONAL)
				}).elfinder('instance');
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
