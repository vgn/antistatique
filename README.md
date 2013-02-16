# Antistatique website v2012

It's a [Silex](http://silex.sensiolabs.org/) powered website.


# Installation

## Configure Apache vhost `2012.dev`

```
    <VirtualHost *:80>
        ServerName 2012.dev
        DocumentRoot "/path/to/projet/antistatique"
        DirectoryIndex index.php
        <Directory "/path/to/projet/antistatique">
            AllowOverride All
            Allow from all
        </Directory>
    </VirtualHost>
```

## Install vendors

We use [Composer](http://getcomposer.org) to manage vendors and dependencies.
First [install it](http://getcomposer.org/download/), if it is not already done.

Then:
```bash
    $ composer install
```

# Update project

Sometimes, after a pull, you need to update the project dependency:

    $ composer install

clear cache (Twig templates and RSS reader):

    $ rm -r cache/*


# Tests

To run the test suite, you need [composer](http://getcomposer.org) and [PHPUnit](https://github.com/sebastianbergmann/phpunit).

```bash
    $ composer install --dev
    $ phpunit
```

# Frontend

To generate new CSS files

```bash
    $ lessc assets/less/style.less assets/css/style.css
```
