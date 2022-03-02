#!/usr/bin/env bash
killall polybar                          #(killall en linux para finalizar barras previas)
# Lanza la barra llamada example. Por defecto en el archivo de ejemplo
polybar example &
# polybar example 2>/tmp/polybar1.log &   # En caso de querer ver logs y depuración
