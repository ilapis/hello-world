FROM httpd:alpine

RUN apk update; \
    apk upgrade;

COPY conf/default.conf /usr/local/apache2/conf/default.conf
COPY conf/default-ssl.conf /usr/local/apache2/conf/default-ssl.conf

RUN echo "Include /usr/local/apache2/conf/default.conf" >> /usr/local/apache2/conf/httpd.conf
RUN echo "Include /usr/local/apache2/conf/default-ssl.conf" >> /usr/local/apache2/conf/httpd.conf
