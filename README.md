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

* aws --endpoint-url http://localhost:9000 s3 mb s3://fotos
* aws --endpoint-url http://localhost:9000 s3 ls

## SUBA O CONTAINER
* ```docker-compose up -d --build```

# 📚 Documentação da API REST

## 🔐 Autenticação

### ▶️ Login
**POST** `/api/login`

**Body (JSON):**
```json
{
  "email": "admin@teste.com",
  "password": "123456"
}
```

**RESPOSTA**
```JSON
{
  "access_token": "TOKEN_AQUI",
  "token_type": "Bearer"
}
```

Listar servidores
GET /api/servidores-efetivos

```json
[
  {
    "id": 1,
    "nome": "Servidor 1",
    "cargo": "Cargo 1",
    "matricula": "123456",
    "created_at": null,
    "updated_at": null
  }
]
``` 
## Criar servidor
POST /api/servidores-efetivos

```json
{
  "nome": "Servidor 1",
  "cargo": "Cargo 1",
  "matricula": "123456"
}
``` 
```json
{
  "id": 1,
  "nome": "Servidor 1",
  "cargo": "Cargo 1",
  "matricula": "123456",
  "created_at": null,
  "updated_at": null
}
``` 
## Atualizar servidor
PUT /api/servidores-efetivos/1

```json
{
  "nome": "Servidor 1",
  "cargo": "Cargo 1",
  "matricula": "123456"
}
``` 
```json
{
  "id": 1,
  "nome": "Servidor 1",
  "cargo": "Cargo 1",
  "matricula": "123456",
  "created_at": null,
  "updated_at": null
}
``` 
## Deletar servidor
DELETE /api/servidores-efetivos/1

```json
{
  "message": "Servidor deletado com sucesso"
}
```
## Listar servidores

GET /api/servidores-efetivos

```json
[
  {
    "id": 1,
    "nome": "Servidor 1",
    "cargo": "Cargo 1",
    "matricula": "123456",
    "created_at": null,
    "updated_at": null
  }
]
```
## Listar servidor por ID
GET /api/servidores-efetivos/1

```json
{
  "id": 1,
  "nome": "Servidor 1",
  "cargo": "Cargo 1",
  "matricula": "123456",
  "created_at": null,
  "updated_at": null
}
```
## Listar servidores com filtro
GET /api/servidores-efetivos?nome=Servidor 1

```json
[
  {
    "id": 1,
    "nome": "Servidor 1",
    "cargo": "Cargo 1",
    "matricula": "123456",
    "created_at": null,
    "updated_at": null
  }
]
```
## Listar servidores com paginação
GET /api/servidores-efetivos?page=1

```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "nome": "Servidor 1",
      "cargo": "Cargo 1",
      "matricula": "123456",
      "created_at": null,
      "updated_at": null
    }
  ],
  "first_page_url": "/api/servidores-efetivos?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "/api/servidores-efetivos?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Anterior",
      "active": true
    },
    {
      "url": "/api/servidores-efetivos?page=1",
      "label": "1",
      "active": true
    },
    {
      "url": null,
      "label": "Próximo &raquo;",
      "active": true
    }
  ],
  "next_page_url": null,
  "path": "/api/servidores-efetivos",
  "per_page": 15,
  "prev_page_url": null,
  "to": 1,
  "total": 1
}
```
### Teste Automatizado Servidor Efetivo
```bash
php artisan test --filter=ServidorEfetivoTest
```


