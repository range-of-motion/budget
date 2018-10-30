[![GitHub issues](https://img.shields.io/github/issues/range-of-motion/budget.svg)](https://github.com/range-of-motion/budget/issues)
[![GitHub stars](https://img.shields.io/github/stars/range-of-motion/budget.svg)](https://github.com/range-of-motion/budget/stargazers)
[![GitHub license](https://img.shields.io/github/license/range-of-motion/budget.svg)](https://github.com/range-of-motion/budget/blob/master/LICENSE)

# Budget

https://budget.pixely.me

Budget is an open-source web application that helps you keep track of your finances.

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

## Contact

* [Discord](https://discord.gg/QFQdvy3)