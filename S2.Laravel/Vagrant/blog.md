# Laravel 5.2 on CentOS 7.2 up and running

I was asked to develop this web application for an academic research project recently and I was looking for robust backend framework. PHP was my obvious choice but there are tons of frameworks written in PHP, so like any other millennial I have decided to look what's trending :

![Google trending](https://lh3.googleusercontent.com/TqVGqKeq9Ce9x9Aq5b1tX37oJyfLGoQME_XOfDNSJdWTHrCIbRk9Ba45b5aV8P7GHyl2YIdcMzhm0w=w867-h546-no)

Also, I have been hearing a lot of good things about Laravel, so I have decided to go with Laravel. To get started with the framework we need to setup a development environment and Laravel documentation allows you to install in couple of ways:
1. [Pre-built homestead vagrant box](https://laravel.com/docs/5.2/homestead)
1. [Using composer](https://laravel.com/docs/5.2)

Keeping in mind that I need to deploy this project one day to a production server I have decided to build a vagrant box with CentOS 7. Following is the step by step tutorial on how to build your own Laravel 5.2 vagrant box with CentOS 7.2.

Note: I assume that the readers have basic understanding of vagrant/virtual development environments and server requests

## 1. Getting vagrant box ready
1. Create a `Vagrantfile` within your project directory. I like to keep my naming conventions simple, so for me it is `Vagrant/Vagrantfile`
1. open your `Vagrantfile` and include:

    ```bash
    # -*- mode: ruby -*-
    # vi: set ft=ruby :

    PROJECT_NAME = "MyLaravel"
    API_VERSION  = "2"

    Vagrant.configure(API_VERSION) do |config|
    	config.vm.define PROJECT_NAME, primary: true do |config|
    		config.vm.provider :virtualbox do |vb|
    			vb.name = PROJECT_NAME
    		end

    		config.vm.box = "bento/centos-7.2"
        config.vm.network "private_network", ip: "192.168.56.6"
    		config.vm.network :forwarded_port, guest: 80, host: 8056
    		config.vm.provision "shell", path: "bootstrap.sh"
    	end
    end
    ```
1. Now, you can see that we have included a provision file `bootstrap.sh`, let's create `bootstrap.sh` in your project directory. So it will be `Vagrant/bootstrap.sh`

## 2. Install LAMP stack and composer
1. We will install the lamp stack and composer with vagrant provision so that it is simple enough for us to install laravel from there onwards. Open `bootstrap.sh` and include:

  ```bash
  #!/bin/bash

  #title           :bootstrap.sh
  #description     :This script will install laravel on PHP 7
  #author		       :Ajay Krishna Teja Kavuri
  #date            :20160718
  #version         :0.1
  #==============================================================================

  #Formal update for no reason
  yum -y update

  #Setup Yum messages
  rpm -Uvh http://repo.mysql.com/mysql-community-release-el7-5.noarch.rpm
  rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
  rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
  yum -y update
  echo -e "----Added RPM's----\n\n"

  # Install apache
  yum -y install httpd httpd-devel httpd-manual httpd-tools
  echo -e "----Installed Apache----\n\n"

  # Install MySQL
  yum -y install mysql-connector-java mysql-connector-odbc mysql-devel mysql-lib mysql-server
  echo -e "----Installed MySQL----\n\n"

  # Install MySQL mods
  yum -y install mod_auth_kerb mod_auth_mysql mod_authz_ldap mod_evasive mod_perl mod_security mod_ssl mod_wsgi
  echo -e "----Installed Auth Plugins for MySQL----\n\n"

  # Install PHP 7
  yum -y install php70w php70w-bcmath php70w-cli php70w-common php70w-gd php70w-ldap php70w-mbstring php70w-mcrypt php70w-mysql php70w-odbc php70w-pdo php70w-pear php70w-pear-Benchmark php70w-pecl-apc php70w-pecl-imagick php70w-pecl-memcache php70w-soap php70w-xml php70w-xmlrpc
  echo -e "----Installed PHP 7----\n\n"

  # Start and set apache
  sudo systemctl start httpd
  sudo systemctl enable httpd
  echo -e "----Started Apache----\n\n"

  # Install composer
  curl -sS https://getcomposer.org/installer | php
  sudo chmod +x composer.phar
  mv composer.phar /usr/bin/composer
  echo -e "----Installed composer----\n\n"

  ```
Note: Feel free to go ahead and change the header of this bash file

1. Now your vagrant environment is ready. Go ahead and do a `vagrant up` from your project directory. In my case project directory will be `Vagrant`.

## 3. Install and configure laravel with composer
1. Run `vagarnt ssh` to get into your vagrant box
1. Change your directory, I choose `vagrant` filepath so that I can see changes on my local machine.
```bash
cd /home/vagrant
```
1. Install laravel installer
```bash
composer global require "laravel/installer"
```
1. export the path for using `laravel` tool set
```bash
export PATH=~/.config/composer/vendor/bin:$PATH
```
1. Create a new laravel project
```bash
laravel new MyLaravel
```
1. move your project to apache folder
```bash
sudo mv /home/vagrant/MyLaravel /var/www/html
```
1. Change the permissions for laravel storage and apache
```bash
chmod 775 /var/www/html/MyLaravel/storage
sudo chown -R apache:apache /var/www/html/MyLaravel
sudo chmod 755 /var/www
```
1. Add VirtualHost to httpd config
```bash
Alias /MyLaravel /var/www/html/MyLaravel/public
<VirtualHost *:80>
       DocumentRoot /var/www/html/MyLaravel/public

       <Directory /var/www/html/MyLaravel>
              AllowOverride All
       </Directory>
</VirtualHost>
```
1. Restart the apache
```bash
sudo systemctl restart httpd
```
## 4. Demo
Once you open your vagrant host which should be http://192.168.56.6 (if you use the same vagrantfile) you should see something like this:
![Laravel](http://i.giphy.com/l46CkQtr1LbsbCQsE.gif)

## Remarks
I am very much aware that laravel comes with it's own server and lot simpler to just install `php` and use laravel installer but this method will give me superhero powers to destroy and rebuild environment and also allow me to deploy this on a production server lot quicker.
