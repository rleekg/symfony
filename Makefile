init: \
	docker-clean \
	docker-up \
	composer-install \
	db-migration \

up: docker-up

stop: docker-stop

docker-clean:
	docker compose down -v --remove-orphans

docker-up:
	docker compose up --build -d

docker-stop:
	docker compose stop

db-migration:
	docker compose run --rm php-cli bin/console

composer-install:
	docker compose run --rm php-cli composer install

composer-update:
	docker compose run --rm php-cli composer update

composer-validate:
	docker compose run --rm php-cli composer validate --no-check-all

console:
	docker compose run --rm php-cli bin/console $(command)
