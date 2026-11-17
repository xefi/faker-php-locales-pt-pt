# Faker PHP — pt_PT locale

European Portuguese (`pt_PT`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-pt-pt
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('pt_PT');

$faker->name();
$faker->fullAddress();
$faker->personalNif();
```

The package provides `pt_PT` variants of the address, colors, company, financial, person, phone and text
extensions. Generators without a `pt_PT` variant fall back to the default locale.

### Locale-specific generators

| Method | Extension | Description |
| --- | --- | --- |
| `personalNif()` | `PersonExtension` | Personal NIF (starts with 1, 2 or 3) with a valid mod 11 check digit |
| `cartaoCidadao()` | `PersonExtension` | Cartão de Cidadão document number, `00000000 0 ZZ0`, with valid check digits |
| `nif()` | `CompanyExtension` | Company NIF / NIPC (starts with 5, 6 or 9) with a valid mod 11 check digit |
| `vat()` | `CompanyExtension` | VAT number, `PT` followed by the company NIF |
| `district()` | `AddressExtension` | One of the 18 mainland districts |
| `postcode()` | `AddressExtension` | Código postal in the `0000-000` format |
| `nib()` | `FinancialExtension` | 21-digit NIB with valid check digits |
| `iban()` | `FinancialExtension` | Portuguese IBAN (`PT50` followed by a valid NIB) |

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add or update an extension under `src/Extensions/` and register it in `FakerPtPtServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
