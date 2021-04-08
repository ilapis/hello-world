# Hello-world

Create .env form .env.example and change passwords

## Enviroments

### Local / Development enviroment
docker-compose -f docker-compose.yml.development up -d

### Staging / Production
docker-compose -f docker-compose.yml.production up -d

### Execute:

composer install

composer dump-autoload

####To update database and create tables:

vendor/bin/phinx migrate -e development
vendor/bin/phinx seed:run -e development

####To analyze PHP Code

php ./vendor/bin/psalm

####To execute PHP Unit tests:

cd ./tests
composer install

php ./vendor/bin/phpunit ./tests/phpunit/*