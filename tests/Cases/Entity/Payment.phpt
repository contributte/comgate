<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Entity;

use Brick\Money\Money;
use Contributte\Comgate\Entity\Codes\CountryCode;
use Contributte\Comgate\Entity\Codes\LangCode;
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;
use Contributte\Comgate\Entity\Payment;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
		PaymentMethodCode::ALL_CARDS,
		CountryCode::CZ,
		LangCode::EN
	);
	Assert::equal([
		'price' => 5000,
		'curr' => 'CZK',
		'label' => 'Test item',
		'refId' => 'order101',
		'email' => 'dev@contributte.org',
		'fullName' => 'John Doe',
		'country' => 'CZ',
		'account' => null,
		'name' => null,
		'method' => 'CARD_ALL',
		'lang' => 'en',
		'prepareOnly' => 'true',
		'preauth' => 'false',
		'initRecurring' => 'false',
		'verification' => 'false',
		'embedded' => 'false',
	], $payment->toArray());
});

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
	);
	$payment->setEmbedded(true);
	Assert::equal('true', $payment->toArray()['embedded']);
});

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
	);
	$payment->setInitRecurring(true);
	Assert::equal('true', $payment->toArray()['initRecurring']);
});

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
	);
	$payment->setPreauth(true);
	Assert::equal('true', $payment->toArray()['preauth']);
});

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
	);
	$payment->setPrepareOnly(false);
	Assert::equal('false', $payment->toArray()['prepareOnly']);
});

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
	);
	$payment->setVerification(true);
	Assert::equal('true', $payment->toArray()['verification']);
});

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
	);
	$payment->setName('item101');
	Assert::equal('item101', $payment->toArray()['name']);
});

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
	);
	$payment->setAccount('acc1');
	Assert::equal('acc1', $payment->toArray()['account']);
});

Toolkit::test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		'John Doe',
	);
	$payment->setLang(LangCode::PL);
	Assert::equal('pl', $payment->toArray()['lang']);
});
