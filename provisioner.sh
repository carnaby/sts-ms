#!/bin/bash

#sudo apt-get install python-software-properties -y
#sudo LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php -y
#
sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 0C49F3730359A14518585931BC711F9BA15703C6
echo "deb [ arch=amd64,arm64 ] http://repo.mongodb.org/apt/ubuntu xenial/mongodb-org/3.4 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-3.4.list

sudo apt-get update

sudo apt-get install -y mongodb-org
sudo apt-get install -y mc

#sudo apt-get install -y mongodb-clients mongodb-server
#php-mongo
#
sudo apt-get install php7.0 php-mongodb -y
#php7.0-fpm
#sudo apt-get --purge autoremove -y
#sudo service php7.0-fpm restart

#php7.0-mysql
#sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
#sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
#sudo apt-get -y install mysql-server mysql-client
#sudo service mysql start

#sudo service mongod start

sudo apt-get install nginx -y
sudo cat > /etc/nginx/sites-available/default <<- EOM
server {
	listen 80 default_server;
	listen [::]:80 default_server ipv6only=on;

	root /vagrant/sts-ms;
	index index.php index.html index.htm;

	server_name server_domain_or_IP;

	location / {
		try_files \$uri \$uri/ /index.php?\$query_string;
	}

	location ~ \.php\$ {
		try_files \$uri /index.php =404;
		fastcgi_split_path_info ^(.+\.php)(/.+)\$;
		fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
		fastcgi_index index.php;
		fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
		include fastcgi_params;
	}
}
EOM
sudo service nginx restart
