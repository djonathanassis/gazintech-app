DOCKER_COMP := docker compose
DOCKER_RUN := docker run --rm

php:
	$(DOCKER_RUN) \
		-u "$$(id -u):$$(id -g)" \
		-v "$$(pwd)/backend:/var/www/html" \
		-w /var/www/html \
		laravelsail/php83-composer:latest \
		sh -c "composer install && php artisan key:generate"

mv:
	cp backend/.env.example backend/.env

up:
	$(DOCKER_COMP) up -d

down:
	$(DOCKER_COMP) down

npm:
	mkdir -p frontend/.npm-cache
	$(DOCKER_RUN) \
		-v "$$(pwd)/frontend:/app" \
		-v "$$(pwd)/frontend/.npm-cache:/home/node/.npm" \
		-e HOME=/home/node \
		-w /app \
		--user node \
		node:18-alpine \
		sh -c "npm cache clean --force && npm install"




