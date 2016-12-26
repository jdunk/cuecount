#!/usr/bin/env bash

# set up bash
git clone https://github.com/jdunk/dotfiles 2>/dev/null
echo 'cd /vagrant/
SUPER_BASHRC="$HOME/dotfiles/.bashrc"
[ -f $SUPER_BASHRC ] && . $SUPER_BASHRC' > .bashrc
ln -nfs dotfiles/.gitconfig .gitconfig
ln -nfs dotfiles/.vim .vim
ln -nfs dotfiles/.vimrc .vimrc
ln -nfs dotfiles/.screenrc .screenrc

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

