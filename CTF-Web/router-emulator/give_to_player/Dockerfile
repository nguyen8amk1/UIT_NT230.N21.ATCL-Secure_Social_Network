FROM php:8-apache

COPY ./src/* /var/www/html
RUN chown root:root /var/www/html

COPY ./flag.txt ./readflag /
RUN chmod 400 /flag.txt && chmod 4755 /readflag
