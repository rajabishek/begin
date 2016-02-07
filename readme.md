## Begin - Simple Task Manager
Begin is a simple web-based task manager written in Vue at the client side and Lumen on server side. 

This project is meant to bring together the Laravel and Vue community to assemble a complete SPA that is built by following some of the best practices followed in both the communities and is meant to serve as a reference for the developers starting to build a full blown SPA with Laravel and Vue.
PRs are welcome to illustrate acceptance testing for the JWT api, using vuex with Vue etc...
Anything that can help structure the application in a better way is always welcome.

It uses vue-router and browserify to keep everyting nicely separated, and makes use of Laravel Elixir to avoid a huge Gulpfile (Laravel Elixir has nothing to do with the Laravel Framework, this package has no relation to that whatsoever).

Online demo: http://beginapp.herokuapp.com

## Installation

### Step 1: Clone the repo
```
git clone https://github.com/rajabishek/begin
```

### Step 2: Prerequisites
This will install the dependencies of this website. It will pull in several packages like Lumen Framework, Vue, Vueify, vue-router, gulp and Laravel Elixir (this is just magic syntactical sugar for gulp, basically).
```
composer install
php artisan migrate
php artisan jwt:secret
npm install
```

### Step 3: Run Gulp
```
gulp --production
```

### Step 4: Serve
```
php artisan serve
```

### Note about Apache
If you use Apache to serve this, you will need to add the following 2 lines to your .htaccess (or your virtualhost configuration):
```
RewriteCond %{HTTP:Authorization} ^(.*)
RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
```

## License
MIT License. See LICENSE file.

## Credits
Begin is built on the shoulder of the giants. My sincere thanks go to:
* Evan You for the awesome Vue
* Taylor Otwell and Graham Campbell for their work on the rocksolid Lumen
* Jeffrey Way for Laravel Elixir and the amazing Vue series on Laracasts
* The authors of all JavaScript and PHP packages used in the project – I’ve literally got the best of both worlds.
