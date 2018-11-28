#Api document generator
- (https://github.com/mpociot/laravel-apidoc-generator)
- Installation
```
composer require mpociot/laravel-apidoc-generator
```
- Publish the config file
```
php artisan vendor:publish --provider="Mpociot\ApiDoc\ApiDocGeneratorServiceProvider" --tag=config
```
- generate
```
php artisan apidoc:generate
```
- connect to 'DOMAIN/docs'