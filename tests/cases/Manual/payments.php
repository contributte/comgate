<?php declare(strict_types = 1);

use Contributte\Comgate\DI\ComgateExtension;
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;
use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Entity\PaymentStatus;
use Contributte\Comgate\Gateway\PaymentService;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;

require __DIR__ . '/../../../vendor/autoload.php';

function createContainer(): Container
{
	$loader = new ContainerLoader(__DIR__ . '/../../tmp/cache', false);
	$class = $loader->load(function (Compiler $compiler): void {
		$compiler->addExtension('comgate', new ComgateExtension())
			->addConfig([
				'comgate' => [
					'merchant' => '***',
					'secret' => '***',
					'test' => true,
				],
			]);
	}, __FILE__);

	/** @var Container $container */
	$container = new $class();

	return $container;
}

function createPayment(): void
{
	$container = createContainer();

	/** @var PaymentService $payments */
	$payments = $container->getByType(PaymentService::class);

	$payment = Payment::of(
		50,
		'CZK',
		'Test item',
		'test001',
		'dev@contributte.org',
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
