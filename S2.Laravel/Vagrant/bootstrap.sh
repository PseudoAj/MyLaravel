#!/bin/bash

#title           :bootstrap.sh
#description     :This script will install laravel on PHP 7
#author		       :Ajay Krishna Teja Kavuri
#date            :20160718
#version         :0.1
#==============================================================================

#Formal update for no reason
sudo apt-get -y update

# Install PHP 7
echo "------Installing PHP 7-----------"
sudo apt-get -y install python-software-properties
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get -y update
sudo apt-get -y install -y php7.0 php7.0-cli php7.0-fpm php7.0-gd php7.0-json php7.0-mysql php7.0-readline php7.0-mbstring php7.0-zip

# Install composer
#sudo apt-get install -y curl > /dev/null
#curl -Ss https://getcomposer.org/installer | php > /dev/null
#sudo mv composer.phar /usr/bin/composer

# Laravel Installers
#composer global require "laravel/installer"
#echo "export PATH=~/.config/composer/vendor/bin:$PATH"
