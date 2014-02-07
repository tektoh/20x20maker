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
    php composer.phar install
    chmod 666 -R app/tmp
    chmod 666 -R app/webroot/thumbs
    cp -v app/Config/core.php.sample app/Config/core.php
    cp -v app/Config/database.php.sample app/Config/database.php
