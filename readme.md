# Installation

## Dev version

### Install Symfony Console

`curl -sS https://get.symfony.com/cli/installer | bash`

### Backend
```
git clone https://github.com/Weberd/xm.git .
cd xm/backend
composer install
cd ..
docker-compose -f docker-compose.yml up -d
```
Wait a little bit

```
docker exec 'symfony console doctrine:database:create'
docker exec 'symfony console doctrine:migration:migrate'
docker exec 'symfony console doctrine:fixtures:load'
symfony server:start
```

### Frontend

```
cd frontend
npm install
npm start
```

App will be available at:
`http://localhost:4200`