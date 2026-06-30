FROM nginx:1.26.2-alpine

COPY docker/vhost.conf /etc/nginx/conf.d/default.conf
