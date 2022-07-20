<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

use Brick\Math\RoundingMode;
use Brick\Money\Money;

class Refund extends AbstractEntity
{

	/** @var int */
	private $amount;

	/** @var string ISO 4217 */
	private $curr;

	/** @var string */
	private $transId;

    /** @var null|string */
    private $refId;

	final private function __construct()
	{
	}

	public static function of(
		Money $money,
		string $transId,
        string $refId = null
	): self
	{
		$p = new static();
		$p->amount = $money->multipliedBy(100, RoundingMode::UNNECESSARY)->getAmount()->toInt();
		$p->curr = $money->getCurrency()->getCurrencyCode();
		$p->transId = $transId;
        $p->refId = $refId;

		return $p;
	}

	public function getAmount(): int
	{
		return $this->amount;
	}

	public function getCurr(): string
	{
		return $this->curr;
	}

	public function getTransId(): string
	{
		return $this->transId;
	}

    public function getRefId(): string
    {
        return $this->refId;
    }


	/**
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		return [
			'amount' => $this->amount,
			'curr' => $this->curr,
			'transId' => $this->transId,
            'refId' => $this->refId,
		];
	}

}
