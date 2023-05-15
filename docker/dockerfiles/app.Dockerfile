FROM ubuntu:latest

ENV TZ=Europe/Minsk
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Update the package list and install necessary packages
RUN apt-get update && \
    apt-get install -y php8.1-fpm curl zip unzip supervisor && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*


RUN apt-get update && apt-get install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php && apt-get update
RUN apt-get install -y php8.1-bcmath \
    php8.1-ctype \
    php8.1-fileinfo \
    php8.1-mbstring \
    php8.1-pdo \
    php8.1-tokenizer \
    php8.1-xml \
    php8.1-dom \
    php8.1-mysql


# Install nginx and configure.
RUN apt-get update \
    && apt-get install -y nginx

COPY ./docker/config/nginx/app.conf /etc/nginx/sites-enabled/app.conf

# Configure Supervisor
COPY ./docker/config/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install Composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    # && mv /usr/local/bin/composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/app

# Copy project code inside working directory.
COPY . .

# Install dependencies with Composer
RUN composer install --no-interaction --no-dev --prefer-dist --ignore-platform-req=ext-dom


# Generate the application key.
RUN php artisan key:generate

# Expose port 80 for Nginx
EXPOSE 81

# Start Supervisor to manage Nginx and PHP-FPM processes
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
