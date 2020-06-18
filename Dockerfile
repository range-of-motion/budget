FROM php:7.2-fpm

# Install system packages (Git, packages for archives, Node.js)
RUN apt-get update \
    && apt-get install -y git libzip-dev zlib1g-dev unzip \
    && curl -sL https://deb.nodesource.com/setup_14.x | bash - && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql && docker-php-ext-install zip && docker-php-ext-install calendar

# Ensure commands are running successfully before continuing
SHELL ["/bin/bash", "-o", "pipefail", "-c"]

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Yarn
RUN npm install -g yarn

WORKDIR /usr/share/nginx/budget
COPY . .

# Required before we're able to run any "php artisan" commands
RUN composer install

RUN php artisan budget:install

RUN chown -R www-data:www-data /usr/share/nginx/budget

CMD ./docker_boot.sh
