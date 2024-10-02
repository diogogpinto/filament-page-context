# Filament Panel Page Context

[![Latest Version on Packagist](https://img.shields.io/packagist/v/diogogpinto/filament-page-context.svg?style=flat-square)](https://packagist.org/packages/diogogpinto/filament-page-context)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/diogogpinto/filament-page-context/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/diogogpinto/filament-page-context/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/diogogpinto/filament-page-context/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/diogogpinto/filament-page-context/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/diogogpinto/filament-page-context.svg?style=flat-square)](https://packagist.org/packages/diogogpinto/filament-page-context)

A Filament plugin that automatically injects current request breadcrumbs and page title into the filament() method, enhancing context and navigation for admin panels. Developed with theme extensibility in mind, it seamlessly integrates with and allows further customization of Filament themes.

It currently returns the current request's Filament breadcrumbs (with Filament's structure) and Page Title (can be a Custom Page Title, Resource Related Title or Record Related Title).  

## Installation

You can install the package via composer:

```bash
composer require diogogpinto/filament-page-context
```

## Usage

Add the plugin to your Panel Provider

```php
public function panel(Panel $panel): Panel
{
    return $panel
        //your other methods
        ->plugins([
            \DiogoGPinto\FilamentPageContext\FilamentPageContextPlugin::make();
        ]);
}
```

### Getting Filament's current request breadrcrumbs

```php
$breadcrumbs = filament()->pageContext()->breadcrumbs;
```

### Getting Filament's current request page title

```php
$pageTitle = filament()->pageContext()->pageTitle;
```


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Diogo Pinto](https://github.com/diogogpinto)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
