#!/bin/bash

#title           :init.sh
#description     :This script will install laravel on PHP 7
#author		       :Ajay Krishna Teja Kavuri
#date            :20160718
#version         :0.1
#==============================================================================
cd .
composer global require "laravel/installer"
export PATH=~/.config/composer/vendor/bin:$PATH
laravel new MyLaravel
sudo mv ~/MyLaravel /var/www/html
chmod 775 /var/www/html/MyLaravel/storage
sudo chown -R apache:apache /var/www/html/MyLaravel
sudo chmod 755 /var/www
sudo rm -R /etc/httpd/conf/httpd.conf
sudo ln -s /vagrant/httpd.conf /etc/httpd/conf
sudo systemctl restart httpd
