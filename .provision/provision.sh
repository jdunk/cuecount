#!/usr/bin/env bash

# fix ppa and install xdebug
# and I would've gotten away with it too! >:D >:D >:D
rm /etc/apt/sources.list.d/ondrej-php-*
add-apt-repository ppa:ondrej/php
add-apt-repository ppa:ondrej/php-qa

apt-get install -y software-properties-common
apt-get update
apt-get purge -y hhvm
rm -rf /etc/php/7.0/
apt-get purge -y php7.0-fpm
apt-get install -y php7.1-fpm
apt-get install -y php7.1-pdo-mysql
apt-get install -y php7.1-gd
apt-get install -y php-xdebug
bash -c "echo 'xdebug.remote_autostart=1
xdebug.remote_enable=1
xdebug.remote_host=10.0.2.2
xdebug.remote_port=9000' > /etc/php/7.1/fpm/conf.d/21-xdebug.ini"
apt-get --purge -y autoremove
service php7.1-fpm restart

# fix mysql 5.7 config
grep sql_mode /etc/mysql/my.cnf >/dev/null

if [[ $? -ne 0 ]]; then
  echo 'sql_mode = NO_ENGINE_SUBSTITUTION' >> /etc/mysql/my.cnf
  service mysql restart
fi

# set up bash
cd /home/vagrant
git clone https://github.com/jdunk/dotfiles 2>/dev/null
echo 'cd /vagrant/
SUPER_BASHRC="$HOME/dotfiles/.bashrc"
[ -f $SUPER_BASHRC ] && . $SUPER_BASHRC' > .bashrc
ln -nfs dotfiles/.gitconfig .gitconfig
ln -nfs dotfiles/.vim .vim
ln -nfs dotfiles/.vimrc .vimrc
ln -nfs dotfiles/.screenrc .screenrc
cd -

# gnu screen
apt-get install screen

# set up nginx server
sudo mkdir /etc/nginx/sites-available 2>/dev/null
sudo mkdir /etc/nginx/sites-enabled 2>/dev/null
sudo cp /vagrant/.provision/nginx/cuecountapp.com /etc/nginx/sites-available/cuecountapp.com
sudo chmod 644 /etc/nginx/sites-available/cuecountapp.com
sudo ln -s /etc/nginx/sites-available/cuecountapp.com /etc/nginx/sites-enabled/cuecountapp.com 2>/dev/null
sudo service nginx restart

# clean /var/www
sudo rm -Rf /var/www/*

# symlink /var/www/cuecountapp.com => /vagrant
ln -s /vagrant /var/www/cuecountapp.com

# set up MySQL
echo 'GRANT ALL ON *.* TO cuecount_db_user@`%` IDENTIFIED BY '\''cuecount123$'\''; FLUSH PRIVILEGES; CREATE DATABASE cuecount;' |mysql -uroot -psecret 2>/dev/null
