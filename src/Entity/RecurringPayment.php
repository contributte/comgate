<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Contributte\Comgate\Entity\Codes\CountryCode;

class RecurringPayment extends AbstractPayment
{

	/** @var string */
	private $initRecurringId;

	final private function __construct()
	{
	}

	public static function of(
		string $initRecurringId,
		Money $money,
		string $label,
		string $refId,
		string $email,
		string $country = CountryCode::ALL,
	): self
	{
		$p = new static();
		$p->initRecurringId = $initRecurringId;
		$p->price = $money->multipliedBy(100, RoundingMode::UNNECESSARY)->getAmount()->toInt();
		$p->curr = $money->getCurrency()->getCurrencyCode();
		$p->label = $label;
		$p->refId = $refId;
		$p->email = $email;
		$p->country = $country;

		return $p;
	}

	public function getInitRecurringId(): int
	{
		return $this->price;
	}

	/**
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		return array_merge(parent::toArray(), [
			'prepareOnly' => 'true',
			'initRecurringId' => $this->initRecurringId,
		]);
	}

}
