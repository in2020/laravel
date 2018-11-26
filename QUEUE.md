# Queue
## Database queue
- create database connection queue 
- set QUEUE_DRIVE=database in .env file
- work queue on server
```
php artisan queue:table
php artisan migrate
php artisan queue:work
```
- create job
```
php artisan make:job SendEmail
```
- run job
```
SendEmail::dispatch($args);
```