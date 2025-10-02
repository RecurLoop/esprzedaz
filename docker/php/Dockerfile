FROM php:8.4-fpm

# Arguments for custom UID and GID
ARG UID=
ARG GID=

ARG APP_ENV=development
ENV APP_ENV=${APP_ENV}

# System dependencies
RUN apt-get update && \
    apt-get install -y git unzip curl libpq-dev libpng-dev libzip-dev libonig-dev zip && \
    docker-php-ext-install pdo pdo_mysql bcmath gd zip mbstring \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Update www-data user/group UID/GID only if provided
RUN if [ -n "$UID" ] && [ -n "$GID" ]; then \
        groupmod -o -g "$GID" www-data && \
        usermod -o -u "$UID" -g www-data www-data ; \
    fi

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install dependencies only if vendor does not exist
RUN if [ ! -d "vendor" ]; then \
      [ "$APP_ENV" = "production" ] \
        && composer install --no-dev --optimize-autoloader \
        || composer install --optimize-autoloader; \
    fi

# Expose PHP-FPM port
EXPOSE 9000

# Default command
CMD ["php-fpm"]
