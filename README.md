# Budget

![GitHub latest release](https://img.shields.io/github/v/release/range-of-motion/budget?include_prereleases)
![GitHub downloads](https://img.shields.io/github/downloads/range-of-motion/budget/total)
[![Build status](https://travis-ci.com/range-of-motion/budget.svg?branch=master)](https://travis-ci.com/range-of-motion/budget)
[![GitHub license](https://img.shields.io/github/license/range-of-motion/budget.svg)](https://github.com/range-of-motion/budget/blob/master/LICENSE)

Budget is an open-source web application that helps you keep track of your finances.

You can use Budget by hosting it yourself, or using [the instance hosted by us](https://budget.pixely.me).

![Product](https://user-images.githubusercontent.com/9268822/46098425-a8877300-c1c4-11e8-9293-f43ceb9d6f97.png)

## Features

* Ability to organize spendings using tags
* Dashboard displaying monthly statistics about your spendings
* Available in multiple languages (English, Dutch, Danish, German)

## Installation

```
composer install --no-dev
yarn install

cp .env.example .env
php artisan key:generate

php artisan storage:link

php artisan migrate

yarn run development

php artisan serve

php artisan queue:work
```

In addition to this you will have to create a cronjob to trigger budgets scheduling.
(Without this, recurring transactions and weekly reports won't work)

```
* * * * * cd /path/to/budget/ && php artisan schedule:run >> 2>&1
```

It's best to make sure this command is run with the user that runs budget (eg. www-data)

## Contact

* [Discord](https://discord.gg/QFQdvy3)
