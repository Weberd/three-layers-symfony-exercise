# Installation

`docker-compose -f docker-compose.prod.yml up -d`

`docker exec -t 'smyfony console migrations:migrate'`
`docker exec -t 'smyfony console fixtures:load'`