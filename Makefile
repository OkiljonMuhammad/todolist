# Makefile for Laravel project with Docker

# Variables
DOCKER_COMPOSE = docker-compose
PHP_CONTAINER = app
DB_CONTAINER = db

# Default target
.DEFAULT_GOAL := help

# Targets
build: ## Build the Docker containers
	$(DOCKER_COMPOSE) up -d --build

up: ## Start the Docker containers
	$(DOCKER_COMPOSE) up -d

down: ## Stop the Docker containers
	$(DOCKER_COMPOSE) down

restart: ## Restart the Docker containers
	$(DOCKER_COMPOSE) down
	$(DOCKER_COMPOSE) up -d

logs: ## Show logs for all containers
	$(DOCKER_COMPOSE) logs -f

bash: ## Access the PHP container via bash
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bash

db: ## Access the db container via bash
	$(DOCKER_COMPOSE) exec $(DB_CONTAINER) bash

composer-install: ## Install PHP dependencies via Composer
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) composer install

composer-update: ## Update PHP dependencies via Composer
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) composer update

migrate: ## Run Laravel database migrations
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan migrate

seed: ## Run Laravel database seeders
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan db:seed

migrate-refresh: ## Rollback and re-run all migrations
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan migrate:refresh

artisan: ## Run an Artisan command (e.g., make artisan cmd="migrate")
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan $(cmd)

npm-install: ## Install Node.js dependencies
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) npm install

npm-run: ## Run a NPM command (e.g., make npm-run cmd="dev")
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) npm run $(cmd)

help: ## Show help for each target
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'
