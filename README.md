![](https://heatbadger.now.sh/github/readme/contributte/comgate/)

<p align=center>
    <a href="https://github.com/contributte/comgate/actions"><img src="https://badgen.net/github/checks/contributte/comgate"></a>
    <a href="https://coveralls.io/r/contributte/comgate"><img src="https://badgen.net/coveralls/c/github/contributte/comgate"></a>
    <a href="https://packagist.org/packages/contributte/comgate"><img src="https://badgen.net/packagist/dm/contributte/comgate"></a>
    <a href="https://packagist.org/packages/contributte/comgate"><img src="https://badgen.net/packagist/v/contributte/comgate"></a>
</p>
<p align=center>
    <a href="https://packagist.org/packages/contributte/comgate"><img src="https://badgen.net/packagist/php/contributte/comgate"></a>
    <a href="https://github.com/contributte/comgate"><img src="https://badgen.net/github/license/contributte/comgate"></a>
    <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
    <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
    <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
    Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

Comgate payment gateway integration for Nette applications.

## Versions

| State  | Version | Branch   | Nette  | PHP     |
|--------|---------|----------|--------|---------|
| dev    | `^0.6`  | `master` | `3.2+` | `>=8.2` |
| stable | `^0.5`  | `master` | `3.2+` | `>=8.1` |
| stable | `^0.4`  | `master` | `3.2+` | `>=8.1` |

## Installation

To install latest version of `contributte/comgate` use [Composer](https://getcomposer.org).

```bash
composer require contributte/comgate
```

Register the extension in your NEON configuration.

```neon
extensions:
	comgate: Contributte\Comgate\DI\ComgateExtension
```

## Quick start

Configure **test-only development credentials** and inject `PaymentService` into an application service:

```neon
comgate:
	merchant: 'test-merchant'
	secret: test-secret
	test: true
```

```php
use Brick\Money\Money;
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;
use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Gateway\PaymentService;

final class Payments
{
	public function __construct(private PaymentService $payments)
	{
	}

	public function create(): string
	{
		$response = $this->payments->create(Payment::of(
			Money::of(50, 'CZK'), 'Test item', 'test-001', 'dev@example.test', 'John Doe', PaymentMethodCode::ALL,
		));

		return $response->getRedirect() ?? '';
	}
}
```

A successful response provides a transaction ID and may provide the payment redirect URL through `getRedirect()`. Use real credentials only outside development; see [the detailed usage reference](.docs/README.md) for status lookups.

## Configuration

```neon
comgate:
	merchant: "12345678"
	secret: foobar
	test: true/false
```

## Development

See [how to contribute](https://contributte.org) to this package. This package is currently maintained by these authors.

<a href="https://github.com/f3l1x">
    <img width="80" height="80" src="https://avatars.githubusercontent.com/f3l1x">
</a>

-----

Consider to [support](https://contributte.org/partners) **contributte** development team.
Also thank you for using this package.
