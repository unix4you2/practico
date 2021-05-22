/*========================================================================
        ARCHIVO PARA ACTIVAR/DESACTIVAR EL MODO DEMO DE PRACTICO
========================================================================

## PARA QUE:
* Este archivo existe para permitir el despliegue de plataformas
  en modo DEMO donde los usuarios tienen algunas operaciones prohibidas

## QUE RESTRINGE:
* Cambio de contrasenas de usuarios
* Actualizacion de perfiles de usuario
* Cambio de configuraciones de la plataforma
* Aplicacion de parches para actualizacion o cambios de version

## COMO ACTIVARLO:
* Forma 1: Renombre este archivo a DEMO (retire su extension)
* Forma 2: Cree un archivo llamado DEMO en la raiz de su instalacion
* Ajuste los permisos: Convierta en inmutables los archivos mediante: chattr +i -R *

## COMO DESACTIVAR:
* Forma 1: Renombre el archivo DEMO a su nombre original DEMO.md
* Forma 2: Elimine cualquier archivo llamado DEMO en su carpeta raiz
* Ajuste los permisos: Convierta en inmutables los archivos mediante: chattr -i -R *

## COMO ACTUALIZAR:
* En entornos de Virtualhost restringidos no olvide desactivar la variable:
  open_basedir   /supath/hasta/WebServer/www.sudominio.com  temporalmente para
  permitir cargue de archivos.
*/