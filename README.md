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

### Base de donnée
```
// Création ou modification d'une entity (table)
docker-compose exec php bin/console make:controller
docker-compose exec php bin/console make:entity
docker-compose exec php bin/console make:form
docker-compose exec php bin/console make:crud

// Mettre à jour votre base de donnée
docker-compose exec php bin/console doctrine:schema:update --dump-sql
docker-compose exec php bin/console doctrine:schema:update --force
```

RealEstateAd
- title
- description
- price

### Commandes à connaitre 
```
// Création d'un controller 'vide'
docker-compose exec php bin/console make:controller
// Debug routing
docker-compose exec php bin/console debug:router
```