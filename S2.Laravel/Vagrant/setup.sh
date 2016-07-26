# Set the configurations
chmod 775 /var/www/html/MyLaravel/storage
sudo chown -R apache:apache /var/www/html/MyLaravel
sudo chmod 755 /var/www
sudo rm -R /etc/httpd/conf/httpd.conf
sudo ln -s /vagrant/httpd.conf /etc/httpd/conf
sudo systemctl restart httpd
