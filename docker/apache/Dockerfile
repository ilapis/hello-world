FROM httpd:alpine

RUN apk update; \
    apk upgrade;

COPY conf/default.conf /usr/local/apache2/conf/default.conf

RUN echo "Include /usr/local/apache2/conf/default.conf" >> /usr/local/apache2/conf/httpd.conf
