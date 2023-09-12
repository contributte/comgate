<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Gateway;

use Brick\Money\Money;
use Contributte\Comgate\Comgate;
use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Entity\PaymentStatus;
use Contributte\Comgate\Entity\RecurringPayment;
use Contributte\Comgate\Entity\Refund;
use Contributte\Comgate\Entity\Response\PaymentResponse;
use Contributte\Comgate\Entity\Response\PaymentStatusResponse;
use Contributte\Comgate\Entity\Response\RecurringPaymentResponse;
use Contributte\Comgate\Entity\Response\RefundResponse;
use Contributte\Comgate\Entity\Response\StornoResponse;
use Contributte\Comgate\Entity\Storno;
use Contributte\Comgate\Gateway\PaymentService;
use Contributte\Comgate\Http\HttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

test(function (): void {
	$transactions = [];
	$mockHandler = new MockHandler();
	$handlerStack = HandlerStack::create(HandlerStack::create($mockHandler));
	$handlerStack->push(Middleware::history($transactions));
	$guzzleClient = new Client(['handler' => $handlerStack]);

	$mockHandler->append(new Response(200, [], 'code=0'));

	$service = new PaymentService(new HttpClient($guzzleClient, new Comgate('merchant1', 'mySecret', false)));
	$response = $service->create(Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	));

	Assert::type(PaymentResponse::class, $response);
	Assert::true($response->isOk());
	Assert::count(1, $transactions);
	Assert::equal('create', (string) $transactions[0]['request']->getUri()->getPath());
});

test(function (): void {
	$transactions = [];
	$mockHandler = new MockHandler();
	$handlerStack = HandlerStack::create(HandlerStack::create($mockHandler));
	$handlerStack->push(Middleware::history($transactions));
	$guzzleClient = new Client(['handler' => $handlerStack]);

	$mockHandler->append(new Response(200, [], 'code=0'));

	$service = new PaymentService(new HttpClient($guzzleClient, new Comgate('merchant1', 'mySecret', false)));
	$response = $service->recurring(RecurringPayment::of(
		'123-ABC-123',
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	));

	Assert::type(RecurringPaymentResponse::class, $response);
	Assert::true($response->isOk());
	Assert::count(1, $transactions);
	Assert::equal('recurring', (string) $transactions[0]['request']->getUri()->getPath());
});

test(function (): void {
	$transactions = [];
	$mockHandler = new MockHandler();
	$handlerStack = HandlerStack::create(HandlerStack::create($mockHandler));
	$handlerStack->push(Middleware::history($transactions));
	$guzzleClient = new Client(['handler' => $handlerStack]);

	$mockHandler->append(new Response(200, [], 'code=0'));

	$service = new PaymentService(new HttpClient($guzzleClient, new Comgate('merchant1', 'mySecret', false)));
	$response = $service->status(PaymentStatus::of('123-ABC-123'));

	Assert::type(PaymentStatusResponse::class, $response);
	Assert::true($response->isOk());
	Assert::count(1, $transactions);
	Assert::equal('status', (string) $transactions[0]['request']->getUri()->getPath());
});

test(function (): void {
	$transactions = [];
	$mockHandler = new MockHandler();
	$handlerStack = HandlerStack::create(HandlerStack::create($mockHandler));
	$handlerStack->push(Middleware::history($transactions));
	$guzzleClient = new Client(['handler' => $handlerStack]);

	$mockHandler->append(new Response(200, [], 'code=0'));

	$service = new PaymentService(new HttpClient($guzzleClient, new Comgate('merchant1', 'mySecret', false)));
	$response = $service->refund(Refund::of(
		Money::of(50, 'CZK'),
		'123-ABC-123',
	));

	Assert::type(RefundResponse::class, $response);
	Assert::true($response->isOk());
	Assert::count(1, $transactions);
	Assert::equal('refund', (string) $transactions[0]['request']->getUri()->getPath());
});

test(function (): void {
	$transactions = [];
	$mockHandler = new MockHandler();
	$handlerStack = HandlerStack::create(HandlerStack::create($mockHandler));
	$handlerStack->push(Middleware::history($transactions));
	$guzzleClient = new Client(['handler' => $handlerStack]);

	$mockHandler->append(new Response(200, [], 'code=0'));

	$service = new PaymentService(new HttpClient($guzzleClient, new Comgate('merchant1', 'mySecret', false)));
	$response = $service->storno(Storno::of('123-ABC-123'));

	Assert::type(StornoResponse::class, $response);
	Assert::true($response->isOk());
	Assert::count(1, $transactions);
	Assert::equal('cancel', (string) $transactions[0]['request']->getUri()->getPath());
});

test(function (): void {
	$transactions = [];
	$mockHandler = new MockHandler();
	$handlerStack = HandlerStack::create(HandlerStack::create($mockHandler));
	$handlerStack->push(Middleware::history($transactions));
	$guzzleClient = new Client(['handler' => $handlerStack]);

	$mockHandler->append(new Response(200, [], ''));

	$service = new PaymentService(new HttpClient($guzzleClient, new Comgate('merchant1', 'mySecret', false)));
	$response = $service->create(Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	));

	Assert::type(PaymentResponse::class, $response);
	Assert::false($response->isOk());
});
