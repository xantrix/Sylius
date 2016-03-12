#Docker debug cli
#off directive
#;xdebug.remote_connect_back = On
#;xdebug.remote_autostart = On

export PHP_IDE_CONFIG=serverName=sylius.dev
php -dxdebug.remote_autostart=1 app/console command
php -dxdebug.remote_autostart=1 bin/behat --name="Products" -p cached
php bin/phpspec run src/Sylius/Component/Attribute/spec

#Postman REST API Debug
api/endpoint?XDEBUG_SESSION_START=PHPSTORM

#Create Database and Schema for env
php app/console doctrine:database:create --env=test
php app/console doctrine:schema:create --env=test

#Fixtures
php app/console doctrine:fixtures:load --env=test
php -dxdebug.remote_autostart=1 app/console doctrine:fixtures:load --env=test
#--purge-with-truncate
php -dxdebug.remote_autostart=1 app/console doctrine:phpcr:fixtures:load --fixtures=src/Sylius/Bundle/FixturesBundle/DataFixtures/ORM/LoadProductsData.php --env=test

#Migrations
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force
php app/console doctrine:migrations:diff #create
php app/console doctrine:migrations:migrate #migration sync
php app/console doctrine:migration:status
php app/console doctrine:migrations:execute 20151028192920
php app/console doctrine:migrations:execute 20151028192920 --down

#Assetic
#[use --symlink option alongside assetic:watch and use_controller: false]
php app/console assets:install --symlink --env=dev
php app/console assetic:dump --env=dev

#Configuration debug Assetic
php app/console debug:config AsseticBundle
php app/console debug:config AsseticBundle --env test

#Containers debug
php app/console debug:container

#Events
php app/console debug:event-dispatcher

#Routing
php app/console debug:router

#Cache
php app/console cache:clear --env=dev

#Show symfony version
composer show -i | grep symfony/symfony

#PHPSPEC
php bin/phpspec run src/Sylius/Component/Attribute/spec  --stop-on-failure
php bin/phpspec run src/Sylius/Bundle/AttributeBundle/spec --stop-on-failure
php bin/phpspec run src/Sylius/Bundle/ProductBundle/spec --stop-on-failure

#BEHAT
bin/behat --strict -f progress -p cached
bin/behat --tags="legacy_products" --strict --stop-on-failure
bin/behat --name="Products" --stop-on-failure -p cached

bin/behat features/legacy/backend/products.feature:47-53 -p cached
