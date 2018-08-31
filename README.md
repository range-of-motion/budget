[![GitHub issues](https://img.shields.io/github/issues/range-of-motion/budget.svg)](https://github.com/range-of-motion/budget/issues)
[![GitHub stars](https://img.shields.io/github/stars/range-of-motion/budget.svg)](https://github.com/range-of-motion/budget/stargazers)
[![GitHub license](https://img.shields.io/github/license/range-of-motion/budget.svg)](https://github.com/range-of-motion/budget/blob/master/LICENSE)

# Budget

https://budget.pixely.me

Budget is an open-source web application that helps you keep track of your finances.

## Features

* Ability to organize spendings using tags
* Dashboard displaying monthly statistics about your spendings
* Available in multiple languages (English and Dutch, others are coming)

## Installation

1. Install Composer/Node.js dependencies

```
composer install
yarn install
```

2. Set-up .env

```
cp .env.example .env
php artisan key:generate
```

3. Set-up storage directory

`php artisan storage:link`

4. Run migrations and seed database

`php artisan migrate --seed`

5. Compile front-end assets

`yarn run development`

6. Serve

`php artisan serve`
