As a user, I want to have an ability to see a list of tasks for my day, so that I can do them one by one.

docker-compose up
docker-compose run app /var/www/bin/console doctrine:schema:drop -f
docker-compose run app /var/www/bin/console doctrine:schema:create
docker-compose run app /var/www/bin/phpunit