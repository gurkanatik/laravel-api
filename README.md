# Installation

To get started, follow these steps:

1. Install the required packages using composer by running the following command:
```
composer update
```
2. Create a ".env" file and fill in the necessary database configurations.
3. Migrate your database by running the following command:
```
php artisan migrate
```
4. Generate the encryption keys needed to generate secure access tokens using the following command:
```
php artisan passport:install
```
5. Finally, run the following command to get the project up and running:
```
php artisan serve
```
That's it! You should now be able to access the project.

## Notes
Laravel file and database drivers don't support tags.
What you need to update, to fix this issue is simply changing the cache driver from file to array in your .env (located in root folder) file as below.
```
CACHE_DRIVER=array
```

# Route List
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/26641100-9aa17277-e10d-4cec-90f3-6640e1e29c43?action=collection%2Ffork&collection-url=entityId%3D26641100-9aa17277-e10d-4cec-90f3-6640e1e29c43%26entityType%3Dcollection%26workspaceId%3D3afa1c41-0904-409c-8858-3bf20950d48b)

# Auth

## Register - POST
```
api/register
```
| Param    | Type   | Description   | Unique | Required |
|----------|--------|---------------|--------|----------|
| email    | string | User email    | *      | *        |
| phone    | bigInt | User phone    | *      | *        |
| name     | string | User name     |        | *        |
| password | string | User password |        | *        |


## Login - POST
```
api/login
```
| Param          | Type          | Description         | Required |
|----------------|---------------|---------------------|----------|
| email or phone | string/bigInt | User phone or email | *        |
| password       | string        | User password       | *        |

# User-contacts

## Get All Contacts - GET
```
api/user-contacts
```
| Param  | Type | Description | Required |
|--------|------|-------------|----------|
| offset | int  | limit start | *        |
| limit  | int  | limit       | *        |

## Search Contacts - GET
```
api/user-contacts/search
```
| Param   | Type   | Description   | Required |
|---------|--------|---------------|----------|
| name    | string | Contact Name  |          |
| phone   | int    | Contact Phone |          |
| offset  | int    | limit start   | *        |
| limit   | int    | limit         | *        |

## Store Contact - POST
```
api/user-contacts
```
| Param | Type   | Description   | Required |
|-------|--------|---------------|----------|
| name  | string | Contact Name  | *        |
| phone | int    | Contact Phone | *        |

## Update Contact - PUT
```
api/user-contacts
```
| Param | Type   | Description   | Required |
|-------|--------|---------------|----------|
| name  | string | Contact Name  |          |
| phone | int    | Contact Phone |          |

## Delete Contact - DELETE
```
api/user-contacts/{id}
```
| Param | Type   | Description | Required |
|-------|--------|-------------|----------|
| id    | int    | Contact ID  | *        |
