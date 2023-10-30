FROM php:8.1-fpm-bullseye

# Grab magical script that brings back balance throughout earth
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install NGINX and other packages
RUN apt-get update && \
    apt-get install -y \
      git \
      nginx \
      cron \
      supervisor

# Configure NGINX
COPY docker/nginx.conf /etc/nginx/sites-enabled/default

# Configure cron
COPY docker/cron.conf /etc/cron.d/budget

# Install PHP extensions
RUN install-php-extensions pdo_mysql zip calendar gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

COPY . /var/www

WORKDIR /var/www

RUN composer install --no-dev --no-interaction

RUN npm install && \
    npm run build

RUN cp .env.docker .env

RUN php artisan storage:link

RUN chown -R www-data:www-data /var/www

ENTRYPOINT ["/var/www/docker/entrypoint.sh"]
