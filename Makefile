init: \
	docker-clean \
	docker-up \
	composer-install \
	db-migration \
	db-migration-test

up: docker-up

stop: docker-stop

lint: \
	composer-validate \
	phplint \
	php-cs-fixer \
	psalm \
	phpstan

docker-clean:
	docker compose down -v --remove-orphans

docker-up:
	docker compose up --build -d

docker-stop:
	docker compose stop

db-migration:
	docker compose run --rm php-cli bin/console migrate:fresh --drop-views


composer-install:
	docker compose run --rm php-cli composer install

composer-update:
	docker compose run --rm php-cli composer update

composer-validate:
	docker compose run --rm php-cli composer validate --no-check-all

lint: \
	composer-validate \
	phplint \
	php-cs-fixer \
	phpstan \
	psalm

phplint:
	docker compose run --rm php-cli vendor/bin/phplint

php-cs-fixer:
	docker compose run --rm php-cli vendor/bin/php-cs-fixer fix --dry-run --diff --show-progress=dots --allow-risky=yes -v

php-cs-fixer-fix:
	docker compose run --rm php-cli vendor/bin/php-cs-fixer fix --verbose --diff --show-progress=dots --allow-risky=yes

phpstan:
	docker compose run --rm php-cli vendor/bin/phpstan analyse --xdebug

phpstan-update-baseline:
	docker compose run --rm php-cli vendor/bin/phpstan analyse --generate-baseline

psalm:
	docker compose run --rm php-cli vendor/bin/psalm

psalm-update-baseline:
	docker compose run --rm php-cli vendor/bin/psalm --no-cache --update-baseline=psalm-baseline.xml

test:
	docker compose run --rm -e DB_DATABASE=app_test php-cli vendor/bin/phpunit --testsuite unit,integration

cache-clear:
	docker compose run --rm php-cli bin/console cache:clear

console:
	docker compose run --rm php-cli bin/console $(command)

rb:
	docker compose run --rm php-cli $(command)
