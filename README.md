
# Magic Desk

## Introduction
Magic Desk is a [Vue](https://vuejs.org/index.html/) and [Laravel](https://laravel.com/) based web application that helps with managing hardware & software inventory and network designing.
Is tailored for companies with a large number of small branches.

## Plan and features
* Everything

## Back-end
https://github.com/toboriusz/magic-desk-api


## Preview
TODO


## Project setup
```
mkdir projectName
```
```
cd projectName
```
```
git clone --depth=1 --branch=master git@github.com:toboriusz/magic-desk.git
```
cp .env.example .env
```
```
Update in .env database config, mailserver, API url, application name and url 
```
```
composer install
```
```
php artisan key:generate
```
```
php artisan migrate
```
```
php artisan passport:install
```
```
php artisan passport:client --personal
```
```
npm install
```
```
npm run dev
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Run your tests
```
npm run test
```

### Lints and fixes files
```
npm run lint
```


### Reference
* [Laravel](https://laravel.com/)
* [Vue](https://vuejs.org/index.html/)
* [Vuetifyjs](https://vuetifyjs.com/)
* [VeeValidate](https://baianat.github.io/vee-validate/)
* [ECharts](http://echarts.baidu.com/option.html)

## License

[MIT](https://github.com/toboriusz/magic-desk-app/blob/master/LICENSE)