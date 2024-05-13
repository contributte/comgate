<?php declare(strict_types = 1);

use Brick\Money\Money;
use Contributte\Comgate\DI\ComgateExtension;
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;
use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Entity\PaymentStatus;
use Contributte\Comgate\Gateway\PaymentService;
use Contributte\Tester\Utils\ContainerBuilder;
use Nette\DI\Compiler;
use Nette\DI\Container;

require __DIR__ . '/../../../vendor/autoload.php';

function createContainer(): Container
{
	return ContainerBuilder::of()
		->withCompiler(function (Compiler $compiler): void {
			$compiler->addExtension('comgate', new ComgateExtension())
				->addConfig([
					'comgate' => [
						'merchant' => '***',
						'secret' => '***',
						'test' => true,
					],
				]);
		})->build();
}

function createPayment(): void
{
	$container = createContainer();

	/** @var PaymentService $payments */
	$payments = $container->getByType(PaymentService::class);

	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'test001',
		'dev@contributte.org',
		'John Doe',
		PaymentMethodCode::ALL
	);
	$res1 = $payments->create($payment);
	assert($res1->isOk() === true);
	// var_dump($res->getData());

	$res2 = $payments->status(PaymentStatus::of($res1->getData()['transId']));
	assert($res2->isOk() === true);
	// var_dump($res2->getData());
}

(function (): void {
	createPayment();
})();
