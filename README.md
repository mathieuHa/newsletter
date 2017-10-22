# newsletter

Un outil qui facilite la création de newsletter par la communication du groupe ESIEA

###**Installation en production**

_Installation des dépendances_
```
php composer.phar install --no-dev --optimize-autoloader
```
_Création de la base de donnée (seulement la première fois)_
```
php bin/console doctrine:database:create
```
_Création/Mise à jour du schéma de la BDD_
```
php bin/console doctrine:schema:update --force --dump-sql
```
_Vidage du Cache_
```
php bin/console cache:clear --env=prod --no-debug --no-warmup
```
_Remplissage du Cache_
```
php bin/console cache:warmup --env=prod
```
_Création d'un utilisateur pour la base de donnée_
```
php bin/console fos:create:user
```

##**Installation en developpement**

_Installation des dépendances_
```
php composer.phar install
```
_Vidage du Cache_
```
php bin/console cache:clear --no-warmup
```
_Remplissage du Cache_
```
php bin/console cache:warmup
```

Certaines étapes en dev sont aussi valable en dev.

Inspiré d'un projet de Tanguy Giton : https://github.com/TanguyGiton/NewsletterProcessor
