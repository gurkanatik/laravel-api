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
