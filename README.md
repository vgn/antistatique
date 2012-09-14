# Antistatique website v2012



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

```bash
    $ php composer.phar install
```

# Update project

Sometimes, after a pull, you need to update the project dependency:

    $ php composer.phar install

clear cache (Twig templates):

    $ rm -r cache/*

# Tests

To run the test suite, you need [composer](http://getcomposer.org) and [PHPUnit](https://github.com/sebastianbergmann/phpunit).

```bash
    $ php composer.phar install --dev
    $ phpunit
```

# Frontend

To generate new CSS files

```bash
    $ lessc assets/less/style.less assets/css/style.css
```
