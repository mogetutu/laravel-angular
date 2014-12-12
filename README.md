laravel-angular
===============

Technical Assignment

* Laravel 4.2+
* AngularJS
* Homestead/Vagrant developement environment
* PHPUnit

### Install/Setup Homestead Environment

* Install homestead: http://laravel.com/docs/homestead#installation-and-setup
* Update `Homestead.yml' add the following under the various segments

    ```
        sites:
            - map: madewithlove.local
              to: /home/vagrant/path/to/code/laravel-angular/public
        databases:
            - madewithlove
    ```

* Update your hosts file

    ``
        192.168.10.10  madewithlove.local
    ``

* Provision you Vagrant Box

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

