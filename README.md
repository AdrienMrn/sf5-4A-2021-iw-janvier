### Installation SF 5 avec docker
```
// Initialiser les images docker
docker-compose build --no-cache
// Lancer les containers docker
docker-compose up -d
```

##### Debug docker
```
docker-compose logs -f [CONTAINER_NAME: php|nginx|db|node]
```

### Doctrine
```
// Création ou modification d'une entity (table)
docker-compose exec php bin/console make:entity

// Mettre à jour votre base de donnée
docker-compose exec php bin/console doctrine:schema:update --dump-sql
docker-compose exec php bin/console doctrine:schema:update --force
```
###### Relation
https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/association-mapping.html
https://symfony.com/doc/current/doctrine/associations.html

###### Fixtures
https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
https://github.com/fzaninotto/Faker
```
// Installation
docker-compose exec php composer require --dev orm-fixtures
```

###### Formulaire
https://symfony.com/doc/5.3/reference/forms/types.html
https://symfony.com/doc/current/form/form_themes.html

### Commandes à connaitre 
```
// Création de fichier via maker bundle
docker-compose exec php bin/console make:controller
docker-compose exec php bin/console make:form
docker-compose exec php bin/console make:crud
// Debug routing
docker-compose exec php bin/console debug:router
```