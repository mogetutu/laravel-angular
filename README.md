### laravel-angular

Technical Assignment

* Laravel 4.2+
* AngularJS
* Homestead/Vagrant developement environment
* PHPUnit

### Install/Setup Homestead Environment

* Install homestead: http://laravel.com/docs/homestead#installation-and-setup
* Clone Repo to /path/to/shared/vagrant/code/folder
    ``
        git clone git@github.com:mogetutu/laravel-angular.git
    ``
* From within clone laravel app directory
    *Migrate and Seed Database

    ``
        php artisan migrate && php artisan db:seed
    ``
* Update `Homestead.yml' add the following under the various segments

    ```
        sites:
            - map: madewithlove.local
              to: /home/vagrant/path/to/code/laravel-angular/public
        databases:
            - madewithlove
    ```

* Update your hosts file, add the following

    ``
        192.168.10.10  madewithlove.local
    ``

* Start up your Vagrant Box

    ``
        homestead up
    ``

* Access app at

    ``
        http://madewithlove.local
    ``

### Running tests

Also: PHPUnit

* From the laravel-angular directory
    * `phpunit`

