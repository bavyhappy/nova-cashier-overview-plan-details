# A Laravel Nova resource tool to manage your Cashier (Stripe) subscriptions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bavyhappy/nova-cashier-overview-plan-details.svg?style=flat-square)](https://packagist.org/packages/bavyhappy/nova-cashier-overview-plan-details)

[![Total Downloads](https://img.shields.io/packagist/dt/bavyhappy/nova-cashier-overview-plan-details.svg?style=flat-square)](https://packagist.org/packages/bavyhappy/nova-cashier-overview-plan-details)

This [Nova](https://nova.laravel.com) tool lets you:

- view a database plan (plan name is a parameter)
- view a database product (product name is a parameter)
- view a database subscription (subscription name is a parameter)
- view Stripe subscription details and plans name
- view invoices for a given subscription with a downloadable link
- change a subscription plan
- cancel a subscription
- resume a subscription
- avoid unnecessary Stripe API call when you load a resource to quickly get a status information and dive deeper if you need it

### Default view of the subscription

![screenshot of the initial Cashier overview tool](https://raw.githubusercontent.com/bavyhappy/nova-cashier-overview-plan-details/master/screenshots/initial.png)

### Expanded view of the subscription

![screenshot of the expanded Cashier overview tool](https://raw.githubusercontent.com/bavyhappy/nova-cashier-overview-plan-details/master/screenshots/expanded.png)

## Disclaimer

This package has been heavily inspired by [themsaid/nova-cashier-manager](https://github.com/themsaid/nova-cashier-manager) and was created to be in sync with latest changes in Cashier as well as to optimize default loads by avoiding a Stripe API request unless it's needed. Structure of this repository was inspired by [spatie/skeleton-nova-tool](https://github.com/spatie/skeleton-nova-tool).

## Installation

You can install the nova tool in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require bavyhappy/nova-cashier-overview-plan-details
```

Next up, you use the resource tool with Nova. This is typically done in the `fields` method of the desired Nova Resource.

## Database Migrations

In this packages the service provider registers its own database migration directory, so remember to migrate your database after installing the package.

```bash
php artisan migrate
```

If you need to overwrite the migrations that ship with Cashier, you can publish them using the vendor:publish Artisan command:

```bash
php artisan vendor:publish --tag="cashier-overview-details-migrations"
```

## Usage

```php
use Bavyhappy\NovaCashierOverviewPlanDetail;

// ...

public function fields(Request $request)
{
    return [
        ID::make()->sortable(),

        ...

        Subscription::make(),

        // if you want to display a specific subscription or multiple
        Subscription::make('a-fancy-subscription-name'),

        ...
    ];
}
```

### Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email info@davidecavallini.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
