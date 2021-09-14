.PHONY: help start-all stop-all build-all restart-all ssh-register ssh-application ssh-mailer

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

start-all: ## Runs all services: RabbitMQ, Register, Application and Mailer
	make -C rabbitmq start
	make -C register start
	make -C api start
	make -C mailer start
	$(MAKE) prepare-all

prepare-all: ## Install dependencies and run migrations in all services
	make -C register prepare
	make -C api prepare
	make -C mailer prepare

stop-all: ## Stops all services: RabbitMQ, Register, Application and Mailer
	make -C rabbitmq stop
	make -C register stop
	make -C api stop
	make -C mailer stop

build-all: ## Build all services: RabbitMQ, Register, Application and Mailer
	make -C register build
	make -C api build
	make -C mailer build

restart-all: ## Restarts all services: RabbitMQ, Register, Application and Mailer
	make -C rabbitmq restart
	make -C register restart
	make -C api restart
	make -C mailer restart

ssh-register: ## bash into Register Service PHP container
	make -C register ssh-be

ssh-api: ## bash into Register Service PHP container
	make -C api ssh-be

ssh-mailer: ## bash into Register Service PHP container
	make -C mailer ssh-be
