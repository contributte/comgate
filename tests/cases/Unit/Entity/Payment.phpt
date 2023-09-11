<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Entity;

use Brick\Money\Money;
use Contributte\Comgate\Entity\Codes\CountryCode;
use Contributte\Comgate\Entity\Codes\LangCode;
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;
use Contributte\Comgate\Entity\Payment;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
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

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setEmbedded(true);
	Assert::equal('true', $payment->toArray()['embedded']);
});

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setInitRecurring(true);
	Assert::equal('true', $payment->toArray()['initRecurring']);
});

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setPreauth(true);
	Assert::equal('true', $payment->toArray()['preauth']);
});

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setPrepareOnly(false);
	Assert::equal('false', $payment->toArray()['prepareOnly']);
});

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setVerification(true);
	Assert::equal('true', $payment->toArray()['verification']);
});

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setName('item101');
	Assert::equal('item101', $payment->toArray()['name']);
});

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setAccount('acc1');
	Assert::equal('acc1', $payment->toArray()['account']);
});

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setLang(LangCode::PL);
	Assert::equal('pl', $payment->toArray()['lang']);
});
