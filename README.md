# Hello-world

Create .env form .env.example and change passwords

### Execute:

composer install

composer dump-autoload

To update database and create tables:

vendor/bin/phinx migrate -e development

vendor/bin/phinx seed:run
