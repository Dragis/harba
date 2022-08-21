# Setting up application

- From project dir `cp .env .env.local` and add you open weather map api key
- Run `composer install`
- Run `bin/console doctrine:database:create`
- Run `bin/console doctrine:migrations:migrate`
- Run `bin/console app:import-harbours`
- Run `symfony serve`

Your application should be up and running. Try navigating to http://127.0.0.1:8000/harbours