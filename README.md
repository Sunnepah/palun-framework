### PHP Web App

NOTE: Requires [Composer](https://getcomposer.org/)

#### Set Up
$ `git clone https://github.com/Sunnepah/php-webapp.git`

$ `cd php-webapp`

$ `composer install`

$ `create MYSQL database 'address_db' in your machine and import address_db20160703.sql file`

$ `Change your database credentials in 'application/Config/DBConfig.php'`

$ `php -S 0.0.0.0:8080 -t web/`

$ List addresses endpoint - `curl -X GET http://0.0.0.0:8080/addresses`

$ Add new address - `curl -X POST -H "Content-Type: application/json" -d '{ "names" : "Sunday", "number" : "567309800", "street" : "Tallinn 34"}' "http://0.0.0.0:8080/address" `

$ Retrieve an address - `curl -X GET "http://0.0.0.0:8080/address?id=1" `

$ Update an address - `curl -X PUT -H "Content-Type: application/json" -d '{  "names" : "Sunday", "number" : "56724770",  "street" : "Tallinn 33"}' "http://0.0.0.0:8080/address?id=1"`

$ Delete an address - `curl -X DELETE "http://0.0.0.0:8080/address?id=15"`

#### To run tests
$ `./vendor/bin/phpunit tests`
