# Rodar App
> php -S localhost:8080 -t public

# Gerar imagem docker
> docker build -t asv-grawa-api .
> docker image ls

# Docker Run Localhost
> docker run -d -p 8080:8080 asv-grawa-api
> docker exec -i -t asv-grawa-api /bin/bash

## Docker Compose
  > docker-compose up

## Image to Google Cloud
  > docker tag  asv-grawa-api gcr.io/infra-assovio-1/asv-grawa-api
  > docker push gcr.io/infra-assovio-1/asv-grawa-api