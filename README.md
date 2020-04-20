# Lumen API Template/Boilerplate with JWT Auth

[![License](https://img.shields.io/github/license/marco-gallegos/lumen-rest-api-template?style=for-the-badge)](http://opensource.org/licenses/MIT)
![PHP7.4](https://img.shields.io/badge/PHP-7.4-blue?style=for-the-badge)
![LUMEN6.X](https://img.shields.io/badge/LUMEN-6.X-orange?style=for-the-badge)


This is a boilerplate for lumen 6.x if you are using lumen to write REST api it will help you.

This project use `dingo/api`  `tymon/jwt-auth`.

Write some easy APIs.

Checkout my other repo that is focused on reply to this template but using graphql [lumen-graphql-api-template](https://github.com/marco-gallegos/lumen-graphql-api-template)

Feel free to make a pull request and make this repo better :D

## Useful Plugins

if you'r using composer v1.x check [this project](https://github.com/hirak/prestissimo)

```bash
# instalar el plugin
composer global require hirak/prestissimo
```


## Main Features

### Document your API

```bash
apidoc -i App/Http/Controller/Api/v1 -o public/apidoc
```

### List API Routes

Not natively supported by lumen, we can list all our routes via [api:route](https://github.com/marco-gallegos/lumen-api-route-list) command

```bash
php artisan api:route
```

### Use Artisan Generators

By default lumen does't support the useful laravel/artisan generators and using [this extension](https://github.com/flipboxstudio/lumen-generator) we can use this comands executing a "dev inclusive" composer install.


Test:

```bash
php artisan make:model MyModel
```

### 

## USEFUL LINKS

- dingo/api [https://github.com/dingo/api](https://github.com/dingo/api)
- json-web-token(jwt) [https://github.com/tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
- transformer [fractal](http://fractal.thephpleague.com/)
- apidoc [apidocjs](http://apidocjs.com/)
- Rest API guidance [jsonapi.org](http://jsonapi.org/format/)
- Rest API Debug [Insomnia](https://insomnia.rest/)
- A good article [http://oomusou.io/laravel/laravel-architecture](http://oomusou.io/laravel/laravel-architecture/)

## Installation

### 1 Install the project

#### Using GIT

``` bash
git clone https://github.com/marco-gallegos/lumen-api-boilerplate-jwt.git new_api
cd new_api
composer install
cp .env.example .env
php artisan jwt:secret
```

#### Using Composer

```bash
composer create-project --stability=dev cbxtechcorp/lumen-rest-api-template new_api
```

### 2 configre your project

Now give to your project access tou your database and create the users table whit a test user.

```bash
vim .env
  DB_*
    configure your database access
  
  APP_KEY
    key:generate is abandoned in lumen, so do it yourself
    md5(uniqid())，str_random(32) etc.，maybe use jwt:secret and copy it

php artisan migrate --seed
```

## Documentation

### Serve Your API

```bash
php -S localhost:8000 -t public
# or
php artisan serve
```

### Deploy

In a production server we can omit development packages autoload using this command

```bash
composer install --no-dev
```

### Routes

We have some routes to start.

#### Login

The login route returns access token to make any other request.

route : http://your.domain/api/v1/authorizations

type : post

parameters : {
  
  email: "yourmail@some.com",

  password: "userpassword"

}


## FAQ

<details>
  <summary>About JWT</summary>

  There is no session and auth guard in lumen 5.2, so attention `config/auth.php`. Also user model must implement `Tymon\JWTAuth\Contracts\JWTSubject`
</details>

<details>
  <summary>How to use mail</summary>

- composer require `illuminate/mail` and `guzzlehttp/guzzle`
- register email service in `bootstrap/app.php` or `some provider`
- add `mail.php` `services.php` in config, just copy them from laravel
- add `MAIL_DRIVER` in env
</details>

<details>
  <summary>How to user transformer </summary>

  transformer is a layer help you format you resource and their relationship.

  maybe you can knowstand with this links:

- [https://lumen-new.lyyw.info/api/posts](https://lumen-new.lyyw.info/api/posts)
- [https://lumen-new.lyyw.info/api/posts?include=user](https://lumen-new.lyyw.info/api/posts?include=user)
- [https://lumen-new.lyyw.info/api/posts?include=user,comments](https://lumen-new.lyyw.info/api/posts?include=user,comments)
- [https://lumen-new.lyyw.info/api/posts?include=user,comments:limit(1)](https://lumen-new.lyyw.info/api/posts?include=user,comments:limit(1))
- [https://lumen-new.lyyw.info/api/posts?include=user,comments.user](https://lumen-new.lyyw.info/api/posts?include=user,comments.user)
- [https://lumen-new.lyyw.info/api/posts?include=user,comments:limit(1),comments.user](https://lumen-new.lyyw.info/api/posts?include=user,comments:limit(1),comments.user)

</details>

<details>
  <summary>transformer data serizlizer </summary>

  dingo/api use [Fractal](http://fractal.thephpleague.com/) to transformer resouses，fractal provider 3 serializer,Array,DataArray,JsonApi.more details at here [http://fractal.thephpleague.com/serializers/](http://fractal.thephpleague.com/serializers/)。DataArray is default.You can set your own serizlizer like this：

  see bootstrap/app.php
  $app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
    $fractal = new League\Fractal\Manager;
    // $serializer = new League\Fractal\Serializer\JsonApiSerializer();
    $serializer = new League\Fractal\Serializer\ArraySerializer();
    // $serializer = new App\Serializers\NoDataArraySerializer();
    $fractal->setSerializer($serializer);,
    return new Dingo\Api\Transformer\Adapter\Fractal($fractal);
  });

  I think default DataArray is good enough.
</details>


## TODO

- [ ] phpunit

## Check the Original Project

[Lumen API Demo](https://github.com/liyu001989/lumen-api-demo)