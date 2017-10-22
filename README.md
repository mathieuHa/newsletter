# newsletter

Un outil qui facilite la création de newsletter par la communication du groupe ESIEA

**Installation en production**


`php composer.phar install --no-dev --optimize-autoloader`

`php bin/console doctrine:database:create`

`php bin/console doctrine:schema:update --force --dump-sql`

`php bin/console cache:clear --env=prod --no-debug --no-warmup`

`php bin/console cache:warmup --env=prod`

**Installation en developpement**

`php composer.phar install`

`php bin/console cache:clear --no-warmup`

`php bin/console cache:warmup`

