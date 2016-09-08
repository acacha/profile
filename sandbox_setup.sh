#!/bin/bash
if ! type "laravel" > /dev/null; then
    composer global require "laravel/installer"
fi
rm -rf sandbox
if [ -e ~/.composer/vendor/bin/laravel ]
then
    ~/.composer/vendor/bin/laravel new sandbox
fi
if [ -e ~/.config/composer/vendor/bin/laravel ]
then
  ~/.config/composer/vendor/bin/laravel new sandbox
fi
cd sandbox
composer require "acacha/profile=dev-master"
if ! type "llum" > /dev/null; then
    composer global require "acacha/llum=~1.0"
fi
llum provider Acacha\\Profile\\Providers\\ProfileServiceProvider::class
touch database/database.sqlite


