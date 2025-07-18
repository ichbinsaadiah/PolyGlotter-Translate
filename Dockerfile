FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y python3 python3-pip git curl unzip && \
    apt-get clean

RUN a2enmod rewrite

RUN pip3 install argostranslate

WORKDIR /var/www/html

COPY . /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
