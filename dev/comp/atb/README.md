Auto-Trading-Bot es una herramienta de código abierto que permite realizar operaciones automáticas sobre el mercado de criptomonedas.   El bot es capaz de conocer el estado actual del mercado y realizar procesos de compra y venta de criptodivisas según unos parámetros establecidos.

## Características

 - Escrito completamente en PHP.
 - Permite ejecución directa sobre terminales.
 - Soporte a operaciones desde servicios web, REST.
 - Multiplataforma (GNU/Linux, *BSD, Microsoft Windows).
 - Fácilmente personalizable.
 - Pequeño, liviano y rápido
 - Código fuente simple, principios KISS ante todo.

## Instalación y uso

 * Descomprima el paquete de instalación en una máquina con soporte PHP 7.0+ (no se requiere servicio web ni base de datos):
```
   $ tar zxvf auto-trading-bot.tar.gz  ó
   $ unzip auto-trading-bot.zip
```
 * Actualice el archivo /include/config.php con sus propios valores de API.
 * Abra su terminal en el PATH correspondiente y ejecute:
 
 ```
   $ php auto-trading-bot.php
```

## Desinstalación:

  Simplemente elimine todos los archivos bajo el directorio de instalación.

## Documentación para desarrolladores
Las funciones se encuentran documentadas al interior del código.   Operaciones específicas sobre el mercado pueden ser consultadas directamente sobre la API de cada proveedor.

#### Soporte y donaciones al proyecto

Si encuentra útil este proyecto y desea contribuir al desarrollo del mismo puede apoyarnos mediante una donación por un valor voluntario.

[![Donaciones](https://raw.githubusercontent.com/unix4you2/practico/master/dev_web/img/paypal.png)](https://www.paypal.com/cgi-bin/webscr?item_name=Donacion+para+desarrollo+de+funcionalidades+de+Pr%E1ctico&cmd=_donations&business=unix4you2%40gmail.com)
