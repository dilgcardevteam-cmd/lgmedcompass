#!/usr/bin/env bash
set -o errexit

echo "Checking for Composer..."
if ! command -v composer &> /dev/null
then
    echo "Composer not found, downloading it..."
    curl -sS https://getcomposer.org/installer | php
    export COMPOSER_PATH="./composer.phar"
else
    export COMPOSER_PATH="composer"
fi

echo "Installing dependencies..."
php $COMPOSER_PATH install --no-dev --optimize-autoloader

echo "Compiling assets..."
npm install && npm run build