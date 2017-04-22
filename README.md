# Vehicle Sign Up

This is a simple app for vehicle signup.

### Run it:

1. `$ cd my-app`
2. `$ php compose.phar start`
3. Browse to http://localhost:8888

## Key directories

* `app`: Application code
* `app/src`: All class files within the `App` namespace
* `app/templates`: Twig template files
* `cache/twig`: Twig's Autocreated cache files
* `log`: Log files
* `public`: Webserver root
* `vendor`: Composer dependencies

## Key files

* `public/index.php`: Entry point to application
* `app/settings.php`: Configuration
* `app/dependencies.php`: Services for Pimple
* `app/middleware.php`: Application middleware
* `app/routes.php`: All application routes are here
* `app/src/Home.php`: Action class for the home page
* `app/templates/home.twig`: Twig template file for the home page

## TODO
* [ ] Make sure timepicker works
* [ ] Prevent scheduling conflicts
* [ ] Update in the background