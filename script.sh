#!/bin/sh

cd /vagrant

# UPDATE COMPOSER
if [ -f composer.lock ]; then
  /usr/local/bin/composer update
else
  /usr/local/bin/composer install
fi

# SETUP CAKEPHP CONFIG
cp app/Config/core.php.sample app/Config/core.php
cp app/Config/database.php.sample app/Config/database.php

# CREATE DATABASE
if [ ! -f app/tmp/database/default ]; then
  yes | php app/Console/cake.php -app /vagrant/app schema create App
fi
