FROM httpd:2.4

ADD ./conf/vhost-application.conf /usr/local/apache2/conf/custom/vhost-application.conf

ADD ./conf/oauth /var/oauth/
RUN chmod 660 /var/oauth/*

RUN echo "Include conf/custom/vhost-application.conf" >> /usr/local/apache2/conf/httpd.conf

WORKDIR /var/www
