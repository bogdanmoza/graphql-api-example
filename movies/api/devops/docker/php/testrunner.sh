#!/bin/sh
set -e

if [ ! -z "$1" ]
then
  mkdir -p var/cache var/log
  composer install --prefer-dist --no-progress --no-suggest --no-interaction
  composer dump-env test
  rm .env
  bin/console doctrine:migrations:migrate --no-interaction
  vendor/bin/simple-phpunit
fi