# Budget

![GitHub latest release](https://img.shields.io/github/v/release/range-of-motion/budget?include_prereleases)
[![Build status](https://travis-ci.com/range-of-motion/budget.svg?branch=master)](https://travis-ci.com/range-of-motion/budget)
[![codecov](https://codecov.io/gh/range-of-motion/budget/branch/master/graph/badge.svg)](https://codecov.io/gh/range-of-motion/budget)
[![GitHub license](https://img.shields.io/github/license/range-of-motion/budget.svg)](https://github.com/range-of-motion/budget/blob/master/LICENSE)

Budget is an open-source web application that helps you keep track of your finances.

You can use Budget by hosting it yourself, or using [the instance hosted by us](https://usebudget.com).

![Product](https://user-images.githubusercontent.com/9268822/46098425-a8877300-c1c4-11e8-9293-f43ceb9d6f97.png)

## Features

* Insertion and management of transactions
* Ability to organize transactions using tags
* Facilitate uploading and organizing of receipts
* Support for importing transactions (CSV format)
* Reports that visualize financials (showing weekly balance and most expensive tags, for example)
* Supports multiple currencies
* Available in multiple languages
* Weekly summary available through e-mail

## Requirements

* PHP 8.2 or higher
* HTTP server (for example Apache or NGINX)
* MySQL
* Composer
* Node.js

## Installation

* Clone the repository (`git clone https://github.com/range-of-motion/budget.git`)
    * You should always check out a tag, since the `master` branch might not always be stable (`git checkout TAG`)
* Install dependencies (`composer install --no-dev -o`)
* Run installation command (`php artisan budget:install`)
* Configure additional services in `.env` (database or mail, for example)
* Run migrations for database (`php artisan migrate`)
* Head over to your list of crons (`crontab -e`) and add `* * * * * cd /path-to-budget && php artisan schedule:run >> /dev/null 2>&1`

*Note that in order for certain features to work properly, the jobs queue needs to be watched. This can be done by either running `php artisan queue:work` or using [Supervisor](https://laravel.com/docs/7.x/queues#supervisor-configuration).*

## Updating

Use the command below to update to the latest version.

```
php artisan budget:update
```

## Docker

You can get set-up with Budget using Docker and Docker Compose. The advantage of using Docker Compose is that it will set you up with a MySQL database.

### Docker

You can either build the Docker image yourself, or use the ones available on [Docker Hub](https://hub.docker.com/r/rangeofmotion/budget).

### Docker Compose

Assuming you already have Docker Compose installed, simply run `docker-compose up -d` and you're good to go.

## Contact

* [Discord](https://discord.gg/QFQdvy3)
