DOCKER_COMP = docker compose

vendor:
	$(DOCKER_COMP) run --rm php composer install


mv:
	mv backend/.env.example backend/.env
