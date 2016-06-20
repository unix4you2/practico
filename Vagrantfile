# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  #Caja utilizada:  vagrant box add CentOS7_Practico https://github.com/CommanderK5/packer-centos-template/releases/download/0.7.1/vagrant-centos-7.1.box 
  config.vm.box = "CentOS7_Practico"

  # Redireccion del puerto apache en la VM para su uso local sobre el puerto 81 del anfitrion
    config.vm.network :forwarded_port, host: 8080, guest: 80

  # Red privada (host-only)
  config.vm.network "private_network", ip: "192.168.55.100"

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
	sudo yum -y install httpd
	sudo systemctl start httpd.service
	sudo systemctl enable httpd.service

	#Instalacion de PHP
	sudo yum -y install php php-mysql php-gd php-ldap php-odbc php-pear php-xml php-xmlrpc php-mbstring php-snmp php-soap curl curl-devel
	sudo systemctl restart httpd.service
	
	sudo mv /var/www/html /var/www/html_old
	sudo ln -s /vagrant /var/www/html
	
	#Instalacion de MariaDB
	sudo yum -y install mariadb-server mariadb
	sudo systemctl start mariadb.service
	sudo systemctl enable mariadb.service
	
	#Instalacion de la base de datos
	mysql --user=root -e "CREATE DATABASE IF NOT EXISTS practico;"	
	mysql -h "localhost" --user=root --database=practico < "ins/sql/practico.mysql"
	mysql --user=root -e "FLUSH PRIVILEGES;"		
	mysql --user=root -e "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('mypass');"

	echo "-------------- FIN APROVISIONAMIENTO --------------"
  SHELL

end
