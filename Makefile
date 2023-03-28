build:
	cp .env.sample .env
	docker-compose build
	${MAKE} up
	docker-compose exec app composer install
	sleep 10 # To give the database service enough time to fully start up and be ready to accept connections
	${MAKE} migrate

migrate:
	docker-compose exec app vendor/bin/doctrine orm:schema-tool:create

up:
	docker-compose up -d

down:
	docker-compose down -v

tests:
	docker-compose exec app ./vendor/bin/phpunit

bash:
	docker-compose exec app sh
