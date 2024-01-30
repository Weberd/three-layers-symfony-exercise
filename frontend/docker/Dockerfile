FROM node:14-alpine as builder

WORKDIR /app
COPY package.json .
RUN npm install
RUN npm install -g @angular/cli@14
COPY . .
RUN ng build -c production

FROM nginx
COPY --from=builder /app/dist/frontend /usr/share/nginx/html
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf

