#!/usr/bin/env bash
rm /tmp/lockbackground.png
rm /tmp/currentworkspace.png
rm /tmp/currentworkspaceblur.png
ImagenFrente=/usr/share/pixmaps/lockoverlay.png
scrot /tmp/currentworkspace.png
convert /tmp/currentworkspace.png -blur 0x5 /tmp/currentworkspaceblur.png
#composite -gravity southeast $ImagenFrente /tmp/currentworkspaceblur.png /tmp/lockbackground.png
#i3lock -i /tmp/lockbackground.png
i3lock -i /tmp/currentworkspaceblur.png
