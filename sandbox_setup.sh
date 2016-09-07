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
touch database/database.sqlite


