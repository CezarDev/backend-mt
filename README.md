## Configurar o .env

* DB_CONNECTION=pgsql
* DB_HOST=postgres
* DB_PORT=5432
* DB_DATABASE=laravel
* DB_USERNAME=laravel
* DB_PASSWORD=secret
* FILESYSTEM_DISK=s3

* AWS_ACCESS_KEY_ID=minio
* AWS_SECRET_ACCESS_KEY=minio123
* AWS_DEFAULT_REGION=us-east-1
* AWS_BUCKET=fotos
* AWS_ENDPOINT=http://minio:9000

## Subir os contêineres
* docker-compose up -d --build

## Acessar o container do Laravel
* docker exec -it laravel bash

## DRIVER DO S3
* composer require league/flysystem-aws-s3-v3

## Sanctum

* composer require laravel/sanctum
* php artisan vendor:publish --provider="Laravel\\Sanctum\\SanctumServiceProvider"
* php artisan migrate

## Acessando MinIO
### insira as credencias setadas no docker-compose.yml
 * http://localhost:9000
### crie o bucket fotos

