# Contributte Comgate

## Content

- [Setup](#usage)
- [Configuration](#configuration)

## Setup

```bash
composer require contributte/comgate
```

```yaml
extensions:
    # Nette 3.0 +
    comgate: Contributte\Comgate\DI\ComgateExtension
    # Nette 2.4
    comgate: Contributte\Comgate\DI\ComgateExtension24
```

## Configuration

```yaml
comgate:
    merchant: e-shop_name # nazev obchodu v systemu ComGate - naleznete v Klientském portalu v sekci Integrace - Nastaveni obchodu - Propojeni obchodu
    secret: foobar
    test: true/false
```

## Usage

### Create payment

```php
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;
use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Gateway\PaymentService;

final class Payments
{

  /** @var PaymentService */
  private $paymentService;

  public function createPayment(array $data): array 
  {
    $payment = Payment::of(
        $data['price'] ?? 50,
        $data['currency'] ?? 'CZK',
        $data['label'] ?? 'Test item',
        $data['refId'] ?? 'order101',
        $data['email'] ?? 'dev@contributte.org',
        PaymentMethodCode::ALL
    );

    $res = $this->paymentService->create($payment);
    
    // $res->isOk();
    return $res->getData();
  }

}
```

### Status

```php
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;
use Contributte\Comgate\Entity\PaymentStatus;
use Contributte\Comgate\Gateway\PaymentService;

final class Payments
{

  /** @var PaymentService */
  private $paymentService;

  public function getStatus(string $transaction): array 
  {
    $res = $this->paymentService->status(PaymentStatus::from($transaction));
    
    // $res->isOk();
    return $res->getData();
  }

}
```
