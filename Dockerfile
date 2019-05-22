FROM php:7-alpine

WORKDIR /var/www/

ADD ./i2torage/ ./i2torage/
        
EXPOSE 8080

ENV DOCKER="true"

CMD php -S 0.0.0.0:8080 -t .
