FROM nginx:1.19-alpine AS build

COPY docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY docker/nginx/snippets/fastcgi-php.conf /etc/nginx/snippets/fastcgi-php.conf

WORKDIR /app
COPY ./public ./public

