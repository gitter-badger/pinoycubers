#!/usr/bin/env bash

echo "--- Good morning, master. Let's get to work. Installing now. ---"


echo "--- Editing sources for raring ---"

#cp -R /vagrant/sources.list /etc/apt/sources.list

echo "--- Updating packages list ---"
sudo apt-get update

echo "--- MySQL time ---"
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

echo "--- Installing base packages ---"
sudo apt-get install -y vim curl python-software-properties python g++ make

echo "--- We want the bleeding edge of PHP, right master? ---"
export LANG=C.UTF-8 
sudo add-apt-repository -y ppa:ondrej/php5

echo "--- Updating packages list ---"
sudo apt-get update

echo "--- Installing PHP-specific packages ---"
sudo apt-get install -y php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt mysql-server-5.5 php5-mysql git-core
sudo php5enmod mcrypt


echo "--- Installing and configuring Xdebug ---"
sudo apt-get install -y php5-xdebug

cat << EOF | sudo tee -a /etc/php5/mods-available/xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF

echo "--- Adding apache ppa ---"
#sudo add-apt-repository -y ppa:rhardy/apache24x

echo "--- Updating packages list ---"
sudo apt-get update

echo "--- Installing apache2 ---"
sudo apt-get install -y apache2

echo "--- Enabling mod-rewrite ---"
sudo a2enmod rewrite

echo "--- Setting document root ---"

sudo rm -rf /var/www/html
sudo ln -fs /vagrant /var/www/html


echo "--- What developer codes without errors turned on? Not you, master. ---"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

sudo sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
sudo sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

echo "--- Restarting Apache ---"
sudo service apache2 restart

echo "--- Allow remote database access --"
sudo sed -i "s/^bind-address/#bind-address/" /etc/mysql/my.cnf
sudo service mysql restart 

echo "--- Composer is the future. But you knew that, did you master? Nice job. ---"
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer


# Laravel stuff here, if you want
dbName="pinoycubers"
dbUser="root"
dbPass="root"
mysql -u $dbUser -p$dbPass -Bse "CREATE DATABASE $dbName;"
mysql --user=$dbUser --password=$dbPass << 'EOF'
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root';
EOF

echo "--- Running site specific commands --"
cd /var/www/html

echo "--- Setting up configuration file --"
cp -fr .env.example .env
sed -i "s/^DB_PASSWORD=/DB_PASSWORD=root/" .env

composer install
php artisan migrate
php artisan db:seed
chown -R www-data:www-data storage
chmod 775 -R storage

sudo bash /vagrant/node.sh