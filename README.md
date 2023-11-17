# Installation (Need PHP 8 or above)

### Create a database and update the .env file before running the commands below.

1. `composer install`
2. `php spark migrate --all`
3. `php spark migrate`
4. `php spark db:seed Admin`
5. `php spark db:seed Subscriptions`
6. `php spark db:seed PaymentMethods`
7. `php spark serve`

### Create an account for customers using registration form

# Developer Guide

### Billing table payment status: 
 - valid, invalid, cancelled, pending, expired, renewed