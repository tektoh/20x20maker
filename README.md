20x20maker
==========

動作環境
--------
* PHP5.4
* Imagemagick

インストール手順
----------------

    git clone git@github.com:tektoh/20x20maker.git
    cd 20x20maker
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install
    cd app
    cp -v Config/core.php.sample Config/core.php
    cp -v Config/database.php.sample Config/database.php
    Console/cake schema create DbApp
    chmod 666 -R tmp
    chmod 666 -R webroot/thumbs
