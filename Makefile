install:
	composer install
migration:
	php bin/console make:migration
migrate:
	php bin/console doctrine:migrations:migrate
yarn:
	yarn install
builds:
	symfony run yarn encore dev
server:
	symfony server:start
lint:
	composer phpcs
start:
	docker-compose up -d
	symfony server:start -d

