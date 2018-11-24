# Queue
- create database connection queue 
```
php artisan queue:table
php artisan migrate
```
- create job
```
php artisan make:job SendEmail
```
- run job
```
SendEmail::dispatch($args);
```