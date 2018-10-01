FROM httpd:2.4

ADD ./conf/vhost-symfony.conf /usr/local/apache2/conf/custom/vhost-symfony.conf

RUN echo "Include conf/custom/vhost-symfony.conf" >> /usr/local/apache2/conf/httpd.conf

WORKDIR /var/www
