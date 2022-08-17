#!/bin/bash
#   PFirewall (Asistente Reglas de Trafico por Paises mediante IpTables)
#             (A wizard to allow/block traffic in IpTables by country  )
#	Copyright (C) 2013  John F. Arroyave Gutiérrez
#						unix4you2@gmail.com
#						www.practico.org

# Basado en la versión inicial de nixCraft <www.cyberciti.biz>
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.

# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software Foundation
# Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

# ----------------------------------------------------------------------
# Objetivo: Bloquear trafico de paises especificos por su codigo ISO
# ----------------------------------------------------------------------
# Dependencias:  iptables, iptables-services, wget
# Probado: CentOS 6.x, 7.x  iptables 1.4.21+
# Codigos de pais soportados:  ae,af,ag,ai,al,am,ao,ap,ar,as,at,au,aw,
#                              az,ba,bb,bd,be,bf,bg,bh,bi,bj,bl,bm,bn,
#   bo,bq,br,bs,bt,bw,by,bz,ca,cd,cf,cg,ch,ci,ck,cl,cm,cn,co,cr,cu,cv,
#   cw,cy,cz,de,dj,dk,dm,do,dz,ec,ee,eg,er,es,et,eu,fi,fj,fm,fo,fr,ga,
#   gb,gd,ge,gf,gg,gh,gi,gl,gm,gn,gp,gq,gr,gt,gu,gw,gy,hk,hn,hr,ht,hu,
#   id,ie,il,im,in,io,iq,ir,is,it,je,jm,jo,jp,ke,kg,kh,ki,km,kn,kp,kr,
#   kw,ky,kz,la,lb,lc,li,lk,lr,ls,lt,lu,lv,ly,ma,mc,md,me,mf,mg,mh,mk,
#   ml,mm,mn,mo,mp,mq,mr,ms,mt,mu,mv,mw,mx,my,mz,na,nc,ne,nf,ng,ni,nl,
#   no,np,nr,nu,nz,om,pa,pe,pf,pg,ph,pk,pl,pm,pr,ps,pt,pw,py,qa,re,ro,
#   rs,ru,rw,sa,sb,sc,sd,se,sg,si,sk,sl,sm,sn,so,sr,ss,st,sv,sx,sy,sz,
#   tc,td,tg,th,tj,tk,tl,tm,tn,to,tr,tt,tv,tw,tz,ua,ug,us,uy,uz,va,vc,
#   ve,vg,vi,vn,vu,wf,ws,ye,yt,za,zm,zw

#=======================================================================
# ¡¡¡ IMPORTANTE !!!    ¡¡¡ ADVERTENCIA !!!    ¡¡¡ IMPORTANTE !!!
# Se recomienda verificar su comando antes de ser lanzado, ya que podria
# Bloquear el acceso a su pais y perder conexion con la maquina remota.
#=======================================================================

# TODO: Revisar ipset para aplicar reglas masivas sin afectar rendimiento

#######################################################################
# PERMISO A SEGMENTOS DE RED ESPECIFICOS
RedesGoogle=( 209.185.108.0/24 209.185.253.0/24 209.85.238.0/24 216.239.33.0/24 216.239.37.0/24 216.239.39.0/24 216.239.41.0/24 216.239.45.0/24 216.239.46.0/24 216.239.51.0/24 216.239.53.0/24 216
.239.57.0/24 216.239.59.0/24 216.33.229.0/24 64.233.173.0/24 64.68.80.0/24 64.68.81.0/24 64.68.82.0/24 64.68.83.0/24 64.68.84.0/24 64.68.85.0/24 64.68.86.0/24 64.68.87.0/24 64.68.88.0/24 64.68.89
.0/24 64.68.90.0/24 64.68.91.0/24 64.68.92.0/24 66.249.0.0/24 72.14.199.0/24 8.6.48.0/24 )
RedesLevel3=( 190.216.128.160/27 190.216.128.192/27 200.31.21.177/29 190.216.130.25/29 201.234.240.233/29 190.216.159.22/30 201.234.178.46/30 )
GoogleCloud=( 74.125.78.100 74.125.77.99 74.125.77.98 )
GoogleBots=( 209.185.108.0/24 209.185.253.0/24 209.85.238.0/24 209.85.238.11/24 209.85.238.4/24 216.239.33.96/24 216.239.33.97/24 216.239.33.98/24 216.239.33.99/24 216.239.37.98/24 216.239.37.99/24 216.239.39.98/24 216.239.39.99/24 216.239.41.96/24 216.239.41.97/24 216.239.41.98/24 216.239.41.99/24 216.239.45.4/24 216.239.46.0/24 216.239.51.96/24 216.239.51.97/24 216.239.51.98/24 216.239.51.99/24 216.239.53.98/24 216.239.53.99/24 216.239.57.96/24 216.239.57.97/24 216.239.57.98/24 216.239.57.99/24 216.239.59.98/24 216.239.59.99/24 216.33.229.163/24 64.233.160.0/24 64.233.161.0/24 64.233.162.0/24 64.233.163.0/24 64.233.164.0/24 64.233.165.0/24 64.233.166.0/24 64.233.167.0/24 64.233.168.0/24 64.233.169.0/24 64.233.170.0/24 64.233.171.0/24 64.233.172.0/24 64.233.173.0/24 64.233.174.0/24 64.233.175.0/24 64.233.176.0/24 64.233.177.0/24 64.233.178.0/24 64.233.179.0/24 64.233.180.0/24 64.233.181.0/24 64.233.182.0/24 64.233.183.0/24 64.233.184.0/24 64.233.185.0/24 64.233.186.0/24 64.233.187.0/24 64.233.188.0/24 64.233.189.0/24 64.233.190.0/24 64.233.191.0/24 66.102.0.0/24 66.102.1.0/24 66.102.2.0/24 66.102.3.0/24 66.102.4.0/24 66.102.5.0/24 66.102.6.0/24 66.102.7.0/24 66.102.8.0/24 66.102.9.0/24 66.102.10.0/24 66.102.11.0/24 66.102.12.0/24 66.102.13.0/24 66.102.14.0/24 66.102.15.0/24 66.249.64.0/24 66.249.65.0/24 66.249.66.0/24 66.249.67.0/24 66.249.68.0/24 66.249.69.0/24 66.249.70.0/24 66.249.71.0/24 66.249.72.0/24 66.249.73.0/24 66.249.74.0/24 66.249.75.0/24 66.249.76.0/24 66.249.77.0/24 66.249.78.0/24 66.249.79.0/24 66.249.80.0/24 66.249.81.0/24 66.249.82.0/24 66.249.83.0/24 66.249.84.0/24 66.249.85.0/24 66.249.86.0/24 66.249.87.0/24 66.249.88.0/24 66.249.89.0/24 66.249.90.0/24 66.249.91.0/24 66.249.92.0/24 66.249.93.0/24 66.249.94.0/24 66.249.95.0/24 72.14.192.0/24 72.14.193.0/24 72.14.194.0/24 72.14.195.0/24 72.14.196.0/24 72.14.197.0/24 72.14.198.0/24 72.14.199.0/24 72.14.200.0/24 72.14.201.0/24 72.14.202.0/24 72.14.203.0/24 72.14.204.0/24 72.14.205.0/24 72.14.206.0/24 72.14.207.0/24 72.14.208.0/24 72.14.209.0/24 72.14.210.0/24 72.14.211.0/24 72.14.212.0/24 72.14.213.0/24 72.14.214.0/24 72.14.215.0/24 72.14.216.0/24 72.14.217.0/24 72.14.218.0/24 72.14.219.0/24 72.14.220.0/24 72.14.221.0/24 72.14.222.0/24 72.14.223.0/24 72.14.224.0/24 72.14.225.0/24 72.14.226.0/24 72.14.227.0/24 72.14.228.0/24 72.14.229.0/24 72.14.230.0/24 72.14.231.0/24 72.14.232.0/24 72.14.233.0/24 72.14.234.0/24 72.14.235.0/24 72.14.236.0/24 72.14.237.0/24 72.14.238.0/24 72.14.239.0/24 72.14.240.0/24 72.14.241.0/24 72.14.242.0/24 72.14.243.0/24 72.14.244.0/24 72.14.245.0/24 72.14.246.0/24 72.14.247.0/24 72.14.248.0/24 72.14.249.0/24 72.14.250.0/24 72.14.251.0/24 72.14.252.0/24 72.14.253.0/24 72.14.254.0/24 72.14.255.0/24 74.125.0.0/24 74.125.1.0/24 74.125.2.0/24 74.125.3.0/24 74.125.4.0/24 74.125.5.0/24 74.125.6.0/24 74.125.7.0/24 74.125.8.0/24 74.125.9.0/24 74.125.10.0/24 74.125.11.0/24 74.125.12.0/24 74.125.13.0/24 74.125.14.0/24 74.125.15.0/24 74.125.16.0/24 74.125.17.0/24 74.125.18.0/24 74.125.19.0/24 74.125.20.0/24 74.125.21.0/24 74.125.22.0/24 74.125.23.0/24 74.125.24.0/24 74.125.25.0/24 74.125.26.0/24 74.125.27.0/24 74.125.28.0/24 74.125.29.0/24 74.125.30.0/24 74.125.31.0/24 74.125.32.0/24 74.125.33.0/24 74.125.34.0/24 74.125.35.0/24 74.125.36.0/24 74.125.37.0/24 74.125.38.0/24 74.125.39.0/24 74.125.40.0/24 74.125.41.0/24 74.125.42.0/24 74.125.43.0/24 74.125.44.0/24 74.125.45.0/24 74.125.46.0/24 74.125.47.0/24 74.125.48.0/24 74.125.49.0/24 74.125.50.0/24 74.125.51.0/24 74.125.52.0/24 74.125.53.0/24 74.125.54.0/24 74.125.55.0/24 74.125.56.0/24 74.125.57.0/24 74.125.58.0/24 74.125.59.0/24 74.125.60.0/24 74.125.61.0/24 74.125.62.0/24 74.125.63.0/24 74.125.64.0/24 74.125.65.0/24 74.125.66.0/24 74.125.67.0/24 74.125.68.0/24 74.125.69.0/24 74.125.70.0/24 74.125.71.0/24 74.125.72.0/24 74.125.73.0/24 74.125.74.0/24 74.125.75.0/24 74.125.76.0/24 74.125.77.0/24 74.125.78.0/24 74.125.79.0/24 74.125.80.0/24 74.125.81.0/24 74.125.82.0/24 74.125.83.0/24 74.125.84.0/24 74.125.85.0/24 74.125.86.0/24 74.125.87.0/24 74.125.88.0/24 74.125.89.0/24 74.125.90.0/24 74.125.91.0/24 74.125.92.0/24 74.125.93.0/24 74.125.94.0/24 74.125.95.0/24 74.125.96.0/24 74.125.97.0/24 74.125.98.0/24 74.125.99.0/24 74.125.100.0/24 74.125.101.0/24 74.125.102.0/24 74.125.103.0/24 74.125.104.0/24 74.125.105.0/24 74.125.106.0/24 74.125.107.0/24 74.125.108.0/24 74.125.109.0/24 74.125.110.0/24 74.125.111.0/24 74.125.112.0/24 74.125.113.0/24 74.125.114.0/24 74.125.115.0/24 74.125.116.0/24 74.125.117.0/24 74.125.118.0/24 74.125.119.0/24 74.125.120.0/24 74.125.121.0/24 74.125.122.0/24 74.125.123.0/24 74.125.124.0/24 74.125.125.0/24 74.125.126.0/24 74.125.127.0/24 74.125.128.0/24 74.125.129.0/24 74.125.130.0/24 74.125.131.0/24 74.125.132.0/24 74.125.133.0/24 74.125.134.0/24 74.125.135.0/24 74.125.136.0/24 74.125.137.0/24 74.125.138.0/24 74.125.139.0/24 74.125.140.0/24 74.125.141.0/24 74.125.142.0/24 74.125.143.0/24 74.125.144.0/24 74.125.145.0/24 74.125.146.0/24 74.125.147.0/24 74.125.148.0/24 74.125.149.0/24 74.125.150.0/24 74.125.151.0/24 74.125.152.0/24 74.125.153.0/24 74.125.154.0/24 74.125.155.0/24 74.125.156.0/24 74.125.157.0/24 74.125.158.0/24 74.125.159.0/24 74.125.160.0/24 74.125.161.0/24 74.125.162.0/24 74.125.163.0/24 74.125.164.0/24 74.125.165.0/24 74.125.166.0/24 74.125.167.0/24 74.125.168.0/24 74.125.169.0/24 74.125.170.0/24 74.125.171.0/24 74.125.172.0/24 74.125.173.0/24 74.125.174.0/24 74.125.175.0/24 74.125.176.0/24 74.125.177.0/24 74.125.178.0/24 74.125.179.0/24 74.125.180.0/24 74.125.181.0/24 74.125.182.0/24 74.125.183.0/24 74.125.184.0/24 74.125.185.0/24 74.125.186.0/24 74.125.187.0/24 74.125.188.0/24 74.125.189.0/24 74.125.190.0/24 74.125.191.0/24 74.125.192.0/24 74.125.193.0/24 74.125.194.0/24 74.125.195.0/24 74.125.196.0/24 74.125.197.0/24 74.125.198.0/24 74.125.199.0/24 74.125.200.0/24 74.125.201.0/24 74.125.202.0/24 74.125.203.0/24 74.125.204.0/24 74.125.205.0/24 74.125.206.0/24 74.125.207.0/24 74.125.208.0/24 74.125.209.0/24 74.125.210.0/24 74.125.211.0/24 74.125.212.0/24 74.125.213.0/24 74.125.214.0/24 74.125.215.0/24 74.125.216.0/24 74.125.217.0/24 74.125.218.0/24 74.125.219.0/24 74.125.220.0/24 74.125.221.0/24 74.125.222.0/24 74.125.223.0/24 74.125.224.0/24 74.125.225.0/24 74.125.226.0/24 74.125.227.0/24 74.125.228.0/24 74.125.229.0/24 74.125.230.0/24 74.125.231.0/24 74.125.232.0/24 74.125.233.0/24 74.125.234.0/24 74.125.235.0/24 74.125.236.0/24 74.125.237.0/24 74.125.238.0/24 74.125.239.0/24 74.125.240.0/24 74.125.241.0/24 74.125.242.0/24 74.125.243.0/24 74.125.244.0/24 74.125.245.0/24 74.125.246.0/24 74.125.247.0/24 74.125.248.0/24 74.125.249.0/24 74.125.250.0/24 74.125.251.0/24 74.125.252.0/24 74.125.253.0/24 74.125.254.0/24 74.125.255.0/24 209.85.128.0/24 209.85.129.0/24 209.85.130.0/24 209.85.131.0/24 209.85.132.0/24 209.85.133.0/24 209.85.134.0/24 209.85.135.0/24 209.85.136.0/24 209.85.137.0/24 209.85.138.0/24 209.85.139.0/24 209.85.140.0/24 209.85.141.0/24 209.85.142.0/24 209.85.143.0/24 209.85.144.0/24 209.85.145.0/24 209.85.146.0/24 209.85.147.0/24 209.85.148.0/24 209.85.149.0/24 209.85.150.0/24 209.85.151.0/24 209.85.152.0/24 209.85.153.0/24 209.85.154.0/24 209.85.155.0/24 209.85.156.0/24 209.85.157.0/24 209.85.158.0/24 209.85.159.0/24 209.85.160.0/24 209.85.161.0/24 209.85.162.0/24 209.85.163.0/24 209.85.164.0/24 209.85.165.0/24 209.85.166.0/24 209.85.167.0/24 209.85.168.0/24 209.85.169.0/24 209.85.170.0/24 209.85.171.0/24 209.85.172.0/24 209.85.173.0/24 209.85.174.0/24 209.85.175.0/24 209.85.176.0/24 209.85.177.0/24 209.85.178.0/24 209.85.179.0/24 209.85.180.0/24 209.85.181.0/24 209.85.182.0/24 209.85.183.0/24 209.85.184.0/24 209.85.185.0/24 209.85.186.0/24 209.85.187.0/24 209.85.188.0/24 209.85.189.0/24 209.85.190.0/24 209.85.191.0/24 209.85.192.0/24 209.85.193.0/24 209.85.194.0/24 209.85.195.0/24 209.85.196.0/24 209.85.197.0/24 209.85.198.0/24 209.85.199.0/24 209.85.200.0/24 209.85.201.0/24 209.85.202.0/24 209.85.203.0/24 209.85.204.0/24 209.85.205.0/24 209.85.206.0/24 209.85.207.0/24 209.85.208.0/24 209.85.209.0/24 209.85.210.0/24 209.85.211.0/24 209.85.212.0/24 209.85.213.0/24 209.85.214.0/24 209.85.215.0/24 209.85.216.0/24 209.85.217.0/24 209.85.218.0/24 209.85.219.0/24 209.85.220.0/24 209.85.221.0/24 209.85.222.0/24 209.85.223.0/24 209.85.224.0/24 209.85.225.0/24 209.85.226.0/24 209.85.227.0/24 209.85.228.0/24 209.85.229.0/24 209.85.230.0/24 209.85.231.0/24 209.85.232.0/24 209.85.233.0/24 209.85.234.0/24 209.85.235.0/24 209.85.236.0/24 209.85.237.0/24 209.85.238.0/24 209.85.239.0/24 209.85.240.0/24 209.85.241.0/24 209.85.242.0/24 209.85.243.0/24 209.85.244.0/24 209.85.245.0/24 209.85.246.0/24 209.85.247.0/24 209.85.248.0/24 209.85.249.0/24 209.85.250.0/24 209.85.251.0/24 209.85.252.0/24 209.85.253.0/24 209.85.254.0/24 209.85.255.0/24 216.239.32.0/24 216.239.33.0/24 216.239.34.0/24 216.239.35.0/24 216.239.36.0/24 216.239.37.0/24 216.239.38.0/24 216.239.39.0/24 216.239.40.0/24 216.239.41.0/24 216.239.42.0/24 216.239.43.0/24 216.239.44.0/24 216.239.45.0/24 216.239.46.0/24 216.239.47.0/24 216.239.48.0/24 216.239.49.0/24 216.239.50.0/24 216.239.51.0/24 216.239.52.0/24 216.239.53.0/24 216.239.54.0/24 216.239.55.0/24 216.239.56.0/24 216.239.57.0/24 216.239.58.0/24 216.239.59.0/24 216.239.60.0/24 216.239.61.0/24 216.239.62.0/24 216.239.63.0/24 64.68.80.0/24 64.68.81.0/24 64.68.82.0/24 64.68.83.0/24 64.68.84.0/24 64.68.85.0/24 64.68.86.0/24 64.68.87.0/24 64.68.88.0/24 64.68.89.0/24 64.68.90.0/24 64.68.91.0/24 64.68.92.0/24 8.6.48.0/24 8.6.49.0/24 8.6.50.0/24 8.6.51.0/24 8.6.52.0/24 8.6.53.0/24 8.6.54.0/24 8.6.55.0/24 )

RedesPermitidas=( ${RedesGoogle[@]} ${RedesLevel3[@]} ${GoogleCloud[@]}  ${GoogleBots[@]})

#######################################################################
# PARAMETROS Y VARIABLES BASICAS DE TRABAJO
Cortafuegos=/sbin/iptables		#Ruta al comando de cortafuegos
ComandoWGet=/usr/bin/wget 		#Ruta al comando wget
CarpetaTrabajo=/tmp/pfirewall	#Ruta a la carpeta de trabajo del script (debe ser escribible)  ZONEROOT
ListaPaisesBloqueados="Paises"	#Lista de los paises a ser pasados a IpTables para ser bloqueados
URLDescargaBase="http://www.ipdeny.com/ipblocks/data/countries"
ArchivoListaFull="$URLDescargaBase/all-zones.tar.gz"
ComandoReinicioServicio=`systemctl restart iptables.service`		# /etc/init.d/iptables restart	| service iptables restart	| systemctl restart iptables.service
ComandoGuardadoFirewall=`service iptables save`	# /etc/init.d/iptables save		| service iptables save		| /usr/libexec/iptables/iptables.init save

#######################################################################
#######################################################################
# Obtengo la ruta de ejecucion del script y fecha actual
	FECHA=$(date)  # Obtengo la fecha y hora actual
	SCRIPT=$(readlink -f "$0")
	SCRIPTPATH=`dirname "$SCRIPT"`
	UsuarioActivo=$(whoami)
	SeparadorElementosActual=$IFS
	ProcesoValido=0
	ModoVisual=0
	#Si el tercer parametro es vacio o no recibido entonces lo llena con cualqueir cosa para hacer todo verbose
	if [ $# == 3 ]; then
		if [ $3 == "-d" ] || [ $3 == "--detalles" ]; then
			ModoVisual=1
		fi
	fi

	
#######################################################################
clear
echo "           _                        _                      "
echo "          |_)  _ _  _|_ .  _  _    |_ .  _ _        _  | | "
echo "          |   | (_|  |_ | (_ (_)   |  | | (/_ \/\/ (_| | | "
echo "---------------------------------------------------------------------"
echo "      Utilidad para el bloqueo de trafico por paises de origen"
echo " Copyright (C) 2016  John F. Arroyave Gutiérrez - www.practico.org "
echo "---------------------------------------------------------------------"


#######################################################################
# Valida usuario root
if [ "$UsuarioActivo" != "root" ]; then
   echo ""
   echo "ERROR:  Permisos insuficientes !!!"
   echo "  Este script debe ser ejecutado como usuario root para poder alterar"
   echo "  las reglas del Firewall.  Escale a su usuario e intente nuevamente."
   cd $SCRIPTPATH
   IFS=$SeparadorElementosActual
   exit 0
fi


#######################################################################
# Valida parametros minimos de entrada
if [ $# == 0 ]; then
	echo " 
Modo de empleo: ./pfirewall.sh -P [ListaCSV] -B [ListaCSV] -s

 -B, --bloqueados  Lista de codigos ISO de los paises bloqueados
                   Permite trafico de todos los paises menos los indicados

 -P, --permitidos  Lista de codigos ISO de los paises permitidos
                   Bloquea todos los codigos ISO de pais conocidos menos
                   los indicados dentro de la lista separada por comas.
 -d, --detalles    Presenta detalles de la ejecucion, descargas, etc.

  * Ej: ./pfirewall.sh -P co,cl  Bloquea todo menos Colommbia y Chile
  * Ej: ./pfirewall.sh -B af,br Permite todo menos Afganistan y Brasil
"
   cd $SCRIPTPATH
   IFS=$SeparadorElementosActual
   exit 0
fi


#######################################################################
#######################################################################
# Crea la carpeta de trabajo si no existe
[ ! -d $CarpetaTrabajo ] && /bin/mkdir -p $CarpetaTrabajo

# Se ubica en carpeta temporal de trabajo
cd $CarpetaTrabajo


#######################################################################
# Valida que se haya creado la carpeta de trabajo y estemos alli
DirectorioActual=$(pwd)
# Valida usuario root
if [ "$DirectorioActual" != "$CarpetaTrabajo" ]; then
   echo ""
   echo "ERROR:  Carpeta de trabajo no pudo ser creada correctamente !!!"
   echo "Path $CarpetaTrabajo"
   cd $SCRIPTPATH
   IFS=$SeparadorElementosActual
   exit 0
fi

# Limpia la carpeta de trabajo si realmente se encuentra alli
rm -rf $CarpetaTrabajo/*


#######################################################################
LimpiarReglasAnteriores()
	{
		$Cortafuegos -F
		$Cortafuegos -X
		$Cortafuegos -t nat -F
		$Cortafuegos -t nat -X
		$Cortafuegos -t mangle -F
		$Cortafuegos -t mangle -X
	}


#######################################################################
AplicarReglasGenerales()
	{
		$Cortafuegos -A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT
	}


#######################################################################
AceptarTodoTrafico()
	{
		$Cortafuegos -P INPUT ACCEPT
		$Cortafuegos -P OUTPUT ACCEPT
		$Cortafuegos -P FORWARD ACCEPT
	}


#######################################################################
RechazarTodoTraficoEntrante()
	{
		$Cortafuegos -P INPUT DROP
		$Cortafuegos -P OUTPUT DROP
		$Cortafuegos -P FORWARD DROP
	}


#######################################################################
#Valida si el parametro recibido es -B
if [ $1 == "-B" ] || [ $1 == "--bloqueados" ]; then
	#Limpia las reglas existentes actualmente en el cortafuegos
	LimpiarReglasAnteriores
	AplicarReglasGenerales
	AceptarTodoTrafico
	
	if [ $ModoVisual = 1 ]; then	
		echo ""
		echo "Generando reglas de bloqueo para los paises con codigo ISO:
	   $2
		"
	fi
	
	ListaPaises=$2							#Toma la lista de codigos ISO
	IFS=','									#Define el separador de campos
	read -r -a ArregloPaises <<< "$ListaPaises"		#Convierte la lista en un arreglo
	#Recorre el arreglo de codigos
	for CodigoPais in "${ArregloPaises[@]}"
	do
		if [ $ModoVisual = 1 ]; then
			echo "Procesando listas de direcciones IP para pais: [${CodigoPais^^}]"
		fi
		
		#Archivo de zona local para guardar las direcciones
		ArchivoRangosIP=$CarpetaTrabajo/$CodigoPais.zone

		# Descarga un archivo fresco para ese codigo de pais de modo silencioso
		if [ $ModoVisual = 1 ]; then
			echo "Descargando segmentos de direcciones para [${CodigoPais^^}]"
		fi
		$ComandoWGet -q -O $ArchivoRangosIP $URLDescargaBase/$CodigoPais.zone
	 
		# Mensaje de log en el firewall especifico para el pais
		MensajeLog="Bloqueo de pais: ${CodigoPais^^}"	#Log en mayuscula para el codigo
	 
		# Procesa cada una de las lineas del archivo
		oldIFS=$IFS  #Almacenamos el valor original de la variable IFS
		IFS=$'\n'    #Cambiamos el valor del IFS
		echo "Aplicando reglas de pais [${CodigoPais^^}]"
		for BloqueDireccionesIP in $(cat $ArchivoRangosIP)
			do
				$Cortafuegos -I INPUT -s $BloqueDireccionesIP -j LOG --log-prefix "$MensajeLog"		#Agrega log de eventos para la regla
				$Cortafuegos -I INPUT -s $BloqueDireccionesIP -j DROP    							#Bloquea trafico entrante.  Opcional agregar regla OUTPUT
				if [ $ModoVisual = 1 ]; then
					echo "   Agregando al bloqueo segmento de red [${CodigoPais^^}] = $BloqueDireccionesIP"
				fi
			done
		IFS=$oldIFS  #Restauramos el IFS
	done
	ProcesoValido=1
fi


#######################################################################
#Valida si el parametro recibido es -P
if [ $1 == "-P" ] || [ $1 == "--permitidos" ]; then
	#Descarga todo lo necesario antes de cerrar el trafico
	ListaPaises=$2							#Toma la lista de codigos ISO
	IFS=','									#Define el separador de campos
	read -r -a ArregloPaises <<< "$ListaPaises"		#Convierte la lista en un arreglo
	#Recorre el arreglo de codigos
	for CodigoPais in "${ArregloPaises[@]}"
	do
		#Archivo de zona local para guardar las direcciones
		ArchivoRangosIP=$CarpetaTrabajo/$CodigoPais.zone

		# Descarga un archivo fresco para ese codigo de pais de modo silencioso
		if [ $ModoVisual = 1 ]; then
			echo "Descargando segmentos de direcciones para [${CodigoPais^^}]"
		fi
		$ComandoWGet -q -O $ArchivoRangosIP $URLDescargaBase/$CodigoPais.zone
	done

	#Limpia las reglas existentes actualmente en el cortafuegos
	LimpiarReglasAnteriores
	AplicarReglasGenerales
	RechazarTodoTraficoEntrante
	
	if [ $ModoVisual = 1 ]; then	
		echo ""
		echo "Generando reglas de aceptacion para los paises con codigo ISO:"
	    echo "   $2
		"
	fi
	
	#Recorre el arreglo de codigos
	for CodigoPais in "${ArregloPaises[@]}"
	do
		if [ $ModoVisual = 1 ]; then
			echo "Procesando listas de direcciones IP para pais: [${CodigoPais^^}]"
		fi

		# Procesa cada una de las lineas del archivo
		oldIFS=$IFS  #Almacenamos el valor original de la variable IFS
		IFS=$'\n'    #Cambiamos el valor del IFS
		echo "Aplicando reglas de pais [${CodigoPais^^}]"
		for BloqueDireccionesIP in $(cat $ArchivoRangosIP)
			do
				$Cortafuegos -A INPUT -s $BloqueDireccionesIP -d 0/0 -j ACCEPT
				$Cortafuegos -A OUTPUT -s $BloqueDireccionesIP -d 0/0 -j ACCEPT
				$Cortafuegos -A FORWARD -s $BloqueDireccionesIP -d 0/0 -j ACCEPT

				$Cortafuegos -A INPUT -s 0/0 -d $BloqueDireccionesIP -j ACCEPT
				$Cortafuegos -A OUTPUT -s 0/0 -d $BloqueDireccionesIP -j ACCEPT
				$Cortafuegos -A FORWARD -s 0/0 -d $BloqueDireccionesIP -j ACCEPT
				
				if [ $ModoVisual = 1 ]; then
					echo "   Agregando aceptacion al segmento de red [${CodigoPais^^}] = $BloqueDireccionesIP"
				fi
			done
		IFS=$oldIFS  #Restauramos el IFS
	done
	ProcesoValido=1
fi


if [ $ProcesoValido == 1 ]; then

	#Permite siempre las redes Permitidas por el usuario
	echo ""
	echo "Aplicando reglas de redes siempre permitidas (Ej.Google,Level3,etc)  Total: ${#RedesPermitidas[*]}"
	for BloqueDireccionesIP in ${RedesPermitidas[*]}
	do
		$Cortafuegos -A INPUT -s $BloqueDireccionesIP -d 0/0 -j ACCEPT
		$Cortafuegos -A OUTPUT -s $BloqueDireccionesIP -d 0/0 -j ACCEPT
		$Cortafuegos -A FORWARD -s $BloqueDireccionesIP -d 0/0 -j ACCEPT

		$Cortafuegos -A INPUT -s 0/0 -d $BloqueDireccionesIP -j ACCEPT
		$Cortafuegos -A OUTPUT -s 0/0 -d $BloqueDireccionesIP -j ACCEPT
		$Cortafuegos -A FORWARD -s 0/0 -d $BloqueDireccionesIP -j ACCEPT
		if [ $ModoVisual = 1 ]; then
			echo "   Aceptando trafico de host o segmento confiable  = $BloqueDireccionesIP"
		fi
	done

	#Reinicia el servicio de cortafuegos con las nuevas reglas
	#$ComandoGuardadoFirewall
	$ComandoReinicioServicio
fi


echo "
PROCESO FINALIZADO!
Ejecute  'iptables -L'  o  'iptables -L -n -v'  para ver su estado
Ejecute  watch -d -n 2 iptables -nvL            para monitorear el firewall
Ejecute  nmap -sT -O localhost para confirmar los puertos abiertos"


# Drop everything 
#$Cortafuegos -I INPUT -j $ListaPaisesBloqueados
#$Cortafuegos -I OUTPUT -j $ListaPaisesBloqueados
#$Cortafuegos -I FORWARD -j $ListaPaisesBloqueados

#######################################################################
#Reglas adicionales para otros servicios
$Cortafuegos -I INPUT -p tcp --dport 22 -j ACCEPT		# SSH
$Cortafuegos -I INPUT -p tcp --dport 53 -j ACCEPT		# DNS
$Cortafuegos -I INPUT -p tcp --dport 80 -j ACCEPT		# Servidor web apache
$Cortafuegos -I INPUT -p tcp --dport 82 -j ACCEPT		# Servicio X en puerto 82
$Cortafuegos -I INPUT -p tcp --dport 443 -j ACCEPT		# Puerto SSL para Apache
# /path/to/other/iptables.sh							# Llamado a otros scripts definidos para el cortafuegos


#######################################################################
# Regreso a la ruta inicial de ejecucion
cd $SCRIPTPATH
IFS=$SeparadorElementosActual
exit 0
 