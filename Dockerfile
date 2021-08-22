# Step One: Configure lightweight Alpine/Nginx/PHP container with proper permissions
# Adapted from https://wiki.alpinelinux.org/wiki/Nginx_with_PHP
FROM alpine
RUN apk add nginx php7 php7-fpm php7-opcache
COPY ./nginx.conf /etc/nginx/nginx.conf
RUN adduser -D -g 'www' www && \
    mkdir /www && \
    chown -R www:www /var/lib/nginx && \
    chown -R www:www /www
ENV PHP_FPM_USER="www"
ENV PHP_FPM_GROUP="www"
ENV PHP_FPM_LISTEN_MODE="0660"
RUN sed -i "s|;listen.owner\s*=\s*nobody|listen.owner = ${PHP_FPM_USER}|g" /etc/php7/php-fpm.d/www.conf && \
    sed -i "s|;listen.group\s*=\s*nobody|listen.group = ${PHP_FPM_GROUP}|g" /etc/php7/php-fpm.d/www.conf && \
    sed -i "s|;listen.mode\s*=\s*0660|listen.mode = ${PHP_FPM_LISTEN_MODE}|g" /etc/php7/php-fpm.d/www.conf && \
    sed -i "s|user\s*=\s*nobody|user = ${PHP_FPM_USER}|g" /etc/php7/php-fpm.d/www.conf && \
    sed -i "s|group\s*=\s*nobody|group = ${PHP_FPM_GROUP}|g" /etc/php7/php-fpm.d/www.conf

# Step Two: Copy ProcessWire dependencies, set permissions
COPY --chown=www:www ./index.php /www/index.php
COPY --chown=www:www  ./htaccess.txt /www/.htaccess
COPY --chown=www:www  ./wire /www/wire
COPY --chown=www:www  ./site/config.php /www/site/config.php
COPY --chown=www:www  ./site/htaccess.txt /www/site/.htaccess

# Step Three: Copy start script and run
COPY ./dockerstart.sh /dockerstart.sh
CMD /dockerstart.sh