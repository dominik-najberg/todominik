As a user, I want to have an ability to see a list of tasks for my day, so that I can do them one by one.

```bash
docker-compose up
docker-compose run app /var/www/bin/console doctrine:schema:drop -f
docker-compose run app /var/www/bin/console doctrine:schema:create
docker-compose run app /var/www/bin/phpunit
```

I am trying my best to keep it as framework agnostic as possible. This is why I moved some classes to `\framework`.
I did not add more endpoints as you see already see how I would do it.