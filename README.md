### PHP Web App

[![Build Status](https://travis-ci.org/Sunnepah/php-webapp.svg?branch=master)](https://travis-ci.org/Sunnepah/php-webapp)

NOTE: Requires [Composer](https://getcomposer.org/)

#### Set Up
$ `git clone https://github.com/Sunnepah/php-webapp.git`

$ `cd php-webapp`

$ `composer install`

$ `php -S 0.0.0.0:8080 -t web/`

$ `curl --request GET --url http://0.0.0.0:8080/address` # List address endpoint

#### To run tests
$ `./vendor/bin/phpunit tests`
