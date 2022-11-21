# -*- mode: ruby -*-
# vi: set ft=ruby :

# VAGRANT PARA PEREZOSOS  1) apt install vagrant   2) git clone https://github.com/unix4you2/practico   3) cd practico
# ADICION MANUAL DE CAJA  4) vagrant box add CentOS7_Practico https://github.com/CommanderK5/packer-centos-template/releases/download/0.7.1/vagrant-centos-7.1.box
# EJECUCION DE LA CAJA    5) vagrant up 
# SUPERUSUARIO DE CAJA    root / vagrant       vagrant/vagrant

Vagrant.configure("2") do |config|

  # SI 4: config.vm.box = "CentOS7_Practico"
  config.vm.box="generic/centos7"

  # Redireccion del puerto apache en la VM para su uso local sobre el puerto 81 del anfitrion
    config.vm.network :forwarded_port, host: 8181, guest: 80

  # Red privada (host-only)
  config.vm.network "private_network", ip: "192.168.56.100"

  # Red en modo Bridge
  # config.vm.network "public_network"
  # config.vm.network "public_network", ip: "192.168.0.17"

  # Carpetas compartidas adicionales
  # config.vm.synced_folder "../data", "/vagrant_data"

  # Configuraciones especificas del proveedor
  #  config.vm.provider "virtualbox" do |vb|
  #    vb.gui = true
  #    vb.memory = "1024"
  #  end

  config.vm.provision "shell", inline: <<-SHELL
	echo "    /\\  _  _ _   . _. _  _  _  _ _ . _  _ _|_ _    "
	echo "   /~~\\|_)| (_)\\/|_\\|(_)| |(_|| | ||(/_| | | (_)   "
	echo "       |                                           "
	echo "---------------------------------------------------"

	#Instalacion de Apache
	sudo yum -y update
	sudo yum -y install httpd
	sudo systemctl start httpd.service
	sudo systemctl enable httpd.service

	#Instalacion de PHP
	sudo yum -y install php php-process php-mysql php-gd php-ldap php-odbc php-pear php-xml php-xmlrpc php-mbstring php-snmp php-soap curl curl-devel
	sudo systemctl restart httpd.service

	#Instalacion de herramientas de desarrollo
	sudo yum -y install git git-gui
	
	#Enlaza la carpeta del servidor web a la carpeta donde reside el repo
	sudo mv /var/www/html /var/www/html_old
	#sudo ln -s /vagrant /var/www/html
	cd /var/www
	git clone https://github.com/unix4you2/practico.git
	chmod 777 practico
	mv practico html
	cd html
	chmod -R 777 *
	sudo systemctl disable firewalld.service
	sudo systemctl stop firewalld.service

    #TODO: Descargar XMLs de ultima version y descomprimir

	#Instalacion de MariaDB
	sudo yum -y install mariadb-server mariadb
	sudo systemctl start mariadb.service
	sudo systemctl enable mariadb.service
	
	#Instalacion de la base de datos
	mysql --user=root -e "CREATE DATABASE IF NOT EXISTS practico;"	
	mysql -h "localhost" --user=root --database=practico < "/var/www/html/ins/sql/practico.mysql"
	mysql --user=root -e "FLUSH PRIVILEGES;"		
	mysql --user=root -e "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('mypass');"

    #Actualiza llaves de paso de usuarios segun valor del archivo configuracion
    cd /var/www/html/ins
    php paso_llave.php

	echo "-------------- FIN APROVISIONAMIENTO --------------"
	echo " "
	echo "  Puede ingresar mediante http://localhost:8181 "
	echo "                          http://192.168.56.100 "
	echo " "
	echo "  Usuario y Contrasena:   admin / admin"
	echo "---------------------------------------------------"
  SHELL

end
