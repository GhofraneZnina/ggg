#!/bin/bash

php bin/console doctrine:database:create --if-not-exists

php bin/console d:s:u --dump-sql --force
php bin/console c:c
