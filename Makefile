#!/bin/bash

UID = $(shell id -u)
DOCKER_BE = nalanda-job-application-php
DOCKER_NETWORK = nalanda-job-application-network
DOCKER_MYSQL = nalanda-job-application-mysql

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

start: ## Start the containers
	docker network create ${DOCKER_NETWORK} || true
	cp --update=none docker-compose.yml.dist docker-compose.yml || true
	cp --update=none .env.dist .env || true
	U_ID=${UID} docker compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker compose stop

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) start

build: ## Rebuilds all the containers
	docker network create ${DOCKER_NETWORK} || true
	cp --update=none docker-compose.yml.dist docker-compose.yml || true
	cp --update=none .env.dist .env || true
	U_ID=${UID} docker compose build

prepare: ## Runs backend commands
	$(MAKE) composer-install

run: ## starts the Laravel development server
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} php artisan serve --host=0.0.0.0 --port=8000


logs: ## Show Laravel logs in real time
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} tail -f storage/logs/laravel.log


# Backend commands
composer-install: ## Installs composer dependencies
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} composer install --no-interaction
# End backend commands

ssh-be: ## bash into the backend container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bash

testing-db: ## starts the Laravel development server
	U_ID=${UID} docker exec -i ${DOCKER_MYSQL} mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS nalanda_job_application_db_test;"
	U_ID=${UID} docker exec -i ${DOCKER_MYSQL} mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON nalanda_job_application_db_test.* TO 'user'@'%'; FLUSH PRIVILEGES;"
