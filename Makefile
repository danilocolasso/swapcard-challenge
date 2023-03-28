build:
	docker-compose build
	${MAKE} up
	docker-compose exec app composer install
	sleep 5 # To give the database service enough time to fully start up and be ready to accept connections
	${MAKE} migrate

migrate:
	docker-compose exec app vendor/bin/doctrine orm:schema-tool:create

up:
	docker-compose up -d

down:
	docker-compose down -v

ps:
	docker-compose ps

logs:
	docker-compose logs -f

bash:
	docker-compose exec app sh
