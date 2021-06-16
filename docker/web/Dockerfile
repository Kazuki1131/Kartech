FROM nginx:1.20

ENV TZ=Asia/Tokyo

# nginx config file
COPY ./docker/web/*.conf /etc/nginx/conf.d/

WORKDIR /var/www/html