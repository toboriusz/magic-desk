
# Magic Desk

## Introduction
Magic Desk is a [Vue](https://vuejs.org/index.html/) and [Laravel](https://laravel.com/) based web application that helps with managing hardware & software inventory and network designing.
Is tailored for companies with a large number of small branches.

## Features
* Adapted to mobile devices


## Plan
* Hardware inventory management (Dektops, Laptops, Printers, Mobile Phones, Network items)
* Suited for multiple Sites
* Users management 
* Custom assets and fields
* Network and building plan
* Probe for Android and Windows 7-10
* Reports
* Agreement generator for mobile device holders

## Preview
TODO


## Project setup
```
mkdir projectName

cd projectName

git clone --depth=1 --branch=master git@github.com:toboriusz/magic-desk.git

cp .env.example .env

Update in .env database config, mailserver, API url, application name and url 

npm install / yarn install

docker-compose up -d

docker-compose exec magicdesk /bin/bash 

php artisan key:generate

php artisan migrate --seed

php artisan passport:install

php artisan passport:client --personal

```

### Compiles and hot-reloads for development
```
npm run watch
```

### Compiles and minifies for production
```
npm run build
```


### Reference
* [Laravel](https://laravel.com/)
* [Vue](https://vuejs.org/index.html/)
* [Vuetifyjs](https://vuetifyjs.com/)
* [VeeValidate](https://baianat.github.io/vee-validate/)

## License

[MIT](https://github.com/toboriusz/magic-desk/blob/master/LICENSE)