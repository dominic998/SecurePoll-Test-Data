FROM debian:buster

RUN apt-get update
RUN apt-get -y upgrade

RUN apt-get -y install php7.3-cli openstv

WORKDIR /var/www/html/w
