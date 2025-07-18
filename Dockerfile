FROM php:8.2-apache

# Install dependencies
RUN apt-get update && \
    apt-get install -y python3 python3-pip python3-venv git curl unzip && \
    apt-get clean

# Enable mod_rewrite
RUN a2enmod rewrite

# Create virtual environment and install argostranslate inside it
RUN python3 -m venv /opt/venv
ENV PATH="/opt/venv/bin:$PATH"
RUN pip install --upgrade pip && pip install argostranslate

# Set working directory
WORKDIR /var/www/html

# Copy app code
COPY . /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]

