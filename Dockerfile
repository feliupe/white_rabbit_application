FROM phpunit/phpunit

COPY . /white_rabbit

ENTRYPOINT phpunit /white_rabbit/Test