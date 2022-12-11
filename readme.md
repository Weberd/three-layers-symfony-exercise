# Installation

```
docker-compose -f docker-compose.prod.yml up -d
docker exec 'symfony console doctrine:database:create'
docker exec 'symfony console doctrine:migration:migrate'
docker exec 'symfony console doctrine:fixtures:load'
```