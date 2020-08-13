# Cohesion API client

A library that allows access to the Cohesion API.

## Table of contents

* [Pre-requisites](#pre-reqs)
* [Installation](#install)
* [Usage](#usage)

## Prerequisites<a name="pre-reqs"></a>

You will need the following to develop:

- PHP 7.1
- [Composer](https://getcomposer.org)

## Installation<a name="install"></a>

Cohesion API client can be included via [Composer](https://getcomposer.org):

```json
{
    "require": {
        "acquia/cohesion-api-client-php": "dev-master"
    },
    "repositories": [
        {
            "type": "git",
            "url": "git@github.com:acquia/cohesion-api-client-php.git"
        }
    ]
}
```

## Usage<a name="usage"></a>

Basic client usage using User Token authentication:

```php
<?php

use Acquia\Cohesion\Api\AuthUserTokenClientFactory;

$client = AuthUserTokenClientFactory::createUsingUserToken('X-AUTH-USER', 'X-AUTH-TOKEN', [
  'base_uri' => 'https://sf-backoffice.cohesiondx8.test',
]);

try {
  $keys = $client->getKeys();
}
catch (\Exception $e) {
  print $e->getMessage();
}
```

## Additional information

* [Issue tracking (for bug reports and feature requests)](https://github.com/*)
