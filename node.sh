#!/bin/sh


echo "--- Installing Node.js ---"
git clone https://github.com/creationix/nvm.git /home/vagrant/.nvm && cd /home/vagrant/.nvm && git checkout `git describe --abbrev=0 --tags`
source /home/vagrant/.nvm/nvm.sh
nvm install 0.12
nvm use 0.12
n=$(which node);n=${n%/bin/node}; chmod -R 755 $n/bin/*; sudo cp -r $n/{bin,lib,share} /usr/local

#echo "--- Install node app dependencies --"
#cd /var/www/html/node