# Hello-world

Create .env form .env.example and change passwords

### Execute:

composer install

composer dump-autoload

####To update database and create tables:

vendor/bin/phinx migrate

vendor/bin/phinx seed:run

####To analyze PHP Code

./vendor/bin/psalm

####To execute PHP Unit tests:

./vendor/bin/phpunit ./tests/phpunit/*