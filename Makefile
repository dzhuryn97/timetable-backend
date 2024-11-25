build-and-push:
	docker build --file=docker/php/Dockerfile --tag dzhuryn/timetable-backend-php:dev  --platform linux/amd64 .
	docker push dzhuryn/timetable-backend-php:dev

	docker build --file=docker/nginx/Dockerfile --tag=dzhuryn/timetable-backend-nginx:dev  --platform linux/amd64 .
	docker push dzhuryn/timetable-backend-nginx:dev
