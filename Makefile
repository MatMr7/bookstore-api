migrate:
	docker-compose exec app php artisan migrate
optimize:
	docker-compose exec app php artisan optimize
rebuild:
	bash ./vendor/bin/sail up --build
up:
	bash ./vendor/bin/sail up -d
down:
	bash ./vendor/bin/sail down
stop:
	bash ./vendor/bin/sail stop
dump-autoload:
	docker-compose exec app composer dump-autoload
composer-install:
	docker-compose exec app composer dump-autoload
