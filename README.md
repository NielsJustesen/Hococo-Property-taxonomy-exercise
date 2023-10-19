# Laravel API

## Project setup

create database: hococo_db

## Migrate database tables

php artisan migrate

## Start server

php artisan serve

## Api documentation:

Endpoint = 'http://127.0.0.1:8000/api/node'

## POST corporation

Endpoint = 'http://127.0.0.1:8000/api/node'

Type = POST

payload: {
"type": "corporation",
"name": "E-corp",
"heigt": 0
}

## POST building

Endpoint = 'http://127.0.0.1:8000/api/node'

Type = POST

payload: {
"type": "building",
"name": "Den of evil",
"heigt": 1,
"parent_id": 1,
"zip_code": 3000
}

## POST property

Endpoint = 'http://127.0.0.1:8000/api/node'

Type = POST

payload: {
"type": "property",
"name": "Ammitville",
"heigt": 2,
"parent_id": 1,
"monthly_rent": 1234
}

## GET child nodes

Endpoint = 'http://127.0.0.1:8000/api/node/{type}/{id}'

returns the children of the node

## PUT change parent

Endpoint = 'http://127.0.0.1:8000/api/node/changeParent/{id}'

Type = PUT

payload: {
"id":1,
"name":"Ammitville",
"height":2,
"type":"Property",
"parent_id":2,
"monthly_rent":"1234.00",
"created_at":"2023-10-19T11:18:43.000000Z",
"updated_at":"2023-10-19T11:18:43.000000Z"
}

See [Configuration Reference](https://cli.vuejs.org/config/).
