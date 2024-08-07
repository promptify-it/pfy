FROM dedecube/php-8.2 as builder

# Supervisor install
RUN apk add supervisor
RUN apk add nodejs
RUN apk add npm

COPY ./docker/services/php/supervisor/supervisord.conf /etc/supervisord.conf
COPY ./docker/services/php/supervisor/conf.d /etc/supervisor/conf.d
COPY ./docker/services/php/php.ini /usr/local/etc/php/conf.d/

# Prepare entrypoint
COPY ./docker/services/php/entrypoint.sh /opt/entrypoint.sh
RUN chmod +x /opt/entrypoint.sh

ENV COMPOSER_ALLOW_SUPERUSER=1
COPY composer.json composer.lock /var/www/html/
RUN composer install --no-scripts

COPY package.json package-lock.json /var/www/html/
RUN npm install

# Copy the rest of the application
COPY . /var/www/html/
RUN composer run-script post-autoload-dump
RUN chmod -R 775 storage

CMD ["/bin/sh"]
ENTRYPOINT [ "/opt/entrypoint.sh" ]
