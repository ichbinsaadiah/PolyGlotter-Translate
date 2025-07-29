FROM php:8.2-apache

# Install dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y \
    python3 python3-pip python3-venv \
    git curl unzip \
    default-mysql-client \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Create virtual environment and install Argos Translate
RUN python3 -m venv /opt/venv
ENV PATH="/opt/venv/bin:$PATH"
RUN pip install --upgrade pip && pip install argostranslate

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
