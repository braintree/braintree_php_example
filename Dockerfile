FROM php:5.6.25

RUN apt-get update && apt-get install -y build-essential zip unzip

ENV APP_HOME /braintree_php_example
RUN mkdir $APP_HOME
WORKDIR $APP_HOME

ADD composer.* $APP_HOME/
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php composer.phar install

ADD . $APP_HOME
