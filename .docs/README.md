# Comgate reference

The root README contains the first test-payment flow. Check a transaction with the existing status API:

```php
$response = $payments->status(PaymentStatus::of($transaction));

if ($response->isOk()) {
	$data = $response->getData();
}
```
