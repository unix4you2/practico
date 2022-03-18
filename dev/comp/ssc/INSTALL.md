#=====================================================================
#                                SISI-CAM
#            Sistema Simple de Grabación de Camaras por Shell
#            Simple System to Record Webcams using only Shell
#         Procedimiento basico de instalacion y puesta en marcha
#=====================================================================


Configurar Motion segun procedimiento para almacenar capturas en la estructura propuesta por el script crear_videos.sh
Ejemplos de configuracion de motion se encuentran en la carpeta correspondiente
Configurar ejecucion automatica de crear_videos.sh a la 1AM con su path absoluto /mnt/disco_usb/camaras/crear_videos.sh
Verificar funcionamiento diario mientras se llega al punto de eliminacion automatica de archivos superiores a N dias (ver .sh al final)

PREREQUISITOS
	ffmpeg-2.0.1.tar.gz
		Posible instalacion mediante: yum -y install postgresql-libs ffmpeg-libs gstreamer-ffmpeg ffmpeg-compat ffmpeg ffmpeg-compat-devel ffmpeg-devel openjpeg openjpeg-devel mencoder

	motion-3.2.12.tar.gz
