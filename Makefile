init:
	make build
	docker-compose -f docker-compose.dev.yml exec --user=www-data train_base composer install

stop:
	docker-compose -f docker-compose.dev.yml down
build:
	docker-compose -f docker-compose.dev.yml build --parallel
	docker-compose -f docker-compose.dev.yml up -d
ps:
	docker-compose -f docker-compose.dev.yml ps
exec:
	docker-compose -f docker-compose.dev.yml exec $(c) $(i)
exec_php:
	docker-compose -f docker-compose.dev.yml exec train_base bash