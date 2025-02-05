FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libapache2-mod-ldap-userdir \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod ldap && \
    a2enmod authnz_ldap

EXPOSE 80

CMD ["apache2-foreground"]