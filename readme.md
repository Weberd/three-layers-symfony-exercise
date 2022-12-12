# Installation

Live Demo Video: https://drive.google.com/file/d/1sesp3Em4tbIlHe6MkbM3N2LPtMxpN2yl/view?usp=sharing

## Dev version

### Install Symfony Console

`curl -sS https://get.symfony.com/cli/installer | bash`

### Backend
```
git clone https://github.com/Weberd/xm.git xm
cd xm/backend
composer install
cd ..
docker-compose -f docker-compose.yml up -d
cd backend
symfony console doctrine:database:create
symfony console doctrine:migration:migrate
symfony console doctrine:fixtures:load
symfony server:start
```

### Frontend (in another console)

#### Prerequisites
```
curl -sL https://deb.nodesource.com/setup_14.x | sudo bash -
npm install -g @angular/cli
```

```
cd frontend
npm install
npm start
```

App will be available at:
`http://localhost:4200`
