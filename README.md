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


## Route List
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/26641100-9aa17277-e10d-4cec-90f3-6640e1e29c43?action=collection%2Ffork&collection-url=entityId%3D26641100-9aa17277-e10d-4cec-90f3-6640e1e29c43%26entityType%3Dcollection%26workspaceId%3D3afa1c41-0904-409c-8858-3bf20950d48b)
